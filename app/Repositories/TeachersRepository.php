<?php


namespace App\Repositories;


use App\Models\Teacher;

class TeachersRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Teacher::class;
    }

    protected function getColumnsForSelect(): array
    {
        return ['id', 'name', 'default_teacher_id'];
    }

    protected function getPaginateCount(): int
    {
        return 10;
    }
}
