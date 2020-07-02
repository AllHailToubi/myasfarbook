<?php

namespace Modules\Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Hotel\Entities\Amenitie;

class Amenities_local extends Model
{
    protected $fillable = [];
    protected $connection = 'mysql_shared';

    public function amenitie(){ 
        return $this->belongsTo(Amenitie::class); 
    }
}
