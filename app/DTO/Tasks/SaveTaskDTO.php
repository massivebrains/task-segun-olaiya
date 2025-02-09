<?php

namespace App\DTO\Tasks;

use App\DTO\BaseDTO;

final class SaveTaskDTO extends BaseDTO
{
    public ?int $id;

    public string $name;

    public int $priority;

    public ?int $project_id;

    public ?string $new_project_name;
}
