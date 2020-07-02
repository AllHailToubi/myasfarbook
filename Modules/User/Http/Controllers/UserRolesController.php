<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRolesController extends AdminController
{
	
	public function permission(){    
        $this->checkPermission('manage roles');  
    }

	
	public function allroles(){
		$this->permission();
		$roles = Role::all();
		$data = [
			'roles'=> $roles
		];
		return view('user::roles.all_roles',$data);
	}

	public function create(){
		$this->permission();
		return view('user::roles.new_role');
	}

	public function createstore(Request $request){
		$this->permission();
		$validatedData = $request->validate([
			'name' => ['required', 'string', 'max:255','unique:roles'],   
		]);

		Role::create([
			'name' => $request['name'],
			'description'=>$request['description']
		]);

		return redirect()->route('user.allroles');
	}

	public function edit($id){
		$this->permission();
		$role=Role::find($id);
 
		$data = [
			'role'=> $role
		];
		return view('user::roles.edit_role',$data);
	}

	public function editupdate(Request $request){
		$this->permission();
		$validatedData = $request->validate([
			'name' => ['required', 'string', 'max:255'], 
		]);

		$role=Role::find($request['id']);
		$role->name = $request['name'];
		$role->description = $request['description'];
		$role->save();

		return redirect()->route('user.allroles');
	}

	public function delete(Request $request){
		$this->permission();
		$role=Role::find($request['id']);
		$role->delete();
		return redirect()->route('user.allroles');
	}

	
	
}