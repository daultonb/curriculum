<div class="mt-2 mb-5">
    <div class="row">
        <div class="col">
            <h3>Course: {{$course->year}} {{$course->semester}} {{$course->course_code}}{{$course->course_num}}  {{$course->section}}</h3>
            <h5 class="text-muted">{{$course->course_title}}</h5>
            <h5>Mode of Delivery:
            @switch($course->delivery_modality)
                @case('O')
                    Online
                    @break
                @case('B')
                    Blended
                    @break
                @default
                    In-person
            @endswitch
            </h5>
        </div>

        <div class="col">
            <div class="row">
                <div class="col">
                    <!-- Edit button -->
                    <button type="button" class="btn btn-secondary btn-sm float-right" style="width:200px" data-toggle="modal" data-target="#editCourseModal{{$course->course_id}}">
                        Edit Course Information
                    </button>
                    <!-- Edit Course Modal -->
                    <div class="modal fade" id="editCourseModal{{$course->course_id}}" tabindex="-1" role="dialog" aria-labelledby="editCourseModalLabel"aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editCourseModalLabel">Edit Course information</h5>
                                    <button type="button" class="close"data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="POST" action="{{ action('CourseController@update', $course->course_id) }}">
                                    @csrf
                                    {{method_field('PUT')}}

                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="course_code" class="col-md-3 col-form-label text-md-right"><span class="requiredField">*</span>Course Code</label>

                                            <div class="col-md-8">
                                                <input id="course_code" type="text" pattern="[A-Za-z]+" minlength="1" maxlength="4" class="form-control @error('course_code') is-invalid @enderror" value="{{$course->course_code}}"
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
                                            <label for="course_num" class="col-md-3 col-form-label text-md-right"><span class="requiredField">*</span>Course Number</label>

                                            <div class="col-md-8">
                                                <input id="course_num" type="text" class="form-control @error('course_num') is-invalid @enderror" name="course_num" value="{{$course->course_num}}" required autofocus>

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
                                                <input id="course_title" type="text" class="form-control @error('course_title') is-invalid @enderror" name="course_title" value="{{$course->course_title}}" required autofocus>

                                                @error('course_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="course_semester" class="col-md-3 col-form-label text-md-right"><span class="requiredField">*</span>Year and Semester</label>

                                            <div class="col-md-3">
                                                <select id="course_semester" class="form-control @error('course_semester') is-invalid @enderror"
                                                    name="course_semester" required autofocus>
                                                    <option @if($course->semester === "W1") selected @endif value="W1">Winter Term 1</option>
                                                    <option @if($course->semester === "W2") selected @endif value="W2">Winter Term 2</option>
                                                    <option @if($course->semester === "S1") selected @endif value="S1">Summer Term 1</option>
                                                    <option @if($course->semester === "S2") selected @endif value="S2">Summer Term 2</option>

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
                                                    <option @if($course->year === 2022) selected @endif value="2022">2022</option>
                                                    <option @if($course->year === 2021) selected @endif value="2021">2021</option>
                                                    <option @if($course->year === 2020) selected @endif value="2020">2020</option>
                                                    <option @if($course->year === 2019) selected @endif value="2019">2019</option>
                                                    <option @if($course->year === 2018) selected @endif value="2018">2018</option>
                                                    <option @if($course->year === 2017) selected @endif value="2017">2017</option>

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
                                            name="course_section" autofocus value= {{$course->section}}>

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
                                                    <option @if($course->delivery_modality === 'O') selected @endif value="O">online</option>
                                                    <option @if($course->delivery_modality === 'I') selected @endif value="I">in-person</option>
                                                    <option @if($course->delivery_modality === 'B') selected @endif value="B">Blended</option>

                                                @error('delivery_modality')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary col-2 btn-sm" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary col-2 btn-sm">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-2">
                <div class="col">
                    <!-- Assign instructor button  -->
                    <button type="button" class="btn btn-outline-primary btn-sm float-right" style="width:200px"
                        data-toggle="modal" data-target="#assignInstructorModal">Add Collaborators</button>

                    <!-- Collaborator Modal -->
                    <div class="modal fade" id="assignInstructorModal" tabindex="-1" role="dialog"
                        aria-labelledby="assignInstructorModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="assignInstructorModalLabel">Add Collaborators to
                                        Course: {{$course->course_title}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <p class="form-text text-muted">Collaborators can see and edit the course. Collaborators must first register with this web application to be added to a course.
                                        By adding a collaborator, a verification email will be sent to their email address.
                                        If your collaborator is not registered with this website yet,
                                        use the "Registration invite" feature to invite them. <a href="{{ url('/invite') }}">re-direct here</a>
                                        </p>

                                    <table class="table table-borderless">

                                            @if(count($courseUsers) == 0)
                                                <tr class="table-active">
                                                    <th colspan="2">You have not added any collaborators to this course
                                                    </th>
                                                </tr>

                                            @else

                                                <tr class="table-active">
                                                    <th colspan="2">Collaborators</th>
                                                </tr>
                                                @foreach($courseUsers as $instructor)
                                                    @if($instructor->email != $user->email)
                                                        <tr>
                                                            <td>{{$instructor->email}}</td>
                                                            <td>
                                                                <form action="{{route('courses.unassign', $course->course_id)}}" method="POST" class="float-right ml-2">
                                                                    @csrf
                                                                    {{method_field('DELETE')}}
                                                                    <input type="hidden" class="form-check-input" name="program_id" value="{{$course->program_id}}">
                                                                    <input type="hidden" class="form-check-input" name="email" value="{{$instructor->email}}">
                                                                    <button type="submit" class="btn btn-danger btn-sm">Unassign</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach


                                            @endif
                                    </table>
                                </div>

                                <form method="POST" action="{{route('courses.assign', $course->course_id)}}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="email" class="col-md-3 col-form-label text-md-right">Collaborator Email</label>

                                            <div class="col-md-7">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" autofocus>

                                                @error('program')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <input type="hidden" class="form-input" name="program_id" value="{{$course->program_id}}">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary col-2 btn-sm" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary col-2 btn-sm">Assign</button>
                                    </div>
                                </form>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                        <button type="button" style="width:200px" class="btn btn-danger btn-sm float-right"
                        data-toggle="modal" data-target="#deleteConfirmation" >Delete Course</button>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteConfirmation" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmation" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteConfirmation">Delete Confirmation</h5>
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

                </div>
            </div>

        </div>

    </div>

    <!-- progress bar -->
    <div class="mt-5">
                <table class="table table-borderless text-center table-sm" style="table-layout: fixed; width: 100%">
                    <tbody>
                        <tr>
                            
                            <td><a class="btn @if (Route::current()->getName() == 'courseWizard.step1') btn-primary @else @if ($lo_count < 1) btn-secondary @else btn-success @endif @endif" href="{{route('courseWizard.step1', $course->course_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>1</b> </a></td>
                            <td><a class="btn @if (Route::current()->getName() == 'courseWizard.step2') btn-primary @else @if ($am_count < 1) btn-secondary @else btn-success @endif @endif" href="{{route('courseWizard.step2', $course->course_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>2</b> </a></td>
                            <td><a class="btn @if (Route::current()->getName() == 'courseWizard.step3') btn-primary @else @if ($la_count < 1) btn-secondary @else btn-success @endif @endif" href="{{route('courseWizard.step3', $course->course_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>3</b> </a></td>
                            <td><a class="btn @if (Route::current()->getName() == 'courseWizard.step4') btn-primary @else @if ($oAct < 1 && $oAss < 1) btn-secondary @else btn-success @endif @endif" href="{{route('courseWizard.step4', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>4</b> </a></td>
                            <td><a class="btn @if (Route::current()->getName() == 'courseWizard.step5') btn-primary @else @if ($outcomeMapsCount < 1) btn-secondary @else btn-success @endif @endif" href="{{route('courseWizard.step5', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>5</b> </a></td>
                            <td><a class="btn @if (Route::current()->getName() == 'courseWizard.step6') btn-primary @else @if ($outcomeMapsCount < 1) btn-secondary @else btn-success @endif @endif" href="{{route('courseWizard.step6', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>6</b> </a></td>
                            <td><a class="btn @if (Route::current()->getName() == 'courseWizard.step7') btn-primary @else btn-secondary @endif" href="{{route('courseWizard.step7', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>7</b> </a></td>

                        </tr>

                        <tr>
                            <td>Course Learning Outcomes</td>
                            <td>Student Assessment Methods</td>
                            <td>Teaching and Learning Activities</td>
                            <td>Course Alignment</td>
                            <td>Program Outcome Mapping</td>
                            <td>Standards and Strategic Priorities</td>
                            <td>Course Summary</td>
                        </tr>
                    </tbody>
                </table>
    </div>
</div>
