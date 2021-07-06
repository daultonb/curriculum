@extends('layouts.app')

@section('content')
<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('programs.wizard.header')

            <div class="card">

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
@endsection
