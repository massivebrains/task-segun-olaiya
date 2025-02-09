<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class GetTasksController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Dashboard', [
            'tasks' => Task::whereUserId(Auth::user()->id)->with('project')->orderBy('priority')->get(),
            'projects' => Project::whereUserId(Auth::user()->id)->get(),
        ]);
    }
}
