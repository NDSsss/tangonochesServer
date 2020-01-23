<?php


namespace App\Repositories;


use App\Models\Student;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class StudentsRepository extends BaseRepository
{

    function getAllStudentsPaginated(): LengthAwarePaginator
    {
        return $this->getAllStudentsQuery()->paginate(10);
    }
    function getAllStudents(): Collection
    {
        return $this->getAllStudentsQuery()->get();
    }
    function getStudentById($id):Student{
        return $this->getAllStudentsQuery()->where('id','=',$id)->get()->first();
    }

    private function getAllStudentsQuery(): Builder
    {
        return Student::query()->select(['id','name','phone',
            'vk_profile_link','vk_profile_id',
            'facebook_profile_link','facebook_profile_id',
            'instagram_profile_link','instagram_profile_id',
            'photo_link','extra_info','push_token', 'barcode_id']);
    }

    function storeStudent($data):Student {
        return Student::create($data);
    }
}
