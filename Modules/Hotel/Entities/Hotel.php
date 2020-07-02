<?php

namespace Modules\Hotel\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Modules\Hotel\Entities\Room;
use Modules\Hotel\Entities\Facilities_hotel;
use DateTime;

class Hotel extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql_shared';
    public $minprice;
    public $nbr_nights;

    protected $fillable = [
        'name','agency_id'
    ];



    
    /**
     * getMinPricesRangeDates
     *
     * @param  mixed $date_start
     * @param  mixed $date_end
     * @return void
     */
    public function getBestAvibility($prmObj){
        $rooms=$this->rooms;
        $min_price=null;
        foreach($rooms as $room){
            $price=$room->getPriceRangeDate($prmObj);
            if(!empty($price)){
                if(empty($min_price)){
                    $min_price=$price;
                }else{
                    if($price<$min_price){
                        $min_price=$price;
                    }
                }
            }
        }
       return $min_price;
    }

    
    
    /**
     * Retourne la liste des hôtels avec le clacul du prix minimal
     *
     * @param  mixed $city
     * @param  mixed $country
     * @param  mixed $date_start
     * @param  mixed $date_end
     * @param  mixed $sortby
     * @return void
     */
    static public function sortPriceCityDate($params){
        $prmObj = (object) $params;
        $days=0;
        $begin = new DateTime( $prmObj->date_start);
        $end   = new DateTime( $prmObj->date_end);
       
        $query=parent::query();
        $query->where('agency_id',agencyID());
        $query->where('status',1);
        if(!empty($prmObj->city)) $query->where('city', $prmObj->city);
        $query->where('country', $prmObj->country);
        $hotels= $query->get();

        for($i = $begin; $i <= $end; $i->modify('+1 day'),$days++);
         
        
        foreach($hotels as $key=>$hotel){
            if($hotel->checkAllFacilities($prmObj->hotel_facilities)){
                //logd($hotel->id."  ".$hotel->checkAllFacilities($prmObj->hotel_facilities));
                $hotel->minprice=$hotel->getBestAvibility($prmObj); 
                $hotel->nbr_nights=$days;
                if($hotel->minprice==0)
                $hotels->forget($key);
            }else{
                $hotels->forget($key);
            }   

        }
        
        return $hotels; 
    }

    public function checkAllFacilities($elms){
        $facilities=explode(",", $this->facilities);
        
        if(empty($facilities))
            return false;

        if(empty($elms))
            return true;

            
        foreach($elms as $elem){
            if(!in_array($elem,$facilities)){
                
                return false;
            }
        }

        return true;
    }

    /**
     * Les Chambres appartenant à un hôtel
     */
    public function rooms(){
        return $this->hasMany(Room::class);
    }
    
    /**
     * Retourne la list des villes utilisées dans la table Hotels
     */
    static public function getHotelCities(){
        $query=Hotel::query();
        $query->where('agency_id',agencyID());
        $query->where('status',1);
        $query->select(['city']);
        $query->groupBy('city');
        $query->orderBy('city');
        $hotels=$query->get();
        return $hotels;
    }

    public function getFacilities(){
        $AllFacilities=null;
        $facilities=explode(",", $this->facilities);
        $facilities_hotel=Facilities_hotel::orderBy('order_show')->get();
        foreach ($facilities_hotel as $facility) {
            if(in_array($facility->id,$facilities)){
                $AllFacilities[] = array("id" => $facility->id, "icon" => $facility->icon, "title" => __($facility->trans_key));
            }  
        }

        return (array)$AllFacilities;
    }

    static public function deleteID($id){
        return parent::where('agency_id',agencyID())
                    ->where('id',$id)
                    ->delete();
    }

    

    static public function restoreID($id){
        return parent::where('agency_id',agencyID())
                    ->where('id', $id)
                    ->withTrashed()
                    ->restore();
    }

    static public function forcedeleteID($id){
        $row=parent::where('agency_id',agencyID())
                    ->where('id', $id)
                    ->withTrashed()->first();
        if(!isset($row)){
            abort(404);
        }
        $row->forceDelete();    
        return $row;            
                    
    }

   

    static public function AllDesc(){
        return parent::where('agency_id',agencyID())
                    ->orderBy('id', 'desc')
                    ->get();
    }

    static public function AllAsc(){
        return parent::where('agency_id',agencyID())
                    ->orderBy('id', 'asc')
                    ->get();
    }

    static public function find($id){
        $row=parent::where('agency_id',agencyID())
                    ->where('id',$id)
                    ->first();

        if(!isset($row)){
            abort(404);
        }
        return $row;
    }
    //$hotels=Hotel::onlyTrashed()->get();

    static public function all($sort="desc"){
        return parent::where('agency_id',agencyID())
                    ->orderBy('id', $sort)
                    ->get();
    }

    static public function myTrashed($sort="desc"){
        return parent::where('agency_id',agencyID())
                    ->onlyTrashed()
                    ->orderBy('id', $sort)
                    ->get();
    }

    static public function FindTrashed($sort="desc"){
        return parent::where('agency_id',agencyID())
                    ->onlyTrashed()
                    ->first();
    }



}
