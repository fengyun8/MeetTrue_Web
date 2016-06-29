<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Admin Home page.
     */
    public function index()
    {
      return view('admin.index');
    }

    public function getActivity()
    {
      return view('admin.activity');
    }
}
