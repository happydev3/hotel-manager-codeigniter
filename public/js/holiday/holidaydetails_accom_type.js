$('.accommodation-select').click(function (e) { 
	$adults=0;
 	$childs=0;
 	$infants=0;
 	$room_count=1;
 	$single=0;
 	$twin=0;
 	$triple=0;
 	$room_no=0;
    var m_names = new Array("Jan", "Feb", "Mar", 
            "Apr", "May", "Jun", "Jul", "Aug", "Sep", 
            "Oct", "Nov", "Dec");
 	var room_arr=[];
    var d=new Date();
    d.setDate(d.getDate() + 2);
 	$accom_type=$(this).val();
    $departureDate=d.getDate()+"-"+m_names[d.getMonth()]+"-"+d.getFullYear();
 	$holiday_id=$('#holiday_id').val();  
 
    if(!$(this).is(':checked')) {
                $('#priceheader').html(' <i class="fa fa-rupee"></i> '+'0');                       
                $('#accom_type').val('');                   
                       
                    
  }
  else{
 	$('.accommodation-select').not(this).prop('checked', false);  
    	$adult=1;$child=0;$infant=0;		
		$adults+=$adult;
		$childs+=$child;
		$infants+=$infant;
		
		 	room_arr.push({
            type: 'single', 
            adults: $adult,
            childs:$child,
            infants: $infant
             });
     		$single+=1;	
		
	

     $.ajax({
                url: siteUrl + 'holiday/pricecal',
                data: 'adults=' + $adults+
                '&childs='+$childs+
                '&infants='+$infants+
                '&room_count='+$room_count+
                '&single='+$single+
                '&twin='+$twin+
                '&triple='+$triple+
                '&accom_type='+$accom_type+
                '&arrivaldate='+$departureDate+
                '&holiday_id='+$holiday_id+
                '&room_arr='+JSON.stringify(room_arr),
                dataType: 'json',
                type: 'POST',
                success: function(data)
                {                   
                    if (data.results == 'success')
                    {   $('#priceheader').html(' <i class="fa fa-rupee"></i> '+data.priceheader);
                    	$('#accom_type').val(data.accom_type);
                      $('#total_cost').val(data.sub_total);
                    }
                  
                }
            });
 }
 
});

function go_to_traveller(){
  var res=true;
    $("input[type='checkbox']").each(function(){
    if(!$(this).is(':checked')) {
            res=false;             
    }
    else{
      res=true; 
      return false;     
    }   
  });
   if(!res){
     new PNotify({
                                  title: '<h4 style="color:red;">Alert &#128566 !!!!</h4>',
                                  text: '<h5 style="color:black;">Select Any one Accommodation option from ( Comfort , Quality or Luxury )</h5>',
                                   type: 'error',                                 
                                  styling: 'bootstrap3'
                              });
    }
  else if(parseInt($('#total_cost').val())<=0)
  {
     new PNotify({
                                  title: '<h4 style="color:red;">Sorry &#x1f629; !!!!<h4>',
                                  text: '<h5 style="color:black;">Package is in updation stage!!!!</h5>'+
                                  '<h5 style="color:black;">Try after some time.</h5>',
                                  type: 'error',                                 
                                  styling: 'bootstrap3'
                              });
     return false;
  }   
  return res;
}