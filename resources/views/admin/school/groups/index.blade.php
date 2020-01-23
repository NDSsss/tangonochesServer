@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @include('includes.result_messages')

                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{ route('admin.school.groups.create') }}">Добавить</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название</th>
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
                                        <td><a href="{{route('admin.school.groups.edit',$group->id)}}">{{$group->name}}</a></td>
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
