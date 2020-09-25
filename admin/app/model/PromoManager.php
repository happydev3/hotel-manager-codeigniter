<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class PromoManager extends Model {
	public $timestamps = false;
     /**
     * Added just to demonstrate that models work
     * @return String
     */
   protected $table = 'promotion_manager';
   protected $primaryKey = 'id';
   protected $guarded = ['id'];
}
