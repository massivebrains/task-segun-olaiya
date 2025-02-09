<?php

namespace App\Actions\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class UpdatePrioritiesAction
{
    public function handle(User|Authenticatable $user, array $tasks)
    {
        $supportedTasks = Task::whereUserId($user->id)->whereIn('id', array_column($tasks, 'id'))->get();
        foreach ($supportedTasks as $task) {
            $task->update([
                'priority' => collect($tasks)->firstWhere('id', $task->id)['priority'],
            ]);
        }
    }
}
