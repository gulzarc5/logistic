<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use App\Role;

class BranchUser
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
        if (Auth::user()->hasRole('Branch')) {
            return $next($request);
        }else{            
            $branch_id = Auth::user()->parent_id;
        }

        $roles = Role::where('branch_id',$branch_id)->get();
        foreach ($roles as $key => $role) {
            if (Auth::user()->hasRole($role->name)) {                
                return $next($request);
            }
        }

        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('branch.login_form');

    }
}
