$(document).ready(function()
{
    // define a set of requests to perform - you could also provide each one		
    $cnt = 0;
    $ajx_cnt = [];
    ajx_reponse = [];
    var successHandler = function(data) {

        //$('#rapid_fire_draft_loading').hide();
        //$('#avail_hotels').append(data.hotels_search_result);                                          
        $cnt++;
        $ajx_cnt.push($cnt);

        if ($.trim(data.hotels_search_result) != '') {
            $('#rapid_fire_draft_loading').hide();
            $('.loader').hide();
            $('#avail_hotels').html(data.hotels_search_result);

            $('#pagination_up').html(data.paging);
            $('#pagination_down').html(data.paging);
        } else {
            if ($ajx_cnt.length == api_array.length) {
                $('.loader').hide();
                if (!ajx_reponse.length) {
                    $('#avail_hotels').append('<div class="row" style="background-color:#fff;font-size:15px;border: 1px solid #A1A1A1;border-radius: 5px;margin: 5px 0;"><div class="" style="text-align:center;"><p style="color:#09ABB1"><b>There are no hotels in ' + hotel_search_data['cityName'].replace(/\([0-9]+\)/, '') + ' on ' + check_In + ' for ' + hotel_search_data['nights'] + ' night(s).</b></p><p>Sorry,we have no prices for hotels in this date range matching your criteria.One or more of your preferences may be affecting the number of exact  matches found.Try searching again with wider search data.</p></div></div>');
                } else {
                    $(ajx_reponse).each(function(i, resp) {
                    });
                }

            }
        }


        // do something			
        if ($.trim(data.hotels_search_result) != '') {
            $order = 'asc';
            $sortBy = 'data-price';
            sortHotels($order, $sortBy, $('.HotelSorting'));

            var data_areas = new Array;
            var hotelCount = 0;
            $(".HotelInfoBoxloc").each(function()
            {
                hotelCount++;
                data_areas.push($(this).attr("data-location"));

                if ($(this).attr("data-location") != '') {
                    $.merge(data_areas, $(this).attr("data-location").split(','));
                }

            });
            var data_fac = new Array;
            $(".HotelInfoBox").each(function()
            {
                if ($(this).attr("data-facilities") != '') {
                    $.merge(data_fac, $(this).attr("data-facilities").split(','));
                }

                // TO DISPLAY BEST PRICE
                $leas = $(this).parent().find('.least').val();
                $(this).parent().find('.leastdisp').html('GBP ' + $leas);
                //data_fac=$(this).attr("data-facilities");
            }); //alert(data_fac);
            $fcnts = new Array;
            data_fac = $.grep(data_fac, function(v, k)
            {
                if (typeof $fcnts[v] != 'undefined') {
                    $fcnts[v]++;
                } else {
                    $fcnts[v] = 1;
                }
                return $.inArray(v, data_fac) === k;
            });

            var FacilitiesString = "";
            for (var ai = 0; ai < data_fac.length; ai++)
            {
                var amenityName = data_fac[ai];
                if (typeof amenityName == "undefined" || amenityName == "") {
                }
                else
                {
                    FacilitiesString += '<label><input type="checkbox" name="amenities" class="Amenities" value="' + amenityName + '" />&nbsp;' + amenityName + '<span class="hotel_counts">' + $fcnts[amenityName] + '</span></label>';

                    //  FacilitiesString += '<label><input type="checkbox" name="amenities" class="Amenities" value="' + amenityName + '" />&nbsp;' + amenityName + '</span></label>';
                }
            }
            $(".amenities").html(FacilitiesString);
            // initPagination(hotelCount); /*Pagination */

            //   $("#hotelCount").text(hotelCount);
            //  $("#hotelCount1").text(hotelCount);

            var prices = $(".HotelInfoBox").map(function() {
                return parseFloat($(this).attr('data-price'), 10);
            }).get();

            var highest = Math.max.apply(Math, prices);
            var lowest = Math.min.apply(Math, prices);
//alert(lowest);
            if (highest > 0 && lowest > 0)
            {
                $("#setMinPrice").val(data.min);
                $("#setMaxPrice").val(data.max);
            }
            else
            {
                $("#setMinPrice").val(0);
                $("#setMaxPrice").val(0);
            }

            // Calling PriceSlider
            setPriceSlider();
            setTripRatingSlider();
            $acnts = new Array;
            data_areas = $.grep(data_areas, function(v, k)
            {
                if (typeof $acnts[v] != 'undefined') {
                    $acnts[v]++;
                } else {
                    $acnts[v] = 1;
                }
                return $.inArray(v, data_areas) === k;
            });

            var LocationString = "";
            for (var ai = 1; ai < data_areas.length; ai++)
            {
                var locationName = data_areas[ai];
                if (typeof locationName == "undefined" || locationName == "") {
                }
                else
                {
                    LocationString += '<label><input type="checkbox" name="areaName" class="Areas" value="' + locationName + '" />&nbsp;' + locationName + '<span class="hotel_counts">' + $acnts[locationName] + '</span></label>';
                    // LocationString += '<label><input type="checkbox" name="areaName" class="Areas" value="' + locationName + '" />&nbsp;' + locationName + '</span></label>';
                    //LocationString+=locationName+',';
                }
            }
            $(".Locations").html(LocationString);

            $(".hotel-search-cntr").css("display", "block");

        }
    }
    // these will basically execute at the same time:
    for (var i = 0, l = api_array.length; i < l; i++)
    {
        $.ajax({
            url: siteUrl + 'hotels/hotels_availability',
            data: 'callBackId=' + api_array[i],
            dataType: 'json',
            type: 'POST',
            beforeSend: function()
            {
                $(".hotel-search-cntr").css("display", "none");
                $('.loader').show();
            },
            success: successHandler,
            error: function(jqXHR, error, errorThrown) {

                successHandler({'hotels_search_result': ''});
            }

        });
    }


});

$(document).on("click", '.Areas', function($e) {

    filter();
});

$(document).on("click", '.Amenities', function($e) {

    //  filter();
});
$(document).on("change", '#hotelName', function($e) {

    filter();
});