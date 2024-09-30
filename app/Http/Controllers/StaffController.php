<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{

    public function login()
    {
        return view('staff.login');
    }
    public function index()
    {
        $staff = Staff::all();
        return view('staff.addStaff', compact('staff'));
    }
    public function dashboard()
    {
        return view('staff.dashboard');
    }
    public function form()
    {
        return view('staff.form');
    }
    public function table()
    {
        return view('staff.table');
    }

    public function AddNewStaff(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'nullable',
            'phone' => 'nullable',
            'companyName' => 'required',
            'email' => 'required',
            'password' => 'required',

        ]);
        $data = new Staff();
        $data->name = $request->input('name');
        $data->address = $request->input('address');
        $data->phone = $request->input('phone');
        $data->companyName = $request->input('companyName');
        $data->email = $request->input('email');
        $data->password = $request->input('password');
        $data->save();
        return redirect()->route('Staff.addSuper')->with('success', 'Super Admin Added Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function UpdateStaff(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'nullable',
            'phone' => 'nullable',
            'companyName' => 'required',
            'email' => 'required',
            'password' => 'required',

        ]);
        $data = Staff::findOrFail($request->input('id'));
        $data->name = $request->input('name');
        $data->address = $request->input('address');
        $data->phone = $request->input('phone');
        $data->companyName = $request->input('companyName');
        $data->email = $request->input('email');
        $data->password = $request->input('password');
        $data->save();
        return redirect()->route('staff.addSuper')->with('success', 'Staff Updated Successfully.');
    }

    public function destroy(Staff $staff, $id)
    {
        $data = Staff::find($id);
        $data->delete();
        return redirect()->route('staff.addSuper')->with('success', 'Staff Deleted Successfully.');
    }
}
