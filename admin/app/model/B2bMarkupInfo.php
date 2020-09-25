<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class B2bMarkupInfo extends Model
{
   protected $table = 'b2b_markup_info';
   protected $primaryKey = 'id';
   protected $guarded   = ['id'];

   public function Agentdetails(){
   	return $this->hasOne('App\model\AgentInfo','agent_no','agent_no');
   }
}
