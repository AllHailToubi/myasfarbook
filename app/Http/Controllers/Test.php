<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Hotel\Entities\Amenitie;
use Modules\Hotel\Entities\Amenities_local;
use Illuminate\Support\Facades\DB;

class Test extends Controller
{
    public function test(){
        // $amenities=Amenitie::getAmenities();

        // foreach ($amenities as $amenitie) {
        //    // $amenitie->locals()->where('code_local', 'en')->first();
        // }
        //$amenities=Amenitie::where("amenitie_id",2)->get()->first()->amenitie;
        //Amenitie::getAll();
        //dd(Amenitie::getAll());

        
        
        $amenities=Amenitie::getAmenities("en","1,5");

        foreach ($amenities as $amenitie) {
            echo logd($amenitie->icon);
        }
        
    }
}
