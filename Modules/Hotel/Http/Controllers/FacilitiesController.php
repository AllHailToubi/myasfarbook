<?php

namespace Modules\Hotel\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Http\Controllers\AdminController;
use Modules\Hotel\Entities\Facilities_hotel;
use Modules\Hotel\Entities\Amenitie;


class FacilitiesController extends AdminController
{

    public function permission(){
        $this->checkPermission('manage hotels');
    }

    public function listHotelFacilities (){
        $this->permission();


        // $hotel=Facilities_hotel::create([
        //     'order_show' => 0,
        //     'icon'=>'soap-icon-handicapaccessiable',
        //     'trans_key' => 'hotel_facilities.facilities for disabled guests',
        // ]);


        $facilities_hotel=Facilities_hotel::orderBy('order_show')->get();

        // foreach($facilities_hotel as $item){
        //     logd($item->id);
        // }
        

        return view('hotel::facilities.hotel_facilities',["facilities_hotel"=>$facilities_hotel]);
    }


    public function listHotelFacilitiesSave(Request $request){
        $sorthotel=$request->sorthotel;
        if(!empty($sorthotel)){
            $sorthotel_tab=explode(',',$sorthotel);
            $order=1;
            foreach($sorthotel_tab as $item){
                $facility=Facilities_hotel::find($item);
                $facility->order_show= $order;
                $facility->save();
                $order++;
            }
        }
       return redirect()->route('facilities.hotel');
    }

    
}
