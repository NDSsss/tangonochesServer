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
                                            <li><a href="http://tangonoches.local/admin/school/teachers">Teachers</a>
                                            </li>
                                            <li><a href="http://tangonoches.local/admin/school/students">Students</a>
                                            </li>
                                            <li><a href="http://tangonoches.local/admin/school/groups">Groups</a>
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
