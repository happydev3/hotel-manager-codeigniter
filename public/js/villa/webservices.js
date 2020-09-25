$(document).ready(function() {
  $('#rapid_fire_draft_loading').show();
  var l = api_array.length;
  $i = 0;
  $ListMapView='';
  $ListMapView=$('.view_type').find("li a.active").attr("data-val");
  search_availability($i,$ListMapView);

  $('.ListMapView').click(function() {
    $('#villa_search_result').html('');
    $(".hotel-search-cntr").css("display", "none");
    $('#rapid_fire_draft_loading').show();
    $('.loader').show();
    $('.ListMapView').parent().find("a").removeClass("active");
    $(this).find("a").addClass('active');
    $('.ListMapView').find("a").find("i").removeClass("active");
    $(this).find("a").find("i").addClass('active');
    $i=0;
    $ListMapView=$(this).find("a").attr("data-val");
    // search_availability($i,$ListMapView);
    filter();
  });

  function search_availability($a,$ListMapView) {
    $.ajax({
      url: siteUrl + 'villa/villa_availability',
      data: 'callBackId='+api_array[$a]+'&ses_id='+ses_id+'&refNo='+refNo+'&ListMapView='+$ListMapView,
      dataType: 'json',
      type: 'POST',
      success: function(data) {
        if ($a == (l - 1)) {
          load_search_results($a,ses_id,refNo,$ListMapView);
          return false;
        }
        if (data.results == 'success')
        {
          load_search_results($a,ses_id,refNo,$ListMapView);
        }
        $a++;
        search_availability($a);
        $(".hotel-search-cntr").css("display", "block");
      }
    });
  }

  function load_search_results($a,ses_id,refNo,$ListMapView) {
    $.ajax({
      url: siteUrl + 'villa/fetch_results',
      data: 'count='+$a+'&ses_id='+ses_id+'&refNo='+refNo+'&ListMapView='+$ListMapView,
      dataType: 'json',
      type: 'POST',
      success: function(data) {
        if(data.villa_search_result != null) {
          $('#rapid_fire_draft_loading').hide();
        }
        $('#villa_search_result').html(data.villa_search_result);
        // $('.Locnearby').html(data.locations);
        // $("#Locations").html(data.locations);
        $("#setMinPrice").val(data.min_price);
        $("#setMaxPrice").val(data.max_price);
        $('#search_count').html(data.search_count);
        setPriceSlider();
        var data_fac = new Array;
        $(".HotelInfoBox").each(function() {
          if ($(this).attr("data-facilities") != '') {
            $.merge(data_fac, $(this).attr("data-facilities").split(','));
          }
        });
        $fcnts = new Array;
        data_fac = $.grep(data_fac, function(v, k) {
          if (typeof $fcnts[v] != 'undefined') {
            $fcnts[v]++;
          } else {
            $fcnts[v] = 1;
          }
          return $.inArray(v, data_fac) === k;
        });
        var FacilitiesString = "";
        for (var ai = 0; ai < data_fac.length; ai++) {
          var amenitys = data_fac[ai];
          var amenityArr = amenitys.split('|');
          if (typeof amenitys == "undefined" || amenitys == "") {
          } else {
            FacilitiesString += '<label class="checkbox-custom checkbox-custom-sm"><input name="amenities" type="checkbox" class="Amenities" value="'+amenityArr[1]+'"><i></i> <span> '+amenityArr[0]+' <small class="pull-right">['+$fcnts[amenitys]+']</small></span></label>';
          }
        }
        $(".amenities").html(FacilitiesString);
      },
      error: function(jqXHR, textStatus, errorThrown){
          console.log(textStatus, errorThrown);
          $('#rapid_fire_draft_loading').hide();
          $('#show_result').html('<div class="result-box" style="color: red;font-size: 14px;font-weight: bold;padding-top:50px;padding-bottom: 50px;margin-top: 20px;"align="center">No villas found for your given search criteria . Can you please make another search or filter criteria...</div>');
      }
    });
  }
});
