@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">


        <div style="width: 100%;border-bottom: 1px solid #DCDCDC">
        <h2 style="float: left;">My Dashboard</h2>
        </div>

        <div class="col-md-12">

                <div class="card shadow rounded m-4" style="border-style: solid;
                border-color: #1E90FF;">
                    <div class="card-title bg-primary p-3">
                        <h3 style="color: white;">
                        My Programs         

                        <div style="float:right;">
                            <button style="border: none; background: none; outline: none;" data-toggle="modal" data-target="#createProgramModal">
                                <i class="bi bi-plus-circle text-white"></i>
                            </button>
                        </div>
                        </h3>
                    </div>

                    
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
                            <!-- Displays 'My Programs' -->
                            @foreach ($activeProgram as $index => $program)
                            <tbody>
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td><a href="{{route('programWizard.step1', $program->program_id)}}">{{$program->program}}</a></td>
                                <td>{{$program->faculty}} </td>
                                <td>{{$program->level}}</td>
                                <td>
                                    <a class="pr-2" href="{{route('programWizard.step1', $program->program_id)}}" style="float: left;">
                                        <i class="bi bi-pencil-fill btn-icon dropdown-item"></i>
                                    </a>
                                    <a data-toggle="modal" data-target="#deleteProgram{{$index}}" href=# style="float: left;">
                                        <i class="bi bi-trash-fill text-danger btn-icon dropdown-item"></i>
                                    </a>
                                    <div class="dropdown-item btn-icon" data-toggle="tooltip" data-html="true" data-bs-placement="right" title="@foreach($programUsers[$program->program_id] as $index => $programUser){{$index + 1}}. {{$programUser->name}}<br>@endforeach">
                                        <div data-toggle="modal" data-target="#addCollaboratorModal{{$program->program_id}}" style="float: left;" href=#>
                                            <i class="bi bi-people-fill"></i>
                                            <sup>
                                                <span class="badge badge-dark" style="font-size:small;">{{ count($programUsers[$program->program_id]) }}</span>
                                            </sup>
                                        </div>
                                    </div>

                                    <!-- Add Collaborator Modal -->
                                    <div class="modal fade" id="addCollaboratorModal{{$program->program_id}}" tabindex="-1" role="dialog" aria-labelledby="addCollaboratorModalLabel{{$program->program_id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addCollaboratorModalLabel">Assign Collaborator to Program</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="card-body">
                                                    <p class="form-text text-muted">Collaborators can see and edit the course. Collaborators must first register with this web application to be added to a course.
                                                        By adding a collaborator, a verification email will be sent to their email address.
                                                        </p>

                                                    <table class="table table-borderless">

                                                            @if(count($programUsers)===1)
                                                                <tr class="table-active">
                                                                    <th colspan="2">You have not added any collaborators to this course
                                                                    </th>
                                                                </tr>

                                                            @else

                                                                <tr class="table-active">
                                                                    <th colspan="2">Collaborators</th>
                                                                </tr>
                                                                @foreach($programUsers[$program->program_id] as $collaborator)
                                                                    @if($collaborator->email != $user->email)
                                                                        <tr>
                                                                            <td>{{$collaborator->email}}</td>
                                                                            <td>
                                                                                <form action="{{ route('programUser.destroy') }}" method="POST" class="float-left">
                                                                                    @csrf
                                                                                    {{method_field('DELETE')}}

                                                                                    <input type="hidden" class="form-check-input" name="program_id" value="{{$program->program_id}}">
                                                                                    <input type="hidden" class="form-check-input" name="user_id" value="{{$collaborator->id}}">
                                                                                    <button type="submit" class="btn btn-danger btn-sm ">Unassign</button>
                                                                                </form>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                    </table>
                                                </div>

                                                <form method="POST" action="{{ action('ProgramUserController@store') }}">
                                                    @csrf

                                                    <div class="modal-body">
                                                        <div class="form-group row">
                                                            <label for="email" class="col-md-3 col-form-label text-md-right">Collaborator Email</label>

                                                            <div class="col-md-7">
                                                                <input id="email" type="email" class="form-control @error('program') is-invalid @enderror" name="email" required autofocus>


                                                                @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <input type="hidden" class="form-check-input" name="program_id" value={{$program->program_id}}>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary col-2 btn-sm" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary col-2 btn-sm">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

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

                <div class="card shadow rounded m-4" style="border-style: solid;
                border-color: #1E90FF;">
                    <div class="card-title bg-primary p-3">
                        <h3 style="color: white;">
                        My Courses         

                        <div style="float:right;">
                            <button style="border: none; background: none; outline: none;" data-toggle="modal" data-target="#createCourseModal">
                                <i class="bi bi-plus-circle text-white"></i>
                            </button>
                        </div>
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
                                    <th scope="col">Term</th>
                                    <!--<th scope="col">Invite Collaborators</th>-->
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Programs </th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>

                                <!-- Displays 'My Courses' -->
                                @foreach ($activeCourses as $index => $course)
                                <tbody>
                                <tr>
                                    @if($course->status !== 1)
                                        <th scope="row">{{$index + 1}}</th>
                                        <td><a href="{{route('courseWizard.step1', $course->course_id)}}">{{$course->course_title}}</a></td>
                                        <td>{{$course->course_code}} {{$course->course_num}}</td>
                                        <td>{{$course->year}} {{$course->semester}}</td>
                                        <td>
                                            <i class="bi bi-exclamation-circle-fill fs-5 text-warning pr-2"></i>In Progress
                                        </td>

                                        <td> 
                                            <div class="row">
                                                <div class="d-flex justify-content-center">
                                                    @if(count($coursesPrograms[$course->course_id]) > 0)
                                                        <div data-toggle="tooltip" data-html="true" title="@foreach($coursesPrograms[$course->course_id] as $index => $courseProgram){{$index + 1}}. {{$courseProgram->program}}<br>@endforeach" data-bs-placement="right">
                                                            <!--<button type="button" style="border:1px solid black; background-color: white; border-radius: 50%; font-weight:bold; color:#40B4E5; opacity: 1; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black; margin: 0 auto; display:block; box-shadow: 2px 2px 10px #888888; font-size: 120%" class="btn btn-secondary" disabled>{{ count($coursesPrograms[$course->course_id]) }}</button>
                                                            -->
                                                            <p style="text-align:center;">
                                                                <i class="bi bi-map" style="font-size:x-large; text-align:center;">
                                                                    <sup>
                                                                        <span class="badge badge-dark" style="font-size:small;">{{ count($coursesPrograms[$course->course_id]) }}</span>
                                                                    </sup>
                                                                </i>
                                                            </p>
                                                        </div>
                                                    @else
                                                    <p style="text-align: center; display:inline-block; margin-left:-15px;"> <i class="bi bi-info-circle-fill" data-toggle="tooltip" data-bs-placement="right" title='To map a course to a program, you must first create a program from the "My Programs" section'></i>None</p>
                                                    @endif
                                                </div>
                                            </div>                                           
                                        </td>
                                    @else
                                        <th scope="row">{{$index + 1}}</th>
                                        <td><a href="{{route('courseWizard.step1', $course->course_id)}}">{{$course->course_title}}</a></td>
                                        <td>{{$course->course_code}} {{$course->course_num}}</td>
                                        <td>{{$course->year}} {{$course->semester}}</td>
                                        <td>
                                            <i class="bi bi-check-circle-fill fs-5 text-success pr-2"></i>Completed
                                        </td>
                                        <td> 
                                            <div class="row">
                                                <div class="d-flex justify-content-center">
                                                    @if(count($coursesPrograms[$course->course_id]) > 0)
                                                        <div data-toggle="tooltip" data-html="true" title="@foreach($coursesPrograms[$course->course_id] as $index => $courseProgram){{$index + 1}}. {{$courseProgram->program}}<br>@endforeach" data-bs-placement="right">
                                                            <!--<button type="button" style="border:1px solid black; background-color: white; border-radius: 50%; font-weight:bold; color:#40B4E5; opacity: 1; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black; margin: 0 auto; display:block; box-shadow: 2px 2px 10px #888888; font-size: 120%" class="btn btn-secondary" disabled>{{ count($coursesPrograms[$course->course_id]) }}</button>
                                                            -->
                                                            <p style="text-align:center;">
                                                                <i class="bi bi-map" style="font-size:x-large; text-align:center;">
                                                                    <sup>
                                                                        <span class="badge badge-dark" style="font-size:small;">{{ count($coursesPrograms[$course->course_id]) }}</span>
                                                                    </sup>
                                                                </i>
                                                            </p>
                                                        </div>
                                                    @else
                                                    <p style="text-align: center; display:inline-block; margin-left:-15px;"> <i class="bi bi-info-circle-fill" data-toggle="tooltip" data-bs-placement="right" title='To map a course to a program, you must first create a program from the "My Programs" section'></i>None</p>
                                                    @endif
                                                </div>
                                            </div>                                           
                                        </td>
                                    @endif

                                    <!--<td></td>-->
                                    <td>
                                        <a  class="pr-2" href="{{route('courseWizard.step1', $course->course_id)}}">
                                        <i class="bi bi-pencil-fill btn-icon dropdown-item"></i></a>
                                        <a data-toggle="modal" data-target="#deleteConfirmation{{$index}}" href=#>
                                        <i class="bi bi-trash-fill text-danger btn-icon dropdown-item"></i></a>

                                        <!-- Collaborators Icon
                                        <a class="dropdown-item btn-icon" data-toggle="modal">
                                        <i class="bi bi-people-fill" data-toggle="tooltip" data-bs-placement="right"></i></a>-->

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

                                <!-- Create Program Modal -->
                                <div class="modal fade" id="createProgramModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Program</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <form method="POST" action="{{ action('ProgramController@store') }}">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="program" class="col-md-2 col-form-label text-md-right">Program Name</label>
                                                    <div class="col-md-8">
                                                        <input id="program" type="text" class="form-control @error('program') is-invalid @enderror" name="program" required autofocus>
                                                        @error('program')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="faculty" class="col-md-2 col-form-label text-md-right">Faculty/School</label>
                                                    <div class="col-md-8">
                                                        <select id='faculty' class="custom-select" name="faculty" required>
                                                            <option disabled selected hidden>Open this select menu</option>
                                                            <option value="School of Engineering">School of Engineering</option>
                                                            <option value="Okanagan School of Education">Okanagan School of Education </option>
                                                            <option value="Faculty of Arts and Social Sciences">Faculty of Arts and Social Sciences </option>
                                                            <option value="Faculty of Creative and Critical Studies">Faculty of Creative and Critical Studies</option>
                                                            <option value="Faculty of Science">Faculty of Science </option>
                                                            <option value="School of Health and Exercise Sciences">School of Health and Exercise Sciences</option>
                                                            <option value="School of Nursing">School of Nursing </option>
                                                            <option value="School of Social Work">School of Social Work</option>
                                                            <option value="Faculty of Management">Faculty of Management</option>
                                                            <option value="Faculty of Medicine">Faculty of Medicine</option>
                                                            <option value="College of Graduate studies">College of Graduate studies</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                        @error('faculty')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="department" class="col-md-2 col-form-label text-md-right">Department</label>
                                                    <div class="col-md-8">
                                                        <select id="department" class="custom-select" name="department">
                                                            <option disabled selected hidden>Open this select menu</option>
                                                            <optgroup label="Faculty of Arts and Social Sciences ">
                                                                <option value="Community, Culture and Global Studies">Community, Culture and Global Studies</option>
                                                                <option value="Economics, Philosophy and Political Science">Economics, Philosophy and Political
                                                                Science</option>
                                                                <option value="History and Sociology">History and Sociology</option>
                                                                <option value="Psychology">Psychology</option>
                                                            </optgroup>
                                                            <optgroup label="Faculty of Creative and Critical Studies ">
                                                                <option value="Creative Studies">Creative Studies</option>
                                                                <option value="Languages and World Literature">Languages and World Literature</option>
                                                                <option value="English and Cultural Studies">English and Cultural Studies</option>
                                                            </optgroup>
                                                            <optgroup label="Faculty of Science">
                                                                <option value="Biology">Biology</option>
                                                                <option value="Chemistry">Chemistry</option>
                                                                <option value="Computer Science, Mathematics, Physics and Statistics">Computer Science,
                                                                Mathematics, Physics and Statistics</option>
                                                                <option value="Earth, Environmental and Geographic Sciences">Earth, Environmental and Geographic
                                                                Sciences</option>
                                                            </optgroup>
                                                                <option value="Other">Other</option>
                                                        </select>
                                                        @error('department')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="level" class="col-md-2 col-form-label text-md-right">Level</label>
                                                    <div class="col-md-6">
                                                        <div class="form-check ">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="level" value="Undergraduate" required>
                                                                Undergraduate
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="level" value="Graduate">
                                                                Graduate
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="level" value="Other">
                                                                Other
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" class="form-check-input" name="user_id" value={{$user->id}}>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary col-2 btn-sm" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary col-2 btn-sm">Add</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Create Program Modal -->

                                <!-- Create Course Modal -->
        <div class="modal fade" id="createCourseModal" tabindex="-1" role="dialog" aria-labelledby="createCourseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCourseModalLabel">Create Course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form id="createCourse" method="POST" action="{{ action('HomeController@store') }}">
                        @csrf
                        <div class="modal-body">


                            <div class="form-group row">
                                <label for="course_code" class="col-md-3 col-form-label text-md-right"><span class="requiredField">*</span>Course
                                    Code</label>

                                <div class="col-md-8">
                                    <input id="course_code" type="text"
                                        pattern="[A-Za-z]+"
                                        minlength="1"
                                        maxlength="4"
                                        class="form-control @error('course_code') is-invalid @enderror"
                                        name="course_code" required autofocus>

                                    @error('course_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <small id="helpBlock" class="form-text text-muted">
                                        Maximum of Four letter course code e.g. SUST, ASL, COSC etc.
                                    </small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="course_num" class="col-md-3 col-form-label text-md-right"><span class="requiredField">*</span>Course
                                    Number</label>

                                <div class="col-md-8">
                                    <input id="course_num" type="text"
                                        class="form-control @error('course_num') is-invalid @enderror" name="course_num"
                                        required autofocus>

                                    @error('course_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="course_title" class="col-md-3 col-form-label text-md-right"><span class="requiredField">*</span>Course Title</label>

                                <div class="col-md-8">
                                    <input id="course_title" type="text"
                                        class="form-control @error('course_title') is-invalid @enderror"
                                        name="course_title" required autofocus>

                                    @error('course_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="course_title" class="col-md-3 col-form-label text-md-right"><span class="requiredField">*</span>Term and Year</label>

                                <div class="col-md-3">
                                    <select id="course_semester" class="form-control @error('course_semester') is-invalid @enderror"
                                        name="course_semester" required autofocus>
                                        <option value="W1">Winter Term 1</option>
                                        <option value="W2">Winter Term 2</option>
                                        <option value="S1">Summer Term 1</option>
                                        <option value="S2">Summer Term 2</option>

                                    @error('course_semester')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </select>
                                </div>

                                <div class="col-md-2 float-right">
                                    <select id="course_year" class="form-control @error('course_year') is-invalid @enderror"
                                    name="course_year" required autofocus>
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                        <option value="2021">2021</option>
                                        <option value="2020">2020</option>
                                        <option value="2019">2019</option>

                                    @error('course_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </select>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="course_section" class="col-md-3 col-form-label text-md-right">Course
                                    Section</label>

                                <div class="col-md-4">
                                    <input id="course_section" type="text"
                                        class="form-control @error('course_section') is-invalid @enderror"
                                        name="course_section" autofocus>

                                    @error('course_section')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="delivery_modality" class="col-md-3 col-form-label text-md-right"><span class="requiredField">*</span>Mode of Delivery</label>

                                <div class="col-md-3 float-right">
                                    <select id="delivery_modality" class="form-control @error('delivery_modality') is-invalid @enderror"
                                    name="delivery_modality" required autofocus>
                                        <option value="O">online</option>
                                        <option value="I">in-person</option>
                                        <option value="B">hybrid</option>

                                    @error('delivery_modality')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="standard_category_id" class="col-md-3 col-form-label text-md-right"><span class="requiredField">*</span>Map this course against</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="standard_category_id" id="standard_category_id" required>
                                        <option value="" disabled selected hidden>Please Choose...</option>
                                        @foreach($standard_categories as $standard_category)
                                            <option value="{{ $standard_category->standard_category_id }}">{{$standard_category->sc_name}}</option>
                                        @endforeach
                                    </select>
                                    <small id="helpBlock" class="form-text text-muted">
                                        These are the standards from the Ministry of Advanced Education in BC.
                                    </small>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-check-input" name="user_id" value={{Auth::id()}}>
                        <input type="hidden" class="form-check-input" name="type" value="unassigned">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary col-2 btn-sm" data-dismiss="modal">Close</button>
                        <button id="submit" type="submit" class="btn btn-primary col-2 btn-sm">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- End Create Course Modal -->


<script type="application/javascript">
    $(document).ready(function () {

        // Enables functionality of tool tips
        $('[data-toggle="tooltip"]').tooltip({html:true});
    });
</script>
@endsection
