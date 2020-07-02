<?php

namespace Modules\Hotel\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
// use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Hotel\Entities\Room;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\Amenitie;
use Modules\Hotel\Entities\Facilities_hotel;

use App\Models\Cities;
use Validator;
use File;
use Carbon\Carbon;

class TestController extends Controller
{

    
    

    public function test(){

        return view('hotel::test.index');
    }

    public function testapi(){
        $hotels=Hotel::paginate(4);
        foreach($hotels as $hotel){
            
            $hotel->setAttribute('countryfull',getCountry($hotel->country,"fr"));
            $hotel->setAttribute('added',$hotel->created_at->diffForHumans());
        }
        return response()->json($hotels);
    }

    public function show($hotel){

    }

    

  

    
    

}
