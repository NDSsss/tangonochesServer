@extends('layouts.app')

@section('content')
    @php
        //admin.school.teachers
        $adminConfig = config('global.admin_routes');
        $adminPath = $adminConfig['prefix'];
        $group = $adminConfig['global_groups'][0];
        $groupPath = $group['group_prefix'];
        $pagePath = $group['pages'][2][0];
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
                                <th>Название</th>
                                <th>Тип</th>
                                <th>1 урок</th>
                                <th>2 урок</th>
                                <th>Адресс</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($paginator))
                                @foreach($paginator as $group)
                                    @php
                                    /** @var \App\Models\Group $group */
                                    @endphp
                                    <tr>
                                        <td>{{$group->id}}</td>
                                        <td><a href="{{route("$currentRoute.edit",$group->id)}}">{{$group->name}}</a></td>
                                        <td>{{$group->ticketEventType->name}}</td>
                                        <td>{{date_format(date_create($group->first_lesson_time),'l H-i')}}</td>
                                        <td>{{date_format(date_create($group->second_lesson_time),'l H-i')}}</td>
                                        <td>{{$group->address}}</td>
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
