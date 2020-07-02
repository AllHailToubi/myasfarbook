<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsController extends AdminController
{
    public function permission(){    
        $this->checkPermission('manage permissions');  
    }
		
    public function AllPermissions(){
        $this->permission();
        $permissions = Permission::all(); 

         foreach($permissions as $permission){
             $tab_permissions_groups[$permission->group][]=["id"=>$permission->id,
                                                            "name"=>$permission->name,
                                                            "description"=>$permission->description];     
        }

        $data = [
            'tab_permissions_groups'=>$tab_permissions_groups
        ];
        return view('user::permissions.allpermissions',$data);
    }

    public function createPermission(){
        $this->permission();
        return view('user::permissions.new_permission');
    }

    public function createPermissionStore(Request $request){
        $this->permission();
        $request->validate([
            'name' => ['required', 'string', 'max:255','unique:permissions'],
            'group' => ['required', 'string', 'max:255'],
        ]);

        Permission::create([
            'name' => $request['name'],
            'group' => $request['group'],
            'description'=>$request['description']
        ]);

        return redirect()->route('user.AllPermissions');
    }

    public function editPermission($id){
        $this->permission();
        $permission=Permission::find($id);

        $data = [
            'permission'=> $permission
        ];
        return view('user::permissions.edit_permission',$data);
    }

    public function editPermissionupdate(Request $request){
        $this->permission();
        $request->validate([
            'group' => ['required', 'string', 'max:255'],
        ]);

        $permission=Permission::find($request['id']);
        $permission->group = $request['group'];
        $permission->description = $request['description'];
        $permission->save();

        return redirect()->route('user.AllPermissions');
    }

    public function showPermissionsMatrix(){
		$this->permission();
		$permissions = Permission::all();
		$roles = Role::all();

		foreach($permissions as $permission){
			$tab_permissions_groups[$permission->group][]=["id"=>$permission->id,
															"name"=>$permission->name,
															"description"=>$permission->description];
		}

		$data = [
			'roles'=>$roles,
			'tab_permissions_groups'=>$tab_permissions_groups
		];
		
		return view('user::roles.permissions_matrix',$data);
	}

	public function updatePermissionMatrix(Request $request){
		$this->permission();

		$rolepermissions = $request->input('permissions');
		$rolespermissions=[];
		if(!empty($rolepermissions)){
			foreach($rolepermissions as $rolepermission){
				$permissiontab = explode(':', trim($rolepermission));
				$rolespermissions[$permissiontab[0]][]=$permissiontab[1];
				
			}
		}

		$roles = Role::all();
		foreach($roles as $role){
			$role->syncPermissions('');
			if(!empty($rolespermissions[$role->name])){
				$role->syncPermissions($rolespermissions[$role->name]);
			}
		}
		
		return redirect()->route('user.allroles');
	}

    
	
}