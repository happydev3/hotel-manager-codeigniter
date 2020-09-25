$(document).ready(function() {

  $('#rapid_fire_draft_loading').show();       
  $i = 0;
  $ListMapView='';
  $ListMapView=$('.view_type').find("li a.active").attr("data-val");
  load_search_results($i,$ListMapView);
  $('.ListMapView').click(function() {
      $('#villa_search_result').html('');
      // $(".hotel-search-cntr").css("display", "none");
      $('#rapid_fire_draft_loading').show();
      $('.loader').show();
      $('.ListMapView').parent().find("a").removeClass("active");
      $(this).find("a").addClass('active');
      $('.ListMapView').find("a").find("i").removeClass("active");
      $(this).find("a").find("i").addClass('active');
      $i=0;
      $ListMapView=$(this).find("a").attr("data-val");
      load_search_results($i,$ListMapView);
  });
  function load_search_results() { 
      $.ajax({
          url: siteUrl + 'villa/fetch_results',
          data: 'ListMapView=' + $ListMapView,
          dataType: 'json',
          type: 'POST',
          success: function(data)
          { 
              if(data.villa_search_result != null){
                $('#rapid_fire_draft_loading').hide();
              }
              $('#villa_search_result').html(data.villa_search_result);
              $("#setMinPrice").val(data.min_price);
              $("#setMaxPrice").val(data.max_price);
              $('#search_count').html(data.search_count); 
              setPriceSlider();
            }
      });
  }

});
