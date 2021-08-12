@extends('layouts.app')

@section('content')

<link href=" {{ asset('css/accordions.css') }}" rel="stylesheet" type="text/css" >
<!--Link for FontAwesome Font for the arrows for the accordions.-->
<link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" rel="stylesheet" type="text/css" >

<div>
    <div class="row justify-content-center">

        <div class="col-md-12">
            @include('courses.wizard.header')

            <div class="card">
                <h3 class="card-header wizard" >
                    Program Outcome Mapping
                </h3>
                <div class="card-body">

                    @if (count($l_outcomes) < 1)
                        <div class="alert alert-warning wizard">
                            <i class="bi bi-exclamation-circle-fill"></i>There are no course learning outcomes set for this course. <a class="alert-link" href="{{route('courseWizard.step1', $course->course_id)}}">Add course learning outcomes.</a>                     
                        </div>

                    @else

                        <h6 class="card-subtitle mb-4 lh-lg">
                            Now that you have inputted your course information, you are ready to map it to program learning outcomes (PLOs). Using the mapping scale provided by each program, identify the alignment between each of your course learning outcomes (CLOs) and PLOs.                        
                        </h6>
                        
                        <!-- list of programs this course belongs to -->
                        <div class="jumbotron">
                            @if (count($coursePrograms) < 1)
                                <div class="alert alert-warning text-center">
                                    <i class="bi bi-exclamation-circle-fill pr-2 fs-3"></i>
                                    <br>
                                    <p>This course does not belong to any programs yet. Please move ahead to the next step.</p>
                                    <p>If you would like to define program learning outcomes to map this course, please create a program first. <a class="alert-link" href="{{route('home')}}">Create a Program.</a></p>
                                </div>
                                
                            @else
                                <div class="programsAccordions" style="width:100%">

                                    @foreach($coursePrograms as $index => $courseProgram)
                                                
                                        <!-- Program accordion -->
                                        <div class="accordion" id="programAccordion{{$courseProgram->program_id}}">
                                            <div class="accordion-item mb-2">
                                                <!-- Program accordion header -->
                                                <h2 class="accordion-header fs-2" id="programAccordionHeader{{$courseProgram->program_id}}">
                                                    <button class="accordion-button collapsed program white-arrow" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProgramAccordion{{$courseProgram->program_id}}" aria-expanded="false" aria-controls="collapseProgramAccordion{{$courseProgram->program_id}}">
                                                        <b>{{$index + 1}}</b>. {{$courseProgram->program}}                                                
                                                    </button>
                                                </h2>
                                                <!-- Program Accordion body -->
                                                <div id="collapseProgramAccordion{{$courseProgram->program_id}}" class="accordion-collapse collapse" aria-labelledby="programAccordionHeader{{$courseProgram->program_id}}" data-bs-parent="programAccordion{{$courseProgram->program_id}}">
                                                    <div class="accordion-body">

                                                        @if ($programsMappingScales[$courseProgram->program_id]->count() > 0)
                                                                        
                                                            <!-- Mapping scale for this program -->            
                                                            <p>Using the mapping scale provided, identify the alignment between each of your course learning outcomes (CLOs) and the program learning outcomes (PLOs).</p>
                                                            <p class="form-text text-primary container font-weight-bold ">Note: Remember to click save once you are done.</p>
                                                            <div class="container row mb-2">
                                                                <div class="col">
                                                                    <table class="table table-bordered table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th colspan="2">Mapping Scale</th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody>
                                                                            @foreach($programsMappingScales[$courseProgram->program_id] as $programMappingScaleLevel)
                                                                                <tr>
                                                                                    <td style="width:20%">
                                                                                        <div style="background-color:{{$programMappingScaleLevel->colour}}; height: 10px; width: 10px;"></div>
                                                                                        {{$programMappingScaleLevel->title}}
                                                                                        <br>
                                                                                        ({{$programMappingScaleLevel->abbreviation}})
                                                                                    </td>
                                                                                    <td>
                                                                                        {{$programMappingScaleLevel->description}}
                                                                                    </td>

                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>       
                                                            </div>

                                                            <!-- list of course learning outcome accordions with mapping form -->
                                                            <div class="cloAccordions mb-4">
                                                                @foreach($l_outcomes as $index => $courseLearningOutcome)
                                                                    <div class="accordion" id="accordionGroup{{$courseProgram->program_id}}-{{$courseLearningOutcome->l_outcome_id}}">
                                                                        <div class="accordion-item mb-2">
                                                                            <h2 class="accordion-header" id="header{{$courseProgram->program_id}}-{{$courseLearningOutcome->l_outcome_id}}">
                                                                                <button class="accordion-button white-arrow clo collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$courseProgram->program_id}}-{{$courseLearningOutcome->l_outcome_id}}" aria-expanded="false" aria-controls="collapse{{$courseProgram->program_id}}-{{$courseLearningOutcome->l_outcome_id}}">
                                                                                    <b>CLO {{$index+1}} </b>. {{$courseLearningOutcome->clo_shortphrase}}
                                                                                </button>
                                                                            </h2>

                                                                            <div id="collapse{{$courseProgram->program_id}}-{{$courseLearningOutcome->l_outcome_id}}" class="accordion-collapse collapse" aria-labelledby="header{{$courseProgram->program_id}}-{{$courseLearningOutcome->l_outcome_id}}" data-bs-parent="#accordionGroup{{$courseProgram->program_id}}-{{$courseLearningOutcome->l_outcome_id}}">
                                                                                <div class="accordion-body">

                                                                                    <form id="{{$courseProgram->program_id}}-{{$courseLearningOutcome->l_outcome_id}}" action="{{action('OutcomeMapController@store')}}" method="POST">
                                                                                        @csrf
                                                                                        <input type="hidden" name="program_id" value="{{$courseProgram->program_id}}">
                                                                                        <input type="hidden" name="l_outcome_id" value="{{$courseLearningOutcome->l_outcome_id}}">

                                                                                        <div class="card border-white">
                                                                                            <div class="card-body">
                                                                                                <h5 style="margin-bottom:16px;text-align:center;font-weight: bold;">{{$courseLearningOutcome->l_outcome}}</h5>

                                                                                                    @if ($programsLearningOutcomes[$courseProgram->program_id]->count() > 0) 

                                                                                                        <table class="table table-bordered table-sm">
                                                                                                            <thead class="thead-light">
                                                                                                                <tr class="table-active">
                                                                                                                    <th>Program Learning Outcomes or Competencies</th>
                                                                                                                    <!-- Mapping Table Levels -->
                                                                                                                    @foreach($programsMappingScales[$courseProgram->program_id] as $programMappingScaleLevel)
                                                                                                                        <th data-toggle="tooltip" title="{{$programMappingScaleLevel->title}}: {{$programMappingScaleLevel->description}}">
                                                                                                                            {{$programMappingScaleLevel->abbreviation}}
                                                                                                                        </th>
                                                                                                                    @endforeach
                                                                                                                            
                                                                                                                    <th data-toggle="tooltip" title="Not Aligned">N/A</th>
                                                                                                                </tr>

                                                                                                            </thead>
                                                                                                            
                                                                                                            <tbody>
                                                                                                                @foreach($programsLearningOutcomes[$courseProgram->program_id] as $pl_outcome)
                                                                                                                    <tr>
                                                                                                                        <td>
                                                                                                                            <b>{{$pl_outcome->plo_shortphrase}}</b>
                                                                                                                            <br>
                                                                                                                            {{$pl_outcome->pl_outcome}}
                                                                                                                        </td>

                                                                                                                        @foreach($programsMappingScales[$courseProgram->program_id] as $programMappingScaleLevel)
                                                                                                                            <td>
                                                                                                                                <div class="form-check">
                                                                                                                                    <input class="form-check-input position-static" type="radio" name="map[{{$courseLearningOutcome->l_outcome_id}}][{{$pl_outcome->pl_outcome_id}}]" value="{{$programMappingScaleLevel->abbreviation}}" @if(isset($courseLearningOutcome->programLearningOutcomes->find($pl_outcome->pl_outcome_id)->pivot)) @if($courseLearningOutcome->programLearningOutcomes->find($pl_outcome->pl_outcome_id)->pivot->map_scale_id == $programMappingScaleLevel->map_scale_id) checked=checked @endif @endif>
                                                                                                                                </div>
                                                                                                                            </td>
                                                                                                                        @endforeach

                                                                                                                        <td>
                                                                                                                            <div class="form-check">
                                                                                                                                <input class="form-check-input position-static" type="radio" name="map[{{$courseLearningOutcome->l_outcome_id}}][{{$pl_outcome->pl_outcome_id}}]" value="N/A" @if(isset($courseLearningOutcome->programLearningOutcomes->find($pl_outcome->pl_outcome_id)->pivot)) @if($courseLearningOutcome->programLearningOutcomes->find($pl_outcome->pl_outcome_id)->pivot->map_scale_id =='N/A') checked=checked @endif @endif required>
                                                                                                                            </div>
                                                                                                                        </td>

                                                                                                                    </tr>
                                                                                                                @endforeach
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                                
                                                                                                        <button type="submit" class="btn btn-success my-3 btn-sm float-right col-2" >Save</button>
                                                                                                    @else 
                                                                                                        <div class="alert alert-warning text-center">
                                                                                                            <i class="bi bi-exclamation-circle-fill pr-2 fs-5"></i>Program learning outcomes have not been set for this program                    
                                                                                                        </div>
                                                                                                    @endif
                                                                                            </div>                                                                                                    
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>                                                                            
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @else 
                                                            <div class="alert alert-warning text-center">
                                                                <i class="bi bi-exclamation-circle-fill pr-2 fs-5"></i>A mapping scale has not been set for this program.                   
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End of Program Accordion -->
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                    
                </div>
                <!-- card footer -->
                <div class="card-footer">
                    <div class="card-body mb-4">
                        <a href="{{route('courseWizard.step4', $course->course_id)}}">
                            <button class="btn btn-sm btn-primary col-3 float-left"><i class="bi bi-arrow-left mr-2"></i> Course Alignment</button>
                        </a>
                        <a href="{{route('courseWizard.step6', $course->course_id)}}">
                            <button class="btn btn-sm btn-primary col-3 float-right">Standards and Strategic Priorities<i class="bi bi-arrow-right ml-2"></i></button>
                        </a>
                    </div>
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
