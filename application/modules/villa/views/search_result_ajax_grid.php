<?php for($i=0;$i<count($result);$i++){
  $session_data = $this->session->userdata('villa_search_data');
  // echo '<pre>';print_r($result);exit;
  $cityname = $session_data['cityName'];
  $bedrooms = $session_data['bedrooms'];
  $bathrooms = $session_data['bathrooms'];
  $guests = $session_data['guests'];
  $destination = $result[$i]->cityid;
  
?>

<div class="result-grid villa-grid result-box htlResultRow searchhotel_box">
  <div class="row left-section HotelInfoBox" id="sort" data-price="<?php echo $result[$i]->price; ?>" data-star="<?php echo $result[$i]->star_rating; ?>" data-hotel-name="<?php echo $result[$i]->property_name; ?>">
    <div class="col-sm-12">
      <div class="htl-img">
        <?php if(!empty($result[$i]->thumb_img)){ ?>
        <img src="<?php echo getResultsThumbnail($result[$i]->thumb_img); ?>" alt="<?php echo $result[$i]->property_name ?>" class="img-responsive">
        <?php } else { ?>
        <img src="<?php echo getResultsThumbnail('public/img/noimage.jpg'); ?>" alt="<?php echo $result[$i]->property_name ?>" class="img-responsive">
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="row no-padding right-section">
    <div class="col-sm-12">
      <div class="grid-content">
        <div class="result-details ajax-div">
          <a href="<?php echo site_url(); ?>villa/villadetails/<?php echo base64_encode('VMNVILLASPACKAGECODE-'.$result[$i]->id); ?>">
            <h3><?php echo $result[$i]->property_name ?> <span class="star star<?php echo $result[$i]->star_rating ?>"></span></h3>
          </a>
          <small><?php echo $result[$i]->address ?>, <?php echo $result[$i]->city_name ?> | <a href="javascript:;" class="maps ajax-tabs searchAjaxData" data-val="<?php echo $result[$i]->property_code ?>" data-type="maps" data-id="maps"><u>Map</u></a></small>
          <div class="row2 ajax-tab-content ajax-content" style="display: none;">
            <div class="resultdiv"></div>
          </div>
        </div>
        <div class="description text-right">
          <div>
            <div class="inclusions text-left">
              <ul>
                <li title="No of People"><i class="fa fa-user-circle"></i> <?php echo $guests ?></li>
                <li title="Bedrooms"><i class="fa fa-bed"></i> <?php echo $bedrooms ?></li>
                <li title="Bathrooms"><i class="fa fa-bath"></i> <?php echo $bathrooms ?></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row no-padding">
          <div class="col-md-12">
            <div class="price-details">
              <a href="<?php echo site_url(); ?>villa/villadetails/<?php echo base64_encode('VMNVILLASPACKAGECODE-'.$result[$i]->id); ?>" class="btn btn-primary book-btn">Book Now</a>
            </div>
            <div class="price-details">
              <h2 class="price-tag">
              <i class="fa fa-dollar"></i><?php echo $result[$i]->price ?> <sub>USD</sub><br>
              <small><?php if($result[$i]->price_type == 1) echo 'per night'; else echo 'per week' ?></small>
              </h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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