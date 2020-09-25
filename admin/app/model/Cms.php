<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    
   protected $table = 'cms';
   protected $primaryKey = 'id';
   protected $fillable   = ['content','status'];
   protected $guarded   = ['type'];
}
