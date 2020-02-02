<?php


namespace App\Repositories;


use App\Models\EventAnnounce;

class EventAnnouncesRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return EventAnnounce::class;
    }

    protected function getColumnsForSelect(): array
    {
        return ['id', 'name', 'first_lesson_time', 'second_lesson_time', 'ticket_event_type_id', 'address'];
    }

    protected function getPaginateCount(): int
    {
        return 10;
    }

    public function getAllAnnounces(){
        $allAnnounces = $this->getAllItemsQuery()->where('is_active','=', true)->get();
        return $allAnnounces;
    }
}
