 $(document).ready(function () {
  $("#destination2").autocomplete({
       source: siteUrl+"home/hotelcitylist/",
       minLength: 2,
       autoFocus: true,
       select: function( event, ui ) 
       {  
         $("#ajax_dropdown").removeClass('active');
	       $("#ajax_dropdown").empty();
	       $("input[name='cityid']").val(''); 
	       $("input[name='cityid']").val(ui.item.id); 
       }
   });
    $("#destination2").keyup(function(){
       $("#ajax_dropdown").removeClass('active');
       $("#ajax_dropdown").empty();
    }); 
});

$(document).ready(function() {
  var $html = $('#ajax_dropdown_div').html();

  $("#destination2").on('click', function() {
      $("#ajax_dropdown").toggleClass('active');
      $(this).attr('autocomplete', 'off');
      $("#ajax_dropdown").empty().append($html);
    $.ajax({   
      success: function(html) {
        $("#ajax_dropdown").empty().append($html);
      }
    });
    return false;
  });
});

$(document).on('click', '.dropdown-list li', function() {
  $("#ajax_dropdown").removeClass('active');
  // $(this).addClass('active');
  $city = $(this).find('span').html();
  $country= $(this).find('span').attr('data-country');
  $id = $(this).find('span').attr('data-val');
  $('#destination2').val($city+', '+$country);
  $("input[name='cityid']").val(''); 
  $("input[name='cityid']").val($id); 
});

jQuery.ui.autocomplete.prototype._resizeMenu = function () {
  var ul = this.menu.element; 
  // ul.outerWidth(this.element.outerWidth());
   ul.outerWidth( $(".ajax_dropdown").width()+5);

}

 

 

