<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminEmailController extends Controller
{
    
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
        // Write code for the mail tool
        $emailTitle = $request->input('emailTitle');
        dd($emailTitle);

        return view('pages.email');
    }
}
