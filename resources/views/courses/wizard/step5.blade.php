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

                    <!--Optional Priorities -->
                    <div class="jumbotron">
                        <p class="container form-text">
                            <b>(Optional) Alignment with UBC/Ministry Priorities:</b>
                            Select, from the below UBC and/or Ministry priorities and strategies, those that align strongly with your course. This is optional.
                        </p>

                        <div id="accordion">
                        <form id="optinal" action="{{ route('storeOptionalPLOs') }}" method="POST">
                            {{ csrf_field() }}

                            <input type="hidden" name="course_id" value="{{$course->course_id}}">

                            <div class="card Ministry" id="Ministry">
                                <div class="card-header" id="headingOne" style="border-bottom: 0px;">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" data-target="#collapse_optional_Ministry" aria-expanded="false" aria-controls="collapse_optional_Ministry" href="#collapse_optional_Ministry" style="text-decoration:none">
                                            Ministry of Advanced Education and Skills Training
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse_optional_Ministry" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">

                                        <h5>UBC's Mandate by the Ministry</h5>
                                        <p>UBC's mandate letter (see<a href="https://www2.gov.bc.ca/gov/content/education-training/post-secondary-education/institution-resources-administration/mandate-letters" target="_blank"> mandate letter here </a>)
                                             calls for the below, as they relate to curriculum:</p>
                                        <table class="table table-hover optionalPLO" id="ubcMandate" data-toolbar="#toolbar" data-toggle="table" data-maintain-meta-data="true">
                                            <thead class="thead-light">
                                                <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="Description">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ubc_mandate_letters as $index => $letter)
                                                <tr>
                                                <td>

                                                    @if (in_array($letter,$optional_PLOs))
                                                        <input type="checkbox" name = "optionalItem[]" value="{{$letter}}" checked>
                                                    @else
                                                        <input type="checkbox" name = "optionalItem[]" value="{{$letter}}">
                                                    @endif

                                                </td>
                                                <td>
                                                    {{$letter}}
                                                </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <h5>
                                            BC's Labour Market: Top skills in Demand
                                        </h5>
                                        <p>BC's tops skills in demand,as forecasted to the year 2029 by the <a href="https://www.workbc.ca/getmedia/18214b5d-b338-4bbd-80bf-b04e48a11386/BC_Labour_Market_Outlook_2019.pdf.aspx" target="_blank">BC Labour Market Outlook (page 46)</a>
                                            , are the following:
                                        </p>

                                        <table class="table table-hover optionalPLO" id="LabourMarket" data-toolbar="#toolbar" data-toggle="table" data-maintain-meta-data="true">
                                            <thead class="thead-light">
                                                <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="Description">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($bc_labour_market as $index => $skill)
                                                <tr>
                                                <td>
                                                    @if (in_array($skill,$optional_PLOs))
                                                            <input type="checkbox" name = "optionalItem[]" value="{{$skill}}" checked>
                                                        @else
                                                            <input type="checkbox" name = "optionalItem[]" value="{{$skill}}">
                                                        @endif
                                                </td>
                                                <td>
                                                    {{$skill}}
                                                </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <p>Additionally, BC expects <a href="https://www.workbc.ca/Labour-Market-Industry/Jobs-in-Demand/High-Demand-Occupations.aspx" target="_blank">these occupations to be of "High Opportunity"</a> in the province. Does your course/program align with a High Opportunity Occupation in BC ?
                                        <select id="highOpportunity" class="highOpportunity">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>

                                        <!--
                                        <div class="addedOptions" id="addedOptions">
                                            <p style="margin-top:5px;">Please list them : </p>

                                            <table class="table table-hover optionalPLO" id="highOpportunityTable" data-toolbar="#toolbar" data-toggle="table" data-maintain-meta-data="true">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th data-field="Description">Description</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                </tbody>
                                            </table>

                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary btn-sm col-2 mt-2" id="btnAdd">
                                                    ＋ Add
                                                </button>
                                            </div>
                                        </div>
                                        -->

                                    </div>
                                </div>
                            </div>

                            <div class="card BC_strategic" id="BC_strategic">
                                <div class="card-header" id="headingOne" style="border-bottom: 0px;">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" data-target="#collapse_optional_BC_strategic" aria-expanded="true" aria-controls="collapse_optional_BC_strategic" href="#collapse_optional_BC_strategic" style="text-decoration:none">
                                            UBC Strategic Priorities
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapse_optional_BC_strategic" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <h5>
                                            <a href="https://strategicplan.ubc.ca/" target="_blank">
                                            Shaping UBC's next Century
                                            </a>
                                        </h5>
                                        <table class="table table-hover optionalPLO" id="ubcStrategy" data-toolbar="#toolbar" data-toggle="table" data-maintain-meta-data="true">
                                            <thead class="thead-light">
                                                <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="Description">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($shaping_ubc as $index => $strategy)
                                                <tr>
                                                <td>
                                                    @if (in_array($strategy,$optional_PLOs))
                                                            <input type="checkbox" name= "optionalItem[]" value="{{$strategy}}" checked>
                                                        @else
                                                            <input type="checkbox" name= "optionalItem[]" value="{{$strategy}}">
                                                        @endif
                                                </td>
                                                <td>
                                                    <a href ="{{$shaping_ubc_link[$index]}}" target="_blank">Strategy {{$index + 1}}: </a>
                                                    {{$strategy}}
                                                    @if($index == 17)
                                                        <a href="https://www.alumni.ubc.ca/about/strategic-plan/" target="_blank">Connecting Forward.</a>
                                                    @endif
                                                </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <h5>
                                            <a href="https://okmain.cms.ok.ubc.ca/wp-content/uploads/sites/26/2019/02/UBCO-Outlook-2040.pdf" target="_blank">
                                            UBC Okanagan 2040 Outlook
                                            </a>
                                        </h5>

                                        <table class="table table-hover optionalPLO" id="ubc_2024Outlook" data-toolbar="#toolbar" data-toggle="table" data-maintain-meta-data="true">
                                            <thead class="thead-light">
                                                <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="Description">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($okanagan_2040_outlook as $index => $outlook)
                                                <tr>
                                                <td>
                                                    @if (in_array($strategy,$optional_PLOs))
                                                        <input type="checkbox" name= "optionalItem[]" value="{{$outlook}}" checked>
                                                    @else
                                                        <input type="checkbox" name= "optionalItem[]" value="{{$outlook}}">
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$outlook}}
                                                </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <h5>
                                            <a href="https://aboriginal-2018.sites.olt.ubc.ca/files/2020/09/UBC.ISP_C2V13.1_Spreads_Sept1.pdf" target="_blank">
                                                UBC's Indigenous Strategic Plan (2020)</h5></a>

                                        <table class="table table-hover optionalPLO" id="IndigenousPlan" data-toolbar="#toolbar" data-toggle="table" data-maintain-meta-data="true">
                                            <thead class="thead-light">
                                                <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="Description">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ubc_indigenous_plan as $index => $plan)
                                                <tr>
                                                <td>
                                                    @if (in_array($strategy,$optional_PLOs))
                                                        <input type="checkbox" name= "optionalItem[]" value="{{$plan}}" checked>
                                                    @else
                                                        <input type="checkbox" name= "optionalItem[]" value="{{$plan}}">
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$plan}}
                                                </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <h5><a href="https://bog3.sites.olt.ubc.ca/files/2021/01/4_2021.02_Climate-Emergency-Engagement.pdf" target="_blank">UBC's Climate Priorities</a></h5>
                                        <p>The <a href="https://bog3.sites.olt.ubc.ca/files/2021/01/4_2021.02_Climate-Emergency-Engagement.pdf" target="_blank">UBC's Climate Emergency Engagement Report and Recommendations (2021)</a> set out the below curricular examples.
                                            Programs are encouraged to take these and/or other initiatives that align with the report:
                                        </p>

                                        <table class="table table-hover optionalPLO" id="climate_priorities" data-toolbar="#toolbar" data-toggle="table" data-maintain-meta-data="true">
                                            <thead class="thead-light">
                                                <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="Description">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ubc_climate_priorities as $index => $climate)
                                                <tr>
                                                <td>
                                                    @if (in_array($strategy,$optional_PLOs))
                                                        <input type="checkbox" name= "optionalItem[]" value="{{$climate}}" checked>
                                                    @else
                                                        <input type="checkbox" name= "optionalItem[]" value="{{$climate}}">
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$climate}}
                                                </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary my-3 btn-sm float-right col-2">Save</button>
                        </form>
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

        // Hide and show the optional
        $("#highOpportunity").on('change', function () {
            var value = $("#highOpportunity").val();
            console.log(value);
            if (value == "1" ){
                $('#addedOptions').show();
                $("#addedOptions :input").prop("disabled", false);
            }else{
                $('#addedOptions').hide();
                $("#addedOptions :input").prop("disabled", true);
            }

        });

        $('#btnAdd').click(function() {
            add();
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

    function add() {
        var length = $('#highOpportunityTable tr').length;

        var element = `
            <tr>
                <td>
                    `
                    +length+
                    `
                </td>
                <td>
                    <input class = "form-control" type="text" name="inputItem[]" spellcheck="true" required>
                </td>
            </tr>`;
            var container = $('#highOpportunityTable tbody');
            container.append(element);
    }

</script>


@endsection
