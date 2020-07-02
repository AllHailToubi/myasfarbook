<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Session;

class UserController extends AdminController
{
    public function permission(){    
        $this->checkPermission('manage users');  
    }

    public function allusers() {
        $this->permission();
        $currentuser = Auth::user();
        $users = User::where('id', '!=',$currentuser->id)->where('type', '!=','SuperAdmin')->orderBy('id', 'desc')->get();;
        $data = [
            'users'=> $users
        ];
        return view('user::users.all_users',$data);
    }

    public function newuser(){
        $this->permission();
        $roles = Role::all();
        $data = [
            'roles'=> $roles
        ];
        return view('user::users.new_user',$data);
    }

    public function newuserstore(Request $request){
        $this->permission();
        $validatedData = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            
            'status' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string'],
        ]);

        $new_user=User::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),

            'status' => $request['status'],
            'type' => 'Admin',
        ]);

        $new_user->syncRoles($request['role']);

       return redirect()->route('user.allusers');
    }



    public function editprofile(){
        
        $user = Auth::user();
        return view('user::users.edit_profile',['user'=>$user]);
    }

    public function updateprofile(Request $request){
        
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();
        $user->firstname=$request['firstname'];
        $user->lastname=$request['lastname'];
        $user->city=$request['city'];
        $user->phone=$request['phone'];
        $user->address=$request['address'];
        $user->country=$request['country'];
        $user->gender=$request['gender'];

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name_photo = 'profile_'.$user->id.'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/src/images/profiles');
            $image->move($destinationPath, $name_photo);  
            $user->photo=$name_photo;
        }

        $user->save();

        return redirect()->route('home');
    }

    public function delete(Request $request){
        $this->permission();
        $currentuser = Auth::user();
        if($currentuser->id!=$request['id'] ){
            $user=User::find($request['id']);
            if($user->type!='SuperAdmin'){
                $user->delete();
            }
        }
        
        return redirect()->route('user.allusers');
    }

    public function edit($id){
        $this->permission();
        $user=User::find($id);
        $roles = Role::all();

        $data = [
            'user'=> $user,
            'roles'=> $roles
        ];
        return view('user::users.edit_user',$data);
    }

    public function editsave(Request $request){
        $this->permission();
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string'],
        ]);

        $id=$request['id'];
        $user=User::find($id);
        
        if(!empty($request['password'])){
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user->password= Hash::make($request['password']);
        }   

        $user->firstname= $request['firstname'];
        $user->lastname= $request['lastname'];
        
        $user->status= $request['status'];
        $user->type= 'Admin';
        $user->syncRoles($request['role']);
        $user->save();
       return redirect()->route('user.allusers');
    }

    public function changeMyPassword(){
       
        return view('user::users.change_my_password_user');
    }

    public function changeMyPasswordUpdate(Request $request){
        $request->validate([
            
            'password' => ['required', 'string', 'min:8'],
            'newpassword'=> ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $currentuser = Auth::user();
        if (Hash::check($request['password'], $currentuser->password)) {
            $currentuser->password =Hash::make($request['newpassword']);
            $currentuser->save();
            return redirect()->route('home');
        }

        return redirect()->route('user.changemypassword')->withErrors(['password' => 'Password is not correct']);;
    }

    public function changeLocale($locale){
        $user = Auth::user();
        $user->locale=$locale;
        $user->save();

        app()->setLocale($user->locale);
        Session::put('locale', $user->locale);
        return back();
    }

    

    
    

    
}
