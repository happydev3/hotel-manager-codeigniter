<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class AgentInfo extends Model
{
    
   protected $table = 'agent_info';
   protected $primaryKey = 'id';
   //protected $fillable   = ['title', 'first_name', 'last_name', 'mobile_no', 'address', 'pin_code'];
   protected $guarded   = ['id'];
}
