<?php


namespace App\Repositories;


use App\Models\Group;

class GroupsRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Group::class;
    }

    protected function getColumnsForSelect(): array
    {
        return ['id', 'name', 'first_lesson_time', 'second_lesson_time', 'address'];
    }

    protected function getPaginateCount(): int
    {
        return 10;
    }
}
