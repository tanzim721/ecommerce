<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CareerController extends Controller
{
    /**
     * Display a listing of jobs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employmentTypes = CareerJob::distinct()->pluck('employment_type')->filter()->values();
        $roles           = CareerJob::distinct()->pluck('role')->filter()->values();

        $jobs = CareerJob::all();
        // dd($jobs);

        return view('admin.career.index', compact('employmentTypes', 'roles', 'jobs'));
    }

    /**
     * Get jobs data for DataTables.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJobsData(Request $request)
    {
        $query = CareerJob::query();

        // Apply filters if provided
        if ($request->filled('employment_type')) {
            $query->where('employment_type', $request->employment_type);
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('company_name', 'like', "%{$searchTerm}%")
                    ->orWhere('role', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        return DataTables::of($query)
            ->addColumn('status', function ($job) {
                // Calculate if job is expired based on created_at + 30 days
                $expiryDate = Carbon::parse($job->created_at)->addDays(30);
                if (Carbon::now()->gt($expiryDate)) {
                    return 'expired';
                } else {
                    return 'active';
                }
            })
            ->make(true);
    }

    /**
     * Get unique roles for filter dropdown.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoles()
    {
        $roles = CareerJob::distinct()->pluck('role')->filter()->values();
        return response()->json($roles);
    }

    /**
     * Show the form for creating a new job.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employmentTypes = [
            'Full-time',
            'Part-time',
            'Contract',
            'Internship',
            'Freelance',
        ];

        return view('admin.career.create', compact('employmentTypes'));
    }

    /**
     * Store a newly created job in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'           => 'required|string|max:60',
            'employment_type' => 'required|string|max:50',
            'company_name'    => 'required|string|max:100',
            'role'            => 'required|string|max:80',
            'apply_url'       => 'required|url',
            'company_logo'    => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description'     => 'required|string',
            'salary'          => 'required|string|max:20',
        ]);

        // Process company logo
        if ($request->hasFile('company_logo')) {
            $logoPath                  = $request->file('company_logo')->store('company_logos', 'public');
            $validated['company_logo'] = Storage::url($logoPath);
        }

        // Create job
        $job = CareerJob::create($validated);

        return redirect()->route('career.index')
            ->with('success', 'Job listing created successfully');
    }

    /**
     * Display the specified job.
     *
     * @param  \App\Models\CareerJob  $careerJob
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $careerJob = CareerJob::findOrFail($id);
        return response()->json($careerJob);
    }

    /**
     * Show the form for editing the specified job.
     *
     * @param  \App\Models\CareerJob  $careerJob
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $career = CareerJob::findOrFail($id);

        $employmentTypes = [
            'Full-time',
            'Part-time',
            'Contract',
            'Internship',
            'Freelance',
        ];

        return view('admin.career.edit', compact('career', 'employmentTypes'));
    }

    /**
     * Update the specified job in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CareerJob  $careerJob
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $careerJob = CareerJob::findOrFail($id);

        $validated = $request->validate([
            'title'           => 'required|string|max:60',
            'employment_type' => 'required|string|max:50',
            'company_name'    => 'required|string|max:100',
            'role'            => 'required|string|max:80',
            'apply_url'       => 'required|url',
            'company_logo'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description'     => 'required|string',
            'salary'          => 'required|string|max:20',
        ]);

        // Process company logo if a new one is uploaded
        if ($request->hasFile('company_logo')) {
            // Delete old logo if it exists
            $oldPath = str_replace('/storage', '', $careerJob->company_logo);
            Storage::disk('public')->delete($oldPath);

            $logoPath                  = $request->file('company_logo')->store('company_logos', 'public');
            $validated['company_logo'] = Storage::url($logoPath);
        }

        // Update job
        $careerJob->update($validated);

        return redirect()->route('career.index')
            ->with('success', 'Job listing updated successfully');
    }

    /**
     * Remove the specified job from storage.
     *
     * @param  \App\Models\CareerJob  $careerJob
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $careerJob = CareerJob::findOrFail($id);

        // Delete company logo
        $path = str_replace('/storage', '', $careerJob->company_logo);
        Storage::disk('public')->delete($path);

        $careerJob->delete();

        return redirect()->route('career.index')
            ->with('success', 'Job listing deleted successfully');
    }

    /**
     * Export jobs data as CSV.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        $filename = 'jobs_export_' . Carbon::now()->format('Y-m-d_His') . '.csv';
        $headers  = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $jobs    = CareerJob::all();
        $columns = ['ID', 'Title', 'Employment Type', 'Company Name', 'Role', 'Apply URL',
            'Salary', 'Description', 'Created At', 'Updated At'];

        $callback = function () use ($jobs, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($jobs as $job) {
                $row = [
                    $job->id,
                    $job->title,
                    $job->employment_type,
                    $job->company_name,
                    $job->role,
                    $job->apply_url,
                    $job->salary,
                    strip_tags($job->description),
                    $job->created_at,
                    $job->updated_at,
                ];

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
