<?php

namespace App\Actions\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class CreateTaskAction
{
    public function handle(User|Authenticatable $user, string $name, int $priority = 0): Task
    {
        return Task::create(['user_id' => $user->id, 'name' => $name, 'priority' => $priority]);
    }
}
