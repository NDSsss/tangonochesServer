@extends('layouts.app')

@section('content')
    @php
        //admin.school.teachers
        $adminConfig = config('global.admin_routes');
        $adminPath = $adminConfig['prefix'];
        $group = $adminConfig['global_groups'][0];
        $groupPath = $group['group_prefix'];
        $pagePath = $group['pages'][0][0];
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
                                <th>Имя</th>
                                <th>Номер телефона</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($items))
                                @foreach($items as $student)
                                    @php
                                    /** @var \App\Models\Student $student */
                                    @endphp
                                    <tr>
                                        <td>{{$student->id}}</td>
                                        <td><a href="{{route("$currentRoute.edit",$student->id)}}">{{$student->name}}</a></td>
                                        <td>{{$student->phone}}</td>
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
{{--        @if($paginator->total() > $paginator->count())--}}
{{--            <br>--}}
{{--            <div class="row justify-content-center">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            {{ $paginator->links() }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
    </div>
@endsection
