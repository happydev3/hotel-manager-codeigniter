
 

  function cancel_editcontract(){  
    $("#contractcontent").html(''); 
    $('#editcontract').modal('hide');  
  }

function editcontract(t){
    $val=t.getAttribute('data-val');
    $("#contractcontent").html('');
  $.ajax({
    url: site_url+'contract/editcontract/',
    data: {id:$val},
    dataType: 'json',
    type: 'POST',
    success: function(data) {      
      if(data.edit_contract_contract != '') {       
      $("#contractcontent").html(data.contractcontent);
      } 
     else{
         $("#contractcontent").html("Sorry No record found");
      }
    
      $('#editcontract').modal('show');    
    }
  });  

  }

 function update_editcontract(t)
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
      $("#contractcontent").html(data.result);     
      $('#editcontract').modal('show');
      setTimeout( function()  {
       $('#editcontract').modal('hide'); }, 5000);  
       window.location.reload();
      } 
     else{
         $("#validation_error").html(data.validation_error);
          $('#editcontract').modal('show');    
      }    
     

     }

    });
  
   }
  }


//contract

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

 

function editmodalcustom(t)
 {
    $val=t.getAttribute('data-val');
    $id=t.getAttribute('data-id');
    $("#customcontent").html('');
    $("#myModalLabel_modal").html('');
    $("#validation_error").html('');
     $.ajax({
      type: "POST",
      url: site_url + $val,
      data :{ id : $id},
      dataType : 'json', 
     success: function(data) {   

    if(data.result != '') {   
      $("#customcontent").html(data.result);
      $("#myModalLabel_modal").html(data.header);
      } 
     else{
         $("#myModalLabel_modal").html(data.header);
          $("#validation_error").html(data.validation_error);
      }
    $('#modalcustom').modal({backdrop: 'static', keyboard: false});
      $('#modalcustom').modal('show');    

     }


    });

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
      $("#myModalLabel_modal").html(data.header);
      $('#modalcustom').modal({backdrop: 'static', keyboard: false});
        $('#modalcustom').modal('show');
      setTimeout( function()  {
       $('#modalcustom').modal('hide'); }, 1000);  
       window.location.reload();
      } 
     else{
         $("#validation_error").html(data.validation_error);
         $('#modalcustom').modal({backdrop: 'static', keyboard: false});
          $('#modalcustom').modal('show');    
      }
    
     

     }

    });
  
   }
  }


 function set_contract_status(t)
 {
    $val=t.getAttribute('data-val');
    $id=t.getAttribute('data-id');
    $status=t.getAttribute('data-status');
    $index=t.getAttribute('data-index');
    $title=t.getAttribute('title');   
    $action='';  
    if($status=='1')
    { 
       $action='<a class="btn btn-warning btn-xs"  data-id="'+$id+'"  data-status="0" data-val="contract/set_contract_status"  onclick="return set_contract_status(this)" data-index="'+$index+'" title="Do you really want to this contract In Progress. ?"><i class="fa fa-times"></i> In Progress</a>'
    }
    else{
       $action='<a class="btn btn-success btn-xs" data-id="'+$id+'"  data-status="1" data-val="contract/set_contract_status"  onclick="return set_contract_status(this)" data-index="'+$index+'" title="Do you really want to this contract In Sale. ?"><i class="fa fa-check"></i> In Sale</a>'
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



   function cancel_contractfile(){
       $('#addfile').modal('hide');  
  }


  function update_contractfile(t)
  {
     $("#validation_error").html("");
     var form =$(t.form);    
     form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } 
      else
      {  
        t.form.submit();
  
     }
  }


    function cancel_contractseason(){
       $('#addnewseason').modal('hide');  
  }


  function update_contractseason(t)
  {
     $("#validation_error").html("");
     var form =$(t.form);    
     form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } 
      else
      {  
        t.form.submit();
  
     }
  }


   function cancelperiod_contract_season(){
       $('#addperiod').modal('hide');  
  }

 function addperiod(t)
 {
  $("#season_id").val(t.getAttribute('data-val'));
 }

  function addperiod_contract_season(t)
  {   
     var form =$(t.form);    
     form.parsley().validate();
      if (!form.parsley().isValid()) {
          return false;
      } 
      else
      {  
        t.form.submit();
  
     }
  }


  function set_season_status(t)
 {
    $val=t.getAttribute('data-val');
    $id=t.getAttribute('data-id');
    $status=t.getAttribute('data-status');
    $index=t.getAttribute('data-index');
    $title=t.getAttribute('title');   
    $action='';  
    if($status=='1')
    { 
       $action='<a class="btn btn-warning btn-xs"  data-id="'+$id+'"  data-status="0" data-val="contract/set_season_status"  onclick="return set_season_status(this)" data-index="'+$index+'" title="Do you really want to Inactive this Season. ?"><i class="fa fa-times"></i> InActive</a>'
    }
    else{
       $action='<a class="btn btn-success btn-xs" data-id="'+$id+'"  data-status="1" data-val="contract/set_season_status"  onclick="return set_season_status(this)" data-index="'+$index+'" title="Do you really want to Active this Season. ?"><i class="fa fa-check"></i> Active</a>'
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


 function remove_contract_season_period(t)
 {
    $val=t.getAttribute('data-val');
    $id=t.getAttribute('data-id'); 
    $index=t.getAttribute('data-index');
    $period=t.getAttribute('data-period');
    $title=t.getAttribute('title');   
     if(confirm($title)){
      $.ajax({
              type: "POST",
              url: site_url + $val,
              data :{ id : $id, period: $period},
              dataType : 'json', 
               success: function(data) { 
                    if(data.result != '') {   
                      $("#period_"+$index).remove();                                                         
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