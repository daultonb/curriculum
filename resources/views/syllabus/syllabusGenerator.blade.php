
@extends('layouts.app')

@section('content')

<div id="app">
    <div class="home">
        <div class="card">
            <div class="card-body">

                <h2> Syllabus Generator
                    <select class="form-group" id="campus" name="campus" form="sylabusGenerator" style="font-size:15px;">
                        <option value="O">
                            UBC-Okanagan (default)
                        </option>
                        <option value="V">UBC-Vancouver</option>
                    </select>
                    <input type="checkbox" name="langAcknoledgement" id="langAcknoledgement" form = "sylabusGenerator">
                    <label for="langAcknoledgement" style="font-size: 14px;">Land acknowledgement</label>
                    <button type="button" class="btn btn-primary btn-sm col-2 mt-2 float-right" data-toggle="modal" data-target="#importExistingCourse" style="margin-right: 10px">
                        Import existing courses
                    </button>
                </h2>


                <!-- Import existing course Modal -->
                <div class="modal fade" id="importExistingCourse" tabindex="-1" role="dialog" aria-labelledby="importExistingCourse" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document" style="width:1250px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="importExistingCourse">Import Existing Course</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                                <div class="modal-body" style="height: auto;">

                                    <p style="text-align:left;">Select one course from the below existing courses</p>
                                    <table class="table table-hover dashBoard">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Course Title</th>
                                                <th scope="col">Course Code</th>
                                                <th scope="col">Semester</th>
                                            </tr>
                                        </thead>
                                        @foreach ($allCourses as $index => $course)
                                        <tbody>
                                        <tr>
                                            <th scope="row">
                                                <input value = {{$course->course_id}} class="form-check-input" type="radio" name="importCourse" id="importCourse"
                                                form = "sylabusGenerator" style="margin-left: 0px">
                                            </th>
                                            <td>{{$course->course_title}}</td>
                                            <td>{{$course->course_code}} {{$course->course_num}}</td>
                                            <td>
                                                @if($course->semester == "W1")
                                                Winter {{$course->year}} Term 1
                                                @elseif ($course->semester == "W2")
                                                Winter {{$course->year}} Term 2
                                                @elseif ($course->semester == "S1")
                                                Summer {{$course->year}} Term 1
                                                @else
                                                Summer {{$course->year}} Term 2
                                                @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>

                                <div class="modal-footer">
                                    <button style="width:60px" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button style="width:60px" type="button" class="btn btn-primary btn-sm"
                                    id="importButton" name="importButton" data-dismiss="modal">Import</button>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        <div class="courseInfo">
                            <form method="POST" id="sylabusGenerator" action="{{ action('SyllabusController@WordExport') }}">
                                @csrf
                                <div class="container">
                                    <!-- Course Title -->
                                    <div class="row">
                                        <div class="col mb-2">
                                            <label for="courseTitle"><span class="requiredField">*</span>Title:</label>
                                            <input id = "courseTitle" name = "courseTitle" class ="form-control" type="text"
                                            placeholder="E.g. Intro to Software development" required value="{{old('courseTitle')}}">
                                        </div>
                                    </div>
                                    <!-- Course Code, Course Number, Course Instructor -->
                                    <div class="row">
                                        <div class="col-3 mb-2">
                                            <label for="courseCode"><span class="requiredField">*</span>Course Code:</label>
                                            <input id = "courseCode" name = "courseCode" class ="form-control" type="text"
                                            placeholder="E.g. CPSC" required value="{{old('courseCode')}}">
                                        </div>

                                        <div class="col-3 mb-2">
                                            <label for="courseNumber"><span class="requiredField">*</span>Course Number:</label>
                                            <input id = "courseNumber" name = "courseNumber" class ="form-control" type="text"
                                            placeholder="E.g. 310" required value="{{old('courseNumber')}}">
                                        </div>

                                        <div class="col-3 mb-2">
                                            <label for="courseinstructor"><span class="requiredField">*</span>Course Instructor:</label>
                                            <input id = "courseinstructor" name = "courseinstructor" class ="form-control" type="text"
                                            placeholder="E.g. Dr. J. Doe" required value="{{old('courseinstructor')}}">
                                        </div>
                                    </div>
                                    <!-- Course TA -->
                                    <div class="row">
                                        <div class="col mb-2">
                                            <label for="courseTA">Course TA's:</label>
                                            <input id = "courseTA" name = "courseTA" class ="form-control col-md-7" type="text" value="{{old('courseTA')}}">
                                        </div>
                                    </div>
                                    <!-- Course Location -->
                                    <div class="row">
                                        <div class="col mb-2">
                                            <label for="courseLocation">Course Location:</label>
                                            <input id = "courseLocation" name = "courseLocation" class ="form-control col-md-5" type="text"
                                            placeholder="E.g. WEL 140"
                                            value="{{old('courseLocation')}}" 
                                            >
                                        </div>
                                    </div>
                                    <!-- Office Hours -->
                                    <div class="row">
                                        <div class="col mb-2">
                                            <label for="officeHour">Office Hours:</label>
                                            <textarea id = "officeHour" name = "officeHour" class ="form-control"
                                            type="date"
                                            form="sylabusGenerator" 
                                            >{{old('officeHour')}}</textarea>
                                        </div>
                                    </div>
                                    <!-- Course Year, Course Term, Course Start Time, Course End Time -->
                                    <div class="row">
                                        <div class="col-2 mb-2">
                                            <label for="courseYear"><span class="requiredField">*</span>Course Year:</label>
                                            <select id="courseYear" class="form-control" name="courseYear">
                                                <option
                                                value="2023"
                                                {{old('courseYear') == '2023' ? 'selected=true' : ''}}
                                                >
                                                    2023
                                                </option>
                                                <option value="2022"
                                                {{old('courseYear') == '2022' ? 'selected=true' : ''}}
                                                >
                                                    2022
                                                </option>
                                                <option value="2021"
                                                {{old('courseYear') == '2021' ? 'selected=true' : ''}}
                                                >
                                                    2021
                                                </option>
                                                <option value="2020"
                                                {{old('courseYear') == '2020' ? 'selected=true' : ''}}
                                                >
                                                    2020
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-3 mb-3">
                                            <label for="courseSemester"><span class="requiredField">*</span>Course Term:</label>
                                            <select id="courseSemester" class="form-control" name="courseSemester" required>
                                                <option value="W1" {{old('courseSemester') == 'W1' ? 'selected=true' : ''}}>
                                                    Winter Term 1
                                                </option>
                                                <option value="W2" {{old('courseSemester') == 'W2' ? 'selected=true' : ''}}>
                                                    Winter Term 2
                                                </option>
                                                <option value="S1" {{old('courseSemester') == 'S1' ? 'selected=true' : ''}}>
                                                    Summer Term 1
                                                </option>
                                                <option value="S2" {{old('courseSemester') == 'S2' ? 'selected=true' : ''}}>
                                                    Summer Term 2
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-3 mb-3">
                                            <label for="startTime">Class Start Time:</label>
                                            <input id = "startTime" name = "startTime" class ="form-control" type="text"
                                            placeholder="E.g. 1:00 PM"
                                            value="{{old('startTime')}}"
                                            >
                                        </div>

                                        <div class="col-3 mb-3">
                                            <label for="endTime">Class End Time:</label>
                                            <input id = "endTime" name = "endTime" class ="form-control" type="text"
                                            placeholder="E.g. 2:00 PM"
                                            value="{{old('endTime')}}" >
                                        </div>
                                    </div>
                                    <!-- Kieran May 19, 2021: Term start and end date not being used in generated syllabus -->
                                    <!-- <div class="row">
                                        <div class="col-3 mb-3">
                                            <label for="semesterStartday">Term Start Date:</label>
                                            <input id = "semesterStartday" name = "semesterStartday" class ="form-control"
                                            type="date" >
                                        </div>

                                        <div class="col-3 mb-3">
                                            <label for="semesterEndday">Last Class Date:</label>
                                            <input id = "semesterEndday" name = "semesterEndday" class ="form-control"
                                            type="date" >
                                        </div>
                                    </div> -->

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="classDate">Class Meeting Days:</label>

                                            <div class="classDate">
                                                <input id="monday" type="checkbox" name="schedule[]" value="Mon">
                                                <label for="monday">Monday</label>

                                                <input id="tuesday" type="checkbox" name="schedule[]" value="Tue">
                                                <label for="tuesday">Tuesday</label>

                                                <input id="wednesday" type="checkbox" name="schedule[]" value="Wed">
                                                <label for="wednesday">Wednesday</label>

                                                <input id="thursday" type="checkbox" name="schedule[]" value= "Thu">
                                                <label for="thursday">Thursday</label>

                                                <input id="friday" type="checkbox" name="schedule[]" value="Fri">
                                                <label for="friday">Friday</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="courseFormat">Course Format:</label>
                                            <textarea id = "courseFormat" name = "courseFormat" class ="form-control"
                                            type="text" form="sylabusGenerator">{{old('courseFormat')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="courseOverview">Course Overview, Content and Objectives:</label>
                                            <textarea id = "courseOverview" name = "courseOverview" class ="form-control"
                                            type="text" form="sylabusGenerator">{{old('courseOverview')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="learningOutcome">Learning Outcomes:
                                            </label>
                                            <p style="color:gray">
                                                <i>                     Upon completion of this course, students will be able to...
                                                </i>
                                            </p>
                                            <textarea id = "learningOutcome" name = "learningOutcome" class ="form-control"
                                            type="date" style="height:125px;" form="sylabusGenerator">{{old('learningOutcome')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="evaluationCriteria">Evaluation Criteria and Grading:</label>
                                            <textarea id = "evaluationCriteria" name = "evaluationCriteria" class ="form-control"
                                            type="date" style="height:125px;" form="sylabusGenerator">{{old('evaluationCriteria')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="latePolicy">Late policy:</label>
                                            <textarea id = "latePolicy" name = "latePolicy" class ="form-control"
                                            type="date" form="sylabusGenerator">{{old('latePolicy')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="missingExam">Missed exam policy:</label>
                                            <textarea id = "missingExam" name = "missingExam" class ="form-control"
                                            type="date" form="sylabusGenerator">{{old('missingExam')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="missingActivity">Missed Activity Policy:</label>
                                            <textarea id = "missingActivity" name = "missingActivity" class ="form-control"
                                            type="date" form="sylabusGenerator">{{old('missingActivity')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="passingCriteria">Passing criteria:</label>
                                            <textarea id = "passingCriteria" name = "passingCriteria" class ="form-control"
                                            type="date" form="sylabusGenerator">{{old('passingCriteria')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="requiredReading">Required Readings and Videos:</label>
                                            <textarea id = "requiredReading" name = "requiredReading" class ="form-control"
                                            type="date" form="sylabusGenerator">{{old('requiredReading')}}</textarea>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col mb-3">
                                            <div id="optionalSyllabus" class="optionalSyllabus" style="margin-top:30px;">
                                            <ul aria-label="Optional: The below are suggested sections to communicate various resources on campus" style="list-style-type:none;">
                                                <li>
                                                <input id="academic" type="checkbox" name="academic" value="academic"
                                                checked
                                                >
                                                <label for="academic">Academic Integrity Statement</label>
                                                </li>

                                                <li>
                                                <input id="final" type="checkbox" name="final" value="final" checked>
                                                <label for="final">Final Examinations</label>
                                                </li>

                                                <li>
                                                <input id="gradingPractices" type="checkbox" name="gradingPractices" value="gradingPractices" checked>
                                                <label for="gradingPractices">Grading Practices</label>
                                                </li>

                                                <li>
                                                <input id="health" type="checkbox" name="health" value="health" checked>
                                                <label for="health">Health & Wellness</label>
                                                </li>

                                                <li>
                                                <input id="safewalk" type="checkbox" name="safewalk" value="safewalk" checked>
                                                <label for="safewalk">Safewalk</label>
                                                </li>

                                                <li>
                                                <input id="hub" type="checkbox" name="hub" value="hub" checked>
                                                <label for="hub">Student Learning Hub</label>
                                                </li>

                                                <li>
                                                <input id="disabilityAssistance" type="checkbox" name="disabilityAssistance" value="disabilityAssistance" checked>
                                                <label for="disabilityAssistance">UBC Okanagan Disability Resource Centre</label>
                                                </li>

                                                <li>
                                                <input id="equity" type="checkbox" name="equity" value= "equity" checked>
                                                <label for="equity">UBC Okanagan Equity and Inclusion Office</label>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary col-2 btn-sm"
            style="float: right;margin:10px;" form="sylabusGenerator">Generate Syllabus</button>
        </div>
    </div>
</div>

<script type="application/javascript">
    $(document).ready(function () {
        $('#finalcheckbox').click(function() {
            $("#finalDate").prop("disabled", !this.checked);
        });

        $('#campus').change(handleVersion);

        // Import Course information into the input field throught GET ajax call
        $('#importButton').click(function() {
            var course_id = $('input[name="importCourse"]:checked').val();
            $.ajax({
                type: "GET",
                url: "/syllabusGenerator/course",
                data: {course_id : course_id},
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
            }).done(function(data) {
                var decode_data = JSON.parse(data);
                var c_title = decode_data['c_title'];
                var c_code = decode_data['c_code'];
                var c_num = decode_data['c_num'];
                var c_year = decode_data['c_year'];
                var c_term = decode_data['c_term'];
                var a_methods = decode_data['a_methods'];
                var l_outcomes = decode_data['l_outcomes'];

                var a_methods_text = "";
                var l_outcomes_text = "";

                a_methods.forEach(element => {
                    a_methods_text += element.a_method + " " + element.weight + "%\n";
                });

                for(var i = 0; i < l_outcomes.length; i++) {
                    l_outcomes_text += (i+1) + ". " + l_outcomes[i].l_outcome + "\n";
                }
                var c_title_input = $('#courseTitle');
                var c_code_input = $('#courseCode');
                var c_num_input = $('#courseNumber');
                var c_year_input = $('#courseYear');
                var c_term_input = $('#courseSemester');
                var a_method_input = $('#evaluationCriteria');
                var l_outcome_input = $('#learningOutcome');

                c_title_input.val(c_title);
                c_code_input.val(c_code);
                c_num_input.val(c_num);
                c_year_input.val(c_year);
                c_term_input.val(c_term);
                a_method_input.val(a_methods_text);
                l_outcome_input.val(l_outcomes_text);
            });
        });

        // Dynamic update required attribute for dates
        // var requiredCheckboxes = $('.classDate :checkbox[required]');
        // requiredCheckboxes.change(function() {
        //     if(requiredCheckboxes.is(':checked')) {
        //     requiredCheckboxes.removeAttr('required');
        //     } else {
        //     requiredCheckboxes.attr('required', 'required');
        //     }
        // });

    });




    // Function changes optional verison of syllabus
    function handleVersion() {
        // the optionalList variables need to match the optional syllabus list above (default is to display Okanagan)

        var vancouverOptionalList = `
        <ul aria-label="Optional: The below are suggested sections to communicate various resources on campus" style="list-style-type:none;">
                <li>
                <input id="disabilities" type="checkbox" name="disabilities" value="disabilities" checked>
                <label for="disabilities">Accommodations for students with disabilities</label>
                </li>
            </ul>`;
        var okanaganOptionalList = `
        <ul aria-label="Optional: The below are suggested sections to communicate various resources on campus" style="list-style-type:none;">
            <li>
            <input id="academic" type="checkbox" name="academic" value="academic" checked>
            <label for="academic">Academic Integrity</label>
            </li>

            <li>
            <input id="final" type="checkbox" name="final" value="final" checked>
            <label for="final">Final Examinations</label>
            </li>

            <li>
            <input id="gradingPractices" type="checkbox" name="gradingPractices" value="gradingPractices" checked>
            <label for="gradingPractices">Grading Practices</label>
            </li>

            <li>
            <input id="health" type="checkbox" name="health" value="health" checked>
            <label for="health">Health & Wellness</label>
            </li>

            <li>
            <input id="safewalk" type="checkbox" name="safewalk" value="safewalk" checked>
            <label for="safewalk">Safewalk</label>
            </li>

            <li>
            <input id="hub" type="checkbox" name="hub" value="hub" checked>
            <label for="hub">Student Learning Hub</label>
            </li>

            <li>
            <input id="disabilityAssistance" type="checkbox" name="disabilityAssistance" value="disabilityAssistance" checked>
            <label for="disabilityAssistance">UBC Okanagan Disability Resource Centre</label>
            </li>

            <li>
            <input id="equity" type="checkbox" name="equity" value= "equity" checked>
            <label for="equity">UBC Okanagan Equity and Inclusion Office</label>
            </li>
            </ul>`;

            var conceptName = $('#campus').find(":selected").text();
            if(conceptName == 'UBC-Vancouver'){
                $('#optionalSyllabus').html(vancouverOptionalList);

            }else{
                $('#optionalSyllabus').html(okanaganOptionalList);
        }
        // unused optional resources
        // <li>
        // <input id="plagiarism" type="checkbox" name="plagiarism" value="plagiarism" checked>
        // <label for="plagiarism">Plagiarism and Collaboration</label>
        // </li>

        // <li>
        // <input id="cooperation" type="checkbox" name="cooperation" value="cooperation" checked>
        // <label for="cooperation">Cooperation vs. Cheating</label>
        // </li>

        // <li>
        // <input id="grievances" type="checkbox" name="grievances" value="grievances" checked>
        // <label for="grievances">Grievances and Complaints Procedures</label>
        // </li>
        // <li>
        // <input id="sexual" type="checkbox" name="sexual" value="sexual" checked>
        // <label for="sexual">Sexual Violence Prevention and Response Office</label>
        // </li>

        // <li>
        // <input id="IIO" type="checkbox" name="IIO" value="IIO" checked>
        // <label for="IIO">Independent Investigations Office</label>
        // </li>

        // <li>
        // <input id="copyright" type="checkbox" name="copyright" value="copyright" checked>
        // <label for="copyright">Copyright Disclaimer</label>
        // </li>

    }
</script>

@endsection
