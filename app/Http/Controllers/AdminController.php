<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.login');
    }
    public function form()
    {
        return view('admin.form');
    }
    public function table()
    {
        return view('admin.table');
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('superadmin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::guard('superadmin')->user()->role != 'superadmin') {
                Auth::guard('superadmin')->logout();
                return redirect()->route('superadmin.login')->with('error', 'Unauthorized User.Access Denied.');
            }
            return redirect()->route('superadmin.dashboard');
        } else {
            return redirect()->route('superadmin.login')->with('error', 'Something went wrong.');
        }
    }
}
