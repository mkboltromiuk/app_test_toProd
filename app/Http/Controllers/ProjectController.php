<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $project = Project::create([
            'name' => $request->name,
        ]);

        return redirect()->route('project.snippet', $project->id);
    }

    public function showSnippet($projectId)
    {
        $project = Project::find($projectId);

        if (!$project) {
            return redirect()->back()->with('error', 'Project not found');
        }

        $snippet = "<script src=\"http://localhost:8000/js/widget.js\" data-api-key=\"{$project->key}\"></script>";

        return view('projects.snippet', ['snippet' => $snippet]);
    }
}