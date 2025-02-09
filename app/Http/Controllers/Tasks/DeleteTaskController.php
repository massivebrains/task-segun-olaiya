<?php

namespace App\Http\Controllers\Tasks;

use App\Actions\Task\DeleteTaskAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\DeleteTaskRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DeleteTaskController extends Controller
{
    public function __invoke(DeleteTaskRequest $request)
    {
        (new DeleteTaskAction)->handle(Auth::user(), $request->input('id'));

        return Redirect::back();
    }
}
