<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use App\Role;

class AdminUser
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
        if (Auth::user()->hasRole('Admin')) {
            return $next($request);
        }else{            
            $roles = Role::whereNull('branch_id')->get();
            foreach ($roles as $key => $role) {
                if (Auth::user()->hasRole($role->name)) {                
                    return $next($request);
                }
            }
        }
        
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('branch.login_form');
    }
}
