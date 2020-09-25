$(document).ready(function() { 
 $("#edit_hotel_room_rate").click(function(){
      $id=$("#hotels").val();
    if($id=="")
    {
      alert("Kindly Select Hotel");
    }
    else{
    window.location=site_url+'roomrates/view_cal_edit/'+$id;
      }
  })
  $("#view_hotel_room_rate").click(function(){
      $id=$("#hotels").val();
    if($id=="")
    {
      alert("Kindly Select Hotel");
    }
    else{
    window.location=site_url+'roomrates/room_rate_list/'+$id;
      }
  })
	$("#select_hotel").click(function(){
		$id=$("#hotels").val();
		if($id=="")
		{
			alert("Kindly Select Hotel");
		}
		else{
		window.location=site_url+'roomrates/add_room_rates/'+$id;
	    }
	})

	$("#rate_date_range").click(function(){  
	var days = { 'Mon':1,'Tue':2,'Wed':3,'Thu':4,'Fri':5,'Sat':6,'Sun':0};
    var days_ar = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
        var sd = $("#from_date").val();
        var ed = $("#to_date").val(); 
        var roomid = $("#room_id").val(); 
      if(sd == ''){
            alert("Please select from date");
            return false;
        }
        if(ed == ''){
            alert("Please select end date");
            return false;
        } 
        if(roomid == ''){
            alert("Please select Room");
            return false;
        } 
        var selectedDays = new Array();
        var j=0;     
       $("input[name='days[]']:checked").each(function() {     
          selectedDays.push(days[$(this).val()]);
        });       
        var sd1 = new Array();
        var ed1 = new Array();
        if(sd1 == '')
        {
            sd1 = sd;
        }
        if(ed1 == '')
        {
            ed1 = ed;
        }
    var sda1 = sd1.split('-');
    var eda1 = ed1.split('-');
    sd1 = sda1[2] + '-' + sda1[1] +  '-' + sda1[0];
    ed1 = eda1[2] + '-' + eda1[1] +  '-' + eda1[0];
    var startdate = new Date(sd1);
    var enddate = new Date(ed1); 
        if(selectedDays == ''){ selectedDays = [0,1,2,3,4,5,6]; }         

    var rates = []
    $.ajax({
      type: "POST",
      url: site_url + 'roomrates/available_rates/',
      data : { room_id : roomid , sd:sd1 ,ed:ed1},
      dataType : 'json',
    }).done(function(json) {
        if(!json.success) {
          $.error(json.error);
        }
        if(json.result) {
          rates = json.result;
          $("#filtering").show(); 
          var rowCount = $('#ratebydates tr').length;
          if(rowCount>1)
          {
            $("#ratebydates").find("tr:not(:last)").remove();
          }  
          else{      
           $("#ratebydates").find("tr:gt(0):not(:last)").remove();
         }
          $.each(getDateRange(startdate,enddate,selectedDays),function(k,dt) {
            roomrate = getRates(dt,json.result);
            var datestr=String(dt.getDate());
            var monthstr=String(dt.getMonth()+1);
            if(datestr.length==1){
              var appendzero='0';
              datestr=appendzero.concat(datestr);
            }
            else
            {
               datestr=dt.getDate();
            }
            if(monthstr.length==1){
              var appendzero='0';
              monthstr=appendzero.concat(monthstr);
            }
            else
            {
               monthstr=(dt.getMonth()+1);
            }
            var formatdate = datestr + '-' + monthstr + '-' + dt.getFullYear() + ' ' + days_ar[dt.getDay()];
            var fdate = dt.getFullYear() + '-' +(dt.getMonth()+1) + '-' + dt.getDate();
            $("#ratebydates tr:last").before('<tr style="border-top:solid 1px #deab6f; border-bottom:solid 1px #deab6f; padding-bottom:2px;"><td class="tdnew" style="width:10%" id="tdtd">'+formatdate+'<input type="hidden" name="dates[]" value="'+fdate+'"><input type="hidden" name="weekday[]" value="'+days_ar[dt.getDay()]+'"></td><td class="tdnew" style="width:10%" id="tdtd3"><input name="avilable_rooms[]" type="text" class="form-control input-field"  style="height:20px;  background:#F2F2F2;" value="'+roomrate.room_available+'" /></td><td class="tdnew"style="width:10%" id="tdtd3"><input name="cost_price[]" type="text" class="form-control input-field"  style="height:20px;  background:#F2F2F2;" value="'+roomrate.room_price+'"/></td><td class="tdnew"style="width:10%" id="tdtd3"><input name="extra_bed_adult[]" type="text" class="form-control input-field"  style="height:20px;  background:#F2F2F2;" value="'+roomrate.room_price+'"/></td><td class="tdnew"style="width:10%" id="tdtd3"><input name="extra_bed_child[]" type="text" class="form-control input-field"  style="height:20px;  background:#F2F2F2;" value="'+roomrate.room_price+'"/></td><td class="tdnew"style="width:10%" id="tdtd3"></tr>');         
          });;
        }
      });


	});
});

 function check_new(){
        var Num=/^(0|[1-9][0-9]*)$/;       
        var deciNum= /^[0-9]+(\.\d{1,3})?$/;
        $avilable_rooms = $('#avilable_rooms').val();
        $cost_price = $('#cost_price').val();
        $extra_bed_adult = $('#extra_bed_adult').val();
        $extra_bed_child = $('#extra_bed_child').val();
          if($avilable_rooms==''){
          alert("Enter Avilable Room");
           $('#avilable_rooms').focus();
          return false;
         }
         else if(!Num.test($avilable_rooms)){
          alert("Enter Numberic Value For Avilable Room");
           $('#avilable_rooms').val('');
           $('#avilable_rooms').focus();
           return false;
         }
           if($cost_price==''){
          alert("Enter Cost Price");
           $('#cost_price').val('');
           $('#cost_price').focus();
           return false;
         }
         else if(!deciNum.test($cost_price)){
          alert("Enter Either Numberic  or Decimal Value For Cost Price");
           $('#cost_price').val('');
            $('#cost_price').focus();
           return false;
         }
          if(!deciNum.test($extra_bed_adult)&&$extra_bed_adult!=''){
          alert("Enter  Either Numberic  or Decimal Value For Extra Bed Price(Per Adult)");
           $('#extra_bed_adult').val('');
            $('#extra_bed_adult').focus();
           return false;
         }
         
         if(!deciNum.test($extra_bed_child)&&$extra_bed_child!=''){
          alert("Enter  Either Numberic  or Decimal Value For Extra Bed Price(Per Child)");
          $('#extra_bed_child').val('');
           $('#extra_bed_child').focus();
           return false;
         }

        if($avilable_rooms!=''){
            $('input[name="avilable_rooms[]"]').each(function(){
                $('input[name="avilable_rooms[]"]').val($avilable_rooms);
            });
        }
        if($cost_price!=''){
            $('input[name="cost_price[]"]').each(function(){
                $('input[name="cost_price[]"]').val($cost_price);
            });
        }
         if($extra_bed_adult!=''){
            $('input[name="extra_bed_adult[]"]').each(function(){
                $('input[name="extra_bed_adult[]"]').val($extra_bed_adult);
            });
        }
          if($extra_bed_child!=''){
            $('input[name="extra_bed_child[]"]').each(function(){
                $('input[name="extra_bed_child[]"]').val($extra_bed_child);
            });
        }
    }
  function getDateRange( d1, d2 ,days){    
    var oneDay = 24*3600*1000;
    for (var d=[],ms=d1*1,last=d2*1;ms<=last;ms+=oneDay){
    var curday = new Date(ms);
     if(jQuery.inArray(curday.getDay(), days)!==-1) {
        d.push( curday );
    }
    }
    return d;
  } 
  function getRates(curdate,rates) {
    var rates = [];
    $.each(rates, function() {
      if(this.date == null) {
        return true;
      }
      var rdate =  new Date(this.date);
      rdate.setHours(0,0,0,0);
      curdate.setHours(0,0,0,0);
      if(rdate.getTime() == curdate.getTime()){
        rates.push(this);
      }
    });
    if(!rates.length) {
      return {date:'',room_available:'',room_price:''};   
    } else {
      return rates[0];    
    }
  }
$('#modaleditrate').modal({backdrop: 'static', keyboard: false});
$('#modaleditrate').modal('hide');   

  function cancel_editrate(){  
    $("#ratecontent").html(''); 
    $('#modaleditrate').modal('hide');  
  }

function editrate(t){
    $val=t.getAttribute('data-val');
    $rateid=t.getAttribute('rateid');
    $room_code=t.getAttribute('room_code');
    $hotel_code=t.getAttribute('hotel_code');  
    $room_id=t.getAttribute('room_id');
    $hotel_id=t.getAttribute('hotel_id');
    $contract_id=t.getAttribute('contract_id');
   
    $("#ratecontent").html('');
  $.ajax({
    url: site_url+$val,
    data: {rateid:$rateid,room_code:$room_code,hotel_code:$hotel_code,room_id:$room_id,contract_id:$contract_id,hotel_id:$hotel_id},
    dataType: 'json',
    type: 'POST',
    success: function(data) {      
      if(data.edit_room_rates != null) {       
      $("#ratecontent").html(data.edit_room_rates);
      } 
     else{
         $("#ratecontent").html("Sorry No record found");
      }
    
      $('#modaleditrate').modal('show');    
    }
  });  

  }


  function update_editrate(t)
  {
    var Num=/^(0|[1-9][0-9]*)$/;   
    var deciNum= /^[0-9]+(\.\d{1,3})?$/;
    var form =$(t.form);
    $val=t.form.getAttribute('data-action');
    $rate_type=$("#rate_type").val();
    var uniqueval=false;
    var uniquesuppval=false;
     $(".deciNum").each(function()
    { 
        if($(this).val()=='')
        {
           alert("Enter The Value for "+$(this).attr('placeholder'));
           $(this).focus();
           return false;
         }
         else if(!deciNum.test($(this).val()))
         {
            alert("Enter Either Numberic  or Decimal Value for "+$(this).attr('placeholder'));
            $(this).val('');
            $(this).focus();
            return false;
         }
      }); 
      $(".Num").each(function()
      {     
          if($(this).val()=='')
          {
            alert("Enter The Value for "+$(this).attr('placeholder'));
            $(this).focus();
            return false;
           }
           else if(!Num.test($(this).val()))
           {
              alert("Enter Numberic  Value for "+$(this).attr('placeholder'));
              $(this).val('');
              $(this).focus();
              return false;
           }
      });
      $(".checkzero").each(function()
      {     
          if(parseFloat($(this).val())==0)
          {
             alert("Value Should be Greater than Zero for "+$(this).attr('placeholder'));
             $(this).val('');
             $(this).focus();
             return false;
           }        
      });
     
    

     form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } 
      else
      {   
        $.ajax({
          type: "POST",
          url: site_url + $val,
          data : form.serialize(),
          dataType : 'json',    
          success: function(data)
          {          
              if(data.success != '')
              {  
              $("#ratecontent").html("Successfully Updated");
              setTimeout( function()  {
               $('#modaleditrate').modal('show'); }, 1000);      
               window.location.reload();
               } 
               else
               {
                 $("#ratecontent").html("Try after sometimes...");
                  setTimeout( function()  {
                 $('#modaleditrate').modal('show'); }, 1000);      
                 window.location.reload();
               }      
          }
         });
    }
 }



//Excursion

$('#modalcustom').modal({backdrop: 'static', keyboard: false});
$('#modalcustom').modal('hide');

 function modalcustom(t)
 {
    $("#customcontent").html('');
    $("#myModalLabel").html('');
    $("#validation_error").html('');
    $val=t.getAttribute('data-val');
     $.ajax({
      type: "POST",
      url: site_url + $val,
      data :'',
      dataType : 'json', 
     success: function(data) {   

    if(data.result != null) {       
      $("#customcontent").html(data.result);
      $("#myModalLabel").html(data.header);
      } 
     else{
         $("#customcontent").html("Sorry No record found");
      }
    
      $('#modalcustom').modal('show');    

     }


    });

 }

 function cancel_modalcustom(){  
    $("#customcontent").html('');
    $("#myModalLabel").html('');
    $("#validation_error").html('');
    $('#modalcustom').modal('hide');  
  }

  function update_modalcustom(t)
  {
     $("#validation_error").html("");
     var form =$(t.form);
     $val=t.form.getAttribute('data-action');
     form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } 
      else
      {  
   $.ajax({
      type: "POST",
      url: site_url + $val,
      data :form.serialize(),
      dataType : 'json', 
     success: function(data) { 
       if(data.result !='') {       
      $("#customcontent").html(data.result);
      $("#myModalLabel").html(data.header);
        $('#modalcustom').modal('show');
      setTimeout( function()  {
       $('#modalcustom').modal('hide'); }, 1000);  
       window.location.reload();
      } 
     else{
         $("#validation_error").html(data.validation_error);
          $('#modalcustom').modal('show');    
      }
    
     

     }

    });
  
   }
  }

function editmodalcustom(t)
 {
    $val=t.getAttribute('data-val');
    $id=t.getAttribute('data-id');
    $("#customcontent").html('');
    $("#myModalLabel").html('');
    $("#validation_error").html('');
     $.ajax({
      type: "POST",
      url: site_url + $val,
      data :{ id : $id},
      dataType : 'json', 
     success: function(data) {   

    if(data.result != '') {   
      $("#customcontent").html(data.result);
      $("#myModalLabel").html(data.header);
      } 
     else{
         $("#myModalLabel").html(data.header);
          $("#validation_error").html(data.validation_error);
      }
    
      $('#modalcustom').modal('show');    

     }


    });

 }

 function set_category_status(t)
 {
    $val=t.getAttribute('data-val');
    $id=t.getAttribute('data-id');
    $status=t.getAttribute('data-status');
    $index=t.getAttribute('data-index');
    $title=t.getAttribute('title');
    $category=t.getAttribute('data-name');
    $action='';  
    if($status=='1')
    { 
       $action='<a class="btn btn-warning btn-xs" data-name="'+$category+'" data-id="'+$id+'"  data-status="0" data-val="excursions/set_category_status"  onclick="return set_category_status(this)" data-index="'+$index+'" title="Do you really want to Inactive this Category ('+$category+'). ?"><i class="fa fa-times"></i> InActive</a>'
    }
    else{
       $action='<a class="btn btn-success btn-xs" data-name="'+$category+'" data-id="'+$id+'"  data-status="1" data-val="excursions/set_category_status"  onclick="return set_category_status(this)" data-index="'+$index+'" title="Do you really want to Active this Category ('+$category+'). ?"><i class="fa fa-check"></i> Active</a>'
    }
    
    if(confirm($title)){
      $.ajax({
              type: "POST",
              url: site_url + $val,
              data :{ id : $id, status: $status},
              dataType : 'json', 
               success: function(data) { 
                    if(data.result != '') {   
                      $("#status"+$index).html(data.result);
                      $("#action"+$index).html($action);
                      alert($category+" is "+data.status+" now");
                      } 
                     else{
                         alert("Try After Sometimes.....");
                      }  
               }
            });
    }
    else
    {
      return false;
    }
 }

 function add_rate_type(t)
 {
  $val=t.getAttribute('data-val'); 
  $room_id=t.getAttribute('data-room-id');
  $hotel_id=t.getAttribute('data-hotel-id');
  $rate_type=t.getAttribute('value');
  $.ajax({
          type: "POST",
          url: site_url + $val,
          data :{ rate_type : $rate_type,hotel_id:$hotel_id,room_id:$room_id},
          dataType : 'json', 
           success: function(data) { 
            if(data.result1==''){
           $("#add_rate_type").html(data.result); 
           }
           else
           {
            alert(data.result1);
           }            
           }
        });
 }

 function add_rates(t)
 {
    var Num=/^(0|[1-9][0-9]*)$/;   
    var deciNum= /^[0-9]+(\.\d{1,3})?$/;
    var uniqueval=false;
    var uniquesuppval=false;
    var form =$(t.form);
    $val=t.form.getAttribute('data-action');
    $rate_type=$(".rate_type:checked").val();
    $(".deciNum").each(function()
    { 
        if($(this).val()=='')
        {
           alert("Enter The Value for "+$(this).attr('placeholder'));
           $(this).focus();
           return false;
         }
         else if(!deciNum.test($(this).val()))
         {
            alert("Enter Either Numberic  or Decimal Value for "+$(this).attr('placeholder'));
            $(this).val('');
            $(this).focus();
            return false;
         }
      }); 
      $(".Num").each(function()
      {     
          if($(this).val()=='')
          {
            alert("Enter The Value for "+$(this).attr('placeholder'));
            $(this).focus();
            return false;
           }
           else if(!Num.test($(this).val()))
           {
              alert("Enter Numberic  Value for "+$(this).attr('placeholder'));
              $(this).val('');
              $(this).focus();
              return false;
           }
      });
      $(".checkzero").each(function()
      {     
          if(parseFloat($(this).val())==0)
          {
             alert("Value Should be Greater than Zero for "+$(this).attr('placeholder'));
             $(this).val('');
             $(this).focus();
             return false;
           }        
      });
     
      if($rate_type=='PRPN')
      {
          if($("#min_adults_without_extra_bed").val()=='')
          {
            alert("Select Min adults without extra bed");
             $("#min_adults_without_extra_bed").focus();
             return false;
          } 
          if($("#max_adults_without_extra_bed").val()=='')
          {
             alert("Select Max adults without extra bed");
             $("#max_adults_without_extra_bed").focus();
             return false;
          } 
           if($("#min_child_without_extra_bed").val()=='')
          {
            alert("Select Min child without extra bed");
             $("#min_child_without_extra_bed").focus();
             return false;
          } 
          if($("#max_child_without_extra_bed").val()=='')
          {
             alert("Select Max child without extra bed");
             $("#max_child_without_extra_bed").focus();
             return false;
          } 

          if(parseInt($("#min_adults_without_extra_bed").val())>parseInt($("#max_adults_without_extra_bed").val()))
          {
            alert("Min adults without extra bed should be less than Max adults without extra bed");
             $("#min_adults_without_extra_bed").focus();
             return false;
          } 

          if(parseInt($("#min_child_without_extra_bed").val())>parseInt($("#max_child_without_extra_bed").val()))
          {
            alert("Min child without extra bed should be less than Max child without extra bed");
             $("#min_child_without_extra_bed").focus();
             return false;
          }
      }

      if($("#min_room_occupancy").val()=='')
      {
        alert("Select Min room occupancy for this rate");
         $("#min_room_occupancy").focus();
         return false;
      } 
      if($("#max_room_occupancy").val()=='')
      {
         alert("Select Max room occupancy for this rate");
         $("#max_room_occupancy").focus();
         return false;
      } 
      if(parseInt($("#min_room_occupancy").val())>parseInt($("#max_room_occupancy").val()))
      {
        alert("Min room occupancy for this rate should be less than Max room occupancy for this rate");
         $("#min_room_occupancy").focus();
         return false;
      } 
    
          if($("#extra_bed_for_adults").val()=='')
          {
            alert("Select Extra bed for Adults");
             $("#extra_bed_for_adults").focus();
             return false;
          } 
          if($("#extra_bed_for_child").val()=='')
          {
             alert("Select Extra bed for Child");
             $("#extra_bed_for_child").focus();
             return false;
          }    

        /*  if(parseInt($("#extra_bed_for_adults").val())>0)
          {
            if(parseFloat($("#extra_bed_for_adults_rate").val())==0)
            {
              alert("Adults rate for Extra bed should be greater than 0");
              $("#extra_bed_for_adults_rate").val('');
              $("#extra_bed_for_adults_rate").focus();
              return false;
            }
          } 

         if(parseInt($("#extra_bed_for_child").val())>0)
         {
            if(parseFloat($("#extra_bed_for_child_rate").val())==0)
            {
              alert("Child rate for Extra bed should be greater than 0");
              $("#extra_bed_for_child_rate").val('');
              $("#extra_bed_for_child_rate").focus();
              return false;
            }
         }  */

          if(parseInt($("#extra_bed_for_adults").val())==0)
          {
            $("#extra_bed_for_adults_rate").val('0');           
          } 
          if(parseInt($("#extra_bed_for_child").val())==0)
          {
            $("#extra_bed_for_child_rate").val('0');           
          } 

         if(!deciNum.test($("#extra_bed_for_adults_rate").val()))
         {
            alert("Enter Either Numberic  or Decimal Value for "+$("#extra_bed_for_adults_rate").attr('placeholder'));
            $("#extra_bed_for_adults_rate").val('');
            $("#extra_bed_for_adults_rate").focus();
            return false;
         } 
         if(!deciNum.test($("#extra_bed_for_child_rate").val()))
         {
            alert("Enter Either Numberic  or Decimal Value for "+$("#extra_bed_for_child_rate").attr('placeholder'));
            $("#extra_bed_for_child_rate").val('');
            $("#extra_bed_for_child_rate").focus();
            return false;
         }

 /* if($("#supplement_check:checked").length!=0)
   { 
      $('.type_of_supplement').each(function()
      {
          var $this = $(this);
          if ($this.val()==='')
          {
           return;
          }
          $('.type_of_supplement').not($this).each(function()
          {
              if ($(this).val()==$this.val())
              {
                uniquesuppval=true;
              }
          });
      });
      if(uniquesuppval) 
      {
       alert('Type Of Supplement must be Unique!!!!');
       return false;
      }
      var i=1;
      $('.type_of_supplement').each(function()
      {
          $supplement_rate=$(this).closest('.supplement_row').find(".supplement_rate");
          $supplement_compulsory_val=$(this).closest('.supplement_row').find(".supplement_compulsory_"+i+":checked").val(); ;         
         i++;
          if($(this).val()=="")
          {
              alert("Select Type Of Supplement");
               $(this).focus();
               return false;
          }
          if(!deciNum.test($supplement_rate.val()))
           {
                  alert("Enter Either Numberic  or Decimal Value for "+$supplement_rate.attr('placeholder'));
                  $supplement_rate.val('');
                  $supplement_rate.focus();
                  return false;
           } 

           if($supplement_compulsory_val=="No") 
           {
             if($supplement_rate.val()==0)
             {
                    alert("Value Cann't be Zero for "+$supplement_rate.attr('placeholder'));
                    $supplement_rate.val('');
                    $supplement_rate.focus();
                    return false;
             } 
           }        
       
      });
    } */

   if($("#non_refundable:checked").length==0)
   { 
      $('.days_before').each(function()
      {
          var $this = $(this);
          if ($this.val()==='')
          {
           return;
          }
          $('.days_before').not($this).each(function()
          {
              if ($(this).val()==$this.val())
              {
                uniqueval=true;
              }
          });
      });
      if(uniqueval) 
      {
       alert('No of Days must be Unique!!!!');
       return false;
      }

      $('.cancel_rates_type').each(function()
      {
          $cancel_rates=$(this).closest('.policy_row').find(".cancel_rates");
          $days_before=$(this).closest('.policy_row').find(".days_before");
          if($(this).val()=="")
          {
              alert("Select Cancellation Rate Type");
               $(this).focus();
               return false;
          }
           if($(this).val()=="percentage")
           { 
                
                $cancel_rates.prop('type','text'); 
                if(parseFloat($cancel_rates.val())>100)
                {
                    alert("Percentage Cann't be Greater Than 100 !!!!")
                    $cancel_rates.val('');              
                    $cancel_rates.focus();
                }
               if(!Num.test($days_before.val()))
               {
                      alert("Enter Numberic  Value for "+$days_before.attr('placeholder'));
                      $days_before.val('');
                      $days_before.focus();
                      return false;
               }
               if(!deciNum.test($cancel_rates.val()))
               {
                      alert("Enter Either Numberic  or Decimal Value for "+$cancel_rates.attr('placeholder'));
                      $cancel_rates.val('');
                      $cancel_rates.focus();
                      return false;
               }
            
          }
          else  if($(this).val()=="fixed")
          {
             
              $cancel_rates.prop('type','text');  
               if(!Num.test($days_before.val()))
               {
                      alert("Enter Numberic  Value for "+$days_before.attr('placeholder'));
                      $days_before.val('');
                      $days_before.focus();
                      return false;
                }
               if(!deciNum.test($cancel_rates.val()))
               {
                      alert("Enter Either Numberic  or Decimal Value for "+$cancel_rates.attr('placeholder'));
                      $cancel_rates.val('');
                      $cancel_rates.focus();
                      return false;
               }   
          }
          else  if($(this).val()=="fullstay")
          {
             $cancel_rates.val('0');
             $cancel_rates.prop('type','hidden');  
             if(!Num.test($days_before.val()))
             {
                    alert("Enter Numberic  Value for "+$days_before.attr('placeholder'));
                    $days_before.val('');
                    $days_before.focus();
                    return false;
              }   
          }  
       
      });
    }

    form.parsley().validate();
    if (!form.parsley().isValid())
    {
        return false;
    } 
    else
    {  
     $.ajax({
        type: "POST",
        url: site_url + $val,
        data :form.serialize(),
        dataType : 'json', 
        success: function(data)
        { 
           if(data.result !='')
           {       
               alert("Successfully Added");          
               $title="Are You Want Add More Room Rates";
               if(confirm($title))
               { }
               else
               {
                  window.location.reload();
               }
          } 
           else if(data.result1 !='')
           {       
               alert(data.result1);          
            
          } 
          else
          {   
             alert("Try After Sometimes....");
             // window.location.reload();    
          }    
       }
      });  
    }
  }