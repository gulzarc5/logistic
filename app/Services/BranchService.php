<?php
namespace App\Services;

use App\User;
use Auth;

class BranchService {

    public static function branchId(){
        $branch_id = Auth::user()->id;

        $user = User::findOrFail($branch_id);
        if ($user->hasRole('Employee')) {
            $branch_id = $user->parent_id;
        }
        return $branch_id;
    }

}
