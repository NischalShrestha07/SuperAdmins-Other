<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $superadmin = SuperAdmin::all();
        return view('superadmin.login', compact('superadmin'));
    }
    // public function index()
    // {
    //     $superadmin = SuperAdmin::all();
    //     return view('superadmin.addSuper', compact('superadmin'));
    // }
    public function dashboard()
    {
        return view('superadmin.dashboard');
    }
    public function form()
    {
        return view('superadmin.form');
    }
    public function table()
    {
        return view('superadmin.table');
    }

    public function logout()
    {
        Auth::guard('superadmin')->logout();
        return redirect()->route('superadmin.login')->with('error', 'Logged Out Successfully.');
    }
    public function authenticate(Request $request)
    {
        $credentials =  $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('superadmin')->attempt($credentials)) {
            if (Auth::guard('superadmin')->user()->email != 'superadmin@gmail.com') {
                Auth::guard('superadmin')->logout();
                return redirect()->route('superadmin.login')->with('error', 'Unauthorized User.Access Denied.');
            }
            return redirect()->route('superadmin.dashboard');
        } else {
            return redirect()->route('superadmin.login')->with('error', 'Something went wrong.');
        }
    }
    // public function AddNewSuper(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'address' => 'nullable',
    //         'phone' => 'nullable',
    //         'companyName' => 'required',
    //         'email' => 'required',
    //         'password' => 'required',

    //     ]);
    //     $data = new SuperAdmin();
    //     $data->name = $request->input('name');
    //     $data->address = $request->input('address');
    //     $data->phone = $request->input('phone');
    //     $data->companyName = $request->input('companyName');
    //     $data->email = $request->input('email');

    //     //BCRYPT PASSWORD
    //     $data->password = Hash::make($request->password);


    //     // $data->password = $request->input('password');
    //     $data->save();

    //     return redirect()->route('superadmin.addSuper')->with('success', 'Super Admin Added Successfully.');
    // }

    public function AddNewSuper(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'nullable',
            'phone' => 'nullable',
            'companyName' => 'required',
            'email' => 'required|email|unique:super_admins,email', // Ensure the email is unique
            'password' => 'required|min:8', // Minimum length for the password
        ]);

        $data = new SuperAdmin();
        $data->name = $request->input('name');
        $data->address = $request->input('address');
        $data->phone = $request->input('phone');
        $data->companyName = $request->input('companyName');
        $data->email = $request->input('email');

        // Hash the password before saving
        $data->password = Hash::make($request->password);
        $data->save();

        return redirect()->route('superadmin.addSuper')->with('success', 'Super Admin Added Successfully.');
    }


    /**
     * Store a newly created resource in storage.
     */
    // public function UpdateSuper(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'address' => 'nullable',
    //         'phone' => 'nullable',
    //         'companyName' => 'required',
    //         'email' => 'required',
    //         'password' => 'required',

    //     ]);
    //     $data = SuperAdmin::findOrFail($request->input('id'));
    //     $data->name = $request->input('name');
    //     $data->address = $request->input('address');
    //     $data->phone = $request->input('phone');
    //     $data->companyName = $request->input('companyName');
    //     $data->email = $request->input('email');
    //     // $data->password = $request->input('password');
    //     $data->password = Hash::make($request->password);

    //     $data->save();
    //     return redirect()->route('superadmin.addSuper')->with('success', 'Super Admin Updated Successfully.');
    // }


    public function UpdateSuper(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:super_admins,id',
            'name' => 'required',
            'address' => 'nullable',
            'phone' => 'nullable',
            'companyName' => 'required',
            'email' => 'required|email|unique:super_admins,email,' . $request->input('id'), // Ignore current user's email
            'password' => 'nullable|min:8', // Make password optional during update
        ]);

        $data = SuperAdmin::findOrFail($request->input('id'));
        $data->name = $request->input('name');
        $data->address = $request->input('address');
        $data->phone = $request->input('phone');
        $data->companyName = $request->input('companyName');
        $data->email = $request->input('email');

        // Only hash the password if it's provided
        if ($request->filled('password')) {
            $data->password = Hash::make($request->password);
        }

        $data->save();
        return redirect()->route('superadmin.addSuper')->with('success', 'Super Admin Updated Successfully.');
    }


    public function destroy(SuperAdmin $superAdmin, $id)
    {
        $data = SuperAdmin::find($id);
        $data->delete();
        return redirect()->route('superadmin.addSuper')->with('success', 'Super Admin Deleted Successfully.');
    }
}
