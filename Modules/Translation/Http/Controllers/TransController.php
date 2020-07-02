<?php

namespace Modules\Translation\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Translation\Entities\Translation;
use Modules\Translation\Entities\Locale;
use Modules\Translation\Entities\Transkey;
use Illuminate\Support\Facades\Schema;
use Modules\User\Http\Controllers\AdminController;
use Cache;

class TransController extends AdminController
{
    public function permission(){    
        $this->checkPermission('manage translation admin');
    }
    
    
    public function showAllbyGrp($name){ 
        $this->permission();
        $transkeys=Transkey::where('group',$name)->orderBy('id', 'desc')->get();;
        $locales=Locale::all();

        $tabtrans=[];
        foreach($transkeys as $transkey){
            foreach($locales as $locale){
                $trans=Translation::where('id_transkey',$transkey->id)->where('code_locale',$locale->code)->get();
                if(isset($trans[0])){
                    $tabtrans[$transkey->key][$locale->code]=$trans[0]->text;
                }else{
                    $tabtrans[$transkey->key][$locale->code]='';
                }
                
                    

            }
        }

        return view('translation::trans.transbygrp',['tabtrans'=>$tabtrans,'transkeys'=>$transkeys,'locales'=>$locales,'namegrp'=>$name]);
    }

    public function clearCach($grpname){
        $this->permission();
        $locales=Locale::all();
        foreach($locales as $locale){
            Cache::forget("{$locale->code}.{$grpname}");
        }
    }

    public function showAllbyGrpSave(Request $request){ 
        $this->permission();
        $name=$request["name"];
        $transkeys=Transkey::where('group',$name)->get();;
        $locales=Locale::all();
        

        //dd($request["max_string_en"]);

        foreach($transkeys as $transkey){
            foreach($locales as $locale){
                $key=str_replace(".","_","$transkey->key");
                logd($transkey->key.".".$locale->code.":".$request[$key."_".$locale->code]);
                $trans=Translation::where('id_transkey',$transkey->id)->where('code_locale',$locale->code)->first();
                if(isset($trans)){
                    Translation::where('id_transkey',$transkey->id)
                                ->where('code_locale',$locale->code)
                                ->update(['text' => $request[$key."_".$locale->code]]);
                }else{
                    $newtrans = new Translation;
                    $newtrans->id_transkey=$transkey->id;
                    $newtrans->code_locale=$locale->code;
                    $newtrans->text=$request[$transkey->key."_".$locale->code];
                    $newtrans->save();
                }
            }
        }
        $this->clearCach($name);
        return redirect()->route('translation.showAllbyGrp',$name);
    }

    public function createTransKey($grpname){
        $this->permission();
        $locales=Locale::all();
        return view('translation::trans.new_transkey',['namegrp'=>$grpname,'locales'=>$locales]);
    }

    public function createTransKeySave(Request $request,$grpname){
        $this->permission();
        
        $transkeyexist=Transkey::where("key",$request['key'])->where("group",$grpname)->first();
        $request->validate([
            'key' => ['required', 'string', 'max:255'],   
        ]);
        if(isset($transkeyexist)){
            $request->validate([
                'key' => ['unique:sqlite.transkeys,key'],   
            ]);
        }
        
        

        $transkey = new Transkey;
                    $transkey->key=$request['key'];
                    $transkey->group=$grpname;
                    $transkey->save();

        $locales=Locale::all();
        foreach($locales as $locale){
            
            $newtrans = new Translation;
                        $newtrans->id_transkey=$transkey->id;
                        $newtrans->code_locale=$locale->code;
                        $newtrans->text=$request[$locale->code];
                        $newtrans->save();
        }

        
        $this->clearCach($grpname);
        return redirect()->route('translation.showAllbyGrp',$grpname);
    }

    public function deleteTransKey(Request $request,$grpname){
        $this->permission();
        $id=$request["id"];

        Translation::where('id_transkey', $id)->delete();
        Transkey::where('id', $id)->delete();
        $this->clearCach($grpname);
        return redirect()->route('translation.showAllbyGrp',$grpname);
    }

    


    
}
