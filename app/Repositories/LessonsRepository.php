<?php


namespace App\Repositories;


use App\Models\Lesson;

class LessonsRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Lesson::class;
    }

    protected function getColumnsForSelect(): array
    {
        return ['id', 'name', 'group_id', 'created_at', 'updated_at'];
    }

    protected function getPaginateCount(): int
    {
        return 10;
    }
}
