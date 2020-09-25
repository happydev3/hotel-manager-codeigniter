<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ApiInfo extends Model
{
    /**
     * Added just to demonstrate that models work
     * @return String
     */
   protected $table = 'api_info';
   protected $primaryKey = 'id';
   protected $fillable   = ['status'];
   //protected $guarded   = ['user_id','created_at'];
}
