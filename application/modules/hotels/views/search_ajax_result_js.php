   <script type="text/javascript">
$(document).ready(function() {
  $(".ajax-tabs").click(function() {    
    $(".resultdiv").html('');
    var $html2 ='';
    var $this = $(this);
    var $ajaxcontent=$this.parent().parent().find(".ajax-content");    
    var $dataId = $(this).attr('data-id');
    if($dataId == 'map'){
      $html2 = $ajaxcontent.find('.mapdiv').html();
      $(".ajax-tabs").not('.maps').removeClass('active');
    }else if($dataId == 'img'){
      $html2 = $ajaxcontent.find('.imagediv').html();
      $(".ajax-tabs").not('.img').removeClass('active');
    }else if($dataId == 'desc'){
      $html2 = $ajaxcontent.find('.descdiv').html();
      $(".ajax-tabs").not('.desc').removeClass('active');
    }else if($dataId == 'option'){
      $html2 = $ajaxcontent.find('.optionsdiv').html();
      $(".ajax-tabs").not('.option').removeClass('active');
    }else{
      $html2 = '';
      $ajaxcontent.find(".resultdiv").html('');
      $(".ajax-tabs").removeClass('active');
      return false;
    }
    // console.log($dataId);

    // $("#loaddiv").show();
    $(".ajax-content").hide();
    $(this).toggleClass('active');

      if($(this).hasClass('active')&&$(this).hasClass('searchAjaxData')){
         $val=$(this).attr('data-val');
        $type=$(this).attr('data-type');         
          $.ajax({
                url: '<?php echo site_url();?>/hotels/searchAjaxData',
                data: 'val=' + $val+'&type=' + $type,
                dataType: 'json',
                type: 'POST',
                beforeSend: function()
                 {
                  $ajaxcontent.find(".loaddiv").show();
                },              
                success: function(data)
                {
                   if(data.type!='')
                   {
                    $('#'+data.type).html('');
                    $('#'+data.type).html(data.result);
                    $html2=$('#'+data.type).html();
                    $ajaxcontent.find(".loaddiv").hide();
                    $this.parent().parent().find(".ajax-content").show();
                    $ajaxcontent.find(".resultdiv").html($html2);
                 }
               }
        });
      }
   else if($(this).hasClass('active')){
      $.ajax({
        // url: 'this.href',
        beforeSend: function() {
          $ajaxcontent.find(".loaddiv").show();
        },
        success: function(html) {
          // console.log($(this));
          $ajaxcontent.find(".loaddiv").hide();
          $this.parent().parent().find(".ajax-content").show();
          $ajaxcontent.find(".resultdiv").html($html2);
        }
      });
    }
    return false;
  });
});
</script>
<script type="text/javascript">

  //  $('.compare-list').on('click', function(){   
  //   $(this).toggleClass('active');
  //   if($(this).hasClass('active')){
  //       show_message("Hotel added to compare list!");
  //       show_message1('<a  id="compare_hotels" data-toggle="modal" data-target="#modalCompare" style="color: #fff; text-decoration: none;font-weight: 700">'+
  //   'Compare List [<span id="count_comp_result"></span>]'+
  // '</a>')
  //   } else{
  //     show_message("Hotel removed from compare list!");
  //     show_message1('');
  //   }
  // });

  checkcomparelist(0);
  $('.compare-list').on('click', function()
  { 
    $(this).toggleClass('active');
    if($(this).hasClass('active')){
     $.ajax({
            url: siteUrl + 'hotels/addCompareList',
            data: 'val=' + $(this).attr('data-val'),
            dataType: 'json',
            type: 'POST',
            success: function(data)
            {  
                show_message("Hotel added to compare list!");                      
            }           
           });           

    } 
    else
    {
        $.ajax({
                url: siteUrl + 'hotels/removeCompareList',
                data: 'val=' + $(this).attr('data-val'),
                dataType: 'json',
                type: 'POST',
                success: function(data)
                {  
                    show_message("Hotel removed from compare list!");
                      
                 }             
              }); 
     } 

     checkcomparelist(0);       
     
  });


  function checkcomparelist(cnt)
  {
    show_message1('');
    $(".compare-list").each(function(){ 
      if($(this).hasClass('active')){
        cnt++;
      }
   });
    // alert(cnt);
  if(parseInt(cnt)>0)
  {
        show_message1('<a  onclick="compare_hotels()" data-toggle="modal"  style="color: #fff; text-decoration: none;font-weight: 700;cursor: pointer;">'+
    'Compare List [<span>'+cnt+'</span>]'+
  '</a>');     
    } 
    else
    {      
      show_message1('');
    }
  }

   function compare_hotels(){
    $('#compare_results').html('');
    $('#modalCompare').modal('hide');
      $cnt=0;
      $compareArr=new Array; 
      $ses_id = '<?php echo $result->session_id; ?>';
        $(".compare-list").each(function()
        {
            if ($(this).hasClass('active')) 
            {
                $compareNum=$(this).attr('data-id');
                $compareArr.push($compareNum); 
                 $cnt++;
            }      
            
        });
        if(parseInt($cnt)>0)
        {
          $.post(siteUrl+"hotels/compareListAjax", {ses_id : ""+$ses_id,compare_list: ""+$compareArr},      
            function(data)
                    {
                         $('#compare_results').html('');
                         $('#compare_results').html(data.compare_results);
                         $('#modalCompare').modal('show');
                    }, 'json');
        }

   }

  $('.wish-list').on('click', function(){
    if($('#ischecklogin').attr('data-val')=='no'){
      showmodalLogin();
      return false;
   } else { 
    $(this).toggleClass('active');
    if($(this).hasClass('active')){
        $.ajax({
                url: siteUrl + 'hotels/addWishList',
                data: 'val=' + $(this).attr('data-val'),
                dataType: 'json',
                type: 'POST',
                success: function(data)
                {  
                    show_message("Hotel added to wishlist!");
                      
                 }                
                
              });

     
    } else{
         $.ajax({
                url: siteUrl + 'hotels/removeWishList',
                data: 'val=' + $(this).attr('data-val'),
                dataType: 'json',
                type: 'POST',
                success: function(data)
                {  
                    show_message("Hotel removed from wishlist!");
                      
                 }                
                
              });      
    }
      }  
  });

  function show_message($msg){
    // console.log($msg);
    $("#msg").html($msg);
    $top = Math.max(0, (($(window).width()/2 - $("#msg").outerWidth()) / 2)) + "px";
    $left = Math.max(0,(($(window).width() - $("#msg").outerWidth()) / 2) + $(window).scrollLeft()) + "px";
    $("#msg").css("left",$left);
    $("#msg").animate({opacity: 0.6,top: $top}, 400,function(){
      $(this).css({'opacity':1});
    }).show();

    setTimeout(function(){$("#msg").animate({opacity: 0.6,top: "0px"}, 400,function(){
      $(this).hide();
    });},1000);
  }


   function show_message1($msg){
    // console.log($msg);
    if($msg!=''){
    $("#comparemsg").html($msg);
    $top = Math.max(0, (($(window).width()/2 - $("#comparemsg").outerWidth()) / 2)) + "px";
    $left = Math.max(0,(($(window).width() - $("#comparemsg").outerWidth()) / 2) + $(window).scrollLeft()) + "px";
    $("#comparemsg").css("right",'0px');
    $("#comparemsg").animate({opacity: 0.6,top: $top}, 400,function(){
      $(this).css({'opacity':1});
    }).show();

    // setTimeout(function(){$("#comparemsg").animate({opacity: 0.6,top: "0px"}, 400,function(){
    //   $(this).hide();
    // });},1000);
  }
  else
  {
    $("#comparemsg").hide();
  }
}


</script>