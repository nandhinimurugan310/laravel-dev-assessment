<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function index(Request $request)
    {
        // Fetch jobs based on search criteria
        $jobs = Job::query()
            ->when($request->title, function ($query) use ($request) {
                $query->where('title', 'like', "%{$request->title}%")
                      ->orWhere('company_name', 'like', "%{$request->title}%")
                      ->orWhere('extra_info', 'like', "%{$request->title}%");
            })
            ->when($request->location, function ($query) use ($request) {
                $query->where('location', 'like', "%{$request->location}%");
            })
            ->get();

        // Return data to the Inertia view
        return Inertia::render('Dashboard', [
            'jobs' => $jobs->isEmpty() ? [] : $jobs->map(function ($job) {
                return [
                    'id' => $job->id,
                    'title' => $job->title,
                    'company_name' => $job->company_name,
                    'experience' => $job->experience,
                    'salary' => $job->salary,
                    'location' => $job->location,
                    'description' => $job->description,
                    'company_logo' => $job->company_logo,
                    'created_at' => $job->created_at,
                    'skills' => $job->skills_names,
                    'extra_info' => $job->extra_info ? explode(',', $job->extra_info) : []
                ];
            })
        ]);
    }
}
