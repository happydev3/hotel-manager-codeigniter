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
    $("#ratecontent").html('');
  $.ajax({
    url: site_url+'roomrates/edit_room_rates/'+$val,
    data: '',
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


  function update_editrate()
  {
    var Num=/^(0|[1-9][0-9]*)$/;   
    var deciNum= /^[0-9]+(\.\d{1,3})?$/;
    var form =$(t.form);
    $val=t.form.getAttribute('data-action');

     form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } 
      else
      {  
    $room_fixed_rate=$("#room_fixed_rate").val();
    $index=$("#index").val();
    $extra_bed_adult=$("#extra_bed_adult").val();
    $extra_bed_child=$("#extra_bed_child").val();
    $hotel_code=$("#hotel_code").val();
    $room_code=$("#room_code").val();
    $sup_room_details_id=$("#sup_room_details_id").val();
    $sup_hotel_room_rates_id=$("#sup_hotel_room_rates_id").val();
     if($room_fixed_rate==''){
    alert("Enter Fixed Price");
     $('#room_fixed_rate').val('');
     $('#room_fixed_rate').focus();
     return false;
   }
   else if(!deciNum.test($room_fixed_rate)){
    alert("Enter Either Numberic  or Decimal Value For Fixed Price");
     $('#room_fixed_rate').val('');
      $('#room_fixed_rate').focus();
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

    $.ajax({
      type: "POST",
      url: site_url + $val,
      data : form.serialize(),
      dataType : 'json',    
      success: function(data) {          
      if(data.success != null) {
      $("#fixedrate"+$index).html(data.room_fixed_rate);
      $("#adult"+$index).html(data.extra_bed_adult);
      $("#child"+$index).html(data.extra_bed_child);
      $bgeven=$(".trevenedit").css('background');
      $coloreven=$(".trevenedit").css('color');
      $bgodd=$(".troddedit").css('background');
      $colorodd=$(".troddedit").css('color');
      $evenodd=1;
      if(parseInt($index)%2==0)
      {       
       $evenodd=2;
      }  
      $(".trevenedit").css('background',$bgeven);
      $(".trevenedit").css('color',$coloreven);
      $(".troddedit").css('background',$bgodd);
      $(".troddedit").css('color',$colorodd);
      $("#tr"+$index).css('background','green');
      $("#tr"+$index).css('color','white');
      $("#ratecontent").html("Successfully Updated");
       $('#modaleditrate').modal('show');
      setTimeout( function()  {
       $('#modaleditrate').modal('hide'); }, 1000);       
      setTimeout( function()  {
        if(parseInt($evenodd)==2){
          $("#tr"+$index).css('background',$bgeven);
          $("#tr"+$index).css('color',$coloreven); 
        }
        else
        {
          $("#tr"+$index).css('background',$bgodd);
          $("#tr"+$index).css('color',$colorodd); 
        }
        }, 4000);  
      window.location.reload();
       } 
     else{
         $("#ratecontent").html("Try after sometimes...");
         $('#modaleditrate').modal('show');
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
  $rate_type=t.getAttribute('value');
  $.ajax({
          type: "POST",
          url: site_url + $val,
          data :{ rate_type : $rate_type},
          dataType : 'json', 
           success: function(data) { 
           $("#add_rate_type").html(data.result);             
           }
        });
 }

 function add_rates(t)
 {
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
       alert("Successfully Added");
       window.location.reload();
      } 
     else{
       alert("Try After Sometimes....");
       window.location.reload();
      } 
     

     }
    });  
   }
 }