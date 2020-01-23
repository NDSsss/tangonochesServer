<?php


namespace App\Repositories;


use App\Models\Group;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class GroupsRepository extends BaseRepository
{
    function getAllItemsPaginated(): LengthAwarePaginator
    {
        return $this->getAllItemsQuery()->paginate(5);
    }
    function getAllItems(): Collection
    {
        return $this->getAllItemsQuery()->get();
    }
    function getItemById($id):Group{
        return $this->getAllItemsQuery()->where('id','=',$id)->get()->first();
    }

    private function getAllItemsQuery(): Builder
    {
        return Group::query()->select(['id','name','first_lesson_time','second_lesson_time','address']);
    }

    function storeItem($data):Group {
        return Group::create($data);
    }

    function destroyItem($id):Group {
        return Group::destroy($id);
    }
}
