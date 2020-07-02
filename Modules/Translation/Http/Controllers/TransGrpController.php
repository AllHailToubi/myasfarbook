<?php

namespace Modules\Translation\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Translation\Entities\Transgrp;
use Modules\User\Http\Controllers\AdminController;

class TransGrpController extends AdminController
{
    public function permission(){    
        $this->checkPermission('manage translation admin');
    }
    
    public function showAll(){ 
        $this->permission();
        $transgps=Transgrp::all()->sortByDesc('id');
        return view('translation::transGrp.all_transgrp',['transgps'=>$transgps]);
    }

    public function create(){ 
        $this->permission();
		return view('translation::transGrp.new_transgrp');
	}

	public function createSave(Request $request){
        $this->permission();
		$request->validate([
			'name' => ['required', 'string', 'max:255'],   
        ]);
        
        $transgrp = new Transgrp;
        $transgrp->name = strtolower($request->name);
        $transgrp->description = $request->description;
        $transgrp->save();

		return redirect()->route('translation.allgroups');
	}

    public function edit($id){
        $this->permission();
		$transgrp=Transgrp::find($id);
		return view('translation::transGrp.edit_transgrp',['transgrp'=> $transgrp]);
    }
    
    public function saveEdit(Request $request){
        $this->permission();
        $transgrp=Transgrp::find($request['id']);
        $transgrp->description = $request['description'];
		$transgrp->save();
		return redirect()->route('translation.allgroups');
	}


    
}
