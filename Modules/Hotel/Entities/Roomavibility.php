<?php

namespace Modules\Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Roomavibility extends Model
{
    protected $table = 'roomavibility';
    protected $connection = 'mysql_shared';
    protected $fillable = ['room_id','date','price','agency_id','status'];
  
    

    static public function getAvibility($room_id,$date_start,$date_end,$defaut_price){

        $begin = new DateTime( $date_start );
        $end   = new DateTime( $date_end);

        if($end<$begin){
            $tmp=$date_start;
            $date_start=$date_end;
            $date_end=$tmp;
        }
        $query=parent::query();
        $query->where('agency_id',agencyID());
        $query->where('room_id',$room_id);
        $query->whereBetween('date',[$date_start,$date_end]);
        $results=$query->get();

        $arr=null;
        foreach($results as $result){
            //$pricing[$result->date]=$result->price;
            $arr[] = array('id' => $room_id,"date"=>$result->date,"price"=>$result->price);
        }

        // $begin = new DateTime( $date_start );
        // $end   = new DateTime( $date_end);

        // if($end<$begin){
        //     $tmp=$begin;$begin=$end;$end=$tmp;
        // }

        
        // for($i = $begin; $i <= $end; $i->modify('+1 day')){
        //     $dt=$i->format("Y-m-d");

        //     if(isset($pricing[$dt]))
        //         $arr[] = array('id' => $room_id,"date"=>$dt,"price"=>$pricing[$dt]);
        //     else
        //         $arr[] = array('id' => $room_id,"date"=>$dt,"price"=>$defaut_price);
        // }

        //dd(json_encode($arr));
        


        return $arr;

    }


    static public function getAvibilityMonth($room_id,$month,$year){

        $query=Roomavibility::query();
        $query->where('agency_id',agencyID());
        $query->whereIn('room_id',$room_id);
        $query->whereYear('date',$year);
        $query->whereMonth('date', $month);
        $results=$query->get();

        $arr=null;
        foreach($results as $result){
            $arr[] = array('id' => $result->room_id,"date"=>$result->date,"price"=>$result->price,"status"=>$result->status);
        }

        return $arr;

    }

    static public function UpdateAvibility($room_id,$date,$price,$isdispo){
        Roomavibility::updateOrCreate(
            [
                'room_id' => $room_id,
                'agency_id' => agencyID(),
                'date'=>$date,
            ],
            [
                'price' => $price,
                'status'=>$isdispo
            ]
        );
    }

    static public function DeleteAvibility($room_id,$date){
        $query=Roomavibility::query();
        $query->where('agency_id',agencyID());
        $query->where('room_id',$room_id);
        $query->where('date',$date);
        $query->delete();
    }

    static public function setDefaultAvibility($room_id){
        $query=Roomavibility::query();
        $query->where('agency_id',agencyID());
        $query->where('room_id',$room_id);
        $query->delete();
    }

    static public function UpdateAvibilityRange($room_id,$date_start,$date_end,$price,$isdispo,$week=null){
        $begin = new DateTime( $date_start );
        $end   = new DateTime( $date_end);

        if($end<$begin){
            $tmp=$date_start;
            $date_start=$date_end;
            $date_end=$tmp;
        }
        
        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            $dt=$i->format("Y-m-d");
            if(!isset($week)){
                Roomavibility::UpdateAvibility($room_id,$dt,$price,$isdispo);
            }else{
                $w=$i->format("w");
                if (in_array($w, $week)) {
                    Roomavibility::UpdateAvibility($room_id,$dt,$price,$isdispo);
                }

            }
        }

        
    }

    static public function deleteAvibilityRange($room_id,$date_start,$date_end,$week=null){
        $begin = new DateTime( $date_start );
        $end   = new DateTime( $date_end);

        if($end<$begin){
            $tmp=$date_start;
            $date_start=$date_end;
            $date_end=$tmp;
        }

        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            $dt=$i->format("Y-m-d");
            if(!isset($week)){
                Roomavibility::DeleteAvibility($room_id,$dt);
            }else{
                $w=$i->format("w");
                if (in_array($w, $week)) {
                    Roomavibility::DeleteAvibility($room_id,$dt);
                }

            }
        }
        return "";
    }

    

}
