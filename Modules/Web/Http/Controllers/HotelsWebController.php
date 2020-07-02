<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\Facilities_hotel;
use Illuminate\Support\Facades\DB;
use App\Models\Cities;

class HotelsWebController extends Controller
{
    /**
     * la page list d'hôtels
     * @return Response
     */
    public function listhotels(){
        $hotels=$this->getListHotel();
        //$cities=Cities::orderBy('name')->get();
        $hotelCities=Hotel::getHotelCities();
        $facilities_hotel=Facilities_hotel::orderBy('order_show')->get();
        return view('web::hotels.list_hotels',['hotels'=> $hotels,'hotelCities'=>$hotelCities,'facilities_hotel'=>$facilities_hotel]);
    }
    
    /**
     * Permet de rechercher les hotels et de les trier 
     *
     * @param  mixed $request
     * @return void
     */
    public function getListHotel(Request $request=null){
        $type="name";
        $city="";
        $date_to=$date_from=date('Y-m-d');
        $facilities_hotel=[];
        if($request!=null){
            $type=$request->sort_type;
            $city=$request->city;
            $date_from=$request->date_from; 
            $date_to=$request->date_to; 
            $facilities_hotel=$request->facilities_hotel;
        }

        $data=[
            "city"=>$city,
            "country"=>"MA",
            "date_start"=>$date_from,
            "date_end"=>$date_to,
            "hotel_facilities"=>$facilities_hotel,
            "room_amenities"=>[]
        ];
        return Hotel::sortPriceCityDate($data)->sortBy->$type;
    }

    public function slideshow($id){
        $query = Hotel::query();
        $query->where('agency_id',agencyID());
        $query->where('id',$id);
        $hotel=$query->first();
        return view('web::commun.slideshow-popup',['hotel'=> $hotel]);
    }

    public function listHotelsType(Request $request,$type){
        $hotels=$this->getListHotel($request);
        return view('web::hotels.'.$type,['hotels'=> $hotels]);
    }

    public function showHoteldetail(Request $request){
        $query = Hotel::query();
        $query->where('agency_id',agencyID());
        $query->where('id',$request->idh);
        $hotel=$query->first();
        if(empty($hotel)){
            abort(404);
        }

        $facilities=$hotel->getFacilities();
        return view('web::hotels.hotel_detailed',['hotel'=> $hotel,"facilities"=>$facilities]);
    }
    


}
