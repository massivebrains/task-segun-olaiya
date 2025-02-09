<?php

namespace App\Http\Controllers\Tasks;

use App\Actions\Task\SaveTaskAction;
use App\DTO\Tasks\SaveTaskDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\SaveTaskRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SaveTaskController extends Controller
{
    public function __invoke(SaveTaskRequest $request)
    {
        (new SaveTaskAction)->handle(Auth::user(), SaveTaskDTO::make([
            'id' => $request->integer('id'),
            'name' => $request->input('name'),
            'priority' => $request->integer('priority'),
            'project_id' => $request->integer('project_id'),
            'new_project_name' => $request->input('new_project_name'),
        ]));

        return Redirect::back();
    }
}
