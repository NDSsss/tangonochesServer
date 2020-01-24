<?php


namespace App\Repositories;


use App\Models\TicketCountType;

class TicketCountTypesRepository extends BaseRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return TicketCountType::class;
    }

    protected function getColumnsForSelect(): array
    {
        return ['id', 'name', 'price', 'lessons_count'];
    }

    protected function getPaginateCount(): int
    {
        return 10;
    }
}
