<?php

namespace Modules\Hotel\Entities;

use Illuminate\Database\Eloquent\Model;

class Facilities_hotel extends Model
{
    protected $table = 'facilities_hotel';
    protected $fillable = ["order_show","icon","trans_key"];
    protected $connection = 'mysql_shared';

    
}
