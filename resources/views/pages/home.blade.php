@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div style="width: 100%;border-bottom: 1px solid #DCDCDC">
        <h2 style="float: left;">My Dashboard</h2>
        </div>

        <div class="col-md-12" style="display: flex">

                <div class="card shadow rounded" style="float: left;width:27%;margin:20px;border-style: solid;
                border-color: #6495ED;">
                    <div class="card-title" style="background-color:#6495ED;float: left;">
                        <h3 style="color: white;margin:22px">
                        <a style="color: white;text-decoration: none;" href="{{ route('programs.index') }}">My Programs</a>
                        <span style="float: right">{{count($activeProgram)}}</span>
                        </h3>
                    </div>

                    <div class="card-body" style="padding:0%;">
                        <span style="color: #6495ED;margin-left:10px;font-size:15px">
                            In-progress or completed programs:
                        </span>
                        <ul style="max-height:150px;overflow-y: auto;">
                            @foreach ($activeProgram as $program)
                            <li>{{$program->program}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="card shadow rounded" style="float: left;width:26%;margin:20px;border-style: solid;
                border-color: #4169E1;">
                    <div class="card-title" style="background-color: #4169E1;">
                        <h3 style="color: white;margin:22px">
                        <a style="color: white;text-decoration: none;" href="{{ route('courses.index') }}">My Courses</a>
                        <span style="float: right">{{count($activeCourses)}}</span>
                        </h3>
                    </div>

                    <div class="card-body" style="padding:0%;">
                        <span style="color: #4169E1;margin-left:10px;font-size:15px">
                            In-progress courses:
                        </span>
                        <ul style="max-height:150px;overflow-y: auto;">
                            @foreach ($activeCourses as $course)
                            <li>{{$course->year}} {{$course->semester}} {{$course->course_code}} {{$course->course_num}} {{$course->section}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="card shadow rounded" style="float: left;width:27%;margin:20px;border-style: solid;
                border-color: #228B22;">
                    <div class="card-title" style="background-color: #228B22;">
                        <h3 style="color: white;margin:22px">
                        <a style="color: white;text-decoration: none;" href="{{ route('requestInvitation') }}" >
                        Registration Invite
                        </a>
                        </h3>
                    </div>

                    <div class="card-body" style="padding:0%;">
                        <span style="color: #228B22;;margin-left:10px;font-size:15px">
                            Invite somebody to the website &#10141;</span>
                    </div>
                </div>

        </div>
    </div>
</div>
@endsection
