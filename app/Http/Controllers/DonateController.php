<?php

namespace App\Http\Controllers;

use App\Events\Donated;
use App\User;
use Illuminate\Http\Request;

class DonateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = User::find(1);

        event(new Donated($user));

        return view('donate.index');
    }
}
