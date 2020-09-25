$(document).ready(function () {
  $("#destination2").autocomplete({
    source: siteUrl+"home/hotelcitylist/",
    minLength: 2,
    autoFocus: true,
    select: function( event, ui ) {
      if(ui.item.id == ''){
        $(this).val('');
        return false;
      }
      $(this).closest('form').find('.autodate').focus();
      $(".ajax_dropdown").removeClass('active');
      $(".ajax_dropdown").empty();
      $('#hotels-tab').find('.active_ajax').html(ui.item.id);
      $("#hotelcityid").val(''); 
      $("#hotelcityid").val(ui.item.id); 
    },
    change: function(event, ui) {
      if(ui.item == null || ui.item.id == '') {
        $(this).val('');
        $("#holicityid").val('');
      }
    }
  });
  $("#destination2").keyup(function(){
    $(".ajax_dropdown").removeClass('active');
    $(".ajax_dropdown").empty();
    $('#hotels-tab').find('.active_ajax').html('');
  }); 
});