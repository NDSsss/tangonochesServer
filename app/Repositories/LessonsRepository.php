<?php


namespace App\Repositories;


use App\Models\Lesson;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LessonsRepository extends BaseRepository
{
    /**
     * @var StudentsLessonsLeftRepository
     */
    private $lessonsLeftRepository;

    /**
     * LessonsRepository constructor.
     * @param StudentsLessonsLeftRepository $lessonsLeftRepository
     */
    public function __construct(
        StudentsLessonsLeftRepository $lessonsLeftRepository
    )
    {
        $this->lessonsLeftRepository = $lessonsLeftRepository;
        parent::__construct();
    }


    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Lesson::class;
    }

    protected function getColumnsForSelect(): array
    {
        return ['id', 'name', 'group_id', 'created_at', 'updated_at'];
    }

    function getAllItemsQuery(): Builder
    {
        return parent::getAllItemsQuery()->orderByDesc('id'); // TODO: Change the autogenerated stub
    }


    protected function getPaginateCount(): int
    {
        return 10;
    }

    public function getAllStudentsOfLesson($id)
    {
        $lesson = Lesson::find($id);
        $studentsPresentOnLesson = $lesson->students;
        $allStudents = Student::query()->select(['id', 'name'])->get();
        foreach ($allStudents as $student) {
            if ($studentsPresentOnLesson->contains('id', $student->id)) {
                $student->selected = true;
            } else {
                $student->selected = false;
            }
        }
        return $allStudents;
    }

    public function getAllTeachersOfLesson($id)
    {
        $lesson = Lesson::find($id);
        $teachersPresentOnLesson = $lesson->teachers;
        $allTeachers = Teacher::all();

        foreach ($allTeachers as $teacher) {
            if ($teachersPresentOnLesson->contains('id', $teacher->id)) {
                $teacher['selected'] = true;
            } else {
                $teacher['selected'] = false;
            }
        }

        return $allTeachers;
    }

    function storeItem($data): Model
    {
        $studentIds = $data['present_students'];
        $studentIdsLog = json_encode($studentIds);
        $teachersIds = $data['present_teachers'];
        $dataLog = json_encode($data);
        \Log::debug("LessonsRepository storeItem studentIds $studentIdsLog dataLog $dataLog");

        $lesson = $this->model->fill($data);
        $eventType = $lesson->group->ticket_event_type_id;

        \DB::beginTransaction();
        $saveResult = $lesson->save();
        $lesson->teachers()->attach($teachersIds);
        $lesson->students()->attach($studentIds);
        $this->lessonsLeftRepository->decreaseStudentsLessonsLeftCount($studentIds, $eventType);
        if ($saveResult) {
            \DB::commit();
            return $lesson->refresh();
        } else {
            \DB::rollBack();
            return null;
        }
    }


    public function updateLesson($id, $data)
    {
        $lesson = $this->startConditions()::find($id);
//        dd($data['group_id'], $lesson->group_id);
        $dataLog = json_encode($data);
        \Log::debug("LessonsRepository pre updateLesson with data $dataLog id $id lesson $lesson");


        $oldStudentIds = \DB::table('lessons_students')->select(['student_id'])->where('lesson_id', '=', $id)->get()->map(function ($value) {
            return $value->student_id;
        });
        $newStudentIds = collect($data['present_students'])->map(function ($value) {
            return (int)$value;
        });

        $presentTeachers = $data['present_teachers'];
        $presentStudents = $data['present_students'];

        $groupsRepository = app(GroupsRepository::class);
        $oldGroup = $groupsRepository->getItemById($lesson->group_id);
        $newGroup = $groupsRepository->getItemById($data['group_id']);

        \DB::beginTransaction();
        if (count($oldStudentIds) > 0) {
            $this->lessonsLeftRepository->increaseStudentsLessonsLeftCount($oldStudentIds, $oldGroup->ticket_event_type_id);
        }
        if (count($newStudentIds) > 0) {
            $this->lessonsLeftRepository->decreaseStudentsLessonsLeftCount($newStudentIds, $newGroup->ticket_event_type_id);
        }

//        if ($oldGroup->ticket_event_type_id != $newGroup->ticket_event_type_id) {
//
//        } else {
//            $deletedStudents = [];
//            foreach ($oldStudentIds as $oldStudentId) {
//                if (!$newStudentIds->contains($oldStudentId)) {
//                    $deletedStudents[] = $oldStudentId;
//                }
//            }
//
//            $addedStudents = [];
//            foreach ($newStudentIds as $newStudentId) {
//                if (!$oldStudentIds->contains($newStudentId)) {
//                    $addedStudents[] = $newStudentId;
//                }
//            }
//
//            $deletedStudentsLog = json_encode($deletedStudents);
//            $deletedStudentsEmptyLog = json_encode(count($deletedStudents) > 0);
//            $addedStudentsLog = json_encode($addedStudents);
//            $addedStudentsEmptyLog = json_encode(count($addedStudents) > 0);
//            \Log::debug("LessonsRepository updatingLesson deletedStudentsLog $deletedStudentsLog is empty $deletedStudentsEmptyLog  addedStudentsLog $addedStudentsLog is empty $addedStudentsEmptyLog");
//
//            if (count($deletedStudents) > 0) {
//                $this->lessonsLeftRepository->increaseStudentsLessonsLeftCount($deletedStudents, $lesson->group->ticket_event_type_id);
//            }
//            if (count($addedStudents) > 0) {
//                $this->lessonsLeftRepository->decreaseStudentsLessonsLeftCount($addedStudents, $lesson->group->ticket_event_type_id);
//            }
//        }

        $lessonResult = $lesson->update($data);
        $teachersResult = $lesson->teachers()->sync($presentTeachers);
        $studentsResult = $lesson->students()->sync($presentStudents);

        if ($lessonResult && $studentsResult && $teachersResult) {
            \DB::commit();
//            dd($lesson,$lesson->);
            return $lesson->refresh();
        } else {
            \DB::rollBack();
            return false;
        }
    }

    function destroyItem($id)
    {
        \DB::beginTransaction();
        $lesson = $this->startConditions()::find($id);
        $teachersSyncResult = $lesson->teachers()->sync([]);
        $studentsSyncResult = $lesson->students()->sync([]);
        $teachersDetached = $teachersSyncResult['detached'];
        $studentsDetached = $studentsSyncResult['detached'];
        if (count($studentsDetached) > 0) {
            $this->lessonsLeftRepository->increaseStudentsLessonsLeftCount($studentsDetached, $lesson->group->ticket_event_type_id);
        }
        $lessonLog = json_encode($lesson);
        $studentsDetachedLog = json_encode($studentsDetached);
        $deleteLesson = $lesson->delete();
        $result = $deleteLesson;
        \Log::debug("LessonsRepository destroyItem id $id lesson $lessonLog studentsDetached $studentsDetachedLog result $result");
        if ($result) {
            \DB::commit();
        } else {
            \DB::rollBack();
        }
        return $result;
    }


}
