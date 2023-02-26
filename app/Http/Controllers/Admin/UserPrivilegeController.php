<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Adminrole;
use Illuminate\Support\Facades\Validator;

class UserPrivilegeController extends Controller
{
    public function index(){
        $roles = Adminrole::get();
        $data = Admin::join('adminroles','adminroles.role_uid','admins.role_uid')->select('admins.*','adminroles.name as rolename')->get();
        return view('admin.user-privilege.index',compact('data','roles'));
    }
    public function updaterole(Request $request){
        $input = $request->all();
        $user = array();
        $user['role_uid'] = $input['role_uid'];
        Admin::where('role_uid',$input['role_uid'])->update($user);
        return redirect()->route('user_privileges');
    }
    public function add(Request $request){
        if($request->isMethod('post')){
            $input = $request->all();
            $rules = array(
                'name' => 'required|string',
                'email' => 'required|string|unique:admins,email',
                'password' => 'required|string',
                'confirmpassword' => 'required|string',
            );
            $validator = Validator::make($input,$rules);
            if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
            }
            unset($input['_token']);
            if($input['password'] != $input['confirmpassword']){
                return redirect()->back()->withErrors('confirmpassword','Password and confrim password should be same');
            }else{
                unset($input['confirmpassword']);
                $input['password'] = bcrypt($input['password']);
                Admin::insert($input);
                return redirect()->back();
            }
        }
        $roles = Adminrole::get();
        return view('admin.user-privilege.add',compact('roles'));
    }
}
