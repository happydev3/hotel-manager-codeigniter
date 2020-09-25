$(function() {
	
        /* Clearable flight search input */	
	if( $('#fromCity').val() != '' ) $('#fromCity').addClass('x');
	if( $('#toCity').val() != '' ) $('#toCity').addClass('x');
        
        //World Wide Airport List 
	$( "#fromCity" ).autocomplete({			
		source: siteUrl+"city_list/airport_autolist?exclude="+$("input[name='destination']").val(),		
		minLength: 2,
		autoFocus: true,                           
		select: function( event, ui ) {
			if( ui.item.id == '' ) return false;
			$("input[name='origin']").val(ui.item.id);
			$( "#toCity" ).autocomplete( "option", "source", siteUrl+"city_list/airport_autolist?exclude="+$("input[name='origin']").val() );

			/* For auto tab */
			if( $('#toCity').val() != '' ) 
                            $('#dpf1').focus();
			else 
                            $('#toCity').focus();
		},
		change: function(event, ui) {
			if( ui.item == null || ui.item.id == '' ) $(this).val('');
		}
                //search: function(){$(this).addClass('auto-loading');},   
                //open: function() {}
                //close: function() {}
	});
        
        $( "#toCity" ).autocomplete({			
		source: siteUrl+"city_list/airport_autolist?exclude="+$("input[name='origin']").val(),
		minLength: 2,
		autoFocus: true,               
		select: function( event, ui ) {
			if( ui.item.id == '' ) return false;
			$("input[name='destination']").val(ui.item.id);
			$( "#fromCity" ).autocomplete( "option", "source", siteUrl+"city_list/airport_autolist?exclude="+$("input[name='destination']").val() );
			
			/* For auto tab */
			if( $('#fromCity').val() != '' ) 
                            $('#dpf1').focus();
			else 
                            $('#fromCity').focus();
		},
		change: function(event, ui) {
			if( ui.item == null || ui.item.id == '' ) $(this).val('');
		}
                //search: function(){$(this).addClass('auto-loading');},   
                //open: function() {}
                //close: function() {}
	});       
        
   
});

$(document).on('click','.onX',function(e){
    
    $Id = $(this).attr('id');
  
    if( $Id == 'fromCity' ) 
        $("input[name='origin']").val('');
    if( $Id == 'toCity'  ) 
        $("input[name='destination']").val('');
 });