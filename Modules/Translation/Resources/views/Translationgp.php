<?php

namespace Modules\Translation\Entities;

use Illuminate\Database\Eloquent\Model;

class Translationgp extends Model
{
    protected $connection;

    public function __construct() {
        $this->connection = env('DB_CONNECTION2');
    }

}
