<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TemplateEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AdminEmailController extends Controller
{
    /*    
    SMTP SERVER WORKS LOCALLY ON VPN! :)

    
    Mail docs: https://laravel.com/docs/8.x/mail
    Laravel queries: https://laravel.com/docs/8.x/queries
    MD Syntax: markdownguide.org/basic-syntax/

    GATE: app/Http/Controller/admin/UserController.php
    
    @canadmin -> views/layout/app.blade.php

    */
    public function __construct()
    {
        $this->middleware('auth');

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   // this Gate checks if user is an admin and redirects to home if they are not (security)
        if(Gate::denies('admin-privilege')){
            return redirect(route('home'));
        }
        return view('pages.email');
    }

    public function send(Request $request){

        $subject = $request->input('email_subject');
        $title = $request->input('email_title');
        $body = $request->input('email_body');
        $signature = $request->input('email_signature');
        //dd($subject, $title, $body); // request debug
        
        // Receive the role input from Emails blade
        $role_id = $request->input('email_recipients');
        // Query the role_user table for all user_id's that have role_id matching the role above.
        $user_ids = DB::table('role_user')->where('role_id', $role_id)->get()->map(function($user) {
            return $user->user_id;
        });
        //dd($user_ids); // query debug 
        // Query all the email addresses from users table that have a user_id matching the ones from the role_user query. 
        $email_recipients = DB::table('users')->whereIn('id', $user_ids)->get();
        //dd($email_recipients); // query debug
        // Loop over recipient emails and send each one a separate email
        // if we want to add names to email we can with $recipient->name
        foreach ($email_recipients as $recipient) {
            Mail::to($recipient->email)->send(new TemplateEmail($subject, $title, $body, $signature));
        }
        // Add all users to the BCC list of email so they do not see each other's email addresses.
        
        return redirect()->back()->with('success', 'Email has been sent.');
    }
}