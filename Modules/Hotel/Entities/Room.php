<?php

namespace Modules\Hotel\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\Roomavibility;
use DateTime;
use Log;

class Room extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql_shared';
    protected $fillable = [
        'name','hotel_id','agency_id',
    ];

    // permet de retourner le prix d'une date spécifié
    public function getPriceDate($date){
        $query = Roomavibility::query();
        $query->where('room_id',$this->id);
        $query->where('date',$date);
        $roomavibility=$query->first();
        return $price=empty($roomavibility)?$this->price:$roomavibility->price;
    }

    /*
     *permet de retourner la sommes des prix entre deux dates "$date_start" et "$date_end"
     *la date "$date_end" n'est pas inclue 
     *la fonction retourne -1 dans le cas d'une date antérieure ou si "$date_start" et "$date_end" sont inversées
     */
    public function getPriceRangeDate($prmObj){
        if($this->status==0) 
            return false;


        if(!$this->checkAllAmenities($prmObj->room_amenities)){
            
            return false;
        }
        

        $prices=null;
        $begin = new DateTime( $prmObj->date_start );
        $end   = new DateTime( $prmObj->date_end);
        $now   = new DateTime(date('Y-m-d'));
        

        if($end<$begin || $begin<$now){
            LogE('Room::getPriceRangeDate error:'.'$date_start'.$prmObj->date_start.' $date_end'.$prmObj->date_end);
            return 0;
        }

        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            $dt=$i->format("Y-m-d");
            $prices[$dt]=$this->price;
        }

        $query = Roomavibility::query();
        $query->where('room_id',$this->id);
        $query->whereBetween('date', [$prmObj->date_start,$prmObj->date_end]);
        $roomavibilities=$query->get();

        foreach($roomavibilities as $roomavibility){
            if($roomavibility->status==0){
                return 0;
            }
            $prices[$roomavibility->date]=$roomavibility->price;
        }

        $sum=0;
        foreach($prices as $price){
            $sum+=$price;
        }
       
        return $sum;
    }

    public function checkAllAmenities($elms){
        $amenities=explode(",", $this->amenities);
        if(empty($amenities))
            return false;

        if(empty($elms))
            return true;

        foreach($elms as $elem){
            if(!in_array($elem,$amenities)){
                return false;
            }
        }

        return true;
    }



   


    public function hotel(){ 
        return $this->belongsTo(Hotel::class); 
    }

    static public function all($hotel_id=null,$cols=['*'],$sort="desc"){
        if(!isset($hotel_id)) abort(404);
        $query=Room::query();

        $query->where('agency_id',agencyID());
        $query->where('hotel_id',$hotel_id);
        
        $query->orderBy('id', $sort);
        $query->select($cols);
        
                    
        return $query->get();
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
}
