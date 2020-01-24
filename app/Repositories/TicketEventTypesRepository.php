<?php


namespace App\Repositories;


use App\Models\TicketEventType;

class TicketEventTypesRepository extends BaseRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return TicketEventType::class;
    }

    protected function getColumnsForSelect(): array
    {
        return ['id', 'name'];
    }

    protected function getPaginateCount(): int
    {
        return 10;
    }
}
