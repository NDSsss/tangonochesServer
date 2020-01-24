<?php


namespace App\Repositories;


use App\Models\Student;

class StudentsRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Student::class;
    }

    protected function getColumnsForSelect(): array
    {
        return ['id', 'name', 'phone',
            'vk_profile_link', 'vk_profile_id',
            'facebook_profile_link', 'facebook_profile_id',
            'instagram_profile_link', 'instagram_profile_id',
            'photo_link', 'extra_info', 'push_token', 'barcode_id'];
    }

    protected function getPaginateCount(): int
    {
        return 10;
    }
}
