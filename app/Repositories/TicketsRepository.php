<?php


namespace App\Repositories;


use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TicketsRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Ticket::class;
    }

    protected function getColumnsForSelect(): array
    {
        return ['id', 'ticket_start_date', 'ticket_end_date',
            'ticket_bought_date', 'ticket_count_type_id', 'ticket_event_type_id',
            'student_id', 'teacher_id', 'is_in_pair',
        ];
    }

    protected function getPaginateCount(): int
    {
        return 10;
    }

    function getAllItemsWithRelationsQuery(): Builder
    {
        return parent::getAllItemsWithRelationsQuery()->with(['student:id,name', 'teacher:id,name', 'ticketEventType:id,name', 'ticketCountType:id,name']);
    }

    function storeItem($data): Model
    {
        if (array_key_exists('is_in_pair', $data) && $data['is_in_pair']==true) {
            $data['is_in_pair'] = true;
        } else{
            $data['is_in_pair'] = false;
        }
        return parent::storeItem($data); // TODO: Change the autogenerated stub
    }


    function updateItem($data, $id)
    {
        if (array_key_exists('is_in_pair', $data) && $data['is_in_pair']==true) {
            $data['is_in_pair'] = true;
        } else{
            $data['is_in_pair'] = false;
        }
        return parent::updateItem($data, $id); // TODO: Change the autogenerated stub
    }

}