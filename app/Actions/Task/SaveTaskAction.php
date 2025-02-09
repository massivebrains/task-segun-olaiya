<?php

namespace App\Actions\Task;

use App\DTO\Tasks\SaveTaskDTO;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class SaveTaskAction
{
    public function handle(User|Authenticatable $user, SaveTaskDTO $dto): Task
    {
        $project = $dto->project_id > 0
            ? Project::whereUserId($user->id)->firstOrFail()
            : Project::create(['user_id' => $user->id, 'name' => $dto->new_project_name]);

        return Task::updateOrCreate(
            ['id' => $dto->id, 'user_id' => $user->id],
            ['user_id' => $user->id, 'project_id' => $project->id, 'name' => $dto->name, 'priority' => $dto->priority]
        );
    }
}
