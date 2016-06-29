<?php

namespace App\Http\Controllers;

use App\Events\LoginEvent;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test(Request $request)
    {
        \Auth::loginUsingId(1);
//        $username = $request->input('username');
        \Event::fire(new LoginEvent($request, auth()->user()));
    }
}
