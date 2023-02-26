<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adminrole;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RoleMasterController extends Controller
{
    public function index(Request $request){
        $data = Adminrole::get();
        return view('admin.roles.index',compact('data'));
    }
    public function create(Request $request){
        if($request->isMethod('post')){
            $input = $request->all();
            $rules = array(
                'name' => 'required|string',
            );
            $validator = Validator::make($input,$rules);
            if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
            }
            unset($input['_token']);
            $name = $input['name'];
            unset($input['name']);
            $permission = implode(',',$input);

            $role_uid = get_random_id('adminroles', 'role_uid');
            if($input['issuperadmin'] == '*'){
                $permission = '*';
            }
            $data = array();
            $data['name'] = $name;
            $data['permissions'] = $permission;
            $data['created_by'] = Auth::user()->unique_user_id;
            $data['role_uid'] = $role_uid;
            Adminrole::insert($data);
        }
        return view('admin.roles.create');
    }
    public function edit(Request $request,$id){
        if($request->isMethod('post')){
            $input = $request->all();
            $rules = array(
                'name' => 'required|string',
            );
            $validator = Validator::make($input,$rules);
            if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
            }
            unset($input['_token']);
            $name = $input['name'];
            unset($input['name']);
            $permission = implode(',',$input);
            
            $data = array();
            $data['name'] = $name;
            $data['permissions'] = $permission;
            Adminrole::where('role_uid',$id)->update($data);
        }
        $data = Adminrole::where('role_uid',$id)->first();
        $permissions = explode(',',$data->permissions);
        return view('admin.roles.edit',compact('data','permissions'));
    }
}
