$(document).ready(function()
{
	
	$(".VillaSorting").change(function()
	{
		// console.log(132);
		$order = $('option:selected', this).attr('data-order');
		$sortBy = $('option:selected', this).attr('rel');
	    console.log($order);
	    filter($sortBy,$order);
	    if($order=="asc")
	        $(this).find('span').attr("data-order",'desc');                    
	    else
	        $(this).find('span').attr("data-order",'asc');
	   	
	}); 


  $(".reset_filter").click(function()
 {    
    $(".priceRange").each(function()
     { $(this).prop('checked', false); });
    $(".StarRating").each(function()
     { $(this).prop('checked', false); });
     $(".StarRatingLi").each(function()
     { $(this).removeClass('active'); });    
    $(".accommodation").each(function()
     { $(this).prop('checked', false); });
    $(".location_nearby").each(function()
     { $(this).prop('checked', false); });
    $("#villaName").val('');
     // $(".accordion-content").css("display","none");
     // $('.accordion-heading').each(function () {
     //  $(this).find('span').removeClass('fa-angle-down').addClass('fa-angle-right');
     // });   
    filter();
    
 });
	
	$(document).on("click", '.Amenities', function($e) {
	 	filter();
	 });
	
	$(".StarRating").click(function()
	{
		$(this).parent().parent().toggleClass('active');
		filter();
	}); 
 
        
    $(".villaNameSearch").click(function()
	{
		filter();
	});
 
	
});
