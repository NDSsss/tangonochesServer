@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @include('includes.result_messages')

                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{ route('admin.school.students.create') }}">Добавить</a>
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
                            @if(!empty($paginator))
                                @foreach($paginator as $student)
                                    @php
                                    /** @var \App\Models\Student $student */
                                    @endphp
                                    <tr>
                                        <td>{{$student->id}}</td>
                                        <td><a href="{{route('admin.school.students.edit',$student->id)}}">{{$student->name}}</a></td>
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
