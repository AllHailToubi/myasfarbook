<?php


	namespace Modules\User\Http\Controllers\Auth;
	use App\Providers\RouteServiceProvider;
	use Illuminate\Http\Request;


	class LoginController extends \App\Http\Controllers\Auth\LoginController
	{
		public function showLoginForm(){
			
			//dd($_SERVER['HTTP_ACCEPT_LANGUAGE']);
	        return view('user::auth.login');
	    }

	    

	    public function redirectPath()
	    {
	        

	        return RouteServiceProvider::HOME;
		}
		
	

	    
	}