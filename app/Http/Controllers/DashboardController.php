<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('Backend.content.dashboard');
    }
    public function profile(){
        return view('Backend.content.profile');
    }
}
