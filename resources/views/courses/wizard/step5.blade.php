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
                            <td><a class="btn @if($la_count < 1) btn-secondary @else  btn-success @endif" href="{{route('courseWizard.step3', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>3</b> </a></td>
                            <td><a class="btn @if($oAct < 1 && $oAss < 1) btn-secondary @else  btn-success @endif" href="{{route('courseWizard.step4', $course->course_id)}}"
                                    style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;">
                                    <b>4</b> </a></td>
                            <td><a class="btn btn-primary" href="{{route('courseWizard.step5', $course->course_id)}}"
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
                    <p class="container form-text text-muted">Now that you have inputted all your course information, you are ready to map it to the program-level learning outcomes (PLOs).
                        @if($course->program_id == 1 ?? $course->program_id == 2 ?? $course->program_id == 3 )
                            In lieu of specific PLOs, the below are the <a href="https://www2.gov.bc.ca/assets/gov/education/post-secondary-education/institution-resources-administration/degree-authorization/degree-program-criteria.pdf#page=19" target="_blank">standards provided by the Ministry of Advanced Education in BC</a>. Using the mapping scale provided, identify the alignment between each of the CLOs against the standards.
                        @else
                            Using the mapping scale provided, identify the alignment between each of the CLOs against the PLOs.
                        @endif
                    </p>
                    <p class="form-text text-primary container font-weight-bold ">Note: Remember to click save once you are done.</p>

                    <div class="container row">
                        <div class="col">
                            @if(count($mappingScales)>0)
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th colspan="2">Mapping Scale</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mappingScales as $ms)

                                        <tr>

                                            <td style="width:20%">
                                                <div style="background-color:{{$ms->colour}}; height: 10px; width: 10px;"></div>
                                                {{$ms->title}}<br>
                                                ({{$ms->abbreviation}})
                                            </td>
                                            <td>
                                                {{$ms->description}}
                                            </td>

                                        </tr>
                                   @endforeach
                                </tbody>
                            </table>
                            @else
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <th class="table-light">There are no mapping scale levels set for this program.</th>
                                </tr>
                            </table>

                            @endif
                        </div>
                    </div>

                    <div class="jumbotron">

                        @if(count($l_outcomes)<1)
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <th class="table-light">There are no course learning outcomes set for this course.</th>
                                </tr>
                            </table>
                        @else
                            <p class="container form-text font-weight-bold">
                                @if($course->program_id == 1 ?? $course->program_id == 2 ?? $course->program_id == 3 )
                                    Using the mapping scale provided, identify the alignment between each of the CLOs against the standards.
                                @else
                                    Using the mapping scale provided, identify the alignment between each of the CLOs against the PLOs.
                                @endif

                            </p>

                            <div id="accordion">

                                @for($i = 0; $i < count($l_outcomes); $i++)

                                    <div class="card">
                                        <div class="card-header" id="headingOne" style="border-bottom: 0px;">
                                            <h5 class="mb-0">
                                                <a data-toggle="collapse" data-target="#collapse{{$l_outcomes[$i]->l_outcome_id}}" aria-expanded="true" aria-controls="collapse{{$l_outcomes[$i]->l_outcome_id}}" href="#collapse{{$l_outcomes[$i]->l_outcome_id}}" style="text-decoration:none">
                                                    <b>CLO #{{$i+1}} </b>: {{$l_outcomes[$i]->clo_shortphrase}}
                                                </a>

                                            </h5>

                                        </div>

                                        <form id="{{$l_outcomes[$i]->l_outcome_id}}" action="{{action('OutcomeMapController@store')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="course_id" value="{{$course->course_id}}">
                                            <input type="hidden" name="l_outcome_id" value="{{$l_outcomes[$i]->l_outcome_id}}">

                                            <div id="collapse{{$l_outcomes[$i]->l_outcome_id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">

                                                <div class="card-body">
                                                    <h5>{{$l_outcomes[$i]->l_outcome}}</h5>

                                                    <table class="table table-bordered table-sm">
                                                        <thead class="thead-light">
                                                            <tr class="table-active">
                                                                @if($course->program_id == 1 ?? $course->program_id == 2 ?? $course->program_id == 3 )
                                                                    <th>BC Ministry Standards (in lieu of PLOs)</th>
                                                                @else
                                                                    <th>Program Learning Outcomes or Competencies</th>
                                                                @endif

                                                                @foreach($mappingScales as $ms)
                                                                    <th data-toggle="tooltip" title="{{$ms->title}}: {{$ms->description}}">
                                                                        {{$ms->abbreviation}}
                                                                    </th>
                                                                @endforeach

                                                                <th data-toggle="tooltip" title="Not Aligned">N/A</th>
                                                            </tr>

                                                        </thead>
                                                        <tbody>
                                                            @foreach($pl_outcomes as $pl_outcome)
                                                                <tr>
                                                                    <td>
                                                                        <b>{{$pl_outcome->plo_shortphrase}}</b><br>
                                                                            {{$pl_outcome->pl_outcome}}
                                                                    </td>
                                                                    @foreach($mappingScales as $ms)
                                                                        <td>

                                                                            <div class="form-check">
                                                                                <input class="form-check-input position-static" type="radio" name="map[{{$l_outcomes[$i]->l_outcome_id}}][{{$pl_outcome->pl_outcome_id}}]" value="{{$ms->abbreviation}}"
                                                                                @if(isset($l_outcomes[$i]->programLearningOutcomes->find($pl_outcome->pl_outcome_id)->pivot))
                                                                                @if($l_outcomes[$i]->programLearningOutcomes->find($pl_outcome->pl_outcome_id)->pivot->map_scale_value == $ms->abbreviation) checked=checked @endif @endif>
                                                                            </div>
                                                                        </td>
                                                                    @endforeach

                                                                    <td>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input position-static" type="radio" name="map[{{$l_outcomes[$i]->l_outcome_id}}][{{$pl_outcome->pl_outcome_id}}]" value="N/A"
                                                                            @if(isset($l_outcomes[$i]->programLearningOutcomes->find($pl_outcome->pl_outcome_id)->pivot))
                                                                            @if($l_outcomes[$i]->programLearningOutcomes->find($pl_outcome->pl_outcome_id)->pivot->map_scale_value =='N/A') checked=checked @endif @endif required>
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>

                                                    <button type="submit" class="btn btn-primary my-3 btn-sm float-right col-2">Save</button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                @endfor
                            </div>
                        @endif

                    </div>

                    <div class="jumbotron">

                        <p class="container form-text">
                            <b>(Optional) Alignmnet with UBC/Ministry Priorities:</b> Select, from the below UBC and/or Ministry priorities and strategies,
                            those that align stongly with your course.
                        </p>

                        <div id="accordion">

                            <div class="card MAEST" id="MAEST">
                                <div class="card-header" id="headingOne" style="border-bottom: 0px;">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" data-target="#collapse_optionalThree" aria-expanded="false" aria-controls="collapse_optionalThree" href="#collapse_optionalThree" style="text-decoration:none">
                                            UBC's Mandate by the Ministry
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse_optionalThree" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <h5>UBC's Mandate by the Ministry</h5>
                                        <table class="table table-hover optionalPLO" id="MAESTTable" data-toolbar="#toolbar" data-toggle="table" data-maintain-meta-data="true">
                                            <thead class="thead-light">
                                                <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="Description">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($optional_maes as $optional_mae)
                                                <tr>
                                                <td>
                                                    <input type="checkbox" id= "optional{{$optional_mae->id}}" value={{$optional_mae->id}}>
                                                </td>
                                                <td>
                                                    <label for="optional{{$optional_mae->id}}">{{$optional_mae->custom_plo}}</label>
                                                </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card WEF" id="WEF">
                                <div class="card-header" id="headingOne" style="border-bottom: 0px;">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" data-target="#collapse_optionalOne" aria-expanded="true" aria-controls="collapse_optionalOne" href="#collapse_optionalOne" style="text-decoration:none">
                                            BC's Labour Market
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapse_optionalOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <h5>BC's Labour Market: Top skills in Demand</h5>
                                        <table class="table table-hover optionalPLO" id="WEFTable" data-toolbar="#toolbar" data-toggle="table" data-maintain-meta-data="true">
                                            <thead class="thead-light">
                                                <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="Description">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($optional_wefs as $optional_wef)
                                                <tr>
                                                <td>
                                                    <input type="checkbox" id= "optional{{$optional_wef->id}}" value={{$optional_wef->id}}>
                                                </td>
                                                <td>
                                                    <label for="optional{{$optional_wef->id}}">
                                                        {{$optional_wef->custom_plo}}
                                                    </label>
                                                </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <p> High Demand Occupation in BC</p>

                                    </div>
                                </div>
                            </div>

                            <div class="card UDLG" id="UDLG">
                                <div class="card-header" id="headingOne" style="border-bottom: 0px;">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" data-target="#collapse_optionalTwo" aria-expanded="false" aria-controls="collapse_optionalTwo" href="#collapse_optionalTwo" style="text-decoration:none">
                                            Universal Design for Learning Guidelines
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse_optionalTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <h5>Universal Design for Learning Guidelines</h5>
                                        <table class="table table-hover optionalPLO" id="UDLGTable" data-toolbar="#toolbar" data-toggle="table" data-maintain-meta-data="true">
                                            <thead class="thead-light">
                                                <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="Description">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($optional_udls as $optional_udl)
                                                <tr>
                                                <td>
                                                    <input type="checkbox" id= "optional{{$optional_udl->id}}" value={{$optional_udl->id}}>
                                                </td>
                                                <td>
                                                    <label for="optional{{$optional_udl->id}}">{{$optional_udl->custom_plo}}</label>
                                                </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card UCP" id="UCP">
                                <div class="card-header" id="headingOne" style="border-bottom: 0px;">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" data-target="#collapse_optionalFour" aria-expanded="false" aria-controls="collapse_optionalFour" href="#collapse_optionalFour" style="text-decoration:none">
                                            UBC's Climate Emergency Priorities
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapse_optionalFour" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <h5>UBC's Climate Emergency Priorities</h5>
                                        <table class="table table-hover optionalPLO" id="UCPTable" data-toolbar="#toolbar" data-toggle="table" data-maintain-meta-data="true">
                                            <thead class="thead-light">
                                                <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="Description">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($optional_ucps as $optional_ucp)
                                                <tr>
                                                <td>
                                                    <input type="checkbox" id= "optional{{$optional_ucp->id}}" value={{$optional_ucp->id}}>
                                                </td>
                                                <td>
                                                    <label for="optional{{$optional_ucp->id}}">{{$optional_ucp->custom_plo}}</label>
                                                </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <a href="{{route('courseWizard.step4', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-left">⬅ Course Outcome Mapping</button>
                    </a>
                    <a href="{{route('courseWizard.step6', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-right">Course Summary ➡</button>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {


        $('[data-toggle="tooltip"]').tooltip();

        $("form").submit(function () {
        // prevent duplicate form submissions
        $(this).find(":submit").attr('disabled', 'disabled');
        $(this).find(":submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

      });

        // $("form").submit(function (e) {
        //     // prevent duplicate form submissions
        //     e.preventDefault();

        //     var id = $(this).attr('id');

        //     $(this).find(":submit").attr('disabled', 'disabled');
        //     $(this).find(":submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

        //     var form_action = $(this).attr("action");

        //     $.ajax({
        //         data: $(this).serialize(),
        //         url: form_action,
        //         type: "POST",
        //         dataType: 'json',
        //         success: function (data) {
        //             $('form[id='+id+']').find(":submit").removeAttr('disabled');
        //             $('form[id='+id+']').find(":submit").html('Save');


        //             $('form[id='+id+']').find("#alert").html("Your answers have been saved successfully");
        //             $('form[id='+id+']').find("#alert").toggleClass("alert alert-success");
        //             $('form[id='+id+']').find("#alert").delay(2000).slideUp(200, function() {
        //                 $(this).alert('close');
        //             });

        //         },
        //         error: function (data) {
        //             $('form[id='+id+']').find(":submit").removeAttr('disabled');
        //             $('form[id='+id+']').find(":submit").html('Save');


        //             $('form[id='+id+']').find("#alert").html("There was an error saving your answers");
        //             $('form[id='+id+']').find("#alert").toggleClass("alert alert-danger");
        //             $('form[id='+id+']').find("#alert").delay(2000).slideUp(200, function() {
        //                 $(this).alert('close');
        //             });
        //         }
        //     });




        // });
    });

  </script>


@endsection
