<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Project $project)
    {
        // User can only update their own projects
        return $user->id === $project->user_id;
    }

    public function delete(User $user, Project $project)
    {
        // User can only delete their own projects
        return $user->id === $project->user_id;
    }

    public function view(User $user, Project $project)
    {
        // User can only view their own projects
        return $user->id === $project->user_id;
    }
}