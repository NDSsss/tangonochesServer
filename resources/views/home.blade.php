@extends('layouts.app')

@section('content')
    <div id="carouselLessonAnnounces" class="carousel slide" data-ride="carousel"
         style="margin: 10vh auto auto;height: 27vh; width: 27vw">
        <div class="carousel-inner">
            @foreach($lessonAnnounces as $key => $announce)
                @if($key == 0)
                    <div class="carousel-item active">
                        @else
                            <div class="carousel-item">
                                @endif
                                <div class="card"
                                     style="width: 27vw; height: 27vh; background-image: linear-gradient(#8a51f9, #6139b2); border-radius: 15px">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col" style="text-align: center; color: white">
                                                <h4>Суббота 28.12</h4>
                                            </div>
                                            <div class="col" style="text-align: center; color: white">
                                                <h4>20:00 - 04:00</h4>
                                            </div>
                                        </div>
                                        <div class="row"
                                             style="height: 11vh; text-align: center; color: white; margin-left: 15px;margin-right: 15px; margin-top: 2vh">
                                            <h3>{{$announce->name}}</h3>
                                        </div>
                                        <div class="row"
                                             style="text-align: center; color: white; margin-left: 15px;margin-right: 15px">
                                            <img src="{{asset('images/student/ic_location.svg')}}">
                                            <h4>{{$announce->address}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselLessonAnnounces" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselLessonAnnounces" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
        </div>

        <div id="carouselEventAnnounces" class="carousel slide" data-ride="carousel"
             style="margin: 10vh auto auto;height: 27vh; width: 27vw">
            <div class="carousel-inner">
                @foreach($eventAnnounces as $key => $announce)
                    @if($key == 0)
                        <div class="carousel-item active">
                            @else
                                <div class="carousel-item">
                                    @endif
                                    <div class="card"
                                         style="width: 27vw; height: 27vh; background-image: url({{asset('images/student/bg_event.png')}}); background-repeat: no-repeat; background-position: center; background-size: cover; border-radius: 15px">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col" style="text-align: center; color: white">
                                                    <h4>Суббота 28.12</h4>
                                                </div>
                                                <div class="col" style="text-align: center; color: white">
                                                    <h4>20:00 - 04:00</h4>
                                                </div>
                                            </div>
                                            <div class="row"
                                                 style="height: 11vh; text-align: center; color: white; margin-left: 15px;margin-right: 15px; margin-top: 2vh">
                                                <h3>{{$announce->name}}</h3>
                                            </div>
                                            <div class="row"
                                                 style="text-align: center; color: white; margin-left: 15px;margin-right: 15px">
                                                <img src="{{asset('images/student/ic_location.svg')}}">
                                                <h4>{{$announce->address}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselEventAnnounces" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselEventAnnounces" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
            </div>
@endsection
