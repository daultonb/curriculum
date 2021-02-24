@extends('layouts.app')

@section('content')
<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('courses.wizard.header')

            <!-- progress bar -->
            <div>
                <table class="table table-borderless text-center table-sm" style="table-layout: fixed; width: 100%">
                    <tbody>
                        <tr>
                            <td><a class="btn @if($lo_count < 1) btn-secondary @else  btn-success @endif" href="{{route('courseWizard.step1', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>1</b> </a></td>
                            <td><a class="btn @if($am_count < 1) btn-secondary @else  btn-success @endif" href="{{route('courseWizard.step2', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>2</b> </a></td>
                            <td><a class="btn btn-primary" href="{{route('courseWizard.step3', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>3</b> </a></td>
                            <td><a class="btn @if($oAct < 1 && $oAss < 1) btn-secondary @else  btn-success @endif" href="{{route('courseWizard.step4', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>4</b> </a></td>
                            <td><a class="btn @if($outcomeMaps < 1) btn-secondary @else  btn-success @endif" href="{{route('courseWizard.step5', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>5</b> </a></td>
                            <td><a class="btn btn-secondary" href="{{route('courseWizard.step6', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>6</b> </a></td>
                        </tr>

                        <tr>
                            <td>Course Learning Outcomes</td>
                            <td>Student Assessment Methods</td>
                            <td>Teaching and Learning Activities</td>
                            <td>Course Outcome Mapping</td>
                            <td>Program Outcome Mapping</td>
                            <td>Course Summary</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card">

                <div class="card-body">
                    <p class="form-text text-muted">Input all teaching and learning activities of the course individually.</p>

                    <div id="admins">
                        <div class="row">
                            <div class="col">
                                <table class="table table-borderless" id="l_activity_table">

                                    @if(count($l_activities)<1)
                                        <tr class="table-active">
                                            <th colspan="2">There are no teaching and learning activities set for this course.</th>
                                        </tr>

                                    @else
                                        <tr class="table-active">
                                            <th colspan="2">Teaching and Learning Activities</th>
                                        </tr>

                                            @foreach($l_activities as $l_activity)

                                            <tr>
                                                <td>
                                                    <input list="l_activities{{$l_activity->l_activity_id}}" name="l_activity[]" id="l_activity{{$l_activity->l_activity_id}}" form="l_activity_form" class="form-control" type="text"
                                                    type= "method" placeholder="Choose from the dropdown list or type your own" value="{{$l_activity->l_activity}}" required autofocus style="white-space: pre">
                                                        <datalist id="l_activities{{$l_activity->l_activity_id}}" >
                                                            <option value="Discussion">
                                                            <option value="Gallery walk">
                                                            <option value="Group discussion">
                                                            <option value="Group work">
                                                            <option value="Guest Speaker">
                                                            <option value="Independent study">
                                                            <option value="Issue-based inquiry">
                                                            <option value="Jigsaw">
                                                            <option value="Journals and learning logs">
                                                            <option value="Lab">
                                                            <option value="Lecture">
                                                            <option value="Literature response">
                                                            <option value="Mind map">
                                                            <option value="Poll">
                                                            <option value="Portfolio development">
                                                            <option value="Problem-solving">
                                                            <option value="Reflection piece">
                                                            <option value="Role-playing">
                                                            <option value="Service learning">
                                                            <option value="Seminar">
                                                            <option value="Sorting">
                                                            <option value="Think-pair-share">
                                                            <option value="Tutorial">
                                                            <option value="Venn diagram">
                                                        </datalist>
                                                    </td>

                                                    <input type="hidden" name="l_activity_id[]" value="{{$l_activity->l_activity_id}}" form="l_activity_form">
                                                </td>

                                                <td>
                                                    <form action="{{route('la.destroy', $l_activity->l_activity_id)}}" method="POST" class="float-right">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <input type="hidden" name="course_id" value="{{$course->course_id}}">
                                                        <button type="submit" style="width:60px;" class="btn btn-danger btn-sm float-right">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                </table>

                            </div>
                        </div>
                    </div>

                    <form method="POST" id="l_activity_form" action="{{ action('LearningActivityController@store') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-3 float-right" id="btnSave" style="margin-right:15px">
                            Save
                        </button>
                        <input type="hidden" name="course_id" value="{{$course->course_id}}" form="l_activity_form">
                    </form>

                    <button type="button" class="btn btn-primary btn-sm col-3 mt-3 float-left" id="btnAdd" style="margin-left: 12px">
                        ＋ Add Teaching and Learning Activity
                    </button>

                </div>

                <div class="card-footer">
                    <a href="{{route('courseWizard.step2', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-left">⬅ Student Assessment Methods</button>
                    </a>
                    <a href="{{route('courseWizard.step4', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-right">Course Outcome Mapping ➡</button>
                    </a>
                </div>
            </div>
        </div>
   </div>
</div>

<script>

    $(document).ready(function () {

      $("form").submit(function () {
        // prevent duplicate form submissions
        $(this).find(":submit").attr('disabled', 'disabled');
        $(this).find(":submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

      });

      $('#btnAdd').click(function() {
            add();
      });

    });

    function add() {
        var container = $('#l_activity_table');
        var rowCount = $('#l_activity_table tr').length;
            var element =
            `<tr>
                <td>
                    <input list="l_new_activities`+ rowCount +`" name="l_activity[]" id="l_new_activity`+ rowCount +` " form="l_activity_form"
                    type="text" class="form-control" required autofocus placeholder="Choose from the dropdown list or type your own">
                        <datalist id="l_new_activities`+ rowCount +`">
                            <option value="Discussion">
                            <option value="Gallery walk">
                            <option value="Group discussion">
                            <option value="Group work">
                            <option value="Guest Speaker">
                            <option value="Independent study">
                            <option value="Issue-based inquiry">
                            <option value="Jigsaw">
                            <option value="Journals and learning logs">
                            <option value="Lab">
                            <option value="Lecture">
                            <option value="Literature response">
                            <option value="Mind map">
                            <option value="Poll">
                            <option value="Portfolio development">
                            <option value="Problem-solving">
                            <option value="Reflection piece">
                            <option value="Role-playing">
                            <option value="Service learning">
                            <option value="Seminar">
                            <option value="Sorting">
                            <option value="Think-pair-share">
                            <option value="Tutorial">
                            <option value="Venn diagram">
                        </datalist>
                    </td>
                </tr>`;
            container.append(element);
    }


  </script>
@endsection
