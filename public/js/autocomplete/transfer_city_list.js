$(function() {
			
   
        //transfer city pick up
         $("#tran_city").autocomplete({ 
		source: siteUrl+"city_list/transfer_city_list",
		minLength: 2,
		autoFocus: true
	});
        //transfer city drop
         $("#cityName_drop").autocomplete({
       source: siteUrl+"city_list/transfer_city_list",
       minLength: 2,
       autoFocus: true
   });	
 //        // FOR FETCHING THE HOTEL NAME
 //           $("#hotelNameno").autocomplete({ 
	// 	source: siteUrl+"home/get_hotel_name/"+$("#sessionId").val(),
	// 	minLength: 2,
	// 	autoFocus: true
	// });

});