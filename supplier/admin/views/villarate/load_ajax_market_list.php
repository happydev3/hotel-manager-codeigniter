 <?php 
 $market_avail=explode('||',$contract_info[0]->market_avail);
 $exclude_market=explode('||', $contract_info[0]->exclude_market);
$market_list=array();
if(in_array('All Markets', $market_avail))
{
	$market_list[0]="All Markets";
	for($i=0;$i<count($country)&&!empty($country);$i++)
	{
		if(in_array($country[$i]->name, $exclude_market))
		{	continue; }
	    else
	    {
	       $market_list[($i+1)]=$country[$i]->name;
	    }
		
	}
}
else if(!empty($market_avail))
{
	$market_list=$market_avail;
}

 ?> 
  <option value="" selected="selected">Select Market</option>
  <?php foreach($market_list as $val){?>
   <option value="<?php echo $val;?>">
     <?php echo $val;?>
   </option>
   <?php } ?>