$(function() {
			
	//World Wide Cars Locations List 
	$("#pickUpCity,#dropOffCity").autocomplete({
		source: siteUrl+"/home/cars_locations_autolist",
		minLength: 2,
		autoFocus: true
	});	
				

});