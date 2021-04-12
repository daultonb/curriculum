@extends('layouts.app')

@section('content')

<div id="app">
    <div class="home">
        <div class="card">
            <div class="card-body">
                <h2> Syllabus Generator </h2>

                <div class="card">
                    <div class="card-body">

                        <div class="courseInfo">
                            <form method="GET" id="sylabusGenerator" action="{{ action('SyllabusController@WordExport') }}">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="col">

                                            <label for="courseTitle">Course Title:</label>
                                            <input id = "courseTitle" name = "courseTitle" class ="form-control" type="text" placeholder="ex. Intro to Software development">

                                            <label for="courseNumber">Course Number:</label>
                                            <input id = "courseNumber" name = "courseNumber" class ="form-control col-md-5" type="text" placeholder="ex. CPSC 310">

                                            <label for="courseinstructor">Course Instructor:</label>
                                            <input id = "courseinstructor" name = "courseinstructor" class ="form-control" type="text" placeholder="ex. Dr. J. Doe">

                                            <label for="courseTA">Course TA's (optional):</label>
                                            <input id = "courseTA" name = "courseTA" class ="form-control" type="text">

                                            <label for="courseLocation">Course Location:</label>
                                            <input id = "courseLocation" name = "courseLocation" class ="form-control" type="text" placeholder="ex. WEL 140">

                                            <label for="courseYear">Course Year:</label>
                                            <select id="courseYear" class="form-control col-md-2" name="courseYear">
                                                <option vlaue="2023">2023</option>
                                                <option value="2022">2022</option>
                                                <option value="2021">2021</option>
                                                <option value="2020">2020</option>
                                            </select>

                                            <label for="startTime">Start Time:</label>
                                            <input id = "startTime" name = "startTime" class ="form-control" type="text" placeholder="ex. 1:00 PM">

                                            <label for="endTime">End Time:</label>
                                            <input id = "endTime" name = "endTime" class ="form-control" type="text" placeholder="ex. 2:00 PM">

                                            <label for="semesterStartday">Semester Start Date:</label>
                                            <input id = "semesterStartday" name = "semesterStartday" class ="form-control col-md-3" type="date">

                                            <label for="semesterEndday">Last Class Date:</label>
                                            <input id = "semesterEndday" name = "semesterEndday" class ="form-control col-md-3" type="date">

                                            <label for="finalcheckbox">Does the course has Final ?</label>
                                            <input id = "finalcheckbox" name = "finalcheckbox" type="checkbox" value="1">

                                            <label for="finalDate">Final Exam Date:</label>
                                            <input id = "finalDate" name = "finalDate" class="form-control col-md-3" type="date" disabled>

                                            <label for="classDate">Class Days:</label>

                                            <div id="classDate">
                                                <input id="monday" type="checkbox" name="schedule[]" value="M">
                                                <label for="monday">Monday</label>

                                                <input id="tuesday" type="checkbox" name="schedule[]" value="Tu">
                                                <label for="tuesday">Tuesday</label>

                                                <input id="wednesday" type="checkbox" name="schedule[]" value="w">
                                                <label for="wednesday">Wednesday</label>

                                                <input id="thursday" type="checkbox" name="schedule[]" value= "Th">
                                                <label for="thursday">Thursday</label>

                                                <input id="friday" type="checkbox" name="schedule[]" value="F">
                                                <label for="friday">Friday</label>
                                            </div>

                                            <button type="submit" class="btn btn-primary col-2 btn-sm"
                                            style="float: right">Generate Syllaus Dococumnet</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    $(document).ready(function () {
        $('#finalcheckbox').click(function() {
            $("#finalDate").prop("disabled", !this.checked);
        });
});
</script>

@endsection
