<?php


namespace App\Repositories;


use App\Models\StudentsTicketTypesLessonsLeft;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;

class StudentsLessonsLeftRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * CoreRepository constructor.
     */
    public function __construct()
    {
        $this->model = app(StudentsTicketTypesLessonsLeft::class);
    }

    public function getAllItemsPaginated()
    {
        return $this->getAllItems()->paginate(10);
    }

    public function getAllItems()
    {
        return $this->startConditions()::query()->select()->with(['student:id,name', 'ticketEventType:id,name'])->orderByDesc('id');
    }

    private function startConditions()
    {
        return $this->model;
    }

    function createItem(): Model
    {
        return $this->startConditions()::make();
    }

    function storeItem($data): Model
    {
        return $this->startConditions()::create($data);
    }

    function getItemById($id): Model
    {
        return $this->getAllItems()->where('id', '=', $id)->get()->first();
    }

    function updateItem($data, $id)
    {
        $group = $this->getItemById($id);
        $result = $group->update($data);
        return $result;
    }

    function destroyItem($id)
    {
        return $this->startConditions()::destroy($id);
    }

    function decreaseStudentsLessonsLeftCount($studentIds, $lessonTypeId)
    {
        $studentIdsLog = json_encode($studentIds);
        \Log::debug("StudentsLessonsLeftRepository decreaseStudentsLessonsLeftCount studentIds $studentIdsLog lessonTypeId $lessonTypeId");
        foreach ($studentIds as $id) {
            $found = $this->startConditions()::query()->select()
                ->where('student_id', '=', $id)
                ->where('ticket_event_type_id', '=', $lessonTypeId)
                ->get();

            if ($found->isEmpty()) {
                $this->createAndSaveItem($id, $lessonTypeId, -1, 1);
            } else {
                $changingItem = $found->first();
                $changingItem->lessons_left--;
                $changingItem->save();
                \Log::debug("saved $changingItem");
            }
        }

        return true;
    }


    function increaseStudentsLessonsLeftCount($studentIds, $lessonTypeId)
    {
        $studentIdsLog = json_encode($studentIds);
        \Log::debug("StudentsLessonsLeftRepository increaseStudentsLessonsLeftCount studentIds $studentIdsLog lessonTypeId $lessonTypeId");
        foreach ($studentIds as $id) {
            $found = $this->startConditions()::query()->select()
                ->where('student_id', '=', $id)
                ->where('ticket_event_type_id', '=', $lessonTypeId)
                ->get();

            if ($found->isEmpty()) {
                $this->createAndSaveItem($id, $lessonTypeId, 1, 1);
            } else {
                $changingItem = $found->first();
                $changingItem->lessons_left++;
                $changingItem->save();
                \Log::debug("saved $changingItem");
            }
        }

        return true;
    }

    private function createAndSaveItem(int $studentId, int $lessonTypeId, int $count, $ticketId): int
    {
        $newItem = new StudentsTicketTypesLessonsLeft;
        $newItem->lessons_left = $count;
        $newItem->student_id = $studentId;
        $newItem->ticket_event_type_id = $lessonTypeId;
        if ($ticketId != null) {
            $newItem->ticket_id = $ticketId;
        }
        $newItem->save();
        \Log::debug("created $newItem");
        $saveResult = $newItem->save();
        if ($saveResult) {
            $foundItem = $this->startConditions()->newQuery()->select()
                ->where(['lessons_left' => $count, 'student_id' => $studentId, 'ticket_event_type_id' => $lessonTypeId])
                ->get()->first();
            return $foundItem->id;
        } else {
            return -1;
        }
    }

    public function registerTicket(Ticket $ticket): int
    {
        \Log::debug("registerTicket ticket $ticket");
        $found = $this->startConditions()::query()->select()
            ->where('student_id', '=', $ticket->student_id)
            ->where('ticket_event_type_id', '=', $ticket->ticket_event_type_id)
            ->get();
        if ($found->isEmpty()) {
            \Log::debug('registerTicket found isEmpty');
            $createdItemId = $this->createAndSaveItem($ticket->student_id, $ticket->ticket_event_type_id, $ticket->ticketCountType->lessons_count, $ticket->id);
            return $createdItemId;
        } else {
            $foundItem = $found->first();
            \Log::debug("registerTicket foundItem $foundItem");
            if ($ticket->is_nullify) {
                $foundItem->lessons_left = $ticket->ticketCountType->lessons_count;
            } else {
                $foundItem->lessons_left = $ticket->ticketCountType->lessons_count + $foundItem->lessons_left;
            }
            $foundItem->save();
            return $foundItem->id;
        }
    }

    public function registerTicketId(Ticket $ticket)
    {
        \Log::debug("registerTicketId ticket $ticket");
        $updatingItem = $this->startConditions()->newQuery()->select()
            ->where('student_id', '=', $ticket->student_id)
            ->where('ticket_event_type_id', '=', $ticket->ticket_event_type_id)
            ->get()->first();
        $updatingItem->ticket_id = $ticket->id;
        $updatingItem->save();
    }
}
