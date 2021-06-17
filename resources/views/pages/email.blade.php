@extends('layouts.app')

@section('content')
    <div>
        <h1>Admin Email Tool</h1>
        <div>
            <p>
                Welcome the admin Email creator, from here you will be able to create and send out mass emails to the users. This will be useful when updating <strong>terms-of-use, or notifying user about updates and features</strong>.
            </p>
            <form method="POST" action="{{ action('AdminEmailController@send') }}">
                @csrf

                <div class="col-md-8">
                    <label for="emailTitle" class="col-md-3 col-form-label text-md-right">Email Title</label>
                    <input id="emailTitle" type="text"></input>
                    <button id="submit" type="submit" class="btn btn-primary col-2 btn-sm">Send</button>
                </div>
            </form>
        </div>
    </div>
@endsection