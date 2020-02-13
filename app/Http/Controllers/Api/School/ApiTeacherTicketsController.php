<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Teacher\ApiTeacherGetTicketByIdRequest;
use App\Http\Requests\Api\Teacher\BaseApiTeacherPaginationRequest;
use App\Http\Requests\Api\Teacher\BaseApiTeacherRequest;
use App\Http\Requests\Api\Teacher\TeacherBaseDeleteRequest;
use App\Http\Requests\Api\Teacher\TeacherRegisterTicketRequest;
use App\Http\Resources\Api\Teacher\ApiTeacherTicketFullResource;
use App\Http\Resources\Api\Teacher\ApiTeacherTicketResource;
use App\Repositories\TicketsRepository;
use Illuminate\Http\Response;

class ApiTeacherTicketsController extends BaseApiController
{

    public function getAllTickets(BaseApiTeacherPaginationRequest $request)
    {
//        dd($request->input(),$request->rules());
        $ticketsRepository = app(TicketsRepository::class);
        $page = $request->input('page');
        $countOnPage = $request->input('count_on_page');
        return ApiTeacherTicketResource::collection($ticketsRepository->getAllItemsApiPaginated($page, $countOnPage));
    }

    public function ticketById(ApiTeacherGetTicketByIdRequest $request){
        $ticketsRepository = app(TicketsRepository::class);
        $ticket = $ticketsRepository->getItemById($request->input('id'));
        return new ApiTeacherTicketFullResource($ticket);
    }

    public function registerTicket(TeacherRegisterTicketRequest $request)
    {
        $ticketsRepository = app(TicketsRepository::class);
        $result = $ticketsRepository->storeItem($request->input());
        if ($result) {
            return Response::create($result);
        } else {
            return Response::create(['error' => true], 400);
        }
    }

    public function deleteTicket(ApiTeacherGetTicketByIdRequest $request)
    {
        $ticketsRepository = app(TicketsRepository::class);
        $result = $ticketsRepository->destroyItem($request->input('id'));
        if ($result) {
            return Response::create(['error' => false]);
        } else {
            return Response::create(['error' => true], 400);
        }
    }
}
