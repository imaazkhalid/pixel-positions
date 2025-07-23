<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()->with(['employer', 'tags'])->get()->groupBy('featured');

        return view('jobs.index', [
            'jobs' => $jobs[0],
            'featuredJobs' => $jobs[1],
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'max:100'],
            'salary' => ['required', 'max:50'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time', 'Temporary'])],
            'url' => ['required', 'active_url'],
            'tags' => [
                'nullable', 'max:50',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        // Split tags, trim whitespace, and filter out empty strings
                        $tags = array_filter(array_map('trim', explode(',', $value)));

                        if (count($tags) > 3) {
                            $fail('You can only provide a maximum of 3 tags.');
                        }
                    }
                },
            ],
        ]);

        $attributes['featured'] = $request->has('featured');

        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

        if ($attributes['tags'] ?? false) {
            // Re-process tags to ensure consistency with validation's trimming/filtering
            $tagsToAttach = array_filter(array_map('trim', explode(',', $attributes['tags'])));
            foreach ($tagsToAttach as $tag) {
                $job->tag($tag);
            };
        }

        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }
}
