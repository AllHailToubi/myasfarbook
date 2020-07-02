<?php

namespace Modules\Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Hotel\Entities\Amenities_local;
use Illuminate\Support\Facades\DB;

class Amenitie extends Model
{
    protected $fillable = [];
    protected $connection = 'mysql_shared';

  

    public function locals()
    {
        return $this->hasMany(Amenities_local::class);
    }

    static public function getAmenities($local,$listid=""){
        $Sql="select `id`,`icon`, `title`, `amenities`.`ordre` from `amenities` 
                inner join `amenities_locals` 
                on `amenities`.`id` = `amenities_locals`.`amenitie_id` 
                and `amenities_locals`.`code_local` = '$local'";
        if(!empty($listid)){
            $Sql.=" and `amenities`.`id` in ($listid)";
        }

        $Sql.="ORDER BY `amenities`.`ordre` ASC";//|DESC
        return DB::connection('mysql_shared')->select($Sql);
    }
}
