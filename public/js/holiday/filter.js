/*
 jQuery UI Slider 
 */

 function setPriceSlider()
 {	
    var setPriceMin	=	parseFloat($("#setMinPrice").val());
    var setPriceMax	=	parseFloat($("#setMaxPrice").val());
    var currency    =  "₹";
    callPriceSlider(setPriceMin,setPriceMax,currency);
    priceSorting();
}
function setdurSlider()
{  
    var setdurMin    =   parseFloat($("#setMindur").val());
    var setdurMax =   parseFloat($("#setMaxdur").val());
    var dur="days";
    calldurSlider(setdurMin,setdurMax,dur);
    priceSorting();
}
function settempSlider()
{  
    var settempMin    =   parseFloat($("#setMintemp").val());
    var settempMax =   parseFloat($("#setMaxtemp").val());
    var temp="°C";
    calltempSlider(settempMin,settempMax,temp);
    priceSorting();
}
function setratingSlider()
{  
    var setratingMin    =   parseFloat($("#setMinrating").val());
    var setratingMax =   parseFloat($("#setMaxrating").val());
    var rating="☆";
    callratingSlider(setratingMin,setratingMax,rating);
    priceSorting();
}
function setTripRatingSlider()
{	
    var setRatingMin	=	parseInt($("#setMinRating").val());
    var setRatingMax	=	parseInt($("#setMaxRating").val());

    callTripRatingSlider(setRatingMin,setRatingMax);
    priceSorting();
}
function callratingSlider(setratingMin,setratingMax,rating)
{
    $selector4=$( "#ratingSlider" );
    $output4=$( "#ratingSliderOutput");
    $minrating2=$( "#minrating2");
    $maxrating2=$( "#maxrating2");
    $selector4.slider
    ({
        range: true,
        min: setratingMin,
        max: setratingMax,
        range:true,
        step:1,
        values: [setratingMin, setratingMax],
        slide: function(event, ui)
        {
            if(ui.values[0]>=ui.values[1])
            {
                return false;
            }
            else
            {                
                $output4.html(ui.values[ 0 ] +' '+ rating+ "  To  "+ ui.values[ 1 ]+' '+ rating);
                $("#minrating").val(ui.values[0]);
                $("#maxrating").val(ui.values[1]);
                $minrating2.html(ui.values[ 0 ] +' '+ rating);
                $maxrating2.html(ui.values[ 1 ]+' '+ rating);               
            }
        }
    });
    
    $output4.html($selector4.slider( "values", 0 )+' '+ rating+ "  To  "+ $selector4.slider( "values",1) + ' ' + rating);
    $("#minrating").val($selector4.slider( "values",0));
    $("#maxrating").val($selector4.slider( "values",1));
    $minrating2.html($selector4.slider( "values", 0 )+' '+ rating);
    $maxrating2.html($selector4.slider( "values",1) + ' ' + rating);
}
function calltempSlider(settempMin,settempMax,temp)
{
    $selector3=$( "#tempSlider" );
    $output3=$( "#tempSliderOutput");
    $selector3.slider
    ({
        range: true,
        min: settempMin,
        max: settempMax,
        range:true,
        step:0.1,
        values: [settempMin, settempMax],
        slide: function(event, ui)
        {
            if(ui.values[0]>=ui.values[1])
            {
                return false;
            }
            else
            {                
                $output3.html(ui.values[ 0 ] +' '+ temp+ "  To  "+ ui.values[ 1 ]+' '+ temp);
                $("#mintemp").val(ui.values[0]);
                $("#maxtemp").val(ui.values[1]);                
            }
        }
    });
    
    $output3.html($selector3.slider( "values", 0 )+' '+ temp+ "  To  "+ $selector3.slider( "values",1) + ' ' + temp);
    $("#mintemp").val($selector3.slider( "values",0));
    $("#maxtemp").val($selector3.slider( "values",1));
}
function calldurSlider(setdurMin,setdurMax,dur)
{
    $selector2=$( "#durSlider" );
    $output2=$( "#durSliderOutput");
    $mindur=$("#mindur");
    $maxdur=$("#maxdur");
    $mindur2=$("#mindur2");
    $maxdur2=$("#maxdur2");
    $selector2.slider
    ({
        range: true,
        min: setdurMin,
        max: setdurMax,
        range:true,
        step:1,
        values: [setdurMin, setdurMax],
        slide: function(event, ui)
        {
            if(ui.values[0]>=ui.values[1])
            {
                return false;
            }
            else
            {                
                $output2.html((ui.values[ 0 ]+1) +' '+ dur+ "  To  "+ (ui.values[ 1 ]+1)+' '+ dur);
               // $output2.html(dur+' '+ (ui.values[ 0 ]+1) + "  To  "+dur+' '+(ui.values[ 1 ]+1) );
               $("#mindur").val(ui.values[0]);
               $("#maxdur").val(ui.values[1]);
               $mindur2.html((ui.values[ 0 ]+1) +' '+ dur);
               $maxdur2.html((ui.values[ 1 ]+1)+' '+ dur);
           }
       }
   });
    
    //$output2.html(dur+' '+($selector2.slider( "values", 0 )+1) + "  To  "+dur+' '+ ($selector2.slider( "values",1)+1) );
    $output2.html(($selector2.slider( "values",0)+1)+' '+ dur+ "  To  "+ ($selector2.slider( "values",1)+1) + ' ' + dur);
    $("#mindur").val($selector2.slider( "values",0));
    $("#maxdur").val($selector2.slider( "values",1));
    $mindur2.html(($selector2.slider( "values",0)+1)+' '+ dur);
    $maxdur2.html(($selector2.slider( "values",1)+1) + ' ' + dur);
}

function callPriceSlider(setPriceMin,setPriceMax,currency)
{
    $selector=$( "#priceSlider" );
    $output=$( "#priceSliderOutput");
    $minPrice=$("#minPrice");
    $maxPrice=$("#maxPrice");
    $minPrice2=$("#minPrice2");
    $maxPrice2=$("#maxPrice2");
    $selector.slider
    ({
        range: true,
        min: setPriceMin,
        max: setPriceMax,
        values: [setPriceMin, setPriceMax],
        slide: function(event, ui)
        {
            if(ui.values[0]+20>=ui.values[1])
            {
                return false;
            }
            else
            {                
                $output.html(currency+' '+ ui.values[ 0 ] + "  To  "+currency+' '+ui.values[ 1 ] );
                $minPrice.val(ui.values[0]);
                $maxPrice.val(ui.values[1]);
                $minPrice2.html(currency+' '+ui.values[0]);
                $maxPrice2.html(currency+' '+ui.values[1]);
            }
        }
    });
    
    $output.html(currency+' '+$selector.slider( "values", 0 ) + "  To  "+currency+' '+ $selector.slider( "values",1) );
    $minPrice.val($selector.slider( "values",0));
    $maxPrice.val($selector.slider( "values",1));
    $minPrice2.html(currency+' '+$selector.slider( "values",0));
    $maxPrice2.html(currency+' '+$selector.slider( "values",1));
}

function callTripRatingSlider(setRatingMin,setRatingMax)
{
    $selector1=$( "#tripRatingSlider" );
    $output1=$( "#tripRatingSliderOutput");
    $minRating=$("#minRating");
    $maxRating=$("#maxRating");
    $selector1.slider
    ({
        range: true,
        min: setRatingMin,
        max: setRatingMax,
        values: [setRatingMin, setRatingMax],
        slide: function(event, ui)
        {
            $output1.html(ui.values[ 0 ] + "  To  "+ui.values[ 1 ] );
            $("#minRating").val(ui.values[0]);
            $("#maxRating").val(ui.values[1]);
        }
    });
    
    $output1.html($selector1.slider( "values", 0 ) + "  To  "+$selector1.slider( "values",1) );
    $minRating.val($selector1.slider( "values",0));
    $maxRating.val($selector1.slider( "values",1));
}

function priceSorting()
{
    $(".ui-slider").bind( "slidestop", function() 
    {		
        filter();
    });
}
function filter($sortBy,$order) {
    $('#show_result').show();
    $('#holiday_search_result').hide();

    $category=new Array;
    $(".category").find('.text-nicelabel:checked').each(function() {
        $categoryNum=$(this).val();
        $category.push($categoryNum);
    });
    $categoryVal=$category;
    if($category.length === 0) {
        $categoryVal = '';
    }

    $region=new Array;
    $(".region").find('.text-nicelabel:checked').each(function() {
        $regionNum=$(this).val();
        $region.push($regionNum);
    });
    $regionVal=$region;
    if($region.length === 0) {
        $regionVal = '';
    }

    $theme=new Array;
    $(".theme").find('.themeInput:checked').each(function() {
        $themeNum=$(this).val();
        $theme.push($themeNum);
    });
    $themeVal=$theme;
    if($theme.length === 0) {
        $themeVal = '';
    }

    $cities=new Array;
    $(".cities").find('.citiesInput:checked').each(function() {
        $cityid=$(this).val();
        $cities.push($cityid);
    });
    $cityVal=$cities;
    if($cities.length === 0) {
        $cityVal = '';
    }

    $month=new Array;
    $(".month").find('.text-nicelabel:checked').each(function() {
        $monthNum=$(this).val();
        $month.push($monthNum);
    });
    $monthVal=$month;
    if($month.length === 0) {
        $monthVal = '';
    }

    $duration=new Array;
    $(".duration").find('.durationInput:checked').each(function() {
        $durationNum=$(this).val();
        $duration.push($durationNum);
    });
    $durationVal = $duration;
    if($duration.length === 0) {
        $durationVal = '';
    }

    $minPr = parseFloat($("#minPrice").val());
    $maxPr = parseFloat($("#maxPrice").val());

    $mindur = parseFloat($("#mindur").val());
    $maxdur = parseFloat($("#maxdur").val());

    $minrating = parseFloat($("#minrating").val());
    $maxrating = parseFloat($("#maxrating").val());

    $.post(siteUrl+"holiday/searchresult_ajax", {

        minPrice: ""+$minPr, maxPrice: ""+$maxPr,
        minDur: ""+$mindur, maxDur: ""+$maxdur,
        minRating: ""+$minrating, maxRating: ""+$maxrating,
        categoryVal: ""+$categoryVal, regionVal: ""+$regionVal,
        themeVal: ""+$themeVal, monthVal: ""+$monthVal,
        sortBy: ""+$sortBy, order: ""+$order,
        cityVal: ""+$cityVal, durationVal: ""+$durationVal

    },  

function(data){
 
    $('#show_result').hide();
    $('#holiday_search_result').show();
    $('#holiday_search_result').html(data.holiday_search_result);
    if(data.search_count>0){
        $('.hideonload').show();
        $('#search_count').html(data.search_count);
    }
    else{
        $('.hideonload').hide();
        $('#search_count').html(data.search_count);
    }
    
}, 'json');

}
