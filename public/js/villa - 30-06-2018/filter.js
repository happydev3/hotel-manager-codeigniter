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
    $('#villa_search_result').html('');
    $('#rapid_fire_draft_loading').show();
    
    $minPr  =   parseFloat($("#setMinPrice").val());
    $maxPr  =   parseFloat($("#setMaxPrice").val());
    $minPrice =new Array;
    $maxPrice =new Array;    
    $villaName  = $("#villaName").val();

    $('.priceRange').each(function (index, obj) {
        if (this.checked === true) {
            $minPriceRange=$(this).attr('data-min');           
            $maxriceRange=$(this).attr('data-max');
            $minPrice.push($minPriceRange);
            $maxPrice.push($maxriceRange);
        }
    });

   if (parseInt($minPrice.length) !== 0) 
   {
         $minPr=Math.min.apply(Math,$minPrice); 
   }
    if (parseInt($maxPrice.length) !== 0) 
   {
         $maxPr=Math.max.apply(Math,$maxPrice); 
   }
   if(isNaN($minPr))
   {
         $minPr = parseFloat($("#setMinPrice").val());
   }
  if(isNaN($maxPr))
   {
     $maxPr = parseFloat($("#setMaxPrice").val());
   }

    $stars=new Array;   
    $(".StarRating").each(function()
    {
        if (this.checked === true) 
        {
            $starNum=$(this).val();
            $stars.push($starNum); 
        }
      
        
    });

    
    $starShow =  $stars;        
    if($stars.length === 0)
    {
        $starShow = '';
    }

    
    $sort_data = 'data-price';
    $sort_order = 'asc';
    if(typeof $sortBy !== 'undefined' && typeof $order !== 'undefined')
    {
        $sort_data = $sortBy;
        $sort_order = $order;
    }
    $ListMapView=$('.view_type').find("li a.active").attr("data-val");
    // console.log($ListMapView);
    $.post(siteUrl+"villa/searchresult_ajax", {minPrice: ""+$minPr, maxPrice: ""+$maxPr, starRating: ""+$starShow, villaName: ""+$villaName, sortBy: ""+$sort_data, order: ""+$sort_order, ListMapView:""+$ListMapView},
    
    function(data) {
         $('#villa_search_result').html('');
         $('#rapid_fire_draft_loading').hide();
         $('#villa_search_result').html(data.villa_search_result);
         $('#search_count').html(data.count);  
        if(parseInt(data.count)>=1) 
        {         
            $('#currency_val').html("from "+data.minPr+" USD");  
        } 
        else
        {
            $('#currency_val').html('');  
        }         
   }, 'json');

}