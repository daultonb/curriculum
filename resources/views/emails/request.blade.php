@extends('layouts.app')

@section('content')
    <div class="container" style="display: flex;justify-content: center;">
        <div class="row" style="width:75%">
            <div class="col-md-12 col-md-offset-1">

                <div class="card mb-5 mt-5" style="background-color: white;">
                    <div class="card-header">
                        <b>Send invitation:</b>
                    </div>

                    <div class="card-body">
                        <p class="form-text text-muted">Enter the email address of the person you would like to invite to use this website.
                            Once they register, you may add them as collaborators to your courses/programs.</p>

                        <form class="form-horizontal" method="POST" action="{{ route('storeInvitation') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address:</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Send An Invitation
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
