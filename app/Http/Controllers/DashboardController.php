<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $letters = Letter::where('nim', Auth::user()->nim)->get();
        return view('dashboard', compact('letters'));
    }
}