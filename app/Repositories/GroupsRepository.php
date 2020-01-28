<?php


namespace App\Repositories;


use App\Models\Group;
use Illuminate\Database\Eloquent\Builder;

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
        return ['id', 'name', 'first_lesson_time', 'second_lesson_time', 'ticket_event_type_id', 'address'];
    }

    function getAllItemsWithRelationsQuery(): Builder
    {
        return $this->getAllItemsQuery()->with(['ticketEventType:id,name']);
    }

    protected function getPaginateCount(): int
    {
        return 10;
    }
}
