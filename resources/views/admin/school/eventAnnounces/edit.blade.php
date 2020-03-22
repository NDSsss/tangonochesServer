@extends('layouts.app')

@section('content')
    @php
        //admin.school.teachers
        $adminConfig = config('global.admin_routes');
        $adminPath = $adminConfig['prefix'];
        $group = $adminConfig['global_groups'][0];
        $groupPath = $group['group_prefix'];
        $pagePath = $group['pages'][9][0];
        $currentRoute = "$adminPath.$groupPath.$pagePath";
    @endphp
    <div>
        <a href="{{route("$currentRoute.index")}}">Весь список</a>
    </div>
    @if($item->exists)
        <form method="POST" action="{{route("$currentRoute.update", $item->id)}}">
            @method('PATCH')
            @else
                <form method="POST" action="{{route("$currentRoute.store")}}">
                    @endif
                    @csrf
                    <div class="container">
                        @include('includes.result_messages')

                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                @include("$currentRoute.includes.item_edit_main_col")
                            </div>
                            <div class="col-md-3">
                                @include("$currentRoute.includes.item_edit_add_col")
                            </div>
                        </div>

                    </div>
                </form>

                @if($item->exists)
                    <br>
                    <form method="POST" action="{{ route("$currentRoute.destroy", $item->id) }}">
                        @method('DELETE')
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card card-block">
                                    <div class="card-body ml-auto">
                                        <button type="submit" class="btn btn-link">Удалить</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>
    @endif

@endsection
