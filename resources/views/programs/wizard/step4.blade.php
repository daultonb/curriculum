@extends('layouts.app')

@section('content')
<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('programs.wizard.header')

            <!-- progress bar -->
            <div>
                <table class="table table-borderless text-center table-sm" style="table-layout: fixed; width: 100%">
                    <tr>
                        <td><a class="btn @if($ploCount<1) btn-secondary @else btn-success @endif" href="{{route('programWizard.step1', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>1</b> </a></td>
                        <td><a class="btn @if($msCount<1) btn-secondary @else btn-success @endif" href="{{route('programWizard.step2', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>2</b> </a></td>
                        <td><a class="btn @if($courseCount<1) btn-secondary @else btn-success @endif" href="{{route('programWizard.step3', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>3</b> </a></td>
                        <td><a class="btn btn-primary" href="{{route('programWizard.step4', $program->program_id)}}" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.42857;"> <b>4</b> </a></td>
                    </tr>
                    <tr>
                        <td>Program Learning Outcomes</td>
                        <td>Mapping Scale</td>
                        <td>Courses</td>
                        <td>Begin Mapping Program</td>
                    </tr>
                </table>
            </div>

            <div class="card">

                <div class="card-header">
                    <b>Begin Mapping Program</b>
                </div>

                <div class="card-body">

                    <p>
                    Please select the course you would like to map.
                    </p>

                            <div>
                                <div>
                                    <table class="table table-hover dashBoard">
                                        <thead>
                                            <tr>
                                                <th scope="col">Course Title</th>
                                                <th scope="col">Course Code</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        @foreach ($courses as $index => $course)
                                        <tbody>
                                        <tr>
                                            <td>{{$course->course_title}}</td>
                                            <td>{{$course->course_code}} {{$course->course_num}}</td>
                                            <td>
                                                <!-- Redirect to Map Course to PLO's --> 
                                                <a href="{{route('map.index',[$course->course_id, $program->program_id])}}"><button type="button" style="width: 100px;" class="btn btn-outline-primary btn-sm ml-2 float-right">Map Course</button></a>
                                                <!-- Redirect to Map CLO's to PLO's -->
                                                <a href="{{route('ploclomap.index',[$course->course_id, $program->program_id])}}"><button type="button" style="width: 150px;" class="btn btn-outline-primary btn-sm ml-2 float-right">Map CLO's to PLO's</button></a>
                                            </td>
                                        </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                        </div>
                </div>

                <div class="card-footer">
                    <a href="{{route('programWizard.step3', $program->program_id)}}"><button class="btn btn-sm btn-primary mt-3 col-3 float-left"><i class="bi bi-arrow-left mr-2"></i> Courses</button></a>
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
