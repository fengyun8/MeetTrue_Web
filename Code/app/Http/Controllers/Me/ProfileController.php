<?php

namespace App\Http\Controllers\Me;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class ProfileController extends Controller
{
   public function __construct()
   {
        Auth::loginUsingId(1);
   }

   public function show()
   {
        return view('me.profile')->with(['user' => Auth::user()]);
   }
}