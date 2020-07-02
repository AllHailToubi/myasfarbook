<?php

namespace Modules\Hotel\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Hotel\Entities\Amenitie;
use Modules\Hotel\Entities\Amenities_local;

class FillAmentiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        

        
        $this->fillAmenities();
        


        
        
    }

    public function fillAmenities(){
        $Amenities[] = array( "icon" => "soap-icon-wifi", "title" => "WI_FI" ); 
        $Amenities[] = array( "icon" => "soap-icon-swimming", "title" => "swimming pool" ); 
        $Amenities[] = array( "icon" => "soap-icon-television", "title" => "television" ); 
        $Amenities[] = array( "icon" => "soap-icon-coffee", "title" => "coffee" ); 
        $Amenities[] = array( "icon" => "soap-icon-elevator", "title" => "Elevator in Building" ); 
        $Amenities[] = array( "icon" => "soap-icon-aircon", "title" => "air conditioning" ); 
        $Amenities[] = array( "icon" => "soap-icon-fitnessfacility", "title" => "fitness facility" ); 
        $Amenities[] = array( "icon" => "soap-icon-fridge", "title" => "fridge" ); 
        $Amenities[] = array( "icon" => "soap-icon-winebar", "title" => "wine bar" ); 
        $Amenities[] = array( "icon" => "soap-icon-smoking", "title" => "smoking allowed" ); 
        $Amenities[] = array( "icon" => "soap-icon-entertainment", "title" => "entertainment" ); 
        $Amenities[] = array( "icon" => "soap-icon-securevault", "title" => "secure vault" ); 
        $Amenities[] = array( "icon" => "soap-icon-pickanddrop", "title" => "pick and drop" ); 
        $Amenities[] = array( "icon" => "soap-icon-phone", "title" => "room service" ); 
        $Amenities[] = array( "icon" => "soap-icon-pets", "title" => "pets allowed" ); 
        $Amenities[] = array( "icon" => "soap-icon-playplace", "title" => "play place" ); 
        $Amenities[] = array( "icon" => "soap-icon-breakfast", "title" => "complimentary breakfast" ); 
        $Amenities[] = array( "icon" => "soap-icon-parking", "title" => "Free parking" ); 
        $Amenities[] = array( "icon" => "soap-icon-conference", "title" => "conference room" ); 
        $Amenities[] = array( "icon" => "soap-icon-fireplace", "title" => "fire place" ); 
        $Amenities[] = array( "icon" => "soap-icon-handicapaccessiable", "title" => "Handicap Accessible" );
        $Amenities[] = array( "icon" => "soap-icon-doorman", "title" => "Doorman" );
        $Amenities[] = array( "icon" => "soap-icon-tub", "title" => "Hot Tub" );
        $Amenities[] = array( "icon" => "soap-icon-star", "title" => "Suitable for Events" );

        $i=0;
        foreach ($Amenities as $Amenitie) {
            
            $new_amenitie=Amenitie::create([
                'icon' => $Amenitie["icon"],
                'ordre'=> $i
            ]);

            Amenities_local::create([
                'amenitie_id' => $new_amenitie->id,
                'code_local'=> "en",
                'title'=>$Amenitie["title"]
            ]);
            $i++;
        }
    }


    public function test(){
        // $locals=Amenities_local::all();

        // foreach ($locals as $key => $value) {
        //     echo $locals[$key];
        // }

        $amenities=Amenitie::find(2)->locals();
        dd($amenities);
        foreach ($amenities as $amenitie) {
            logd($amenitie."\n");
        }

        
    }
}
