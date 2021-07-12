@extends('layouts.app')

@section('content')
<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('programs.wizard.header')

            <div class="card">
                <h3 class="card-header wizard" >
                    Program Overview
                </h3>
                <div class="card-body">
                    @if( count($programCourses) < 1 )
                    <div class="alert alert-warning wizard">
                            <i class="bi bi-exclamation-circle-fill pr-2 fs-5"></i>There are no Courses set for this program yet.                    
                        </div>
                    @else
                        <div class="card m-1">
                            <h5 class="card-header wizard text-start">
                                Courses to PLOs Frequency Distribution
                            </h5>
                            
                            <table>
                                <tr class="table-primary">
                                    <th colspan='1'>Courses</th>
                                    <th colspan='{{ count($plos) }}'>Program-level Learning Outcomes</th>
                                </tr>
                                <tr>
                                    <th colspan='1' style="background-color: rgba(0, 0, 0, 0.03);"></th>
                                    @foreach($ploCategories as $plo)
                                        @if ($plo->plo_category != NULL)
                                            @if ($plo->plos->count() > 0) 
                                                <th colspan='{{ $plosPerCategory[$plo->plo_category_id] }}' style="background-color: rgba(0, 0, 0, 0.03);">{{$plo->plo_category}}</th>
                                            @endif
                                        @endif
                                    @endforeach
                                    <!-- Heading appended at the end, if there are Uncategorized PLOs  -->
                                    @if($hasUncategorized)
                                        <th colspan="{{$numUncategorizedPLOS}}" style="background-color: rgba(0, 0, 0, 0.03);">Uncategorized PLOs</th>
                                    @endif
                                </tr>

                                <tr>
                                    <th colspan='1' style="background-color: rgba(0, 0, 0, 0.03);"></th>
                                    <!-- Categorized PLOs -->
                                    @foreach($ploProgramCategories as $plo)
                                        @if ($plo->plo_category != NULL)
                                            <th style="background-color: rgba(0, 0, 0, 0.03);">{{$plo->plo_shortphrase}}</th>
                                        @endif
                                    @endforeach
                                    <!-- Uncategorized PLOs -->
                                    @foreach($plos as $plo)
                                        @if ($plo->plo_category == NULL)
                                            <th style="background-color: rgba(0, 0, 0, 0.03);">{{$plo->plo_shortphrase}}</th>
                                        @endif
                                    @endforeach
                                </tr>
                                <!-- Show all courses associated to the program -->
                                @foreach($programCourses as $index => $course)
                                    <tr>
                                        <th colspan="1" style="background-color: rgba(0, 0, 0, 0.03);">
                                        {{$course->course_title}}
                                        <br>
                                        {{$course->course_code}} {{$course->course_num}} {{$course->section}}
                                        <br>
                                        {{$course->semester}} {{$course->year}}
                                    </th>
                                        <!-- Frequency distribution from each course -->
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <div class="card-body mb-4">
                        <a href="{{route('programWizard.step3', $program->program_id)}}">
                            <button class="btn btn-sm btn-primary col-3 float-left"><i class="bi bi-arrow-left mr-2"></i> Courses</button>
                        </a>
                    </div>
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

<style>
    table {
        margin: 2%;
        width: 95%;
        table-layout: fixed;
        background-color: blueviolet;
    }
    table, th, td {
    border: 1px solid white;
    color: black;
    
}
    th {
        text-align: center;
    }
.table-primary th, .table-primary td, .table-primary thead th, .table-primary tbody + tbody {
    border-color: white;
}
</style>
@endsection
