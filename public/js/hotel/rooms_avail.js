$(document).ready(function()
 {
	$.ajax({
			  type: 'POST',
			  url: siteUrl+'hotels/rooms_availability',
			  data: 'callBackId='+callbackId+'&sessionId='+sessionId+'&hotelCode='+hotelId+'&searchId='+searchId+'&contract='+contract,
			  async: true,
			  dataType: 'json',
			  beforeSend:function()
			  {

			 },
			success: function(data)
			{
				$("#rooms_info").html(data.rooms_result);
		  	},
		 	error:function(request, status, error)
			{
				$("#rooms_info").html('<div class="row" style="border: 1px solid #A1A1A1;border-radius: 5px;margin: 5px 0;"><div class="error" style="text-align:center;">Sorry, No Rooms are available. Search for another Hotel.</div></div>');
		  	}

	});

	$.ajax({
			  type: 'POST',
			  url: siteUrl+'hotels/nearby_hotels',
			  data: 'callBackId='+callbackId+'&sessionId='+sessionId+'&hotelCode='+hotelId+'&latitude='+latitude+'&longitude='+longitude+'&city='+city,
			  async: true,
			  dataType: 'json',
			  beforeSend:function()
			  {
				  $(".hotelloader").show();
			 },
			success: function(data)
			{
				if(data.nearby_hotels != '' && data.related_hotels != '')
				{
					$("#nearby_hotels").html(data.nearby_hotels);
					$("#related_hotels").html(data.related_hotels);
				}
				else
				{
					$(".hotelloader").hide();
				}
		  	},
		 	error:function(request, status, error)
			{
				$(".hotelloader").hide();
		  	}

	});


});

$(document).on('click','.htl-ind-rm-dtls',function()
{
	$(this).parents('.htl-rm-detail').find('#htl-ind-details').slideToggle(600);
	$(this).find('i').toggleClass('fa-caret-up');

});
