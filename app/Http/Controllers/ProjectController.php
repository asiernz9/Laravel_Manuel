<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Auth::user()->projects;
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'estimated_hours' => 'required|integer|min:1',
            'start_date' => 'required|date'
        ]);

        $project = Auth::user()->projects()->create($validated);

        return redirect()->route('projects.index')
            ->with('success', 'El proyecto ha sido creado correctamente.');
    }

    public function edit(Project $project)
    {
        // Instead of using authorize, check ownership directly
        if (Auth::id() !== $project->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        // Instead of using authorize, check ownership directly
        if (Auth::id() !== $project->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'estimated_hours' => 'required|integer|min:1',
            'start_date' => 'required|date'
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')
            ->with('success', 'El proyecto ha sido actualizado con éxito.');
    }

    public function show(Project $project)
    {
        // Instead of using authorize, check ownership directly
        if (Auth::id() !== $project->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        // Instead of using authorize, check ownership directly
        if (Auth::id() !== $project->user_id) {
            abort(403, 'Unauthorized action.');
        }
        $project->delete();
        return redirect()->route('projects.index')
            ->with('success', 'El proyecto ha sido eliminado correctamente.');
    }
}
