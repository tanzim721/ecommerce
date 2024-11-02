<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CareerJob;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $jobs = CareerJob::when($request->search, function ($query) use ($request){
          return $query->where('title', 'LIKE', "%{$request->search}%"); 
        })->latest()->get();
        return view('home.job.view', ['jobs' => $jobs]);
    }
}
