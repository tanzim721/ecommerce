<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CareerJob;
use Illuminate\Http\Request;

class JobDetailsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, CareerJob $job)
    {
        // dd($job);
        return view('home.job.job_details', ['job' => $job]);
    }
}
