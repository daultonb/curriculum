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
                        <a style="color: white;text-decoration: none;">
                        My Programs
                        <div style="float:right; padding-right:10px;">
                            <button style="border: none; background: none; outline: none;" data-toggle="modal" data-target="#createProgramModal">
                                <img src="{{ asset('dashboard-icons/add_White.png') }}" style="width:20px;height:20px;"/>
                            </button>
                        </div>
                        </a>
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
                            <!-- Displays 'My Programs' -->
                            @foreach ($activeProgram as $index => $program)
                            <tbody>
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td><a href="{{route('programWizard.step1', $program->program_id)}}">{{$program->program}}</a></td>
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
                                                                Undegraduate
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
                        <a style="color: white;text-decoration: none;">
                        My Courses
                        <div style="float:right; padding-right:10px;">
                            <button style="border: none; background: none; outline: none;" data-toggle="modal" data-target="#createCourseModal">
                                <img src="{{ asset('dashboard-icons/add_White.png') }}" style="width:20px;height:20px;"/>
                            </button>
                        </div>
                        </a>           
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
                                    <th scope="col">Program</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>

                                <!-- Displays 'My Courses' -->
                                @foreach ($activeCourses as $index => $course)
                                <tbody>
                                <tr>
                                    @if($course->status !== 1)
                                        @if($course->program_id == 1 || $course->program_id == 2 || $course->program_id == 3)
                                            <th scope="row">{{$index + 1}}</th>
                                            <td><a href="{{route('courseWizard.step1', $course->course_id)}}">{{$course->course_title}}</a></td>
                                            <td>{{$course->course_code}} {{$course->course_num}}</td>
                                            <td>{{$course->year}} {{$course->semester}}</td>
                                            <td>❗In Progress</td>
                                            <td>None</td>
                                        @else
                                            <th scope="row">{{$index + 1}}</th>
                                            <td><a href="{{route('courseWizard.step1', $course->course_id)}}">{{$course->course_title}}</a></td>
                                            <td>{{$course->course_code}} {{$course->course_num}}</td>
                                            <td>{{$course->year}} {{$course->semester}}</td>
                                            <td>❗In Progress</td>
                                            <td><a href="{{route('programWizard.step1', $course->program_id)}}">{{$course->program}}</a></td>
                                        @endif
                                    @else
                                        @if($course->program_id == 1 || $course->program_id == 2 || $course->program_id == 3 )
                                        <th scope="row">{{$index + 1}}</th>
                                            <td><a href="{{route('courseWizard.step1', $course->course_id)}}">{{$course->course_title}}</a></td>
                                            <td>{{$course->course_code}} {{$course->course_num}}</td>
                                            <td>{{$course->year}} {{$course->semester}}</td>
                                            <td>✔️Completed</td>
                                            <td>None</td>
                                        @else
                                            <th scope="row">{{$index + 1}}</th>
                                            <td><a href="{{route('courseWizard.step1', $course->course_id)}}">{{$course->course_title}}</a></td>
                                            <td>{{$course->course_code}} {{$course->course_num}}</td>
                                            <td>{{$course->year}} {{$course->semester}}</td>
                                            <td>✔️Completed</td>
                                            <td><a href="{{route('programWizard.step1', $course->program_id)}}">{{$course->program}}</a></td>
                                        @endif
                                    @endif

                                    <!--<td></td>-->
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
                                        <!-- Create Course Modal -->
        <div class="modal fade" id="createCourseModal" tabindex="-1" role="dialog" aria-labelledby="createCourseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCourseModalLabel">Add Course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form id="createCourse" method="POST" action="{{ action('HomeController@store') }}">
                        @csrf
                        <div class="modal-body">


                            <div class="form-group row">
                                <label for="course_code" class="col-md-3 col-form-label text-md-right">Course
                                    Code</label>

                                <div class="col-md-8">
                                    <input id="course_code" type="text"
                                        pattern="[A-Za-z]{4}"
                                        class="form-control @error('course_code') is-invalid @enderror"
                                        name="course_code" required autofocus>

                                    @error('course_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <small id="helpBlock" class="form-text text-muted">
                                        Four letter course code e.g. SUST, COSC etc.
                                    </small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="course_num" class="col-md-3 col-form-label text-md-right">Course
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
                                <label for="course_title" class="col-md-3 col-form-label text-md-right">
                                    Course Title</label>

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
                                <label for="course_title" class="col-md-3 col-form-label text-md-right">Term and Year</label>

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
                                <label for="delivery_modality" class="col-md-3 col-form-label text-md-right">
                                    Delivery Modality
                                </label>

                                <div class="col-md-3 float-right">
                                    <select id="delivery_modality" class="form-control @error('delivery_modality') is-invalid @enderror"
                                    name="delivery_modality" required autofocus>
                                        <option value="O">online</option>
                                        <option value="I">in-person</option>
                                        <option value="B">blended</option>

                                    @error('delivery_modality')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="program_id" class="col-md-3 col-form-label text-md-right"> Map this course against</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="program_id" id="program_id" required>
                                        <option value="" disabled selected hidden>Please Choose...</option>
                                        <option value="1">Bachelor's degree level standards</option>
                                        <option value="2">Master's degree level standards</option>
                                        <option value="3">Doctoral degeree level standards</option>
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
                            <button type="button" class="btn btn-secondary col-2 btn-sm"
                                data-dismiss="modal">Close</button>
                            <button id="submit" type="submit" class="btn btn-primary col-2 btn-sm" href="{{route('courseWizard.step1', $course->course_id)}}">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Create Course Modal -->
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
