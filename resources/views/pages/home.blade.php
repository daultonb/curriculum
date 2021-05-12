@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div style="width: 100%;border-bottom: 1px solid #DCDCDC">
        <h2 style="float: left;">My Dashboard</h2>
        </div>

        <div class="col-md-12">

                <div class="card shadow rounded" style="margin:20px;border-style: solid;
                border-color: #1E90FF;">
                    <div class="card-title" style="background-color:#1E90FF;margin-bottom: 0.00rem;">
                        <h3 style="color: white;margin:22px">
                        <!-- <a style="color: white;text-decoration: none;" href="{{ route('programs.index') }}">My Programs</a> -->
                        <a style="color: white;text-decoration: none;" href="/construction">My Programs</a>
                        </h3>
                    </div>

                    <div class="card-body" style="padding:0%;">
                        @if(count($activeProgram)>0)
                        <table class="table table-hover dashBoard">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Program</th>
                                <th scope="col">Faculty and Department/School</th>
                                <th scope="col">Level</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>

                            @foreach ($activeProgram as $index => $program)
                            <tbody>
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td>{{$program->program}}</td>
                                <td>{{$program->faculty}}</td>
                                <td>{{$program->level}}</td>
                                <td style="display: inline-block">
                                    <a class="dropdown-item btn-icon" href="{{route('programWizard.step1', $program->program_id)}}">
                                    <img src=" {{ asset('dashboard-icons/edit.png') }}" style="width:15px;height:15px"/></a>
                                    <a class="dropdown-item btn-icon" data-toggle="modal" data-target="#deleteProgram{{$index}}" href=#>
                                    <img src="{{ asset('dashboard-icons/delete.png') }}" style="width:15px;height:15px"/></a>


                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteProgram{{$index}}" tabindex="-1" role="dialog" aria-labelledby="deleteProgram{{$index}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                Are you sure you want to delete {{$program->program}} program ?
                                                </div>

                                                <form action="{{route('programs.destroy', $program->program_id)}}" method="POST" class="float-right">
                                                    @csrf
                                                    {{method_field('DELETE')}}

                                                    <div class="modal-footer">
                                                    <button style="width:60px" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                                    <button style="width:60px" type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            </tbody>
                            @endforeach
                        </table>
                        @endif

                    </div>
                </div>

                <div class="card shadow rounded" style="margin:20px;border-style: solid;
                border-color: #6495ED;">
                    <div class="card-title" style="background-color: #6495ED;margin-bottom: 0.00rem;">
                        <h3 style="color: white;margin:22px">
                        <a style="color: white;text-decoration: none;" href="{{ route('courses.index') }}">My Courses</a>
                        </h3>
                    </div>

                    <div class="card-body" style="padding:0%;">
                        @if(count($activeCourses)>0)
                            <table class="table table-hover dashBoard">
                                <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Course Title</th>
                                    <th scope="col">Course Code</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Invite Collaborators</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>

                                @foreach ($activeCourses as $index => $course)
                                <tbody>
                                <tr>
                                    <th scope="row">{{$index + 1}}</th>
                                    <td>{{$course->course_title}}</td>
                                    <td>{{$course->course_code}} {{$course->course_num}}</td>
                                    <td>{{$course->year}} {{$course->semester}}</td>
                                    <td>
                                    </td>
                                    <td style="display: inline-block">
                                        <a class="dropdown-item btn-icon" href="{{route('courseWizard.step1', $course->course_id)}}">
                                        <img src="{{ asset('dashboard-icons/edit.png') }}" style="width:15px;height:15px"/></a>
                                        <a class="dropdown-item btn-icon" data-toggle="modal" data-target="#deleteConfirmation{{$index}}" href=#>
                                        <img src="{{ asset('dashboard-icons/delete.png') }}" style="width:15px;height:15px"/></a>

                                        <!-- Delete Confirmation Modal -->
                                        <div class="modal fade" id="deleteConfirmation{{$index}}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmation{{$index}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteConfirmation{{$index}}">Delete Confirmation</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                    Are you sure you want to delete {{$course->course_code}} {{$course->course_num}} ?
                                                    </div>

                                                    <form action="{{route('courses.destroy', $course->course_id)}}" method="POST">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <input type="hidden" class="form-check-input " name="program_id"
                                                            value={{$course->program_id}}>

                                                        <div class="modal-footer">
                                                            <button style="width:60px" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                                            <button style="width:60px" type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                </tbody>
                                @endforeach
                            </table>

                        @else

                        @endif
                    </div>
                </div>

        </div>
    </div>
</div>
@endsection
