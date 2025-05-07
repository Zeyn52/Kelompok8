<?php

  namespace App\Http\Controllers\Auth;

  use App\Http\Controllers\Controller;
  use App\Models\User;
  use Illuminate\Foundation\Auth\RegistersUsers;
  use Illuminate\Support\Facades\Hash;
  use Illuminate\Support\Facades\Validator;
  use Illuminate\Http\Request;

  class RegisterController extends Controller
  {
      use RegistersUsers;

      protected $redirectTo = '/dashboard';

      public function __construct()
      {
          $this->middleware('guest');
      }

      protected function validator(array $data)
      {
          return Validator::make($data, [
              'name' => ['required', 'string', 'max:255'],
              'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
              'password' => ['required', 'string', 'min:8', 'confirmed'],
              'role' => ['required', 'in:mahasiswa,dosen,admin'],
          ]);
      }

      protected function create(array $data)
      {
          return User::create([
              'name' => $data['name'],
              'email' => $data['email'],
              'password' => Hash::make($data['password']),
              'role' => $data['role'],
          ]);
      }

      protected function redirectTo()
      {
          return $this->redirectTo;
      }

      protected function registered(Request $request, $user)
      {
          return redirect($this->redirectPath());
      }

      protected function sendFailedRegisterResponse(Request $request)
      {
          return redirect()->back()
              ->withInput($request->only('name', 'email', 'role'))
              ->with('register_error', 'Registration failed. Please check your input.');
      }
  }