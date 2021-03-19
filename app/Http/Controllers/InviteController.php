<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvitationRequest;
use Illuminate\Http\Request;
use App\Models\Invite;
use Illuminate\Support\Str;
use App\Mail\Invitation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\directoryExists;

class InviteController extends Controller
{

    public function invite() {
        // show the user a form with an email field to invite a new user

    }

    // function to get to Invitation page
    public function requestInvitation() {
        return view('emails.request');
    }

    // Sent a invitation email with generated token
    public function store(Request $request){

        $this->validate($request, [
            'email' => 'required',
            ]);


        if(!$invite = Invite::where('email', $request->email)->first()) {
            $invite = new Invite($request->all());
        }

        if( DB::table('users')->where('email', $invite->email)->first()) {
            return redirect()->route('requestInvitation')->with('error', $invite->email. " is already a reigstered user. You can now add them as collaboratr to your course/program.");
        }

        $invite->generateToken();
        $invite->save();

        Mail::to($invite->email)->send(new Invitation($invite->invitation_token));

        return redirect()->route('requestInvitation')->with('success','You have successfully invited '.$invite->email.". Once they register, you may collaborate on a course or a program in this website.");
    }

    public function accept($token) {
        if(!$invite = Invite::where('invitation_token',$token)->first()) {
            abort(404);
        }
        $invite->delete();
        return "Your invitation was successfully accepted";
    }

}
