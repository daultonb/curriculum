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
                            <td><a class="btn btn-primary" href="{{route('courseWizard.step1', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>1</b> </a></td>
                            <td><a class="btn @if($am_count < 1) btn-secondary @else  btn-success @endif" href="{{route('courseWizard.step2', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>2</b> </a></td>
                            <td><a class="btn @if($la_count < 1) btn-secondary @else  btn-success @endif" href="{{route('courseWizard.step3', $course->course_id)}}"
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
                            <td>Student Assesment Methods</td>
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
                    <p class="form-text text-muted"> Input the <a href="https://ctl.ok.ubc.ca/teaching-development/classroom-practices/learning-outcomes/" target="_blank">course learning outcomes (CLOs)</a> or <a href="https://sph.uth.edu/content/uploads/2012/01/Competencies-and-Learning-Objectives.pdf" target="_blank">competencies</a> of the course individually.
                        <strong>It is recommended that a course has 6 CLOs max</strong>.
                    </p>

                    <div id="clo">
                        <div class="row">
                            <div class="col">
                                <table class="table table-borderless">

                                    @if(count($l_outcomes)<1)
                                        <tr class="table-active">
                                            <th colspan="3">There are no course learning outcomes or competencies set for this course.</th>
                                        </tr>


                                    @else

                                        <tr class="table-active">
                                            <th colspan="2">Course Learning Outcomes or Competencies</th>
                                        </tr>

                                            @foreach($l_outcomes as $l_outcome)

                                            <tr>
                                                <td>
                                                    <b>{{$l_outcome->clo_shortphrase}}</b><br>
                                                    {{$l_outcome->l_outcome}}
                                                </td>
                                                <td width="250px">
                                                    <form class="float-right ml-2" action="{{route('lo.destroy', $l_outcome->l_outcome_id)}}" method="POST">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <input type="hidden" name="course_id" value="{{$course->course_id}}">
                                                        <button style="width:60px;" type="submit" class="btn btn-danger btn-sm ">Delete</button>
                                                    </form>

                                                    <button type="button" style="width:60px;" class="btn btn-secondary btn-sm float-right" data-toggle="modal" data-target="#editLearningOutcomeModal{{$l_outcome->l_outcome_id}}">
                                                        Edit
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="editLearningOutcomeModal{{$l_outcome->l_outcome_id}}" tabindex="-1" role="dialog"
                                                        aria-labelledby="editLearningOutcomeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editLearningOutcomeModalLabel">Edit Course Learning Outcome or Competency
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <form method="POST" action="{{ route('lo.update', $l_outcome->l_outcome_id) }}">
                                                                    @csrf
                                                                    {{method_field('PUT')}}
                                                                    <div class="modal-body">

                                                                        <div class="form-group row">
                                                                            <label for="l_outcome" class="col-md-4 col-form-label text-md-center">Course Learning Outcome (CLO) or Competency</label>

                                                                            <div class="col-md-8">
                                                                                <textarea id="l_outcome" class="form-control" @error('l_outcome') is-invalid @enderror rows="3" name="l_outcome" required autofocus>{{$l_outcome->l_outcome}}
                                                                                </textarea>

                                                                                @error('l_outcome')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                                @enderror

                                                                                <small class="form-text text-muted">
                                                                                    <a href="https://tips.uark.edu/using-blooms-taxonomy/" target="_blank"><strong>Click here</strong></a>
                                                                                    for tips to write effective CLOs
                                                                                </small>

                                                                            </div>

                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <label for="title" class="col-md-4 col-form-label text-md-right">Short Phrase</label>

                                                                            <div class="col-md-8">
                                                                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$l_outcome->clo_shortphrase}}" autofocus>

                                                                                @error('title')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                                @enderror

                                                                                <small class="form-text text-muted">
                                                                                    Having a short phrase helps with data visualization at the end of this process <strong>(4 words max)</strong>.
                                                                                </small>

                                                                            </div>
                                                                        </div>

                                                                        <div style="col-md-8">
                                                                            <p>Bloom’s Taxonomy can help you identify the targeted level of knowledge/skill attainment for each CLO</p>
                                                                            <img src="https://cpb-us-e1.wpmucdn.com/wordpressua.uark.edu/dist/a/315/files/2013/09/Blooms_Taxonomy_pyramid_cake-style-use-with-permission.jpg"
                                                                            style="max-width: 100%; max-height: 100%">
                                                                            <p>Image created by Jessica Shabatura , retrieved from https://tips.uark.edu/using-blooms-taxonomy/</P>
                                                                        </div>

                                                                        <input type="hidden" name="course_id" value="{{$course->course_id}}">

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary col-2 btn-sm" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary col-2 btn-sm">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </td>
                                            </tr>

                                            @endforeach



                                    @endif
                                </table>
                            </div>

                        </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-sm col-3 mt-3 float-left" data-toggle="modal" data-target="#addLearningOutcomeModal" style="margin-left: 10px">
                        ＋ Add Course Learning Outcome
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addLearningOutcomeModal" tabindex="-1" role="dialog"
                        aria-labelledby="addLearningOutcomeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addLearningOutcomeModalLabel">Add Course Learning Outcome or Competency
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="POST" action="{{ action('LearningOutcomeController@store') }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="l_outcome" class="col-md-4 col-form-label text-md-center">Course Learning Outcome (CLO) or Competency</label>

                                            <div class="col-md-8">
                                                <textarea id="l_outcome" class="form-control" @error('l_outcome') is-invalid @enderror
                                                rows="3" name="l_outcome" required autofocus placeholder="Develop..."></textarea>

                                                @error('l_outcome')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                                <small class="form-text text-muted">
                                                    <a href="https://tips.uark.edu/using-blooms-taxonomy/" target="_blank"><strong>Click here</strong></a>
                                                    for tips to write effective CLOs
                                                </small>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="title" class="col-md-4 col-form-label text-md-right">Short Phrase</label>

                                            <div class="col-md-8">
                                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="title" autofocus placeholder="Experiment...">

                                                @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                                <small class="form-text text-muted">
                                                    Having a short phrase helps with data visualization at the end of this process <strong>(4 words max)</strong>.
                                                </small>
                                            </div>

                                            <div style="col-md-8; text-align: center; margin-top:20px">

                                                <div>
                                                    <p style="margin-top: 25px;margin-left:4px;margin-right:4px;">A well-written learning outcome states what students are expected to <span style="font-style: italic;">know, be able to do, or care about</span>, after successfully completing the course/program. Such statements begin with one measurable verb.</p>
                                                    <p>The below are examples of verbs associated with different levels of Bloom’s Taxonomy of Learning.</p>
                                                </div>

                                                <div class="flex-container">
                                                    <div class="box" style="background-color: #e8f4f8;">
                                                        <strong>REMEMBER</strong>
                                                        <p>Retrieve relevant knowledge from long-term memory</p>
                                                    </div>
                                                    <div class="box" style="background-color: #E6E6FA;">
                                                        <strong>UNDERSTAND</strong>
                                                        <p>Construct meaning from instructional messages</p>
                                                    </div>
                                                    <div class="box" style="background-color: #c1e1ec;">
                                                        <strong>APPLY</strong>
                                                        <p>Carry out or use a procedure in a given situation</p>
                                                    </div>
                                                    <div class="box" style="background-color: #ADD8E6;">
                                                        <strong>ANALYZE</strong>
                                                        <p>Break material into its constituent parts and determine how the parts relate</p>
                                                    </div>
                                                    <div class="box" style="background-color: #87CEEB;">
                                                        <strong>EVALUATE</strong>
                                                        <p>Make judgements basesd on criteria and standards</p>
                                                    </div>
                                                    <div class="box" style="background-color: #6495ED;">
                                                        <strong>CREATE</strong>
                                                        <p>Put elements together to form a coherent or functional whole</p>
                                                    </div>

                                                    <div class="box">
                                                        <p class="CLO_example">Example: define, describe, identify, list, locate, match, memorize, recall, recognize, reproduce, select, state</p>
                                                    </div>
                                                    <div class="box">
                                                        <p class="CLO_example">Example: classify，compare，discuss，distinguish，exemplify，explain，illustrate，inder，interpret，paraphrase，predict，summarize</p>
                                                    </div>
                                                    <div class="box">
                                                        <p class="CLO_example">Example: calculate，construct，demonstrate，dramatize，employ，execute，implement，manipulate，modify，simulate solve</p>
                                                    </div>
                                                    <div class="box">
                                                        <p class="CLO_example">Example: attribute，categorize，classify，compare，correlate，deduce，differentiate，distinguish，organize plan</p>
                                                    </div>
                                                    <div class="box">
                                                        <p class="CLO_example">Example: assess，check，critique，decide，defend，judge，justify，presuade，recommend，support</p>
                                                    </div>
                                                    <div class="box">
                                                        <p class="CLO_example">Example: compile，compose，construct，design，develop，formulate，generate，hypothesize，integrate，modify，plan，produce</p>
                                                    </div>
                                                </div>

                                                <small>
                                                    Source: Anderson, L. W., Krathwohl, D. R., & Bloom, B. S. (2001). A taxonomy for learning, teaching, and assessing: A revision of bloom's taxonomy of educational objectives (Abridged ed.). New York: Longman.
                                                </small>
                                            </div>

                                        </div>

                                        <input type="hidden" name="course_id" value="{{$course->course_id}}">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary col-2 btn-sm" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary col-2 btn-sm">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">

                    <a href="{{route('courseWizard.step2', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-right">Student Assessment Methods ➡</button>
                    </a>
                </div>


            </div>
        </div>


    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

      $("form").submit(function () {
        // prevent duplicate form submissions
        $(this).find(":submit").attr('disabled', 'disabled');
        $(this).find(":submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

      });
    });
  </script>
@endsection
