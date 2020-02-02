<?php


namespace App\Repositories;


use App\Models\LessonAnnounce;
use Illuminate\Database\Eloquent\Builder;

class LessonAnnouncesRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return LessonAnnounce::class;
    }

    protected function getColumnsForSelect(): array
    {
        return ['id', 'name', 'first_lesson_time', 'second_lesson_time', 'ticket_event_type_id', 'address'];
    }

    protected function getPaginateCount(): int
    {
        return 10;
    }

    function getAllItemsWithRelationsQuery(): Builder
    {
        return $this->getAllItemsQuery()->with('group:id,name');
    }


    public function getAllEvents(){
        $activeLessonAnnounces = $this->getAllItemsWithRelationsQuery()->where('is_active','=', true)->get();
        return $activeLessonAnnounces;
    }
}
