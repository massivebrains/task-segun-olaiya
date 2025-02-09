<?php

namespace Tests\Feature\Actions\Tasks;

use App\Actions\Task\SaveTaskAction;
use App\DTO\Tasks\SaveTaskDTO;
use App\Models\User;
use Tests\TestCase;

class SaveTaskActionTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_handle(): void
    {
        $user = User::factory()->create();
        $task = (new SaveTaskAction)->handle(
            $user,
            new SaveTaskDTO([
                'id' => 0,
                'project_id' => 0,
                'new_project_name' => 'Test Project',
                'name' => 'Test Task',
                'priority' => 2,
            ])
        );

        $this->assertDatabaseHas('projects', ['id' => $task->project_id]);
        $this->assertDatabaseHas('tasks', ['user_id' => $user->id, 'project_id' => $task->project_id, 'name' => 'Test Task']);
    }

    // We can add more tests here (And even other actions).. But you already get the idea
}
