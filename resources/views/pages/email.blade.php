@extends('layouts.app')

@section('content')
    <div>
        <h2>Admin Email Tool</h2>
        <div>
            <p>
                Welcome the admin Email creator, from here you will be able to create and send out mass emails to the users. This will be useful when updating <strong>terms-of-use, or notifying user about updates and features</strong>.
            </p>
            <p>
            The body field of this form accepts Markdown for email formatting. To generate Markdown for your email please use <a href="https://markdownlivepreview.com/" target="_blank">Markdown Live Preview</a>.
            </p>
            <form method="POST" action="{{ action('AdminEmailController@send') }}">
                @csrf

                <div class="col-md-8">
                <label for="email_recipients" class="col-md-3 col-form-label text-md-right"><span class="requiredField">*</span>Email Recipients</label>
                    <?php
                        use Illuminate\Support\Facades\DB;

                        
                        // create dropdown for recipient selection
                        echo '<select id="email_recipients" name="email_recipients">';
                        // pulls role column from roles table in DB
                        $user_roles = DB::table('roles')->pluck('role');
                        
                        
                        // pulls id column from roles table in DB
                        $role_id = DB::table('roles')->pluck('id');
                        for($idx=0; $idx < 2; $idx++){
                            // this will output the roles in the roles table, and the value returned is the role id (needed to query user table)
                            echo '<option value="'.$role_id[$idx] . '">' . ucfirst($user_roles[$idx]) . '</option>';
                        }
                        echo '</select>';
                    ?>
                    <br>
                    <label for="email_subject" class="col-md-3 col-form-label text-md-right"><span class="requiredField">*</span>Email Subject</label>
                    <textarea id="email_subject" name="email_subject" type="text" cols="60" rows="1" style="vertical-align: middle;" required spellcheck="true"></textarea>
                    <br>
                    <label for="email_title" class="col-md-3 col-form-label text-md-right"><span class="requiredField">*</span>Email Title</label>
                    <textarea id="email_title" name="email_title" type="text" cols="60" rows="1" style="vertical-align: middle;" required spellcheck="true"></textarea>
                    <br>
                    <label for="email_body" class="col-md-3 col-form-label text-md-right"><span class="requiredField">*</span>Email Body</label>
                    <textarea id="email_body" name="email_body" type="text" cols="60" rows="10" style="vertical-align: top;" required spellcheck="true"></textarea>
                    <br><br>
                    <label for="email_signature" class="col-md-3 col-form-label text-md-right"><span class="requiredField">*</span>Email Signature (without comma)</label>
                    <textarea id="email_signature" name="email_signature" type="text" cols="60" rows="1" style="vertical-align: middle;" required spellcheck="true"></textarea>
                    <br>
                    <button id="submit" type="submit" class="btn btn-primary col-2 btn-sm">Send</button>
                </div>
                
            </form>
        </div>
    </div>
@endsection
