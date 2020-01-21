<?php


namespace App\Repositories;


use App\Models\Teacher;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class TeachersRepository extends  BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Teacher::class;
    }

    function getAllTeachersPaginated(): LengthAwarePaginator
    {
        return $this->getAllTeachersQuery()->paginate(5);
    }
    function getAllTeachers(): Collection
    {
        return $this->getAllTeachersQuery()->get();
    }
    function getTeacherById($id):Teacher{
        return $this->getAllTeachersQuery()->where('id','=',$id)->get()->first();
    }

    private function getAllTeachersQuery(): Builder
    {
        return Teacher::query()->select(['id','name','default_teacher_id']);
    }

    function storeTeacher($data):Teacher {
        return Teacher::create($data);

    }
}
