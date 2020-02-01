<?php

namespace App\Observers;

use App\Models\Lesson;

class LessonsObserver
{
    public function creating(Lesson $lesson)
    {
        \Log::debug("Lesson creating $lesson");
    }

    /**
     * Handle the lesson "created" event.
     *
     * @param \App\Models\Lesson $lesson
     * @return void
     */
    public function created(Lesson $lesson)
    {
        \Log::debug("Lesson created $lesson");
    }

    public function updating(Lesson $lesson)
    {
        \Log::debug("Lesson updating $lesson dirty {$lesson->getDirty()}");
    }

    /**
     * Handle the lesson "updated" event.
     *
     * @param \App\Models\Lesson $lesson
     * @return void
     */
    public function updated(Lesson $lesson)
    {
        \Log::debug("Lesson updated $lesson");
    }

    /**
     * Handle the lesson "deleted" event.
     *
     * @param \App\Models\Lesson $lesson
     * @return void
     */
    public function deleted(Lesson $lesson)
    {
        //
    }

    /**
     * Handle the lesson "restored" event.
     *
     * @param \App\Models\Lesson $lesson
     * @return void
     */
    public function restored(Lesson $lesson)
    {
        //
    }

    /**
     * Handle the lesson "force deleted" event.
     *
     * @param \App\Models\Lesson $lesson
     * @return void
     */
    public function forceDeleted(Lesson $lesson)
    {
        //
    }
}