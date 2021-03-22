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
                            <td><a class="btn btn-primary" href="{{route('courseWizard.step2', $course->course_id)}}"
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
                    <p class="form-text text-muted">Input all <a href="https://ctlt.ubc.ca/resources/webliography/assessmentevaluation/" target="_blank">assessment methods</a> of the course individually.
                        You may also choose to use the <a href="https://ubcoapps.elearning.ubc.ca/">UBCO's Workload Calculator</a> to estimate the student time commitment in this course based on the chosen assignments.</p>

                    <div id="admins">
                        <div class="row">
                            <div class="col">
                                <table class="table table-borderless" id="a_method_table">

                                    @if(count($a_methods)<1)
                                        <tr class="table-active">
                                            <th colspan="3">There are no student assessment methods set for this course.</th>
                                        </tr>

                                    @else

                                        <tr class="table-active">
                                            <th>Student Assesment Methods</th>
                                            <th colspan="2">Weight</th>
                                        </tr>


                                            @foreach($a_methods as $index=>$a_method)

                                            <tr>
                                                <td>
                                                    <input list="a_methods{{$index}}" id="a_method{{$a_method->a_method_id}}" type="text" class="form-control @error('a_method') is-invalid @enderror"
                                                    name="a_method[]" value = "{{$a_method->a_method}}" placeholder="Choose from the dropdown list or type your own" form="a_method_form" required autofocus>
                                                    <datalist id="a_methods{{$index}}" name="a_methods" spellcheck="true">
                                                        <option value="Annotated bibliography">
                                                        <option value="Assignment">
                                                        <option value="Attendance">
                                                        <option value="Brochure, poster">
                                                        <option value="Case analysis">
                                                        <option value="Debate">
                                                        <option value="Diagram/chart">
                                                        <option value="Dialogue">
                                                        <option value="Essay">
                                                        <option value="Exam">
                                                        <option value="Fill in the blank test">
                                                        <option value="Group discussion">
                                                        <option value="Lab/field notes">
                                                        <option value="Letter">
                                                        <option value="Literature review">
                                                        <option value="Mathematical problem">
                                                        <option value="Materials and methods plan">
                                                        <option value="Multimedia or slide presentation">
                                                        <option value="Multiple-choice test">
                                                        <option value="News or feature story">
                                                        <option value="Oral report">
                                                        <option value="Outline">
                                                        <option value="Participation">
                                                        <option value="Project">
                                                        <option value="Project plan">
                                                        <option value="Poem">
                                                        <option value="Play">
                                                        <option value="Quiz">
                                                        <option value="Research proposal">
                                                        <option value="Review of book, play, exhibit">
                                                        <option value="Rough draft or freewrite">
                                                        <option value="Social media post">
                                                        <option value="Summary">
                                                        <option value="Technical or scientific report">
                                                        <option value="Term/research paper">
                                                        <option value="Thesis statement">

                                                        @if(isset($custom_methods))
                                                        @foreach($custom_methods as $method)
                                                            <option value={{$method->custom_methods}}>
                                                        @endforeach
                                                        @endif

                                                    </datalist>
                                                </td>

                                                    <input type="hidden" name="a_method_id[]" value="{{$a_method->a_method_id}}" form="a_method_form">
                                                    <td style="display: flex">
                                                        <input id="a_method_weight{{$a_method->a_method_id}}" type="number" step=".1" form="a_method_form" style="width:auto"
                                                        class="form-control @error('weight') is-invalid @enderror" value="{{$a_method->weight}}" name="weight[]" min="0" max="100" required autofocus>
                                                        <label for="a_method_weight{{$a_method->a_method_id}}" style="font-size: medium; margin-top:5px;margin-left:5px"><strong>%</strong></label>
                                                    </td>

                                                <td>
                                                    <form action="{{route('am.destroy', $a_method->a_method_id)}}" method="POST" class="float-right ml-2">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <input type="hidden" name="course_id" value="{{$course->course_id}}">
                                                        <button type="submit" style="width:60px;" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>

                                            </tr>

                                            @endforeach

                                            <tr>
                                                <td><b>TOTAL</b></td>
                                                <td style="padding-left:25px"><b id="sum">{{$totalWeight}}%</b></td>
                                            </tr>

                                    @endif
                                </table>
                            </div>

                        </div>
                    </div>

                    <form method="POST" id="a_method_form" action="{{ action('AssessmentMethodController@store') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-3 float-right" id="btnSave" style="margin-right:15px; ">
                            Save
                        </button>
                        <input type="hidden" name="course_id" value="{{$course->course_id}}" form="a_method_form">
                    </form>

                    <button type="button" class="btn btn-primary btn-sm col-3 mt-3 float-left" id="btnAdd" style="margin-left: 12px">
                        ＋ Add Student Assessment Method
                    </button>

                </div>

                <div class="card-footer">
                    <a href="{{route('courseWizard.step1', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-left">⬅ Course Learning Outcomes</button>
                    </a>
                    <a href="{{route('courseWizard.step3', $course->course_id)}}">
                        <button class="btn btn-sm btn-primary mt-3 col-3 float-right">Teaching and Learning Activities ➡</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

      sortDropdown();
      $("form").submit(function () {
        // prevent duplicate form submissions
        $(this).find(":submit").attr('disabled', 'disabled');
        $(this).find(":submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

      });

      //add a new assesment method
      $('#btnAdd').click(function() {
            add();
            var sortedDropdown = sortDropdown();
            var rowCount = calculateRow();
            var datalist = $("#l_activities" + rowCount);
            datalist.empty().append(sortedDropdown);
      });

      // dynamic update for the total grade
      $(document).on('change',"input[name='weight[]']", function() {
        var total = calculateTotal();
        $('#sum').text(total + '%');
      });

      // Ajax save custom assessment methods
      $('#btnSave').click(function(){
          var custom = filterCustom();
          if(custom.length > 0){
            $.ajax({
                type: "POST",
                url: "/ajax/custom_methods",
                data: {custom_methods : custom},
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
            }).done(function(msg) {
                console.log(msg);
            });
        }
        });

    });

    //Add a new row of assesment method
    function add() {
        var rowCount = calculateRow();
            var element =
            `<tr>
                <td>
                    <input list="a_methods`+rowCount+`" name= "a_method[]" id="a_new_method`+rowCount+`" type="text" class="form-control
                    @error('a_method') is-invalid @enderror" name="a_method" form="a_method_form" placeholder="Choose from the dropdown list or type your own" required autofocus>
                    <datalist id="a_methods`+rowCount+`" name="a_methods" spellcheck="true">
                        <option value="Annotated bibliography">
                        <option value="Assignment">
                        <option value="Attendance">
                        <option value="Brochure, poster">
                        <option value="Case analysis">
                        <option value="Debate">
                        <option value="Diagram/chart">
                        <option value="Dialogue">
                        <option value="Essay">
                        <option value="Exam">
                        <option value="Fill in the blank test">
                        <option value="Group discussion">
                        <option value="Lab/field notes">
                        <option value="Letter">
                        <option value="Literature review">
                        <option value="Mathematical problem">
                        <option value="Materials and methods plan">
                        <option value="Multimedia or slide presentation">
                        <option value="Multiple-choice test">
                        <option value="News or feature story">
                        <option value="Oral report">
                        <option value="Outline">
                        <option value="Participation">
                        <option value="Project">
                        <option value="Project plan">
                        <option value="Poem">
                        <option value="Play">
                        <option value="Quiz">
                        <option value="Research proposal">
                        <option value="Review of book, play, exhibit">
                        <option value="Rough draft or freewrite">
                        <option value="Social media post">
                        <option value="Summary">
                        <option value="Technical or scientific report">
                        <option value="Term/research paper">
                        <option value="Thesis statement">

                        @if(isset($custom_methods))
                        @foreach($custom_methods as $method)
                            <option value={{$method->custom_methods}}>
                        @endforeach
                        @endif

                    </datalist>
                </td>
                    <td style="display: flex">
                        <input id="a_new_method_weight`+rowCount+`" type="number" step=".1" form="a_method_form" style="width:auto"
                        class="form-control @error('weight') is-invalid @enderror" value = 0 name="weight[]" min="0" max="100" required autofocus>
                        <label for="a_new_method_weight`+rowCount+`" style="font-size: medium; margin-top:5px;margin-left:5px"><strong>%</strong></label>
                    </td>
                </tr>`;

            if($('#sum').length === 0){
                var container = $('#a_method_table');
                container.append(element);
            }else{
                var container = $('#a_method_table').find("tr:last");
                container.prev().after(element);
            }
    }


    // Dynamic finds total
    function calculateTotal() {
        var sum = 0;
        $("input[name = 'weight[]']").each(function() {
            sum += Number($(this).val());
        });
        return sum;
    }

    //Calculate the row count
    function calculateRow() {
        var rowCount;
        if(document.getElementById("sum") !== null){
            rowCount = $('#a_method_table tr').length-2;
        }else{
            rowCount = $('#a_method_table tr').length-1;
        }
        return rowCount;
    }

    //  Finds all custom user learning activites
    function filterCustom(){
        var custom = [];
        var inputArray = $('input[name^="a_method[]"]').map(function(idx,elem){
            return $(elem).val();
        }).get();

        var datalist = $('datalist[name^="a_methods"]:first option').map(function(idx,elem){
            return $(elem).val();
        }).get();

        for(var i=0;i<inputArray.length;i++){
            if(!datalist.includes(inputArray[i])){
                custom.push(inputArray[i]);
            }
        }
        return custom;
    }


    // Sort drop alphabeticlly
    function sortDropdown(){
        var datalist = $('datalist[name^="a_methods"]:first option').map(function(idx,elem){
            return $(elem).val();
        }).get();

        var sortedDropdown = [];
        var sortedDatalist = sort(datalist);
        for(var i =0, n = sortedDatalist.length;i<n;i++){
            sortedDropdown.push("<option value='" + sortedDatalist[i] + "'>")
        }

        var rowCount;
        if(document.getElementById("sum") !== null){
            rowCount = $('#a_method_table tr').length-2;
        }else{
            rowCount = $('#a_method_table tr').length-1;
        }

        sortedDropdown.join();

        for(var i = 0;i<rowCount;i++) {
            var datalist = $("#a_methods" + i);
            datalist.empty().append(sortedDropdown);
        }
    }

    function sort(datalist) {
        datalist.sort(function(string_1,string_2) {
            if(string_1.toLowerCase() < string_2.toLowerCase()){return -1;}
            if(string_1.toLowerCase() > string_2.toLowerCase()){return 1;}
            return 0;
        });
        return datalist;
    }

  </script>
@endsection
