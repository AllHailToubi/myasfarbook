<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
        $this->middleware('status');

        
    }

    public function checkPermission($permission = false)
    {
        if (Auth::check()) {
            if($permission) {
                if(Auth::user()->type!='SuperAdmin'){
                    if (!Auth::user()->hasPermissionTo($permission)) {
                        abort(403);
                    }
                }
            }
        }else{
            abort(403);
        }
    }

    public function hasPermission($permission)
    {
        return Auth::user()->hasPermissionTo($permission);
    }

}