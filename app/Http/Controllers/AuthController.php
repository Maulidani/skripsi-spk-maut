<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;

class AuthController extends Controller
{
    public function login(Request $request)
    {
      
        $user = Users::where('username', 'admin')->first();
        $previousSessionID = $user->session;

        // Compare the current and previous session IDs
        if ($previousSessionID === '0') {
            return view('auth.login');
        } else {
            return redirect()->route('dashboard');
        }

    }

    public function logout()
    {

        $session = Users::where('username', 'admin')->first();
        $session->session = '0';
        $session->save();

        if ($session) {               
            
            return redirect()->route('login');
         
        } 

    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $username = $request->username;
        $password = $request->password;

        // Query the users table for a matching username
        $user = Users::where('username', $username)->first();

        if ($user) {
         
            // Verify the password
            if ($password == $user->password) {
                // Password is correct
            
                $session = Users::find($user->id);
                $session->session = '1';
                $session->save();

                return redirect()->route('dashboard');
            
            } else {
                return back()->withErrors([
                    'username' => 'The provided credentials do not match our records.',
                ])->onlyInput('username');
            }
        } else {
            return back()->withErrors([
                'username' => 'The provided credentials do not match our records.',
            ])->onlyInput('username');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }
}
