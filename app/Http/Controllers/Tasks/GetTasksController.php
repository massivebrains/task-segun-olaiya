<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Inertia\Inertia;

class GetTasksController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Dashboard', [
            'tasks' => Task::orderBy('priority')->get(),
        ]);
    }
}
