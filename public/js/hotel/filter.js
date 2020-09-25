function setPriceSlider() {
    var setPriceMin =  parseFloat($("#setMinPrice").val());
    var setPriceMax =  parseFloat($("#setMaxPrice").val());
    var currency =  $("#setCurrency").val();
    callPriceSlider(setPriceMin,setPriceMax,currency);
    priceSorting();
}

function callPriceSlider(setPriceMin,setPriceMax,currency) {
    var $selector=$("#priceSlider");
    var $MinOutput=$("#price-start");
    var $MaxOutput=$("#price-end");
    var $minPrice=$("#minPrice");
    var $maxPrice=$("#maxPrice");
    $selector.slider ({
        range: true,
        min: setPriceMin,
        max: setPriceMax,
        values: [setPriceMin, setPriceMax],
        slide: function(event, ui) {
            if(ui.values[0]+20>=ui.values[1]) {
                return false;
            } else {
                console.log(ui.values[0]);
                $MinOutput.html(currency+' '+ ui.values[ 0 ] );
                $MaxOutput.html(currency+' '+ ui.values[ 1 ] );
                $minPrice.val(ui.values[0]);
                $maxPrice.val(ui.values[1]);
            }
        }
    });
    
    $MinOutput.html(currency+' '+$selector.slider( "values", 0 ));
    $MaxOutput.html(currency+' '+$selector.slider( "values", 1 ));
    $minPrice.val($selector.slider( "values",0));
    $maxPrice.val($selector.slider( "values",1));
}


function priceSorting() {
    $(".ui-slider").bind( "slidestop", function()  {
        // console.log(232);
        filter();
    });
}

function filter($sortBy,$order) {
    $('#show_result').html('');
    $('#rapid_fire_draft_loading').show();
    
    // $minPr  =   parseFloat($("#setMinPrice").val());
    // $maxPr  =   parseFloat($("#setMaxPrice").val());
    $minPr  =   parseFloat($("#minPrice").val());
    $maxPr  =   parseFloat($("#maxPrice").val());
    // $minPrice =new Array;
    // $maxPrice =new Array;    
    $hotelName  = $("#hotelName").val();

    $stars=new Array;   
    $(".StarRating").each(function() {
        if (this.checked === true) {
            $starNum=$(this).val();
            $stars.push($starNum); 
        }  
    });

    $fac=new Array; 
    $(".Amenities:checked").each(function() {
        $facVal=$(this).val();
        $fac.push($facVal); 
    });

    $accommodation=new Array;
    $(".accommodation").each(function() {
        if (this.checked === true) {
            $accommodation.push($(this).attr("data-val")); 
        }
    });

   $locationnearby=new Array;
   $(".location_nearby").each(function() {
        if (this.checked === true) {
            $locationnearby.push($(this).attr("data-location-val")); 
        }    
        
    });
    
    $starShow =  $stars;        
    if($stars.length === 0) {
        $starShow = '';
    }

    $accommodation_type =  $accommodation;        
    if($accommodation.length === 0) {
        $accommodation_type = '';
    }
    
    $locationShow =  $locationnearby;        
    if($locationnearby.length === 0) {
        $locationShow = '';
    }
    
    $sort_data = 'data-price';
    $sort_order = 'asc';
    if(typeof $sortBy !== 'undefined' && typeof $order !== 'undefined') {
        $sort_data = $sortBy;
        $sort_order = $order;
    }
    $ListMapView=$('.view_type').find("li a.active").attr("data-val");
    // console.log($ListMapView);
    $.post(siteUrl+"hotels/searchresult_ajax", { ses_id: ""+ses_id, refNo: ""+refNo, minPrice: ""+$minPr, maxPrice: ""+$maxPr, starRating: ""+$starShow,fac:""+$fac, hotelName: ""+$hotelName, location: ""+$locationShow, sortBy: ""+$sort_data, order: ""+$sort_order, accommodation_type:""+$accommodation_type, ListMapView:""+$ListMapView },
    
    function(data) {
         $('#show_result').html('');
         $('#rapid_fire_draft_loading').hide();
         $('#show_result').html(data.hotels_search_result);
         $('#search_count').html(data.count);  
        if(parseInt(data.count)>=1) {         
            $('#currency_val').html("from "+data.minPr+" USD");  
        } else {
            $('#currency_val').html('');  
        }
        if (typeof readMorePara !== 'undefined' && $.isFunction(readMorePara)) {
            readMorePara();
        }
   }, 'json');

}