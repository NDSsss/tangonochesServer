<?php

namespace App\Observers;

use App\Models\Ticket;
use App\Repositories\StudentsLessonsLeftRepository;

class TicketObserver
{

    public function creating(Ticket $ticket)
    {
        \Log::debug("creating ticket original $ticket");
        \Log::debug("creating ticket new $ticket");
        $lessonsLeftRepository = app(StudentsLessonsLeftRepository::class);
        $result = $lessonsLeftRepository->registerTicket($ticket);
        return $result > -1;
    }

    /**
     * Handle the ticket "created" event.
     *
     * @param \App\Models\Ticket $ticket
     * @return void
     */
    public function created(Ticket $ticket)
    {
        \Log::debug("created ticket $ticket");
        $lessonsLeftRepository = app(StudentsLessonsLeftRepository::class);
        $this->registredTicketRowId = $lessonsLeftRepository->registerTicketId($ticket);

    }

    public function updating(Ticket $ticket)
    {
        \Log::debug("updating ticket {$ticket->getDirty()}");
    }

    /**
     * Handle the ticket "updated" event.
     *
     * @param \App\Models\Ticket $ticket
     * @return void
     */
    public function updated(Ticket $ticket)
    {
        \Log::debug("updated ticket $ticket");
    }

    /**
     * Handle the ticket "deleted" event.
     *
     * @param \App\Models\Ticket $ticket
     * @return void
     */
    public function deleted(Ticket $ticket)
    {
        \Log::debug("deleted ticket $ticket");
    }

    /**
     * Handle the ticket "restored" event.
     *
     * @param \App\Models\Ticket $ticket
     * @return void
     */
    public function restored(Ticket $ticket)
    {
        \Log::debug("restored ticket $ticket");
    }

    /**
     * Handle the ticket "force deleted" event.
     *
     * @param \App\Models\Ticket $ticket
     * @return void
     */
    public function forceDeleted(Ticket $ticket)
    {
        \Log::debug("forceDeleted ticket $ticket");
    }
}
