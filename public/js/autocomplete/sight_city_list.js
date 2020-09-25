$(function() {
			
   
        //sightseeing city list
         $("#sight_city").autocomplete({ 
		source: siteUrl+"city_list/sightseeing_city_list",
		minLength: 2,
		autoFocus: true
	});


});