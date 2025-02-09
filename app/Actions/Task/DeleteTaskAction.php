<?php

namespace App\Actions\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class DeleteTaskAction
{
    public function handle(User|Authenticatable $user, int $id)
    {
        Task::where(['id' => $id, 'user_id' => $user->id])->delete();
    }
}
