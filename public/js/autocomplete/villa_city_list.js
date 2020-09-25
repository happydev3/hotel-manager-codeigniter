$(document).ready(function () {
  $("#villa_cityName").autocomplete({
    source: siteUrl+"home/villacitylist/",
    minLength: 2,
    autoFocus: true,
    select: function(event, ui) {
      if(ui.item.id == ''){
        $(this).val('');
        return false;
      } 
      $(this).closest('form').find('.autodate').focus();
      $(".ajax_dropdown").removeClass('active');
      $(".ajax_dropdown").empty();
      $('#villas-tab').find('.active_ajax').html(ui.item.id);
      $("#villacityid").val(''); 
      $("#villacityid").val(ui.item.id); 
    },
    change: function(event, ui) {
      if(ui.item == null || ui.item.id == '') {
        $(this).val('');
        $("#villacityid").val('');
      }
    }
  });

  $("#villa_cityName").keyup(function(){
    $(".ajax_dropdown").removeClass('active');
    $(".ajax_dropdown").empty();
    $('#villas-tab').find('.active_ajax').html('');
  }); 
});