<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    public function index()
    {
        // Fetch projects belonging to the authenticated user with alumnos relationship
        $projects = auth()->check() 
            ? auth()->user()->projects()->with('alumnos')->get() 
            : collect();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'estimated_hours' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'alumno_ids' => 'sometimes|array',
            'alumno_ids.*' => 'exists:alumnos,id'
        ]);

        // Create project for the authenticated user
        $project = auth()->user()->projects()->create([
            'title' => $validatedData['title'],
            'estimated_hours' => $validatedData['estimated_hours'],
            'start_date' => $validatedData['start_date']
        ]);

        // Sync students to the project if any are selected
        if (isset($validatedData['alumno_ids'])) {
            $project->alumnos()->sync($validatedData['alumno_ids']);
        }

        return redirect()->route('projects.index')
            ->with('success', 'El proyecto ha sido creado correctamente.');
    }

    public function edit(Project $project)
    {
        // Check if the current user owns the project
        if (Auth::id() !== $project->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        // Check if the current user owns the project
        if (Auth::id() !== $project->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'estimated_hours' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'alumno_ids' => 'sometimes|array',
            'alumno_ids.*' => 'exists:alumnos,id'
        ]);

        $project->update([
            'title' => $validatedData['title'],
            'estimated_hours' => $validatedData['estimated_hours'],
            'start_date' => $validatedData['start_date']
        ]);

        // Sync students to the project if any are selected
        if (isset($validatedData['alumno_ids'])) {
            $project->alumnos()->sync($validatedData['alumno_ids']);
        } else {
            // If no students are selected, detach all existing students
            $project->alumnos()->detach();
        }

        return redirect()->route('projects.index')
            ->with('success', 'El proyecto ha sido actualizado con éxito.');
    }

    public function show(Project $project)
    {
        // Check if the current user owns the project
        if (Auth::id() !== $project->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        // Check if the current user owns the project
        if (Auth::id() !== $project->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'El proyecto ha sido eliminado correctamente.');
    }

    public function assignStudents(Request $request, Project $project)
    {
        $validated = $request->validate([
            'alumno_ids' => 'required|array',
            'alumno_ids.*' => 'exists:alumnos,id'
        ]);

        // Ensure the user owns the project
        if (Auth::id() !== $project->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Sync the students to the project
        $project->alumnos()->sync($validated['alumno_ids']);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Estudiantes asignados al proyecto correctamente.');
    }

    public function removeStudentFromProject(Project $project, Alumno $alumno)
    {
        // Ensure the user owns the project
        if (Auth::id() !== $project->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $project->alumnos()->detach($alumno->id);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Estudiante eliminado del proyecto.');
    }
}
