@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <ul>
                            <li>
                                Admin
                                <ul>
                                    <li>
                                        School
                                        <ul>
                                            <li><a href='{{route('admin.school.students.index')}}'>Students</a>
                                            </li>
                                            <li><a href='{{route('admin.school.teachers.index')}}'>Teachers</a>
                                            </li>
                                            <li><a href='{{route('admin.school.groups.index')}}'>Groups</a>
                                            </li>
                                            <li><a href='{{route('admin.school.ticketCountTypes.index')}}'>ticketCountTypes</a>
                                            </li>
                                            <li><a href='{{route('admin.school.ticketEventTypes.index')}}'>ticketEventTypes</a>
                                            </li>
                                            <li><a href='{{route('admin.school.lessons.index')}}'>Lessons</a>
                                            </li>
                                            <li><a href='{{route('admin.school.tickets.index')}}'>Tickets</a>
                                            </li>
                                            <li><a href='{{route('admin.school.studentsLessonsLeft.index')}}'>studentsLessonsLeft</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
