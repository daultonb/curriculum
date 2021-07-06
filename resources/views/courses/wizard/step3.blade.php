@extends('layouts.app')

@section('content')
<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('courses.wizard.header')

            <div class="card">

                <h3 class="card-header wizard" >
                    Teaching and Learning Activities
                </h3>


                <div class="card-body">
                    <h6 class="card-subtitle mb-4 lh-lg">
                        Input all teaching and learning activities or <a target="_blank" href="https://teaching.cornell.edu/teaching-resources/teaching-cornell-guide/instructional-strategies"><i class="bi bi-box-arrow-up-right"></i> instructional strategies</a> of the course individually. For increased accessibility and enhanced student participation, while still offering challenging learning opportunities,
                        use there <a target="_blank" href="https://udlguidelines.cast.org/binaries/content/assets/udlguidelines/udlg-v2-2/udlg_graphicorganizer_v2-2_numbers-no.pdf"><i class="bi bi-box-arrow-up-right"></i> Universal Design for Learning Guildlines</a>
                        (Offered by CAST) to design your course. You may also use <a target="_blank" href="https://udlguidelines.cast.org/binaries/content/assets/common/publications/articles/cast-udl-planningq-a11y.pdf"><i class="bi bi-box-arrow-up-right"></i> these key questions to guide</a> you.               
                    </h6>

                    <div id="admins">
                        <div class="row">
                            <div class="col">
                                
                                <table class="table table-light table-bordered" id="l_activity_table">
                                    <tr class="table-primary">
                                        <th>Teaching and Learning Activities</th>
                                        <th class="text-center">Actions</th>
                                    </tr>


                                    @if(count($l_activities)<1)
                                        <tr>
                                            <td colspan="2">
                                                <div class="alert alert-warning wizard">
                                                    <i class="bi bi-exclamation-circle-fill"></i>There are no teaching and learning activities set for this course.                    
                                                </div>
                                            </td>
                                        </tr>
                                    @else

                                        @foreach($l_activities as $index => $l_activity)

                                                <tr>
                                                    <td>
                                                        <input list="l_activities{{$index}}" name="l_activity[]" id="l_activity{{$l_activity->l_activity_id}}" form="l_activity_form" class="form-control" type="text"
                                                        type= "method" placeholder="Choose from the dropdown list or type your own" value="{{$l_activity->l_activity}}" required autofocus style="white-space: pre"
                                                        spellcheck="true">
                                                        <datalist id="l_activities{{$index}}" name="l_activities" >
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

                                                                @if(isset($custom_activities))
                                                                @foreach($custom_activities as $activity)
                                                                    <option value={{$activity->custom_activities}}>
                                                                @endforeach
                                                                @endif
                                                            </datalist>
                                                        </td>

                                                        <input type="hidden" name="l_activity_id[]" value="{{$l_activity->l_activity_id}}" form="l_activity_form">
                                                    </td>

                                                    <td class="text-center">
                                                        <form action="{{route('la.destroy', $l_activity->l_activity_id)}}" method="POST" >
                                                            @csrf
                                                            {{method_field('DELETE')}}
                                                            <input type="hidden" name="course_id" value="{{$course->course_id}}">
                                                            <button type="submit" style="width:60px;" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                        @endforeach

                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-body mb-4">
                        <form method="POST" id="l_activity_form" action="{{ action('LearningActivityController@store') }}">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm col-2 float-right" id="btnSave">
                                Save
                            </button>
                            <input type="hidden" name="course_id" value="{{$course->course_id}}" form="l_activity_form">
                        </form>

                        <button type="button" class="btn btn-primary btn-sm col-3 float-left" id="btnAdd" style="background-color:#002145;color:white;">
                            ＋ Add Teaching and Learning Activity
                        </button>
                    </div>

                </div>

                <!-- card footer -->
                <div class="card-footer">
                    <div class="card-body mb-4">
                        <a href="{{route('courseWizard.step2', $course->course_id)}}">
                            <button class="btn btn-sm btn-primary col-3 float-left"><i class="bi bi-arrow-left mr-2"></i> Student Assessment Methods</button>
                        </a>
                        <a href="{{route('courseWizard.step4', $course->course_id)}}">
                            <button class="btn btn-sm btn-primary col-3 float-right">Course Alignment <i class="bi bi-arrow-right ml-2"></i></button>
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

      //add a new learning outcomes
      $('#btnAdd').click(function() {
        add();
        var sortedDropdown = sortDropdown();
        var rowCount = $('#l_activity_table tr').length - 2;
        var datalist = $("#l_activities" + rowCount);
        datalist.empty().append(sortedDropdown);
      });

      // Ajax save custom learning activities
      $('#btnSave').click(function(){
          var custom = filterCustom();
          if(custom.length > 0){
            $.ajax({
                type: "POST",
                url: "/ajax/custom_activities",
                data: {custom_activities : custom},
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
        var rowCount = $('#l_activity_table tr').length - 1;
            var element =
            `<tr>
                <td>
                    <input list="l_activities" name="l_activity[]" id="l_activity`+rowCount+`" form="l_activity_form" class="form-control" type="text"
                    type= "method" placeholder="Choose from the dropdown list or type your own" required autofocus
                    spellcheck="true">
                    <datalist id="l_activities" name="l_activities" >
                        <option value="Discussion">Discussion</option>
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

                        @if(isset($custom_activities))
                        @foreach($custom_activities as $activity)
                            <option value={{$activity->custom_activities}}>
                        @endforeach
                        @endif
                        </datalist>
                    </td>
                    <td></td>
                </tr>`;

            var container = $('#l_activity_table');
            container.append(element);
    }

    //  Finds all custom user learning activites
    function filterCustom(){
        var custom = [];

        var inputArray = $('input[name^="l_activity[]"]').map(function(idx,elem){
            return $(elem).val();
        }).get();

        var datalist = $('datalist[name^="l_activities"]:first option').map(function(idx,elem){
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
        var datalist = $('datalist[name^="l_activities"]:first option').map(function(idx,elem){
            return $(elem).val();
        }).get();

        var sortedDropdown = [];
        var sortedDatalist = sort(datalist);
        for(var i =0, n = sortedDatalist.length;i<n;i++){
            sortedDropdown.push("<option value='" + sortedDatalist[i] + "'>")
        }

        var rowCount = $('#l_activity_table tr').length - 1;
        sortedDropdown.join();

        for(var i = 0;i<rowCount;i++) {
            var datalist = $("#l_activities" + i);
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
