$(document).ready(function() { 
 $("#edit_hotel_excursion_rate").click(function(){
      $id=$("#hotels").val();
    if($id=="")
    {
      alert("Kindly Select Hotel");
    }
    else{
    window.location=site_url+'excursions/view_cal_edit/'+$id;
      }
  })
  $("#view_hotel_excursion_rate").click(function(){
      $id=$("#hotels").val();
    if($id=="")
    {
      alert("Kindly Select Hotel");
    }
    else{
    window.location=site_url+'excursions/excursion_rate_list/'+$id;
      }
  })
	$("#select_hotel").click(function(){
		$id=$("#hotels").val();
		if($id=="")
		{
			alert("Kindly Select Hotel");
		}
		else{
		window.location=site_url+'excursions/add_excursion_rates/'+$id;
	    }
	})

	$("#rate_date_range").click(function(){  
	var days = { 'Mon':1,'Tue':2,'Wed':3,'Thu':4,'Fri':5,'Sat':6,'Sun':0};
    var days_ar = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
        var sd = $("#from_date").val();
        var ed = $("#to_date").val(); 
        var excursions_rate_types_id = $("#excursions_rate_types_id").val(); 
      if(sd == ''){
            alert("Please select from date");
            return false;
        }
        if(ed == ''){
            alert("Please select end date");
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
      url: site_url + 'excursions/available_rates/',
      data : { excursions_rate_types_id : excursions_rate_types_id , sd:sd1 ,ed:ed1},
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
            excursionrate = getRates(dt,json.result);
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
            $("#ratebydates tr:last").before('<tr style="border-top:solid 1px #deab6f; border-bottom:solid 1px #deab6f; padding-bottom:2px;"><td class="tdnew" style="width:10%" id="tdtd">'+formatdate+'<input type="hidden" name="dates[]" value="'+fdate+'"><input type="hidden" name="weekday[]" value="'+days_ar[dt.getDay()]+'"></td><td class="tdnew" style="width:10%" id="tdtd3"><input name="available_booking[]" type="text" class="form-control input-field"  style="height:20px;  background:#F2F2F2;" value="'+excursionrate.available_booking+'" /></td><td class="tdnew"style="width:10%" id="tdtd3"><input name="adult_price[]" type="text" class="form-control input-field"  style="height:20px;  background:#F2F2F2;" value="'+excursionrate.adult_price+'"/></td><td class="tdnew"style="width:10%" id="tdtd3"><input name="child_price[]" type="text" class="form-control input-field"  style="height:20px;  background:#F2F2F2;" value="'+excursionrate.child_price+'"/></td><td class="tdnew"style="width:10%" id="tdtd3"></tr>');         
          });;
        }
      });


	});
});

 function check_new(){
        var Num=/^(0|[1-9][0-9]*)$/;       
        var deciNum= /^[0-9]+(\.\d{1,3})?$/;
        $available_booking = $('#available_booking').val();
        $cost_price = $('#cost_price').val();
        $adult_price = $('#adult_price').val();
        $child_price = $('#child_price').val();
          if($available_booking==''){
          alert("Enter Avilable Booking");
           $('#available_booking').focus();
          return false;
         }
         else if(!Num.test($available_booking)){
          alert("Enter Numberic Value For Avilable Booking");
           $('#available_booking').val('');
           $('#available_booking').focus();
           return false;
         }        
          if(!deciNum.test($adult_price)&&$adult_price!=''){
          alert("Enter  Either Numberic  or Decimal Value For Adult Price(Per Adult)");
           $('#adult_price').val('');
            $('#adult_price').focus();
           return false;
         }
         
         if(!deciNum.test($child_price)&&$child_price!=''){
          alert("Enter  Either Numberic  or Decimal Value For Child Price(Per Child)");
          $('#child_price').val('');
           $('#child_price').focus();
           return false;
         }

        if($available_booking!=''){
            $('input[name="available_booking[]"]').each(function(){
                $('input[name="available_booking[]"]').val($available_booking);
            });
        }
       
         if($adult_price!=''){
            $('input[name="adult_price[]"]').each(function(){
                $('input[name="adult_price[]"]').val($adult_price);
            });
        }
          if($child_price!=''){
            $('input[name="child_price[]"]').each(function(){
                $('input[name="child_price[]"]').val($child_price);
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
      return {date:'',available_booking:'',adult_price:'',child_price:''};   
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
    url: site_url+'excursions/edit_excursion_rates/'+$val,
    data: '',
    dataType: 'json',
    type: 'POST',
    success: function(data) {      
      if(data.edit_excursion_rates != null) {       
      $("#ratecontent").html(data.edit_excursion_rates);
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
               alert("Successfully Updated");          
                window.location.reload();             
            } 
          else
          {   
             alert("Try After Sometimes....");
             window.location.reload();    
          }    
       }
      });  
    }
  }
  
  function update_editrate_old()
  {
    var Num=/^(0|[1-9][0-9]*)$/;   
    var deciNum= /^[0-9]+(\.\d{1,3})?$/;    
    $index=$("#index").val();
    $adult_price=$("#adult_price").val();
    $child_price=$("#child_price").val();
    $excursion_code=$("#excursion_code").val();
    $rate_code=$("#rate_code").val();
    $excursions_rate_types_id=$("#excursions_rate_types_id").val();
    $sup_excursion_rate_id=$("#sup_excursion_rate_id").val();
  
    if(!deciNum.test($adult_price)&&$adult_price!=''){
    alert("Enter  Either Numberic  or Decimal Value For Adult Price");
     $('#adult_price').val('');
      $('#adult_price').focus();
     return false;
   }
   
   if(!deciNum.test($child_price)&&$child_price!=''){
    alert("Enter  Either Numberic  or Decimal Value For Child Price");
    $('#child_price').val('');
     $('#child_price').focus();
     return false;
   }

    $.ajax({
      type: "POST",
      url: site_url + 'excursions/update_excursion_rates/',
      data : { adult_price:$adult_price ,child_price:$child_price, excursion_code : $excursion_code , rate_code:$rate_code ,excursions_rate_types_id:$excursions_rate_types_id, sup_excursion_rate_id:$sup_excursion_rate_id },
      dataType : 'json',    
      success: function(data) {          
      if(data.success != null) {     
      $("#adult"+$index).html(data.adult_price);
      $("#child"+$index).html(data.child_price);
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

 function set_excursionrate_status(t)
 {
    $val=t.getAttribute('data-val');
    $id=t.getAttribute('data-id');
    $status=t.getAttribute('data-status');
    $index=t.getAttribute('data-index');
    $title=t.getAttribute('title');   
    $action='';  
    if($status=='1')
    { 
       $action='<a class="btn btn-warning btn-xs"  data-id="'+$id+'"  data-status="0" data-val="excursions/set_excursionrate_status"  onclick="return set_excursionrate_status(this)" data-index="'+$index+'" title="Do you really want to Inactive this Excursion Rate. ?"><i class="fa fa-times"></i> InActive</a>'
    }
    else{
       $action='<a class="btn btn-success btn-xs" data-id="'+$id+'"  data-status="1" data-val="excursions/set_excursionrate_status"  onclick="return set_excursionrate_status(this)" data-index="'+$index+'" title="Do you really want to Active this Excursion Rate. ?"><i class="fa fa-check"></i> Active</a>'
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