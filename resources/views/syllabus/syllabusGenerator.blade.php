
@extends('layouts.app')

@section('content')

<div id="app">
    <div class="home">
        <div class="card">
            <div class="card-body">
                <h2> Syllabus Generator
                    <!-- Campus dropdown -->
                    <span class="requiredField" style="margin-left: 32px;font-size:15px;">*
                        <select  class="form-group" id="campus" name="campus" form="sylabusGenerator" style="text-align:center; margin-right: 8px" required>
                            <option disabled selected value=""> -- Campus -- </option>
                            <option value="O">
                                UBC Okanagan
                            </option>
                            <option value="V">UBC Vancouver</option>
                        </select>
                    </span>
                    <!-- land acknowledgment -->
                    <input type="checkbox" name="landAcknowledgement" id="landAcknowledgement" form = "sylabusGenerator" checked>
                    <label for="landAcknowledgement" style="font-size: 14px;">Land acknowledgement</label>
                    <button type="button" class="btn btn-primary btn-sm col-2 mt-2 float-right" data-toggle="modal" data-target="#importExistingCourse" style="margin-right: 10px">
                        Import existing courses
                    </button>
                </h2>

                <div class="card">
                    <div class="card-body">

                        <div class="courseInfo">
                            <form method="POST" id="sylabusGenerator" action="{{!empty($syllabus) ? action('SyllabusController@save', $syllabus->id) : action('SyllabusController@save')}}">
                                @csrf
                                <div class="container">
                                    <!-- Course Title -->
                                    <div class="row">
                                        <div class="col mb-2">
                                            <label for="courseTitle"><span class="requiredField">*</span>Course Title</label>
                                            <input spellcheck="true" id = "courseTitle" name = "courseTitle" class ="form-control" type="text"
                                            placeholder="E.g. Intro to Software development" required value="{{ isset($courseTitle) ? $courseTitle : ''}}">
                                        </div>
                                    </div>
                                    <!-- Course Code, Course Number, Course Credit -->
                                    <div class="row">
                                        <div class="col-2 mb-2">
                                            <label for="courseCode"><span class="requiredField">*</span>Course Code</label>
                                            <input id = "courseCode" name = "courseCode" class ="form-control" type="text"
                                            placeholder="E.g. CPSC" required value="{{ isset($courseCode) ? $courseCode : ''}}">
                                        </div>

                                        <div class="col-2 mb-2">
                                            <label for="courseNumber"><span class="requiredField">*</span>Course Number</label>
                                            <input id = "courseNumber" name = "courseNumber" class ="form-control" type="text"
                                            placeholder="E.g. 310" required value="{{ isset($courseNum) ? $courseNum : ''}}">
                                        </div>
                                        <div id="courseCredit" class="col-2 mb-2">
                                        </div>
                                    </div>
                                    <!-- Course Instructor, Course Semester -->
                                    <div class="row">

                                        <div class="col-5 mb-2">
                                            <label for="courseInstructor"><span class="requiredField">*</span>Course Instructor</label>
                                            
                                            <input id = "courseInstructor" name = "courseInstructor" class ="form-control" type="text"
                                            placeholder="E.g. Dr. J. Doe" required value="{{ !empty($syllabus) ? $syllabus->course_instructor : ''}}">
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label for="courseSemester"><span class="requiredField">*</span>Course Term</label>
                                            <select id="courseSemester" class="form-control" name="courseSemester" required>
                                                <option value="W1" {{isset($courseSemester) ? (($courseSemester == 'W1') ? 'selected=true' : '') : ''}}>
                                                    Winter Term 1
                                                </option>
                                                <option value="W2" {{isset($courseSemester) ? (($courseSemester == 'W2') ? 'selected=true' : '') : ''}}>
                                                    Winter Term 2
                                                </option>
                                                <option value="S1" {{isset($courseSemester) ? (($courseSemester == 'S1') ? 'selected=true' : '') : ''}}>
                                                    Summer Term 1
                                                </option>
                                                <option value="S2" {{isset($courseSemester) ? (($courseSemester == 'S2') ? 'selected=true' : '') : ''}}>
                                                    Summer Term 2
                                                </option>
                                            </select>
                                        </div>
                                        <!-- Course Year -->
                                        <div class="col-2 mb-2">
                                            <label for="courseYear"><span class="requiredField">*</span>Course Year</label>
                                            <select id="courseYear" class="form-control" name="courseYear">
                                                <option
                                                value="2023"
                                                {{isset($courseYear) ? (($courseYear == '2023') ? 'selected=true' : '') : ''}}
                                                >
                                                    2023
                                                </option>
                                                <option value="2022"
                                                {{isset($courseYear) ? (($courseYear == '2022') ? 'selected=true' : '') : ''}}
                                                >
                                                    2022
                                                </option>
                                                <option value="2021"
                                                {{isset($courseYear) ? (($courseYear == '2021') ? 'selected=true' : '') : ''}}
                                                >
                                                    2021
                                                </option>
                                                <option value="2020"
                                                {{isset($courseYear) ? (($courseYear == '2020') ? 'selected=true' : '') : ''}}
                                                >
                                                    2020
                                                </option>
                                                <option value="2019"
                                                {{isset($courseYear) ? (($courseYear == '2019') ? 'selected=true' : '') : ''}}
                                                >
                                                    2019
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Course Location -->
                                    <div class="row">
                                        <div class="col-6 mb-2">
                                            <label for="courseLocation">Course Location</label>
                                            <input id = "courseLocation" name = "courseLocation" class ="form-control" type="text"
                                            placeholder="E.g. WEL 140"
                                            value="{{ !empty($syllabus) ? $syllabus->course_location : ''}}" 
                                            >
                                        </div>
                                        <!-- Office Location -->
                                        <div id="officeLocation" class="col-6 mb-2">
                                        </div>
                                    </div>

                                    <!-- Course Description -->
                                    <div class="row" id="courseDescription"></div>                                    
                                    <!-- Course Contacts -->
                                    <div class="row" id="courseContacts"></div>

                                    <!-- Office Hours -->
                                    <div class="row">
                                        <div class="col mb-2">
                                            <label for="officeHour">Office Hours</label>
                                            <i class="bi bi-info-circle-fill" data-toggle="tooltip" data-bs-placement="right" title="{{$inputFieldDescriptions['officeHours']}}"></i>
                                            <textarea spellcheck="true" id = "officeHour" name = "officeHour" class ="form-control"
                                            type="date"
                                            form="sylabusGenerator" 
                                            >{{ !empty($syllabus) ? $syllabus->office_hours : ''}}</textarea>
                                        </div>
                                    </div>
                                    <!-- Other Course Staff -->
                                    <div class="row">
                                        <div class="col mb-2">
                                            <label  for="otherCourseStaff">Other Instructional Staff</label>
                                            <i class="bi bi-info-circle-fill" data-toggle="tooltip" data-bs-placement="right" title="{{$inputFieldDescriptions['otherCourseStaff']}}"></i>
                                            <div class="form-note">
                                                <i class="bi bi bi-exclamation-lg"></i><p>Place each entry on a newline for the best formatting results.</p>
                                            </div>
                                            <textarea id = "otherCourseStaff" placeholder="Professor, Dr. Phil, PhD Clinical Psychology, ...&#10;Instructor, Bill Nye, BS Mechanical Engineering, ..." name = "otherCourseStaff" class ="form-control" form="sylabusGenerator" spellcheck="true">{{ !empty($syllabus) ? $syllabus->other_instructional_staff : ''}}</textarea>
                                        </div>
                                    </div>
                                    <!-- Class Start Time, Class End Time -->
                                    <div class="row">
                                        <div class="col-3 mb-3">
                                            <label for="startTime">Class Start Time</label>
                                            <input id = "startTime" name = "startTime" class ="form-control" type="text"
                                            placeholder="E.g. 1:00 PM"
                                            value="{{ !empty($syllabus) ? $syllabus->class_start_time : ''}}"
                                            >
                                        </div>

                                        <div class="col-3 mb-3">
                                            <label for="endTime">Class End Time</label>
                                            <input id = "endTime" name = "endTime" class ="form-control" type="text"
                                            placeholder="E.g. 2:00 PM"
                                            value="{{ !empty($syllabus) ? $syllabus->class_end_time : ''}}" >
                                        </div>
                                    </div>
                                    <!-- Class Meeting Days -->
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="classDate">Class Meeting Days</label>

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

                                    <!-- Course Instructor Biographical Statement -->
                                    <div class="row" id="courseInstructorBio"></div>

                                    <!-- Course Prerequisites -->
                                    <div class="row" id="coursePrereqs"></div>

                                    <!-- Course Corequisites -->
                                    <div class="row" id="courseCoreqs"></div>

                                    <!-- Course Structure -->
                                    <div class="row" id="courseStructure"></div>

                                    <!-- Course Schedule -->
                                    <div class="row" id="courseSchedule"></div>

                                    <!-- Course Format -->
                                    <div class="row" id="courseFormat"></div>

                                    <!-- Course Overview -->
                                    <div class="row" id="courseOverview"></div>

                                    <!-- Learning Outcomes -->
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="learningOutcome">Learning Outcomes
                                            </label>
                                            <i class="bi bi-info-circle-fill" data-toggle="tooltip" data-bs-placement="right" title="{{$inputFieldDescriptions['learningOutcomes']}}"></i>
                                            <div class="form-note">
                                                <i class="bi bi-exclamation-lg"></i><p>Place each entry on a newline for the best formatting results.</p>
                                            </div>
                                            <p style="color:gray">
                                                <i>                     Upon successful completion of this course, students will be able to...
                                                </i>
                                            </p>
                                            <textarea id = "learningOutcome" placeholder="Define ... &#10;Classify ..." name = "learningOutcome" class ="form-control"
                                            type="date" style="height:125px;" form="sylabusGenerator" spellcheck="true">{{ !empty($syllabus) ? $syllabus->learning_outcomes : ''}}</textarea>
                                        </div>
                                    </div>
                                    
                                    <!-- Course Learning Assessments -->
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="learningAssessments">Assessments of Learning</label>
                                            <i class="bi bi-info-circle-fill" data-toggle="tooltip" data-bs-placement="right" title="{{$inputFieldDescriptions['learningAssessments']}}"></i>
                                            <div class="form-note">
                                                <i class="bi bi-exclamation-lg"></i><p>Place each entry on a newline for the best formatting results.</p>
                                            </div>
                                            <textarea id = "learningAssessments" placeholder="Presentation, 25%, Dec 1, ... &#10;Midterm Exam, 25%, Sept 31, ..." name = "learningAssessments" class ="form-control"
                                            type="date" style="height:125px;" form="sylabusGenerator" spellcheck="true">{{ !empty($syllabus) ? $syllabus->assessments_of_learning : ''}}</textarea>
                                        </div>
                                    </div>

                                    <!-- Learning Activities -->
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="learningActivities">Learning Activities</label>
                                            <i class="bi bi-info-circle-fill" data-toggle="tooltip" data-bs-placement="right" title="{{$inputFieldDescriptions['learningActivities']}}"></i>
                                            <div class="form-note">
                                                <i class="bi bi-exclamation-lg"></i><p>Place each entry on a newline for the best formatting results.</p>
                                            </div>
                                            <textarea id = "learningActivities" placeholder="Class participation consists of clicker questions, group discussions ... &#10;Students are expected to complete class pre-readings ..."name = "learningActivities" class ="form-control"
                                            type="date" style="height:125px;" form="sylabusGenerator" spellcheck="true">{{ !empty($syllabus) ? $syllabus->learning_activities : ''}}</textarea>
                                        </div>
                                    </div>

                                    <!-- Late Policy -->
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="latePolicy">Late policy</label>
                                            <i class="bi bi-info-circle-fill" data-toggle="tooltip" data-bs-placement="right" title="{{$inputFieldDescriptions['latePolicy']}}"></i>
                                            <textarea id = "latePolicy" name = "latePolicy" class ="form-control"
                                            type="date" form="sylabusGenerator" spellcheck="true">{{ !empty($syllabus) ? $syllabus->late_policy : ''}}</textarea>
                                        </div>
                                    </div>

                                    <!-- Course Missing Exam -->
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="missingExam">Missed exam policy</label>
                                            <textarea id = "missingExam" name = "missingExam" class ="form-control"
                                            type="date" form="sylabusGenerator" spellcheck="true">{{ !empty($syllabus) ? $syllabus->missed_exam_policy : ''}}</textarea>
                                        </div>
                                    </div>

                                    <!-- Course Missed Activity Policy -->
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="missingActivity">Missed Activity Policy</label>
                                            <i class="bi bi-info-circle-fill" data-toggle="tooltip" data-bs-placement="right" title="{{$inputFieldDescriptions['missedActivityPolicy']}}"></i>
                                            <textarea id = "missingActivity" name = "missingActivity" class ="form-control"
                                            type="date" form="sylabusGenerator" spellcheck="true">{{ !empty($syllabus) ? $syllabus->missed_activity_policy : ''}}</textarea>
                                        </div>
                                    </div>

                                    <!-- Course Passing Criteria -->
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="passingCriteria">Passing criteria</label>
                                            <textarea id = "passingCriteria" name = "passingCriteria" class ="form-control"
                                            type="date" form="sylabusGenerator" spellcheck="true">{{ !empty($syllabus) ? $syllabus->passing_criteria : ''}}</textarea>
                                        </div>
                                    </div>

                                    <!-- Course Learning Materials -->
                                    <div class="row">
                                        <div class="col mb-3" >
                                            <label for="learningMaterials">Learning Materials</label>
                                            <i class="bi bi-info-circle-fill" data-toggle="tooltip" data-bs-placement="right" title="{{$inputFieldDescriptions['learningMaterials']}}"></i>
                                            <textarea id = "learningMaterials" name = "learningMaterials" class ="form-control"
                                            type="date" form="sylabusGenerator" spellcheck="true">{{ !empty($syllabus) ? $syllabus->learning_materials : ''}}</textarea>
                                        </div>
                                    </div>

                                    <!-- Course Learning Resources -->
                                    <div class="row" id="courseLearningResources"></div>

                                    <!-- Course Optional Resources -->
                                    <div class="row">
                                        <div class="col mb-3">
                                            <div class="optionalSyllabus" style="margin-top:30px;">
                                            <ul id="optionalSyllabus" aria-label="Optional: The below are suggested sections to communicate various resources on campus" style="list-style-type:none;">
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
            <div style="display:flex; flex-flow:row nowrap; justify-content:flex-end; margin-top: 24px">
                <button type="submit" class="btn btn-primary col-2 btn-sm" style="margin-right:24px;" form="sylabusGenerator">Save</button>
                <button type="submit" name="download" value="1" class="btn btn-primary col-2 btn-sm" form="sylabusGenerator">Save and Download <i class="bi bi-download"></i></button>
            </div>
        </div>
    </div>
</div>

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
                    @foreach ($myCourses as $index => $course)
                    <tbody>
                        <tr>
                            <th scope="row">
                                <input value = {{$course->course_id}} class="form-check-input" type="radio" name="importCourse" id="importCourse" form = "sylabusGenerator" style="margin-left: 0px">
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
                <button style="width:60px" type="button" class="btn btn-primary btn-sm" id="importButton" name="importButton" data-dismiss="modal">Import</button>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">

    // Function changes optional verison of syllabus
    function onChangeCampus() {
        // the optionalList variables need to match the optional syllabus list above (default is to display Okanagan)

        $('.courseInfo').tooltip(
            {
                selector: '.has-tooltip'
            }     
        );


        var vancouverOptionalList = `
            <li>
            <input id="academic" type="checkbox" name="academic" value="academic" checked>
            <label for="academic">Academic Integrity Statement</label>
            </li>

            <li>
            <input id="disabilities" type="checkbox" name="disabilities" value="disabilities" checked>
            <label for="disabilities">Accommodations for students with disabilities</label>
            </li>`;
        var okanaganOptionalList = `
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
            </li>`;

        var courseCredit = `
            <label for="courseCredit">
                <span class="requiredField">*</span>
                Course Credit
            </label>
            <input name = "courseCredit" class ="form-control" type="number" min="0" step="1"placeholder="E.g. 3" required>
            `;
        
        var officeLocation = `
            <label for="officeLocation">Office Location</label>
            <input name = "officeLocation" class ="form-control" type="text" placeholder="E.g. WEL 140" value="{{old('officeLocation')}}">
            `;

        var courseDescription = `
            <div class="col mb-2">
                <label for="courseDescription">Course Description</label>
                <i class="bi bi-info-circle-fill has-tooltip"  data-bs-placement="right" title="{{$inputFieldDescriptions['courseDescription']}}"></i>
                <textarea name = "courseDescription" class ="form-control" type="date" form="sylabusGenerator">{{old('courseDescription')}}</textarea>
            </div>
            `;

        var courseContacts = `
            <div class="col mb-2">
                <label for="courseContacts">Contacts</label>
                <i class="bi bi-info-circle-fill has-tooltip"  data-bs-placement="right" title="{{$inputFieldDescriptions['courseContacts']}}"></i>
                <div class="form-note">
                    <i class="bi bi-exclamation-lg"></i><p>Place each entry on a newline for the best formatting results.</p>
                </div>
                <textarea name = "courseContacts" placeholder="Professor, Jane Doe, jane.doe@ubc.ca, +1 234 567 8900, ... &#10;Teaching Assistant, John Doe, john.doe@ubc.ca, ..."class ="form-control" type="date" form="sylabusGenerator">{{old('courseContacts')}}</textarea>
            </div>
            `;

        var coursePrereqs = `
            <div class="col mb-3">
                <label for="coursePrereqs">Course Prerequisites</label>
                <i class="bi bi-info-circle-fill has-tooltip" data-bs-placement="right" title="{{$inputFieldDescriptions['coursePrereqs']}}"></i>
                <div class="form-note">
                    <i class="bi bi-exclamation-lg"></i><p>Place each entry on a newline for the best formatting results.</p>
                </div>
                <textarea name = "coursePrereqs" placeholder="CPSC 210 or EECE 210 or CPEN 221 &#10;CPSC 121 or MATH 220"class ="form-control" type="text" form="sylabusGenerator" >{{old('coursePrereqs')}}</textarea>
            </div>
            `;
        var courseCoreqs = `
            <div class="col mb-3">
                <label for="courseCoreqs">Course Corequisites</label>
                <i class="bi bi-info-circle-fill has-tooltip" data-bs-placement="right" title="{{$inputFieldDescriptions['courseCoreqs']}}"></i>
                <div class="form-note">
                    <i class="bi bi-exclamation-lg"></i><p>Place each entry on a newline for the best formatting results.</p>
                </div>
                <textarea id = "courseCoreqs" placeholder="CPSC 107 or CPSC 110 &#10;CPSC 210" name = "courseCoreqs" class ="form-control" type="text" form="sylabusGenerator">{{old('courseCoreqs')}}</textarea>
            </div>
            `;
        var courseInstructorBio = `
            <div class="col mb-2">
                    <label for="courseInstructorBio">Course Instructor Biographical Statement</label>
                    <i class="bi bi-info-circle-fill has-tooltip" data-bs-placement="right" title="{{$inputFieldDescriptions['instructorBioStatement']}}"></i>
                    <textarea id = "courseInstructorBio" name = "courseInstructorBio" class ="form-control" form="sylabusGenerator" spellcheck="true">{{old('courseInstructorBio')}}</textarea>
            </div>
            `;

        var courseSchedule = `
            <div class="col mb-3">
                <label for="courseSchedule">Course Schedule</label>
                <i class="bi bi-info-circle-fill has-tooltip"  data-bs-placement="right" title="{{$inputFieldDescriptions['courseSchedule']}}"></i>
                <textarea name = "courseSchedule" class ="form-control" type="text" form="sylabusGenerator" spellcheck="true">{{old('courseSchedule')}}</textarea>
            </div>
            `;        
        
        var courseStructure = `
            <div class="col mb-3">
                <label for="courseStructure">Course Structure</label>
                <i class="bi bi-info-circle-fill has-tooltip" data-bs-placement="right" title="{{$inputFieldDescriptions['courseStructure']}}"></i>
                <textarea name = "courseStructure" class ="form-control" type="text" form="sylabusGenerator" spellcheck="true">{{old('courseStructure')}}</textarea>
            </div>
            `;

        var courseLearningResources = `
            <div class="col mb-2">
                    <label for="courseLearningResources">Learning Resources</label>
                    <i class="bi bi-info-circle-fill has-tooltip" data-bs-placement="right" title="{{$inputFieldDescriptions['courseLearningResources']}}"></i>
                    <textarea id = "courseLearningResources" name = "courseLearningResources" class ="form-control" form="sylabusGenerator" spellcheck="true">{{old('courseLearningResources')}}</textarea>
            </div>
            `;

        var courseFormat = `
            <div class="col mb-3">
                <label for="courseFormat">Course Format</label>
                <textarea name = "courseFormat" class ="form-control" type="text" form="sylabusGenerator" spellcheck="true">{{old('courseFormat')}}</textarea>
            </div>
            `;
        var courseOverview = `
            <div class="col mb-3">
                <label for="courseOverview">Course Overview, Content and Objectives</label>
                <textarea name = "courseOverview" class ="form-control" type="text" form="sylabusGenerator" spellcheck="true">{{old('courseOverview')}}</textarea>
            </div>        
            `;
        var campusName = $('#campus').find(":selected").text();
        if(campusName == 'UBC Vancouver'){
            $('#optionalSyllabus').html(vancouverOptionalList);
            $('#courseCredit').html(courseCredit);
            $('#officeLocation').html(officeLocation);
            $('#courseContacts').html(courseContacts);
            $('#coursePrereqs').html(coursePrereqs);
            $('#courseCoreqs').html(courseCoreqs);
            $('#courseStructure').html(courseStructure);
            $('#courseSchedule').html(courseSchedule);
            $('#courseInstructorBio').html(courseInstructorBio);
            $('#courseDescription').html(courseDescription);
            $('#courseLearningResources').html(courseLearningResources);

            $('#courseFormat').empty();
            $('#courseOverview').empty();
        }
        else
        {
            $('#optionalSyllabus').html(okanaganOptionalList);
            $('#courseFormat').html(courseFormat);
            $('#courseOverview').html(courseOverview);
            
            $('#courseCredit').empty();
            $('#officeLocation').empty();
            $('#courseContacts').empty();
            $('#coursePrereqs').empty();
            $('#courseCoreqs').empty();
            $('#courseStructure').empty();
            $('#courseSchedule').empty();
            $('#courseInstructorBio').empty();
            $('#courseDescription').empty();
            $('#courseLearningResources').empty();
        }

    }

    $(document).ready(function () {

        var syllabus = <?php echo json_encode($syllabus);?>;

        console.log(courseSemester + courseYear);
    
        $('[data-toggle="tooltip"]').tooltip();

        $('#campus').change(onChangeCampus);


        // Import Course information into the input field throught GET ajax call
        $('#importButton').click(function() {
            var course_id = $('input[name="importCourse"]:checked').val();
            $.ajax({
                type: "GET",
                url: "/syllabusGenerator/import/course",
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
                var a_method_input = $('#learningAssessments');
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

        // trigger campus dropdown change based on saved syllabus
        if (syllabus['campus'] === 'O') {
            $('#campus').val('O').trigger('change');
        } else if (syllabus['campus'] === 'V') {
            $('#campus').val('V').trigger('change');
        }
        
        // use saved class meeting days
        if (syllabus['class_meeting_days']) {
            // split class meeting days string into an array
            const classMeetingDays = syllabus['class_meeting_days'].split("/");
            // mark days included in classMeetingDays as checked

            if (classMeetingDays.includes('Mon')) {
                $('#monday').attr('checked', 'true');
            }
            if (classMeetingDays.includes('Tue')) {
                $('#tuesday').attr('checked', 'true');
            }
            if (classMeetingDays.includes('Wed')) {
                $('#wednesday').attr('checked', 'true');
            }
            if (classMeetingDays.includes('Thu')) {
                $('#thursday').attr('checked', 'true');
            }
            if (classMeetingDays.includes('Fri')) {
                $('#friday').attr('checked', 'true');
            }
        }

    });


    
</script>

@endsection
