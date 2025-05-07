<?php

   namespace App\Http\Controllers;

   use App\Models\Letter;
   use Illuminate\Http\Request;

   class DashboardController extends Controller
   {
       public function index()
       {
           $letters = Letter::all(); // Ambil semua data dari tabel letters
           return view('dashboard', compact('letters'));
       }
   }