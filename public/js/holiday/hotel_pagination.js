function initPagination(total){	
	var page_limit = 5;	
	$("#pagination_up,#pagination_down").pagination({
        	items: total,
        	itemsOnPage: page_limit,
		displayedPages: 3,
        	cssStyle: 'light-theme',
		onPageClick: function(pageNumber){			
			var start_count = (pageNumber-1)*page_limit;
			var end_count = start_count + page_limit-1;

			$('#avail_hotels div.searchhotel_box').not('.searchhoteldisable').each(function(k,v){
				
					if( k >= start_count && k <= end_count ){
						$(this).show();
					} else {
						$(this).hide();
					}
				
			});			
			return false;
		}
    	});
	$("#pagination_up,#pagination_down").pagination('selectPage', '1');
}
