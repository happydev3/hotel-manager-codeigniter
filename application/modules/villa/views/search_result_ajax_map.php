<?php for($i=0;$i<count($result);$i++){
  $session_data = $this->session->userdata('villa_search_data');
  // echo '<pre>';print_r($result);exit;
  $cityname = $session_data['cityName'];
  $bedrooms = $session_data['bedrooms'];
  $bathrooms = $session_data['bathrooms'];
  $guests = $session_data['guests'];
  $destination = $result[$i]->cityid;
  
?>

<div class="result-box villa-box">
  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d25778.88844710089!2d-115.1780026!3d36.1334212!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c8c3f7c07ce98b%3A0x9ba92e2a846953c1!2sPalace+Station+villa+%26+Casino!5e0!3m2!1sen!2sin!4v1517807156952" width="100%" height="550" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<?php } ?>

<script type="text/javascript">
  $(document).ready(function() {
    $(".ajax-tabs").on('click', function(e) {
      e.preventDefault();
      var $loadinghtml = "<div class='loaddiv' style='display: none;'><div class='row2' id='loading' style='text-align: center;padding: 30px 0;'><div id='loader' style='position: static;margin: auto;'></div></div></div>";
      var $dataId = $(this).attr('data-id');
      if($dataId == 'maps') {
        $(".ajax-tabs").not('.maps').removeClass('active');
      } else {
        $(".ajax-tabs").removeClass('active');
        return false;
      }
      // console.log($dataId);
      // $("#loaddiv").show();
      $(".ajax-content").hide();
      $(this).toggleClass('active');
      var $ajaxcontent = $(this).closest(".ajax-div").find(".ajax-content");
      $ajaxcontent.find(".resultdiv").html($loadinghtml);

      if($(this).hasClass('active')&&$(this).hasClass('searchAjaxData')) {
        console.log(1);
        $val=$(this).attr('data-val');
        $type=$(this).attr('data-type');
        $.ajax({
          url: '<?php echo site_url();?>/villa/searchAjaxData',
          data: 'val=' + $val+'&type=' + $type,
          dataType: 'json',
          type: 'POST',
          beforeSend: function() {
            $ajaxcontent.show();
            $ajaxcontent.find(".loaddiv").show();
            // return false;
          },
          success: function(data) {
            if(data.type!='') {
              // $('#'+data.type).html('');
              // $('#'+data.type).html(data.result);
              // $html2 = $('#'+data.type).html();
              $ajaxcontent.find(".loaddiv").hide();
              // $ajaxcontent.show();
              $ajaxcontent.find(".resultdiv").html(data.result);
            }
          }
        });
      } else if($(this).hasClass('active')) {
        console.log(2);
        $.ajax({
          // url: 'this.href',
          beforeSend: function() {
            $ajaxcontent.find(".loaddiv").show();
          },
          success: function(html) {
            // console.log($(this));
            $ajaxcontent.find(".loaddiv").hide();
            $this.closest(".ajax-div").find(".ajax-content").show();
            $ajaxcontent.find(".resultdiv").html($html2);
          }
        });
      } else {
        return false;
      }
      return false;
    });
  });
</script>