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
    {
        if(Gate::denies('admin-privilege')){
            return redirect(route('home'));
        }
        return view('pages.email');
    }

    public function send(Request $request){
        
        $subject = $request->input('email_subject');
        $title = $request->input('email_title');
        $body = $request->input('email_body');
        //dd($subject, $title, $body);

        // Query all emails in Users table
        $emails = DB::table('users')->select('email')->get();
        // For each email address, send separate email informing the Terms changes.
        foreach ($emails as $recipient) {
            Mail::to($recipient)->send(new TemplateEmail($subject, $title, $body));
                                
        }
        $request->session()->flash('success', 'Your email has been sent!');
        
        return view('pages.email');
    }
}