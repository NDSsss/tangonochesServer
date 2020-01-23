@extends('layouts.app')

@section('content')
    <div>
        <a href="{{route('admin.school.students.index')}}">Весь список</a>
    </div>
    @if($item->exists)
        <form method="POST" action="{{route('admin.school.students.update', $item->id)}}">
    @method('PATCH')
    @else
        <form method="POST" action="{{route('admin.school.students.store')}}">
     @endif
     @csrf
            <div class="container">
                @include('includes.result_messages')

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @include('admin.school.students.includes.item_edit_main_col')
                    </div>
                    <div class="col-md-3">
                        @include('admin.school.students.includes.item_edit_add_col')
                    </div>
                </div>

            </div>
        </form>

        @if($item->exists)
            <br>
            <form method="POST" action="{{ route('admin.school.students.destroy', $item->id) }}">
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
