/*$(document).ready(function() {
  var $html = $('#ajax_dropdown_div').html();
  $(document).on('click', '.autocity', function() {
      $('#ajax_dropdown_div').removeAttr('click-type');
      $(this).parent().parent().find(".ajax_dropdown").toggleClass('active');
      var lastClick = $(this).parent().parent().find(".active_ajax").html();
      $(this).attr('autocomplete', 'off');
      var clickType = $(this).attr('pop-type');
      $('#ajax_dropdown_div').attr('click-type', clickType);
      // $(this).parent().parent().find(".ajax_dropdown").empty().append($html);
      console.log(lastClick);
      $(this).parent().parent().find(".ajax_dropdown").empty().append($html).find('.num_'+lastClick+' > div').addClass('active');
    $.ajax({
      success: function(html) {
        $(this).parent().parent().find(".ajax_dropdown").empty().append($html);
      }
    });
    return false;
  });
});*/

$(document).ready(function() {
  $(document).on('click', '.autocity', function() {
    var _this = $(this);
    var lastClick = $(this).parent().find(".cityid").val();
    var clickType = $(this).attr('pop-type');
    $(this).parent().parent().find(".ajax_dropdown").toggleClass('active');
    $(this).attr('autocomplete', 'off');
    console.log(lastClick);
    $.ajax({
      url: siteUrl + 'home/popularcities',
      data: 'module_type='+clickType+'&last_click='+lastClick,
      dataType: 'json',
      type: 'POST',
      beforeSend: function(){
        _this.parent().parent().find(".ajax_dropdown").html('<div id="rules_loading" align="center"><img align="top" alt="loading.. Please wait.." src="'+loaderimg+'"></div>');
      },
      success: function(data) {
        _this.parent().parent().find(".ajax_dropdown").html(data.result);
      }
    });
    return false;
  });
});


$(document).on('click', '.dropdown-list li', function() {
  $(this).parents('.ajax_dropdown').removeClass('active');
  $(this).parent().find('div.active').removeClass('active');

  focusObj($(this).closest('form').find('.autodate'),'focus'); // function call autofocus on click

  // $('.dropdown-list > li > div').addClass('active');
  $city = $(this).find('span').html();
  $country= $(this).find('span').attr('data-country');
  $id = $(this).find('span').attr('data-val');
  $(this).closest('form').find('.autocity').val($city+', '+$country);
  $(this).closest('form').find(".cityid").val(''); 
  $(this).closest('form').find(".cityid").val($id);

  var returnClick = $(this).attr('data-num');
  var clickType = $('#ajax_dropdown_div').attr('click-type');

  if (typeof clickType !== typeof undefined && clickType !== false) {
    $('#'+clickType).find('.active_ajax').html(returnClick);
  }
  
  // console.log(clickType);
});

jQuery.ui.autocomplete.prototype._resizeMenu = function () {
  var ul = this.menu.element; 
  // ul.outerWidth(this.element.outerWidth());
  ul.outerWidth( $(".ajax_dropdown").width()+5);
}