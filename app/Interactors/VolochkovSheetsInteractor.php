<?php


namespace App\Interactors;


class VolochkovSheetsInteractor
{

    function getSheetsUrl()
    {
        return env('VOLOCHKOV_SHEETS_URL');
    }

    function registerLessonVisits($lesson, $studentIds)
    {
        $request = [];
        $request['action'] = 'register_lesson_visits';
        $students = [];
        $lessonId = $lesson->id;
        foreach ($lesson->students as $student) {
            $currentStudentId = $student->id;
            if (is_array($studentIds) && in_array($currentStudentId, $studentIds)) {
                $item = [];
                $item['name'] = $student->name;
                $item['visit_id'] = $lessonId .'0'. $student->id;
                $students[] = $item;
            }
        }
        $request['students'] = $students;
        $requestJson = json_encode($request);

        $client = new \GuzzleHttp\Client();
        $url = $this->getSheetsUrl();
        \Log::debug('registerLessonVisits'.json_encode($lessonId).json_encode($students));
//        dd('registerLessonVisits', $lessonId, $students);

        $apiRequest = $client->post($url, ['body' => $requestJson]);
    }

    function unregisterLessonVisits($lesson, $studentIds)
    {
        $request = [];
        $request['action'] = 'unregister_lesson_visits';
        $students = [];
        $lessonId = $lesson->id;
        foreach ($studentIds as $idToDelete) {
            $item = [];
            $item['visit_id'] = $lessonId .'0'. $idToDelete;
            $students[] = $item;
        }
        $request['students'] = $students;
        $requestJson = json_encode($request);

        $client = new \GuzzleHttp\Client();
        $url = $this->getSheetsUrl();
        \Log::debug('registerLessonVisits'.json_encode($lessonId).json_encode($students));
//        dd('unregisterLessonVisits', $lessonId, $students);

        $apiRequest = $client->post($url, ['body' => $requestJson]);
    }

    function updateStudent($student)
    {
        $request = [];
        $request['action'] = 'update_student';
        $requestStudent = [];

        $requestStudent['name'] = $student->name;
        $requestStudent['group'] = '';
        $requestStudent['phone'] = $student->phone;
        $requestStudent['vk_link'] = $student->vk_profile_link;
        $requestStudent['photo_link'] = $student->photo_link;
        $requestStudent['extra_inf'] = $student->extra_info;
        $requestStudent['push_token'] = $student->push_token;
        $requestStudent['ticket_id'] = $student->barcode_id;
        $requestStudent['vk_id'] = $student->vk_profile_id;
        $requestStudent['facebook_link'] = $student->facebook_profile_link;
        $requestStudent['facebook_id'] = $student->facebook_profile_id;
        $requestStudent['instagram_link'] = $student->instagram_profile_link;
        $requestStudent['instagram_id'] = $student->instagram_profile_id;

        $request['student'] = $requestStudent;
        $requestJson = json_encode($request);
        $client = new \GuzzleHttp\Client();
        $url = $this->getSheetsUrl();

        $apiRequest = $client->post($url, ['body' => $requestJson]);
    }

    function registerTicket($ticket)
    {
        $request = [];
        $request['action'] = 'add_record_to_journal';
        $record = [];

        $record['recordDate'] = $ticket->ticket_bought_date;
        $record['ticketEndDate'] = $ticket->ticket_end_date;
        $record['ticketStartDate'] = $ticket->ticket_start_date;

        switch ($ticket->ticket_count_type_id) {
            case 1:
                $recordType = 'Покупка абонемента на 4 урока';
                break;
            case 2:
                $recordType = 'Покупка абонемента на 8 уроков';
                break;
            case 3:
                $recordType = 'Покупка абонемента на 12 уроков';
                break;
            case 4:
                $recordType = 'Оплата разового посещения';
                break;
            default:
                $recordType = '';
                break;
        }
        $record['recordType'] = $recordType;

        $record['studentName'] = $ticket->student->name;

        if ($ticket->is_in_pair) {
            $extraInfo = 'Парный абонемент по скидке';
        } else {
            $extraInfo = '';
        }
        $record['extraInfo'] = $extraInfo;

        $request['record'] = $record;
        $requestJson = json_encode($request);
        $client = new \GuzzleHttp\Client();
        $url = $this->getSheetsUrl();

        $apiRequest = $client->post($url, ['body' => $requestJson]);
    }
}
