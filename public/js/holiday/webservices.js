$(document).ready(function()
    {
         $('#show_result').show();       
         $i = 0;
        load_search_results();
        function load_search_results()
        { 
            $.ajax({
                url: siteUrl + 'holiday/fetch_results',
                data: '',
                dataType: 'json',
                type: 'POST',
                success: function(data)
                { 
                    if(data.holiday_search_result != null){
                      // $('#rapid_fire_draft_loading').hide();
                      $('#show_result').hide();
                      if(data.search_count > 1) {
                        $('.hideonload').show();
                        $('#search_count').html(data.search_count);
                      } else{
                        $('.hideonload').hide();
                        $('#search_count').html('');
                      }
                    }
                    $('#holiday_search_result').html(data.holiday_search_result);
                    
                      //  setPriceSlider();
                      // setdurSlider();
                      // setratingSlider();
                      //  $(".holiday-search-cntr").css("display", "block");
                  }
            });
        }     
    }); 

//  $(document).on("click , change", '.budget-slider , .dur-slider , .temp-slider,.rating-slider', function($e) {
//  filter();
//  });
$(document).on("change", '.custom-radio', function($e) {
  filter();
});
// $(document).on("click", '.Areas', function($e) {
//     filter();
// });

// $(document).on("click", '.HolidaySorting', function($e) 
//  { 
//      $order=$(this).attr("data-order");
//      $sortBy=$(this).attr("rel");
//     $(this).find('i').css("display", "block");
//     $('.HolidaySorting').not(this).find('i').css("display", "none"); 
//     $(this).find('.fa-long-arrow-down').toggleClass('fa-long-arrow-up');
//           filter($sortBy,$order);
//             if($order=="asc")
//                 $(this).attr("data-order",'desc');                    
//             else
//                 $(this).attr("data-order",'asc');
//  });
