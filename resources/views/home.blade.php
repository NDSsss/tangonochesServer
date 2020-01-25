@extends('layouts.app')

@section('content')
    @php
    $results = ['one','two','three','four','five',];
    @endphp
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
                                            <li><a href='{{route('admin.school.students.index')}}'>Teachers</a>
                                            </li>
                                            <li><a href='{{route('admin.school.teachers.index')}}'>Students</a>
                                            </li>
                                            <li><a href='{{route('admin.school.groups.index')}}'>Groups</a>
                                            </li>
                                            <li><a href='{{route('admin.school.ticketCountTypes.index')}}'>ticketCountTypes</a>
                                            </li>
                                            <li><a href='{{route('admin.school.ticketEventTypes.index')}}'>ticketEventTypes</a>
                                            </li>
                                            <li><a href='{{route('admin.school.lessons.index')}}'>Lessons</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                            <template>
                                <div>
                                    <input type="text" placeholder="what are you looking for?" v-model="query" v-on:keyup="autoComplete" class="form-control">
                                    <div class="panel-footer" v-if="true">
                                        <ul class="list-group">
                                            <li class="list-group-item" v-for="result in results">
                                                {{ $results[0] }}
                                            </li>
                                            <li>
                                                {{$results[0]}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </template>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
