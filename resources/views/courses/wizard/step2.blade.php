@extends('layouts.app')

@section('content')

<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('courses.wizard.header')

            <div class="card">

                <h3 class="card-header wizard" >
                    Student Assessment Methods
                </h3>

                <div class="card-body">

                    <h6 class="card-subtitle mb-4 text-muted lh-lg">
                        Input all <a href="https://ctlt.ubc.ca/resources/webliography/assessmentevaluation/" target="_blank"><i class="bi bi-box-arrow-up-right"></i> assessment methods</a> of the course individually. You may also choose to use the <a href="https://ubcoapps.elearning.ubc.ca/" target="_blank"><i class="bi bi-box-arrow-up-right"></i> UBCO's Workload Calculator</a> to estimate the student time commitment in this course based on the chosen assignments.              
                    </h6>

                    <div id="admins">
                        <div class="row">
                            <div class="col">
                                <table class="table table-light table-bordered" id="a_method_table">
                                    <tr class="table-primary">
                                        <th>Student Assesment Methods</th>
                                        <th>Weight</th>
                                        <th class="text-center">Actions</th>
                                    </tr>

                                    @if(count($a_methods)<1)
                                        <tr>
                                            <td colspan="3">
                                                <div class="alert alert-warning wizard">
                                                    <i class="bi bi-exclamation-circle-fill"></i>There are no student assessment methods set for this course.                    
                                                </div>
                                            </td>
                                        </tr>
                                    @else
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
                                                        <option value="Final Exam">
                                                        <option value="Group discussion">
                                                        <option value="Lab/field notes">
                                                        <option value="Letter">
                                                        <option value="Literature review">
                                                        <option value="Mathematical problem">
                                                        <option value="Materials and methods plan">
                                                        <option value="Mid-term Exam">
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
                                                <td>
                                                    <input id="a_method_weight{{$a_method->a_method_id}}" type="number" step="1" form="a_method_form" style="width:auto" class="p-1 form-control @error('weight') is-invalid @enderror" value="{{$a_method->weight}}" name="weight[]" min="0" max="100" required autofocus>
                                                    <label for="a_method_weight{{$a_method->a_method_id}}" style="font-size: medium; margin-top:5px;margin-left:5px"><strong>%</strong></label>
                                                </td>

                                                <td class="text-center">
                                                    <form action="{{route('am.destroy', $a_method->a_method_id)}}" method="POST" >
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <input type="hidden" name="course_id" value="{{$course->course_id}}">
                                                        <button type="submit" style="width:60px;" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>

                                            </tr>

                                        @endforeach
                                    @endif
                                    <tr class="table-secondary">
                                        <td><b>TOTAL</b></td>
                                        <td><b id="sum">{{$totalWeight}}%</b></td>
                                        <td></td>
                                    </tr>
                                </table>                                    
                            </div>
                        </div>
                    </div>

                    <div class="card-body mb-4">
                        <form method="POST" id="a_method_form" action="{{ action('AssessmentMethodController@store') }}">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm col-2 float-right" id="btnSave" >
                                Save
                            </button>
                            <input type="hidden" name="course_id" value="{{$course->course_id}}" form="a_method_form">
                        </form>

                        <button type="button" class="btn btn-sm col-3 float-left ml-3" id="btnAdd" style="background-color:#002145;color:white;">
                            ＋ Add Student Assessment Method
                        </button>
                    </div>
                </div>

                <!-- card footer -->
                <div class="card-footer">
                    <div class="card-body mb-4">
                        <a href="{{route('courseWizard.step1', $course->course_id)}}">
                            <button class="btn btn-sm btn-primary col-3 float-left"><i class="bi bi-arrow-left mr-2"></i> Course Learning Outcomes</button>
                        </a>
                        <a href="{{route('courseWizard.step3', $course->course_id)}}">
                            <button class="btn btn-sm btn-primary col-3 float-right">Teaching and Learning Activities <i class="bi bi-arrow-right ml-2"></i></button>
                        </a>
                    </div>
                </div>            
            </div>
        </div>
    </div>
</div>


<script>
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
                    @error('a_method') is-invalid @enderror" name="a_method" form="a_method_form" placeholder="Choose from the dropdown list or type your own"
                    spellcheck="true" required autofocus>
                    <datalist id="a_methods`+rowCount+`" name="a_methods">
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
                        <option value="Final Exam">
                        <option value="Group discussion">
                        <option value="Lab/field notes">
                        <option value="Letter">
                        <option value="Literature review">
                        <option value="Mathematical problem">
                        <option value="Materials and methods plan">
                        <option value="Mid-term Exam">
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
                <td>
                    <input class="p-1" id="a_new_method_weight`+rowCount+`" type="number" step="1" form="a_method_form" style="width:auto" class="form-control @error('weight') is-invalid @enderror" value = 0 name="weight[]" min="0" max="100" required autofocus>
                    <label for="a_new_method_weight`+rowCount+`" style="font-size: medium; margin-top:5px;margin-left:5px"><strong>%</strong></label>
                </td>
                <td></td>


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

    // Helper function used to Sorting the datalist
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
