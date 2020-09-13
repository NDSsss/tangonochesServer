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
                                            <li><a href='{{route('admin.school.students.index')}}'>Ученики</a>
                                            </li>
                                            <li><a href='{{route('admin.school.teachers.index')}}'>Преподователи</a>
                                            </li>
                                            <li><a href='{{route('admin.school.groups.index')}}'>Группы</a>
                                            </li>
                                            <li><a href='{{route('admin.school.ticketCountTypes.index')}}'>Возможное количество занятий в абонементе</a>
                                            </li>
                                            <li><a href='{{route('admin.school.ticketEventTypes.index')}}'>Возможные типы абонементов</a>
                                            </li>
                                            <li><a href='{{route('admin.school.lessons.index')}}'>Уроки</a>
                                            </li>
                                            <li><a href='{{route('admin.school.tickets.index')}}'>Абонементы</a>
                                            </li>
                                            <li><a href='{{route('admin.school.studentsLessonsLeft.index')}}'>Количество оставшихся уроков у учеников</a>
                                            </li>
                                            <li><a href='{{route('admin.school.eventAnnounces.index')}}'>Анонсы мероприятий</a>
                                            </li>
                                            <li><a href='{{route('admin.school.lessonAnnounces.index')}}'>Рассписание уроков</a>
                                            </li>
                                            <li><a href='{{route('admin.school.notifications.index')}}'>Уведомления</a>
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
