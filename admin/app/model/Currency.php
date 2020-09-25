<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model {
	public $timestamps = false;
     /**
     * Added just to demonstrate that models work
     * @return String
     */
   protected $table = 'currency';
   protected $primaryKey = 'currency_id';
   protected $guarded = ['currency_id'];
}
