<!doctype html>
<html lang="en">

    <head>
<!-- CSS only -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">    </head>
    <body>

        <div style="margin-bottom:16px>
            <p class="text-right">{{date("Y-m-d")}}</p>
            <h2>{{$course->course_code}}{{$course->course_num}}: Course Summary</h2>
            <p><b>Course:</b> {{$course->year}} {{$course->semester}} {{$course->course_code}}{{$course->course_num}} {{$course->section}}
            - {{$course->course_title}}</p>
            <p><b>Delivery modality:</b>
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
            </p>
            <p><b>Faculty/School:</b> {{$program->faculty}}</p>
            <p><b>Department:</b> {{$program->department}}</p>
            <p><b>Level: </b>{{$program->level}}</p>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><h4>Course Learning Outcomes</h4></div>
            <!-- <div class="panel-body" style="margin:8px"> -->

                @if(count($l_outcomes)<1)
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-circle-fill"></i>There are no course learning outcomes set for this course. <a class="alert-link" href="{{route('courseWizard.step1', $course->course_id)}}">Add course learning outcomes.</a>                     
                    </div>
                @else
                    <table class="table" >
                        <tr class="info">
                            <th class="text-center">#</th>
                            <th>Course Learning Outcome</th>
                        </tr>

                        @foreach($l_outcomes as $index => $l_outcome)
                        <tr>
                            <td class="text-center" style="width:5%" ><strong>{{$index+1}}</strong></td>
                            <td>
                                <strong>{{$l_outcome->clo_shortphrase}}</strong><br>
                                    {{$l_outcome->l_outcome}}
                            </td>
                        </tr>
                        @endforeach


                    </table>
                @endif
            <!-- </div> -->
        </div>

        <!-- <div class="card ">
            <h3 class="card-header wizard" >
            {{$course->course_code}}{{$course->course_num}}: Course Summary
            </h3>

            <div class="card mt-4 mb-4">
                <h5 class="card-header">
                    Course Learning Outcomes
                </h5>

                <div class="card-body m-2">

                
                <div class="body m-4 mb-2">
                    @if(count($l_outcomes)<1)
                        <div class="alert alert-warning wizard">
                            <i class="bi bi-exclamation-circle-fill"></i>There are no course learning outcomes set for this course. <a class="alert-link" href="{{route('courseWizard.step1', $course->course_id)}}">Add course learning outcomes.</a>                     
                        </div>
                    @else
                        <table class="table table-light table-bordered table" >
                            <tr class="table-primary">
                                <th class="text-center">#</th>
                                <th>Course Learning Outcome</th>
                            </tr>

                            @foreach($l_outcomes as $index => $l_outcome)
                            <tr>
                                <td class="text-center fw-bold" style="width:5%" >{{$index+1}}</td>
                                <td>
                                    <b>{{$l_outcome->clo_shortphrase}}</b><br>
                                        {{$l_outcome->l_outcome}}
                                    </td>
                            </tr>
                            @endforeach


                        </table>
                    @endif
                </div>
            </div>
        </div> -->
    </body>
</html>

