@extends('layouts.app')

@section('content')
    @php
        //admin.school.teachers
        $adminConfig = config('global.admin_routes');
        $adminPath = $adminConfig['prefix'];
        $group = $adminConfig['global_groups'][0];
        $groupPath = $group['group_prefix'];
        $pagePath = $group['pages'][6][0];
        $currentRoute = "$adminPath.$groupPath.$pagePath";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @include('includes.result_messages')

                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{ route("$currentRoute.create") }}">Добавить</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Кому</th>
                                <th>Кто</th>
                                <th>Когда</th>
                                <th>С</th>
                                <th>По</th>
                                <th>Количество</th>
                                <th>Тип</th>
                                <th>В паре</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($paginator))
                                @foreach($paginator as $item)
                                    <tr>
                                        <td><a href="{{route("$currentRoute.edit",$item->id)}}">{{$item->id}}</a></td>
                                        <td>{{$item->student->name}}</td>
                                        <td>{{$item->teacher->name}}</td>
                                        <td>{{$item->ticket_bought_date}}</td>
                                        <td>{{$item->ticket_start_date}}</td>
                                        <td>{{$item->ticket_end_date}}</td>
                                        <td>{{$item->ticketCountType->name}}</td>
                                        <td>{{$item->ticketEventType->name}}</td>
                                        <td>{{$item->is_in_pair}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if($paginator->total() > $paginator->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $paginator->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
