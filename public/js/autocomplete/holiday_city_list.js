$(document).ready(function () {
  $("#hol_cityName").autocomplete({
    source: siteUrl+"home/holidaycitylist/",
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
      $('#tours-tab').find('.active_ajax').html(ui.item.id);
      $("#holicityid").val(''); 
      $("#holicityid").val(ui.item.id); 
    },
    change: function(event, ui) {
      $("#holicityid").val('');
      if(ui.item == null || ui.item.id == '') {
        $(this).val('');
        $("#holicityid").val('');
      }
    }
  });

  $("#hol_cityName").keyup(function(){
    $(".ajax_dropdown").removeClass('active');
    $(".ajax_dropdown").empty();
    $('#tours-tab').find('.active_ajax').html('');
  }); 
});