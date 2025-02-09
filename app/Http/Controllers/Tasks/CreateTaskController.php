<?php

namespace App\Http\Controllers\Tasks;

use App\Actions\Task\CreateTaskAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CreateTaskController extends Controller
{
    public function __invoke(CreateTaskRequest $request)
    {
        (new CreateTaskAction)->handle(
            Auth::user(),
            $request->input('name'),
            $request->input('priority'),
        );

        return Redirect::back();
    }
}
