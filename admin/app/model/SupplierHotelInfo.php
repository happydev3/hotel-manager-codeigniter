<?php
namespace App\model;

use Illuminate\Database\Eloquent\Model;

class SupplierHotelInfo extends Model
{
	public $timestamps = false;
	protected $table = 'supplier_hotel_list';
    protected $primaryKey = 'id';
   	// protected $guarded   = ['id'];

}
