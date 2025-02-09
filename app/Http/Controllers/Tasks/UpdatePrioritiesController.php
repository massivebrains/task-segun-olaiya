<?php

namespace App\Http\Controllers\Tasks;

use App\Actions\Task\UpdatePrioritiesAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UpdatePrioritiesController extends Controller
{
    public function __invoke(Request $request)
    {
        (new UpdatePrioritiesAction)->handle(
            Auth::user(),
            $request->array('tasks') ?? [],
        );

        return Redirect::back();
    }
}
