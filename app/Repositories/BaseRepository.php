<?php


namespace App\Repositories;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepository
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
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    abstract protected function getColumnsForSelect(): array;

    abstract protected function getPaginateCount(): int;

    /**
     * @return Model|\Illuminate\Foundation\Application|mixed
     */
    protected function startConditions()
    {
        return clone $this->model;
    }

    function getAllItemsPaginated(): LengthAwarePaginator
    {
        return $this->getAllItemsWithRelationsQuery()->paginate($this->getPaginateCount());
    }

    function getAllItemsQuery(): Builder
    {
        return $this->startConditions()::query()->select();
    }

    function getAllItemsWithRelationsQuery(): Builder
    {
        return $this->getAllItemsQuery();
    }

    function createItem(): Model
    {
        return $this->startConditions()::make();
    }

    function getAllItems(): Collection
    {
        return $this->getAllItemsQuery()->get();
    }

    function getItemById($id): Model
    {
        return $this->getAllItemsQuery()->where('id', '=', $id)->get()->first();
    }

    function updateItem($data, $id)
    {
        \Log::debug('BaseRepository updating');
        $group = $this->getItemById($id);
        $result = $group->update($data);
        return $result;
    }

    function storeItem($data): Model
    {
        \Log::debug('BaseRepository creating');
        $item = $this->startConditions()::create($data);
        return $item;
    }

    function destroyItem($id)
    {
        return $this->model::destroy($id);
    }
}
