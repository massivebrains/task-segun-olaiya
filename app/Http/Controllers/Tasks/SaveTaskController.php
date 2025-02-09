<?php

namespace App\Http\Controllers\Tasks;

use App\Actions\Task\SaveTaskAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\SaveTaskRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SaveTaskController extends Controller
{
    public function __invoke(SaveTaskRequest $request)
    {
        (new SaveTaskAction)->handle(
            Auth::user(),
            $request->input('id'),
            $request->input('name'),
            $request->input('priority'),
        );

        return Redirect::back();
    }
}
