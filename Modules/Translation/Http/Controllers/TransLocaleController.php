<?php

namespace Modules\Translation\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Http\Controllers\AdminController;
use Modules\Translation\Entities\Locale;

class TransLocaleController extends AdminController
{
    public function permission(){    
      $this->checkPermission('manage admin languages');
    }

    public function showAll(){ 
        $this->permission();
        $locales=Locale::all();
        return view('translation::locale.all_locales',['locales'=>$locales]);
    }

    public function create(){ 
      $this->permission();
		  return view('translation::locale.new_locale');
    }
    
    public function createSave(Request $request){
      $this->permission();
      $request->validate([
              'code' => ['required', 'string', 'max:3','unique:sqlite.locales'], 
              'name' => ['required', 'string', 'max:100']  
          ]);
          
          $locale = new Locale;
          $locale->code = strtolower($request->code);
          $locale->name = $request->name;
          $locale->save();

      return redirect()->route('translation.locales');
    }

    public function edit($code){
      $this->permission();
      $locale=Locale::where('code',$code)->first();
      return view('translation::locale.edit_locale',['locale'=> $locale]);
      }
      
      public function editSave(Request $request){
          Locale::where('code',$request['codelacale'])
                      ->update(['name' => $request['name']]);
      return redirect()->route('translation.locales');
	}
    

}