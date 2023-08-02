<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\Kwbs;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $user = Users::where('username', 'admin')->first();
        $previousSessionID = $user->session;

        // Compare the current and previous session IDs
        if ($previousSessionID === '0') {
            return redirect()->route('login');
        } else {
            $count = Kwbs::get()->count();
            return view('dashboard.index',[
                'count' => $count
            ]);
        }

    }

}
