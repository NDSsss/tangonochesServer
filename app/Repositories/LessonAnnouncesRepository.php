<?php


namespace App\Repositories;


use App\Models\LessonAnnounce;

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
}
