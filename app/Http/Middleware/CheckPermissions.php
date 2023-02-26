<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Auth;
use App\Models\Admin;
use App\Models\Adminrole;
use Artisan;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $i = 1;

        do {
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
            
            $i++;
        } while($i <= 10);

        // cache()->flush();
        if(Auth::check()){
        $user = Admin::where('id', Auth::user()->id)->first();
        if($user->role_uid == NULL){
            return $next($request);
        }else{
        $adminrole = Adminrole::where('role_uid',$user->role_uid)->first();
        if(!empty($adminrole)){ 
        if(Auth::check() && $adminrole->permissions == '*') 
        {            
            return $next($request);
        } 
        else if(Auth::check() && $adminrole->permissions != '*')
        {
            $current_function = Route::currentRouteAction();

            $permissions = explode(',', $adminrole->permissions);
            if( in_array( class_basename($current_function) , $permissions) or $adminrole->permissions == '*')
            {
                return $next($request);
            }
            else {
                return redirect()->route('dashboard')->with('danger',"You cannot access this page");
            }
        }
    }
        }
    }
    }
}
