@extends('layouts.app')

@section('content')
    <div>
        <h2>Admin Email Tool</h2>
        <div>
            <p>
                Welcome the admin Email creator, from here you will be able to create and send out mass emails to the users. This will be useful when updating <strong>terms-of-use, or notifying user about updates and features</strong>.
            </p>
            <form method="POST" action="{{ action('AdminEmailController@send') }}">
                @csrf

                <div class="col-md-8">
                    <label for="email_subject" class="col-md-3 col-form-label text-md-right"><span class="requiredField">*</span>Email Subject</label>
                    <textarea id="email_subject" name="email_subject" type="text" cols="60" rows="1" style="vertical-align: middle;" required spellcheck="true"></textarea>
                    <br>
                    <label for="email_title" class="col-md-3 col-form-label text-md-right"><span class="requiredField">*</span>Email Title</label>
                    <textarea id="email_title" name="email_title" type="text" cols="60" rows="1" style="vertical-align: middle;" required spellcheck="true"></textarea>
                    <br>
                    <label for="email_body" class="col-md-3 col-form-label text-md-right"><span class="requiredField">*</span>Email Body</label>
                    <textarea id="email_body" name="email_body" type="text" cols="60" rows="10" style="vertical-align: top;" required spellcheck="true"></textarea>
                    <br>
                    <button id="submit" type="submit" class="btn btn-primary col-2 btn-sm">Send</button>
                </div>
            </form>
        </div>
    </div>
@endsection
