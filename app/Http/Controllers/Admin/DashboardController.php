<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Hash;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function changepassword(){
        return view('admin.auth.changepassword');
    }

    public function updatePassword(Request $request)
{
        # Validation
        $request->validate([
            'new_password' => 'required|confirmed',
        ]);


        


        #Update the new Password
        Admin::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
}

}
