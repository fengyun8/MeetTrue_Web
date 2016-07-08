<?php

namespace App\Http\Controllers\Me;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class WorksController extends Controller
{
   public function __construct()
   {
        Auth::loginUsingId(1);
   }

   public function index()
   {
        return view('me.works')->with(['user' => Auth::user()]);
   }
}