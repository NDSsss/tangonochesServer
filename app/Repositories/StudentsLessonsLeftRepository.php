<?php


namespace App\Repositories;


use App\Models\StudentsTicketTypesLessonsLeft;
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
    public function getAllItemsPaginated(){
        return $this->getAllItems()->paginate(10);
    }

    public function getAllItems(){
        return $this->startConditions()::query()->select()->with(['student:id,name','ticketEventType:id,name']);
    }

    private function startConditions(){
        return $this->model;
    }

    function createItem():Model{
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

    function updateItem($data, $id){
        $group = $this->getItemById($id);
        $result = $group->update($data);
        return $result;
    }

    function destroyItem($id)
    {
        return $this->model::destroy($id);
    }
}
