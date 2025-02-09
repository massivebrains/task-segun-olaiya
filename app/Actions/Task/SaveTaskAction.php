<?php

namespace App\Actions\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class SaveTaskAction
{
    public function handle(User|Authenticatable $user, ?int $id, string $name, int $priority = 0): Task
    {
        return Task::updateOrCreate(
            ['id' => $id, 'user_id' => $user->id],
            ['user_id' => $user->id, 'name' => $name, 'priority' => $priority]
        );
    }
}
