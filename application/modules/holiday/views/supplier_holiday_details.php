<?php $this->load->view('home/header');?>
<?php
$cities=explode(',', $package_details->city_covering);
$countries='';
$continents='';
$country_id_array=array();
$continent_id_array=array();
for($i=0;$i<count($cities);$i++){
  $city_res=$this->Holiday_Model->get_city_details($cities[$i]);
  $country_id_array[]=$city_res->country_id;
}
$countryId=array_unique($country_id_array);
for($i=0;$i<count($countryId);$i++){
  $country_res=$this->Holiday_Model->get_country_details($countryId[$i]);
  $continent_id_array[]=$country_res->continent_id;
  if((($i+1)!=count($countryId))){
    $countries.=$country_res->country_name.', ';
  } else{
    $countries.=$country_res->country_name;
  }
}
$continentId=array_unique($continent_id_array);
for($i=0;$i<count($continentId);$i++){
  $continent_res=$this->Holiday_Model->get_continent_details($continentId[$i]);
  if((($i+1)!=count($continentId))){
    $continents.=$continent_res->continent_name.', ';
  } else{
    $continents.=$continent_res->continent_name;
  }
}
?>
<!-- breadcumb -->
<section class="padding-t-b-10">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 breadcrumb2">
        <span>Holiday / <?php echo $continents; ?> / <?php echo $countries; ?> / <?php echo $package_details->holiday_name; ?></span>
      </div>
    </div>
  </div>
</section>
<!--   Content Search Area   -->
<section class="bg-grey padding-t-b-15">
  <div class="container">
    <div class="row flightResultsSection">
      <!-- Advance Search  -->
      <?php $this->load->view('home/advance_search');?>
      <!-- End -->
      <div class="col-md-12">
        <div class="shadow-box white-container holiday_details_col margin-t0">
          <div class="row">
            <div class="col-sm-9">
              <div class="packge_head">
                <h2 style="display: inline-block;"><?php echo $package_details->holiday_name; ?></h2>&nbsp;&nbsp;<span class="text-red" style=" position: relative;top: -4px;left: 5px;" >|&nbsp;&nbsp;Code: <?php echo $package_details->holiday_code; ?></span>
                <p><span><?php custom_echo($package_details->short_desc, 220); ?></span></p>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="like_share_pos2 text-right">
                <a>
                  <span class="like_share p_like"></span>
                </a>
                <a>
                  <span class="like_share p_share"></span>
                </a>
                <a>
                  <img style="position: relative;top: -7px;" src="<?php echo base_url(); ?>public/images/pdf.png">
                </a>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- Thumbnail Gallery -->
            <div class="thumbgallery col-sm-9" id="main" role="main">
              <section class="slider">
                <div id="slider" class="flexslider">
                  <ul class="slides">
                    <?php
                    if(!empty($thumbgallery)){
                    for($gt=0;$gt<count($thumbgallery);$gt++){
                    
                    $str=base_url().'supplier/'.$thumbgallery[$gt]->gallery_img;
                    $str=get_image_aws($thumbgallery[$gt]->gallery_img);
                    if(getimagesize($str) !== false) {  ?>
                    <li data-thumb="<?php echo $str; ?>">
                      <img src="<?php echo $str; ?>" alt="" class="img-responsive" style="width:100%;height:330px;" />
                    </li>
                    <?php } else { ?>
                    <li data-thumb="<?php echo get_image_aws('public/img/noimage.jpg') ?>">
                      <img src="<?php echo get_image_aws('public/img/noimage.jpg') ?>" alt="" class="img-responsive" style="width:100%;" />
                    </li>
                    <?php } ?>
                    <?php } } else { ?>
                    <li data-thumb="<?php echo get_image_aws('public/img/noimage.jpg') ?>">
                      <img src="<?php echo get_image_aws('public/img/noimage.jpg') ?>" alt="" style="width:100%;" />
                    </li>
                    <?php } ?>
                  </ul>
                </div>
                <div id="carousel" class="flexslider">
                  <ul class="slides">
                    <?php
                    if(!empty($thumbgallery)){
                    for($gt=0;$gt<count($thumbgallery);$gt++){
                    
                    $str=base_url().'supplier/'.$thumbgallery[$gt]->gallery_img;
                    if(getimagesize($str) !== false) {  ?>
                    <li data-thumb="<?php echo $str; ?>">
                      <img src="<?php echo $str; ?>" alt="" class="img-responsive" style="width:139px;height:50px;" />
                    </li>
                    <?php } else { ?>
                    <li data-thumb="<?php echo get_image_aws('public/img/noimage.jpg') ?>">
                      <img src="<?php echo get_image_aws('public/img/noimage.jpg') ?>" alt="" class="img-responsive" style="width:139px;height:50px;" />
                    </li>
                    <?php } ?>
                    <?php } } else { ?>
                    <li data-thumb="<?php echo get_image_aws('public/img/noimage.jpg') ?>">
                      <img src="<?php echo get_image_aws('public/img/noimage.jpg') ?>" alt="" style="width:139px;height:50px;" />
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </section>
            </div>
            <!-- End Thumbnail Gallery -->
            <div class="col-sm-3 packge_detail_col">
              <div class="packge_detail">
                <?php if(!empty($package_details->star_rating)){ ?>
                <div class="small_box">
                  <span class="review-text">Reviews</span>
                  <!-- <span class="star star<?php //echo $package_details->star_rating;?>"></span> -->
                  <!-- <div class="reviews_title">REVIEWS</div> -->
                  <div class="review-rating"><?php echo $package_details->star_rating;?> / 5</div>
                </div>
                <?php } ?>
                <?php if(!empty($package_details->themes)&&$package_details->themes!=$info){ ?>
                <div class="small_box">
                  <span>Theme</span>
                  <span class="text-red">
                    <?php
                    $themes=explode(',',$package_details->themes);
                    $theme_str=array();
                    for($k=0;$k<count($themes);$k++)
                    {
                    if(!empty($themelistarrary[$themes[$k]])){
                    $theme_str[]=$themelistarrary[$themes[$k]];
                    }
                    }
                    echo implode(', ', $theme_str);
                    ?>
                  </span>
                </div>
                <?php } ?>
                <?php if(!empty($package_details->accomodation_type)){
                $accomodation_type=explode(',', $package_details->accomodation_type);
                $accomodation_str = array();
                foreach($accomodation_type as $acc){
                $accomodation_str[] = $acc;
                }
                ?>
                <div class="small_box">
                  <span>Accommodation</span>
                  <span class="text-red"><?php echo implode(', ',$accomodation_str) ?></span>
                </div>
                <?php } ?>
                <div class="price_box">
                  <span class="block font-b">Price Starting From</span>
                  <span>
                    <?php if(!empty($economy_rates)) { ?>
                      <span class="block">Economy: INR <?php echo number_format($economy_rates[0]->adults_two) ?></span>
                    <?php } ?>
                    <?php if(!empty($superior_rates)) { ?>
                      <span class="block">Superior: INR <?php echo number_format($superior_rates[0]->adults_two) ?></span>
                    <?php } ?>
                    <?php if(!empty($first_class_rates)) { ?>
                      <span class="block">First class: INR <?php echo number_format($first_class_rates[0]->adults_two) ?></span>
                    <?php } ?>
                    <?php if(!empty($luxury_rates)) { ?>
                      <span class="block">Luxury: INR <?php echo number_format($luxury_rates[0]->adults_two) ?></span>
                    <?php } ?>
                    <br>
                    <form action="<?php echo site_url() ?>holiday/select_package_rate" method="POST">
                      <input type="hidden" name="package_id" value="<?php echo $package_details->id; ?>">
                      <button class="btn btn-danger btn_price">Continue to Book</button>
                    </form>
                  </span>
                </div>
              </div>
              <div class="enq_box">
                <button data-toggle="modal" data-target="#enquiry_request" class="btn btn-primary enq-btn form-control">Enquiry <i class="fa fa-caret-right"></i></button>
              </div>
            </div>
          </div>
          <div class="row margin-t-20 details_tab">
            <div class="col-sm-12">
              <ul class="nav nav-tabs" role="tablist">
                <?php  if(!empty($package_details->overview) && ($package_details->overview!=$info)){ ?>
                <li role="presentation" class="active"><a href="#Overview" aria-controls="Overview" role="tab" data-toggle="tab">Overview</a></li>
                <?php } ?>
                <?php  if(!empty($package_details->highlights) && ($package_details->highlights!=$info)){ ?>
                <li role="presentation" class=""><a href="#Highlight" aria-controls="Highlight" role="tab" data-toggle="tab">Highlights</a></li>
                <?php }?>
                <?php if(!empty($package_itinerary)){ ?>
                <li role="presentation" class=""><a href="#Itinerary" aria-controls="Itinerary" role="tab" data-toggle="tab">Itinerary</a></li>
                <?php  } ?>
                <?php if((!empty($package_details->includes)&&($package_details->includes!=$info))||(!empty($package_details->excludes)&&($package_details->excludes!=$info))){ ?>
                <li role="presentation" class=""><a href="#Inclusion-Exclusion" aria-controls="Inclusion-Exclusion" role="tab" data-toggle="tab">Inclusions &amp; Exclusions</a></li>
                <?php } ?>
                <?php
                if((!empty($package_details->cancellation_policy)||!empty($package_details->child_policy)||!empty($package_details->pet_policy)||!empty($package_details->voltage)||!empty($package_details->currency)||!empty($package_details->passport_visa)||!empty($package_details->medical_health)||!empty($package_details->travel_insurance)||!empty($package_details->weather)||!empty($package_details->food_requirement)||!empty($package_details->safety)||!empty($package_details->clothing)||!empty($package_details->accomodation)||!empty($package_details->insurance)) && ($package_details->cancellation_policy!=$info||$package_details->child_policy!=$info||$package_details->pet_policy!=$info||$package_details->voltage!=$info||$package_details->currency!=$info||$package_details->passport_visa!=$info||$package_details->medical_health!=$info||$package_details->travel_insurance!=$info||$package_details->weather!=$info||$package_details->food_requirement!=$info||$package_details->safety!=$info||$package_details->clothing!=$info||$package_details->accomodation!=$info||$package_details->insurance!=$info)){
                ?>
                <li role="presentation" class=""><a href="#ImportantInfo" aria-controls="ImportantInfo" role="tab" data-toggle="tab">Important Info</a></li>
                <?php } ?>
                <?php
                $countarr = array();
                foreach ($package_itinerary as $value) {
                  if(!empty($value->hotelaccomodation)){
                    $countarr[] = $value->hotelaccomodation;
                  }
                }
                ?>
                <?php if(!empty($countarr)) { ?>
                <li role="presentation" class=""><a href="#Accommodation" aria-controls="Accommodation" role="tab" data-toggle="tab">Accommodation</a></li>
                <?php } ?>
                <?php  if(!empty($activity)){ ?>
                <li role="presentation" class=""><a href="#Activity" aria-controls="Activity" role="tab" data-toggle="tab">Activity</a></li>
                <?php } ?>
                <?php  if(!empty($attraction)){ ?>
                <li role="presentation" class=""><a href="#Attraction" aria-controls="Attraction" role="tab" data-toggle="tab">Attraction</a></li>
                <?php } ?>
                <?php if(!empty($route_info)){ ?>
                <li role="presentation" class=""><a href="#Routemap" aria-controls="Routemap" role="tab" data-toggle="tab" id="maptab">Route Map</a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php  if(!empty($package_details->overview) && ($package_details->overview!=$info)){ ?>
                <div role="tabpanel" class="tab-pane active" id="Overview"><?php echo $package_details->overview; ?></div>
                <?php } ?>

                <?php  if(!empty($package_details->highlights) && ($package_details->highlights!=$info)){ ?>
                <div role="tabpanel" class="tab-pane" id="Highlight"><?php echo $package_details->highlights; ?></div>
                <?php } ?>
                
                <?php if((!empty($package_details->includes)&&($package_details->includes!=$info))||(!empty($package_details->excludes)&&($package_details->excludes!=$info))){ ?>
                <div role="tabpanel" class="tab-pane" id="Inclusion-Exclusion">
                  <div class="row">
                    <?php if(!empty($package_details->includes)){ ?>
                    <div class="col-sm-6">
                      <h5>What's included</h5>
                      <?php echo $package_details->includes; ?>
                    </div>
                    <?php } ?>
                    <?php if(!empty($package_details->excludes)){ ?>
                    <div class="col-sm-6">
                      <h5>What's excluded</h5>
                      <?php echo $package_details->excludes; ?>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <?php } ?>
                <?php if(!empty($package_itinerary)) { ?>
                <div role="tabpanel" class="tab-pane" id="Itinerary">
                  <div class="row day_itinery">
                    <div class="col-sm-12 i_outtext text-red" id="i_outtext">Collapse All</div>
                    <div class="col-sm-12" id="day_itinery_details">
                      <div class="panel-group">
                        <?php for($i=0;$i<count($package_itinerary);$i++){ ?>
                        <div class="panel panel-default">
                          <div class="panel-heading toggleHeading">
                            <h4 class="panel-title row">
                              <div class="col-sm-8 col-xs-7">
                                <?php
                                $city_arr=explode(',', $package_itinerary[$i]->itinerary_destination);
                                // echo '<pre>';print_r($city_arr);exit;
                                $img_cityid = $city_arr[0];
                                $cityname='';
                                // $continent_id_array=array();
                                for($k=0;$k<count($city_arr);$k++){
                                $city_res=$this->Holiday_Model->get_city_details($city_arr[$k]);
                                $city_res2=$this->Holiday_Model->get_city_details($city_arr[0]);
                                $img_cityname = $city_res2->city_name;
                                if((($k+1)!=count($city_arr)))
                                $cityname.=$city_res->city_name.', ';
                                else
                                $cityname.=$city_res->city_name;
                                // echo '<pre>';print_r($cityname);exit;
                                } ?>
                                <span class="i_day">Day <?php echo $package_itinerary[$i]->day_count;?> </span><span style="display: inline"><img src="<?php echo base_url(); ?>public/img/location_black.png"><?php echo $cityname ?></span>
                              </div>
                              <div class="col-sm-4 col-xs-5">
                                <?php
                                  $iti_meals=explode(',', $package_itinerary[$i]->itinerary_meals);
                                  $meal='';
                                  for($itm=0;$itm<count($iti_meals);$itm++){
                                  if(($itm+1)==count($iti_meals)){
                                  if($iti_meals[$itm]=='B')
                                  $meal.='Breakfast';
                                  if($iti_meals[$itm]=='L')
                                  $meal.='Lunch';
                                  if($iti_meals[$itm]=='D')
                                  $meal.='Dinner';
                                  }
                                  else
                                  {
                                  if($iti_meals[$itm]=='B')
                                  $meal.='Breakfast, ';
                                  if($iti_meals[$itm]=='L')
                                  $meal.='Lunch, ';
                                  if($iti_meals[$itm]=='D')
                                  $meal.='Dinner, ';
                                  }
                                  }
                                ?>
                                <?php if(!empty($meal)) { ?>
                                  <span class="i_meals">MEALS: <?php echo $meal; ?></span>
                                <?php } ?>
                                <div class="p-m-icon">
                                  <span class="pull-right plus-minus">
                                    <?php if($i==0){  ?>
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                    <?php } else { ?>
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                    <?php } ?>
                                  </span>
                                </div>
                              </div>
                            </h4>
                          </div>
                          <?php if($i==0){ ?>
                          <div class="collapse in toggleBody">
                          <?php } else { ?>
                          <div class="collapse in toggleBody">
                          <?php } ?>
                            <div class="panel-body">
                              <?php echo $package_itinerary[$i]->itinerary_description;?>
                              <div class="row">
                                <div class="col-sm-4">
                                  <?php
                                      $citygall_img = $this->Holiday_Model->check_gallery_img($img_cityid,'destination_images','city_id');
                                  ?>
                                  <?php if($citygall_img != ''){ ?>
                                  <a class="label label-danger gallery_label" id="image-<?php echo $img_cityid; ?>" acco_id="<?php echo $img_cityid; ?>" hotel_name="<?php echo $img_cityname; ?>" table_name="destination_images" id_column="city_id" active_day=""><i class="fa fa-camera"></i></a>
                                  <?php } ?>
                                </div>
                              </div>
                            </div>
                          <?php if($i==0){ ?></div><?php } else { ?></div><?php } ?>
                        </div>
                        <?php } ?>
                      </div>
                      <div id="editor"></div>
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div role="tabpanel" class="tab-pane day_itinery" id="ImportantInfo">
                  <div class="col-sm-12 i_outtext text-red">Collapse All</div>
                  <div class="panel-group">
                    <?php if(!empty($package_details->cancellation_policy)&& $package_details->cancellation_policy!=$info){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading toggleHeading">
                        <h4 class="panel-title row">
                        <div class="col-sm-9 col-xs-8">
                          <span class="">Cancellation Policy</span>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                          <span class="p-m-icon">
                            <span class="pull-right plus-minus">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                          </span>
                        </div>
                        </h4>
                      </div>
                      <div class="collapse in toggleBody">
                        <div class="panel-body">
                          <p> <?php echo $package_details->cancellation_policy; ?></p>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(!empty($package_details->child_policy) && $package_details->child_policy!=$info){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading toggleHeading">
                        <h4 class="panel-title row">
                        <div class="col-sm-9 col-xs-8">
                          <span class="">Child Policy</span>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                          <span class="p-m-icon">
                            <span class="pull-right plus-minus">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                          </span>
                        </div>
                        </h4>
                      </div>
                      <div class="collapse in toggleBody">
                        <div class="panel-body">
                          <p> <?php echo $package_details->child_policy; ?></p>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(!empty($package_details->pet_policy)&& $package_details->pet_policy!=$info){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading toggleHeading">
                        <h4 class="panel-title row">
                        <div class="col-sm-9 col-xs-8">
                          <span class="">Pet Policy</span>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                          <span class="p-m-icon">
                            <span class="pull-right plus-minus">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                          </span>
                        </div>
                        </h4>
                      </div>
                      <div class="collapse in toggleBody">
                        <div class="panel-body">
                          <p> <?php echo $package_details->pet_policy; ?></p>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(!empty($package_details->voltage)&& $package_details->voltage!=$info){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading toggleHeading">
                        <h4 class="panel-title row">
                        <div class="col-sm-9 col-xs-8">
                          <span class="">Voltage</span>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                          <span class="p-m-icon">
                            <span class="pull-right plus-minus">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                          </span>
                        </div>
                        </h4>
                      </div>
                      <div class="collapse in toggleBody">
                        <div class="panel-body">
                          <p> <?php echo $package_details->voltage; ?></p>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(!empty($package_details->currency)&& $package_details->currency!=$info){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading toggleHeading">
                        <h4 class="panel-title row">
                        <div class="col-sm-9 col-xs-8">
                          <span class="">Currency</span>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                          <span class="p-m-icon">
                            <span class="pull-right plus-minus">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                          </span>
                        </div>
                        </h4>
                      </div>
                      <div class="collapse in toggleBody">
                        <div class="panel-body">
                          <p> <?php echo $package_details->currency; ?></p>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(!empty($package_details->passport_visa)&& $package_details->passport_visa!=$info){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading toggleHeading">
                        <h4 class="panel-title row">
                        <div class="col-sm-9 col-xs-8">
                          <span class="">Passport/Visa</span>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                          <span class="p-m-icon">
                            <span class="pull-right plus-minus">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                          </span>
                        </div>
                        </h4>
                      </div>
                      <div class="collapse in toggleBody">
                        <div class="panel-body">
                          <p> <?php echo $package_details->passport_visa; ?></p>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(!empty($package_details->medical_health)&& $package_details->medical_health!=$info){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading toggleHeading">
                        <h4 class="panel-title row">
                        <div class="col-sm-9 col-xs-8">
                          <span class="">Medical Health</span>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                          <span class="p-m-icon">
                            <span class="pull-right plus-minus">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                          </span>
                        </div>
                        </h4>
                      </div>
                      <div class="collapse in toggleBody">
                        <div class="panel-body">
                          <p> <?php echo $package_details->medical_health; ?></p>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(!empty($package_details->travel_insurance)&& $package_details->insurance!=$info){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading toggleHeading">
                        <h4 class="panel-title row">
                        <div class="col-sm-9 col-xs-8">
                          <span class="">Travel Insurance</span>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                          <span class="p-m-icon">
                            <span class="pull-right plus-minus">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                          </span>
                        </div>
                        </h4>
                      </div>
                      <div class="collapse in toggleBody">
                        <div class="panel-body">
                          <p> <?php echo $package_details->travel_insurance; ?></p>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(!empty($package_details->weather)&& $package_details->weather!=$info){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading toggleHeading">
                        <h4 class="panel-title row">
                        <div class="col-sm-9 col-xs-8">
                          <span class="">Weather</span>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                          <span class="p-m-icon">
                            <span class="pull-right plus-minus">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                          </span>
                        </div>
                        </h4>
                      </div>
                      <div class="collapse in toggleBody">
                        <div class="panel-body">
                          <p> <?php echo $package_details->weather; ?></p>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(!empty($package_details->food_requirement)&& $package_details->food_requirement!=$info){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading toggleHeading">
                        <h4 class="panel-title row">
                        <div class="col-sm-9 col-xs-8">
                          <span class="">Food and Dietary Requirements</span>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                          <span class="p-m-icon">
                            <span class="pull-right plus-minus">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                          </span>
                        </div>
                        </h4>
                      </div>
                      <div class="collapse in toggleBody">
                        <div class="panel-body">
                          <p> <?php echo $package_details->food_requirement; ?></p>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(!empty($package_details->safety)&& $package_details->safety!=$info){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading toggleHeading">
                        <h4 class="panel-title row">
                        <div class="col-sm-9 col-xs-8">
                          <span class="">Safety</span>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                          <span class="p-m-icon">
                            <span class="pull-right plus-minus">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                          </span>
                        </div>
                        </h4>
                      </div>
                      <div class="collapse in toggleBody">
                        <div class="panel-body">
                          <p> <?php echo $package_details->safety; ?></p>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(!empty($package_details->clothing)&& $package_details->clothing!=$info){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading toggleHeading">
                        <h4 class="panel-title row">
                        <div class="col-sm-9 col-xs-8">
                          <span class="">Clothing</span>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                          <span class="p-m-icon">
                            <span class="pull-right plus-minus">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                          </span>
                        </div>
                        </h4>
                      </div>
                      <div class="collapse in toggleBody">
                        <div class="panel-body">
                          <p> <?php echo $package_details->clothing; ?></p>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(!empty($package_details->accomodation)&& $package_details->accomodation!=$info){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading toggleHeading">
                        <h4 class="panel-title row">
                        <div class="col-sm-9 col-xs-8">
                          <span class="">Accommodation</span>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                          <span class="p-m-icon">
                            <span class="pull-right plus-minus">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                          </span>
                        </div>
                        </h4>
                      </div>
                      <div class="collapse in toggleBody">
                        <div class="panel-body">
                          <p> <?php echo $package_details->accomodation; ?></p>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(!empty($package_details->insurance)&& $package_details->insurance!=$info){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading toggleHeading">
                        <h4 class="panel-title row">
                        <div class="col-sm-9 col-xs-8">
                          <span class="">Insurance</span>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                          <span class="p-m-icon">
                            <span class="pull-right plus-minus">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                          </span>
                        </div>
                        </h4>
                      </div>
                      <div class="collapse in toggleBody">
                        <div class="panel-body">
                          <p> <?php echo $package_details->insurance; ?></p>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <?php if(!empty($countarr)) { ?>
                <div role="tabpanel" class="tab-pane" id="Accommodation">
                  <div class="table-responsive">
                    <table class="table table-condensed table-striped table-bordered table-hover no-margin" style="font-size: 14px;">
                      <thead>
                        <tr>
                          <th style="width: 5%">Days</th>
                          <th style="width: 32%">Economy</th>
                          <th style="width: 32%">Superior</th>
                          <th style="width: 32%">First Class</th>
                          <!-- <th style="width: 15%">City</th> -->
                          <!-- <th style="width: 16%">Itinerary</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // $counts = count(array_keys($package_itinerary, 'hotelaccomodation'));
                        // echo '<pre>'; print_r(count($countarr));exit;
                        for($i=0;$i<count($countarr);$i++){
                        
                        $hotels = explode('|2|',$package_itinerary[$i]->hotelaccomodation);
                        $hotels2 = explode('|3|',$hotels[1]);
                        $acco1 = explode(',', $hotels[0]);
                        $acco2 = explode(',', $hotels2[0]);
                        $acco3 = explode(',', $hotels2[1]);
                        // echo '<pre>'; print_r($acco1);exit;
                        // $acco_type = explode(',',$hoteldetails->accomodation_type);
                        // echo '<pre>';print_r($hoteldetails);//exit;
                        ?>
                          <tr>
                            <td>Day <?php echo $i+1; ?></td>
                            <td>
                              <?php
                              if(!empty($acco1)){
                              foreach($acco1 as $val){
                                $hoteldetails = $this->Holiday_Model->get_accomodation($val);
                                $city_info1 = $this->Holiday_Model->get_city_details($hoteldetails->hotel_city);
                                $gall_img1 = $this->Holiday_Model->check_gallery_img($hoteldetails->id,'accomodation_images','accomodation_id');
                              ?>
                              <?php echo $hoteldetails->hotel_name; ?>
                              <?php if(!empty($city_info1->city_name)){ ?>
                              <?php echo ' - '.$city_info1->city_name; ?>
                              <?php } ?>
                              <?php if(!empty($hoteldetails->description)){ ?>
                              <a class="label label-default acco_label" acco_id="<?php echo $hoteldetails->id; ?>">Description</a>
                              <?php } ?>
                              <?php if(!empty($hoteldetails->description) && $gall_img1 != ''){ ?> | <?php } ?>
                              <?php if($gall_img1 != ''){ ?>
                              <a class="label label-default gallery_label" id="image-<?php echo $hoteldetails->id; ?>" acco_id="<?php echo $hoteldetails->id; ?>" hotel_name="<?php echo $hoteldetails->hotel_name; ?>" table_name="accomodation_images" id_column="accomodation_id" active_day=""><i class="fa fa-camera"></i></a>
                              <?php } ?>
                              <?php echo '<br>'; } } ?>
                            </td>
                            <td>
                              <?php
                              if(!empty($acco2)){
                              foreach($acco2 as $val){
                                $hoteldetails2 = $this->Holiday_Model->get_accomodation($val);
                                $city_info2 = $this->Holiday_Model->get_city_details($hoteldetails2->hotel_city);
                                $gall_img2 = $this->Holiday_Model->check_gallery_img($hoteldetails2->id,'accomodation_images','accomodation_id');
                              ?>
                              <?php echo $hoteldetails2->hotel_name; ?>
                              <?php if(!empty($city_info2->city_name)){ ?>
                              <?php echo ' - '.$city_info2->city_name; ?>
                              <?php } ?>
                              <?php if(!empty($hoteldetails2->description)){ ?>
                              <a class="label label-default acco_label" acco_id="<?php echo $hoteldetails2->id; ?>">Description</a>
                              <?php } ?>
                              <?php if(!empty($hoteldetails2->description) && $gall_img2 != ''){ ?> | <?php } ?>
                              <?php if($gall_img2 != ''){ ?>
                              <a class="label label-default gallery_label" id="image-<?php echo $hoteldetails2->id; ?>" acco_id="<?php echo $hoteldetails2->id; ?>" hotel_name="<?php echo $hoteldetails2->hotel_name; ?>" table_name="accomodation_images" id_column="accomodation_id" active_day=""><i class="fa fa-camera"></i></a>
                              <?php } ?>
                              <?php echo '<br>'; } } ?>
                            </td>
                            <td>
                              <?php
                              if(!empty($acco3)){
                              foreach($acco3 as $val3){
                                $hoteldetails3 = $this->Holiday_Model->get_accomodation($val3);
                                $city_info3 = $this->Holiday_Model->get_city_details($hoteldetails3->hotel_city);
                                $gall_img3 = $this->Holiday_Model->check_gallery_img($hoteldetails3->id,'accomodation_images','accomodation_id');
                              ?>
                              <?php echo $hoteldetails3->hotel_name; ?>
                              <?php if(!empty($city_info3->city_name)){ ?>
                              <?php echo ' - '.$city_info3->city_name; ?>
                              <?php } ?>
                              <?php if(!empty($hoteldetails3->description)){ ?>
                              <a class="label label-default acco_label" acco_id="<?php echo $hoteldetails3->id; ?>">Description</a>
                              <?php } ?>
                              <?php if(!empty($hoteldetails3->description) && $gall_img3 != ''){ ?> | <?php } ?>
                              <?php if($gall_img3 != ''){ ?>
                              <a class="label label-default gallery_label" id="image-<?php echo $hoteldetails3->id; ?>" acco_id="<?php echo $hoteldetails3->id; ?>" hotel_name="<?php echo $hoteldetails3->hotel_name; ?>" table_name="accomodation_images" id_column="accomodation_id" active_day=""><i class="fa fa-camera"></i></a>
                              <?php } ?>
                              <?php echo '<br>'; } } ?> 
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <?php } ?>
                <?php if(!empty($activity)){ ?>
                <div role="tabpanel" class="tab-pane" id="Activity">
                  <div class="col-sm-12 i_outtext text-red">Collapse All</div>
                  <div class="panel-group">
                    <?php foreach($activity as $val){ 
                      $act_img = $this->Holiday_Model->check_gallery_img($val->package_id,'holiday_activity_images','package_id'); ?>
                    <div class="panel panel-default">
                      <div class="panel-heading toggleHeading">
                        <h4 class="panel-title row">
                        <div class="col-sm-8 col-xs-7">
                          <span class=""><?php echo $val->activity_name; ?></span>
                        </div>
                        <div class="col-sm-4 col-xs-5">
                          <span>Day <?php echo $val->activity_day; ?></span>
                          <span class="p-m-icon">
                            <span class="pull-right plus-minus">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                          </span>
                        </div>
                        </h4>
                      </div>
                      <div class="collapse in toggleBody">
                        <div class="panel-body">
                          <ul style="margin-left: 15px;">
                            <li>Adult Cost: INR <?php echo $val->activity_adult_cost; ?></li>
                            <li>Child Cost(Below 12 years): INR <?php echo $val->activity_child_cost; ?></li>
                            <li>Family Cost(2 Adults + 2 Children): INR <?php echo $val->activity_family_cost; ?></li>
                          </ul>
                          <p><?php echo $val->activity_description; ?></p>
                          <div class="row">
                            <div class="col-sm-6">
                              <?php if($act_img != ''){ ?>
                              <a class="label label-danger gallery_label" id="image-<?php echo $val->activity_id; ?>" acco_id="<?php echo $val->package_id; ?>" hotel_name="<?php echo $val->activity_name; ?>" table_name="holiday_activity_images" id_column="package_id" active_day="<?php echo $val->activity_day; ?>"><i class="fa fa-camera"></i></a>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <?php } ?>
                <?php  if(!empty($attraction)){ ?>
                <div role="tabpanel" class="tab-pane" id="Attraction">
                  <div class="col-sm-12 i_outtext text-red">Collapse All</div>
                  <div class="panel-group">
                    <?php foreach($attraction as $val){ 
                      $attr_img = $this->Holiday_Model->check_gallery_img($val->package_id,'holiday_attraction_images','package_id'); ?>
                    <div class="panel panel-default">
                      <div class="panel-heading toggleHeading">
                        <h4 class="panel-title row">
                        <div class="col-sm-8 col-xs-7">
                          <span class=""><?php echo $val->attraction_name; ?></span>
                        </div>
                        <div class="col-sm-4 col-xs-5">
                          <span>Day <?php echo $val->attraction_day; ?></span>
                          <span class="p-m-icon">
                            <span class="pull-right plus-minus">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                          </span>
                        </div>
                        </h4>
                      </div>
                      <div class="collapse in toggleBody">
                        <div class="panel-body">
                          <ul style="margin-left: 15px;">
                            <li>Adult Cost: INR <?php echo $val->attraction_adult_cost; ?></li>
                            <li>Child Cost(Below 12 years): INR <?php echo $val->attraction_child_cost; ?></li>
                            <li>Family Cost(2 Adults + 2 Children): INR <?php echo $val->activity_family_cost; ?></li>
                          </ul>
                          <p><?php echo $val->attraction_description; ?></p>
                          <div class="row">
                            <div class="col-sm-6">
                              <?php if($attr_img != ''){ ?>
                              <a class="label label-danger gallery_label" id="image-<?php echo $val->attraction_id; ?>" acco_id="<?php echo $val->package_id; ?>" hotel_name="<?php echo $val->attraction_name; ?>" table_name="holiday_attraction_images" id_column="package_id" active_day="<?php echo $val->attraction_day; ?>"><i class="fa fa-camera"></i><!-- &nbsp; Gallery &nbsp;<i class="fa fa-caret-right"></i> --></a>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <?php } ?>
                <?php  if(!empty($route_info)){ ?>
                <div role="tabpanel" class="tab-pane" id="Routemap">
                  <div class="col-sm-7 padd-l0">
                    <!-- <div id="controls-polyline" style=""></div> -->
                    <div id="gmap-list" style="height:550px;"></div>
                  </div>
                  <div class="col-sm-5 padd-l0 padd-r0">
                    <!-- <table class="routing_day one table table-condensed">
                      <thead>
                        <tr>
                          <th>#</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php for($j=0;$j<count($route_info);$j++){ ?>
                        <tr>
                          <td><?php echo $j+1 ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <table class="routing_day two table table-condensed">
                      <thead>
                        <tr>
                          <th>DAYS</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        for($j=0;$j<count($route_info);$j++){
                            $transprtday = explode(',', $route_info[$j]->transport_day);
                          if(count($transprtday)> 1){
                            $dayc = count($transprtday)-1;
                            $dayt = $transprtday[0].' - '.$transprtday[$dayc];
                          } else {
                            $dayt = $transprtday[0];
                        }
                        ?>
                        <tr>
                          <td>DAY <?php echo $dayt ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <table class="routing_day three table table-condensed">
                      <thead>
                        <tr>
                          <th>LOCATION</th>
                        </tr>
                      </thead>
                      <tbody id="controls-polyline">
                      </tbody>
                    </table>
                    <table class="routing_day four table table-condensed">
                      <thead>
                        <tr>
                          <th>TRANSFER</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php for($j=0;$j<count($route_info);$j++){ ?>
                        <tr>
                          <td><?php echo $route_info[$j]->transport_mode ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table> -->
                    <!-- <table class="routing_day table table-condensed">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>DAYS</th>
                            <th>LOCATION</th>
                            <th>TRANSFER</th>
                            <th>Start</th>
                            <th>Distance</th>
                            <th>Time</th>
                          </tr>
                        </thead>
                        <tbody id="controls-polyline">
                        </tbody>
                    </table> -->
                    <!-- <ul id="controls-head">
                      <li><b>#</b></li>
                      <li><b>Days</b></li>
                      <li><b>Location</b></li>
                      <li><b>Transfer</b></li>
                      <li><b>Start</b></li>
                      <li><b>Distance</b></li>
                      <li><b>Time</b></li>
                    </ul> -->
                    <div id="controls-polyline"></div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- call request -->
<div class="modal fade" id="enquiry_request" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title">Request for Call</h3>
      </div>
      <div class="modal-body">
        <form action="#/holiday/call_back_request" method="POST">
          <div class="row holiday_details_col" style="">
            <div class="packge_head text-center">
              <h2 style="display: inline-block;"><?php echo $package_details->holiday_name; ?></h2>&nbsp;&nbsp;<span class="text-red" style=" position: relative;top: -4px;left: 5px;">|&nbsp;&nbsp;Code: <?php echo $package_details->holiday_code; ?></span>
            </div>
          </div>

          <div class="row" style="padding-top:10px;">
            <div class="col-md-4 form-group">
              <label for="fname" class="control-label">First Name:</label><label class="asterisk">*</label>
              <input type="text" pattern="[A-Za-z]{3,}" title="Please Enter Text(minimum 3 Character)" class="form-control" placeholder="First Name" name="fname" id="user_fname" required="" autofocus="">
            </div>
            <div class="col-md-4 form-group">
              <label for="mname" class="control-label">Middle Name:</label>
              <input type="text" class="form-control" placeholder="Middle Name" name="mname" id="user_mname" required="" autofocus="">
            </div>

            <div class="col-md-4 form-group">
              <label for="lname" class="control-label">Surname:</label><label class="asterisk">*</label>
              <input type="text" class="form-control" placeholder="Surname" name="lname" id="user_lname" required="" autofocus="">
            </div>
             </div>

             <div class="row">

                   <div class="col-md-4 form-group">
                    <label for="email" class="control-label">Email Id:</label><label class="asterisk">*</label>
                    <input type="text" class="form-control" placeholder="Enter Your Email Address" name="email"  id="user_email" required="" autofocus="">
                  </div>

                  <div class="col-md-4 form-group">
                    <label for="tphone" class="control-label">Mobile No:</label><label class="asterisk">*</label>
                    <input type="text"  pattern="[0-9]{10,}" title="Please Enter 10 digit Mobile Number" class="form-control" placeholder="Enter your 10 digit mobile number" name="tphone" id="user_phone" required="" autofocus="" maxlength="10">
                  </div>

                  <div class="col-md-4 form-group">
                    <label for="telephone" class="control-label">Telphone:</label>
                    <input type="text" class="form-control" placeholder="Telephone" name="telephone"  id="user_telephone" required="" autofocus="">
                  </div>

             </div>

              <div class="row">

                   <div class="col-md-4 form-group">
                    <label for="adults" class="control-label">Adults:</label>
                    <select type="text" class="form-control" name="no_of_adults" id="no_of_adults" required="" autofocus="">
                      <option value="">Select No. Of Adults</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>

                  <div class="col-md-4 form-group">
                    <label for="children" class="control-label">Childrens:</label>
                    <select type="text" class="form-control" name="no_of_children" id="no_of_children" required="" autofocus="">
                      <option value="">Select No. Of Childs</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>

                  <div class="col-md-4 form-group">
                    <label for="single_room" class="control-label">Single Room:</label>
                    <input type="text" class="form-control" placeholder="Enter No. of Single Rooms" name="single_room"  id="single_room" required="" autofocus="">
                  </div>

             </div>


              <div class="row">

                   <div class="col-md-4 form-group">
                    <label for="double_room" class="control-label">Double Room:</label>
                    <input type="text" class="form-control" placeholder="Enter no. of Double Rooms" name="double_room"  id="double_room" required="" autofocus="">
                  </div>

                  <div class="col-md-4 form-group">
                    <label for="twin_room" class="control-label">Twin Room:</label>
                    <input type="text" class="form-control" placeholder="Enter no. of Twin Rooms" name="twin_room" id="twin_room" required="" autofocus="">
                  </div>

                  <div class="col-md-4 form-group">
                    <label for="triple_room" class="control-label">Triple Room:</label>
                    <input type="text" class="form-control" placeholder="Enter no. of Double Rooms" name="triple_room"  id="triple_room" required="" autofocus="">
                  </div>

             </div>

       
      
          <div class="row">
            <div class="col-md-4 form-group">
              <label for="comments" class="control-label">Travel Plans/Notes:</label>
              <textarea rows="3" cols="42" class="form-control" name="comments"></textarea>
              <small>Your data will be kept confidential and will not be shared with a third party.</small>
             </div>
            
          </div> 
          <!-- <label><input type="checkbox" name="call_back" value="1"/> I request a call back from Matrix</label> -->
          <input type="hidden" name="holiday_id" value="<?php echo $package_details->holiday_code; ?>" />
          <input type="hidden" name="p_title" value="<?php echo $package_details->holiday_name; ?>" />
          <input type="hidden" name="p_country" value="<?php echo $countries; ?>" />
          <input type="hidden" name="holi_ttype" value="international-holidays" />
          <div class="row">
            <div class="col-sm-2 text-center pull-right">
              <input type="submit" value="Send Enquiry" class="btn btn-primary"/>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end call request -->

<!-- Modal Gallery -->
<div id="modal-gallery" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content gallery-imgs">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title"></h3>
      </div>
      <div class="modal-body">
        <div id="modal-carousel" class="carousel">
          <div class="carousel-inner"></div>
          <a class="carousel-control left" href="#modal-carousel" data-slide="prev"><i class="soap-icon-left"></i></a>
          <a class="carousel-control right" href="#modal-carousel" data-slide="next"><i class="soap-icon-right"></i></a>  
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="hidden" id="img-repo"></div>
<!-- End of Modal Gallery -->

<!-- Modal Acco Description -->
<div id="modal-acco" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title htl-title"></h3>
      </div>
      <div class="modal-body">
       <div class="acco-desc">
         
       </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Modal Acco Description -->

<?php $this->load->view('home/footer');?>
<script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyADPfKkRh8XYqiV5gPIzPW1CdXAbR7l9gE&libraries=places"></script>
<!-- <script src="<?php //echo base_url(); ?>public/js/modernizr-2.8.3-respond-1.4.2.min.js"></script>  -->
<script src="<?php echo base_url(); ?>public/js/maplace.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/holiday/webservices.js"></script>
<?php
function custom_echo($x, $length) {
  if(strlen($x)<=$length){
    echo $x;
  }
  else{
    $y=substr($x,0,$length) . '<span class="read-more read">Read More</span>';
    echo '<span class="show-this">'.$y.'</span>';
    read_more($x,$length);
  }
}
function read_more($x, $length) {
  $r=substr($x,$length) . '<span class="read-more">Hide</span>';
  echo '<span class="hide-this" style="display:none">'.$r.'</span>';
}
?>
<script type="text/javascript">
$('.read-more').on('click', function(){
  $('.hide-this').slideToggle(200);
  $('.hide-this').toggleClass('inline');
  $('.read-more.read').toggleClass('hide');
})
</script>
<script type="text/javascript">
var _height = $('.packge_detail_col').height()-56;
$('.thumbgallery #slider.flexslider .slides img').css('height',_height);
$(window).load(function() {
  var wrap_width = $('.thumbgallery').width()/6;
  // alert(wrap_width);
  // The slider being synced must be initialized first
  $('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    prevText: "",
    nextText: "",
    itemWidth: wrap_width,
    itemMargin: 5,
    asNavFor: '#slider'
  });
 
  $('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    prevText: "",
    nextText: "",
    sync: "#carousel"
  });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $(".toggleHeading").click(function(e){
        $(this).parent().find('.toggleBody').collapse('toggle');
        var classname = $(this).children().find('i').attr('class');
        if(classname == 'fa fa-plus'){
          $(this).children().find('i.fa-plus').toggleClass('fa-plus fa-minus');
        } else {
          $(this).children().find('i.fa-minus').toggleClass('fa-minus fa-plus');
        }
        // alert(a);
        e.preventDefault();
    });

    $(".i_outtext").on('click', function(e){
      var _text = $(this).html();
      // alert(_text);
      if(_text == 'Expand All'){
        $(this).parent().find('i.fa-plus').toggleClass('fa-plus fa-minus');
        $(this).html('Collapse All');
        $(this).parent().find('.toggleBody').collapse('show');
        // return false;
      }
      if(_text == 'Collapse All') {
        $(this).parent().find('i.fa-minus').toggleClass('fa-minus fa-plus');
        $(this).html('Expand All');
        $(this).parent().find('.toggleBody').collapse('hide', true);
        // return false;
      }
      // e.stopPropagation();
      e.preventDefault();
    });
    
});
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
<script type="text/javascript">
var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

$('.download_pdf').click(function () {
     doc.text(10, 10, 'Package Name : <?php echo $package_details->holiday_name; ?>');
    doc.fromHTML($('#day_itinery_details').html(), 5, 15, {
        'width': '100%',
            'elementHandlers': specialElementHandlers
    });
    doc.save('<?php echo $package_details->holiday_name; ?>.pdf');
    window.location.href=location.href;
});
</script>
<?php
  if(!empty($thumbgallery)){
   $str=base_url().'supplier/'.$thumbgallery[0]->gallery_img;
   } else {
    $str=base_url()."public/images/noimage.jpg";
   }

   ?>
<script type="text/javascript">
  var urlsite="<?php echo base_url(); ?>holiday/holidaydetails/<?php echo $package_details->id; ?>";
  var titlesite=" Matrix Holidays Package : <?php echo $package_details->holiday_name; ?>";
  var descriptionsite="<?php echo $package_details->short_desc; ?>";
  var imagepath="<?php echo $str; ?>";
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/sharesocial/simple_social_share.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/sharesocial/simple_social_share.css">
  
<script type="text/javascript">
  $( document ).ready(function() {   
    // $(".p_share").simpleSocialShare({sites: {urlsite}, url: {urlsite}, title: {titlesite}, description: {descriptionsite}, image: {imagepath}, shareType: "button", triggerButtonActiveState: false, buttonSide: "right", orientation: "horizontal"});

    $(".p_share").simpleSocialShare({sites: "", url: "<?php echo base_url(); ?>holiday/holidaydetails/<?php echo $package_details->id; ?>", title: " Matrix Holidays Package : <?php echo $package_details->holiday_name; ?>", description: "<?php echo $package_details->short_desc; ?>", image: "<?php echo $str; ?>", shareType: "button", triggerButtonActiveState: false, buttonSide: "right", orientation: "horizontal"});
  });
</script>
<script type="text/javascript">
$(document).ready(function() {   
   /* activate the carousel */
   $("#modal-carousel").carousel({interval:false});
   /* change modal title when slide changes */
   $("#modal-carousel").on("slid.bs.carousel", function () {
        $(".modal-title")
        .html($(this)
        .find(".active img")
        .attr("title"));
   });
  /* when clicking a thumbnail */
  $(".gallery_label").click(function(){
    $active_day = '';
    $acco_id = $(this).attr('acco_id');
    $img_id = $(this).attr('id');
    $hotel_name = $(this).attr('hotel_name');
    $table_name = $(this).attr('table_name');
    $id_column = $(this).attr('id_column');
    $active_day = $(this).attr('active_day');
    // alert($desti_id);

    var content = $(".carousel-inner");
    var title = $(".gallery-imgs .modal-title");
    content.empty();  
    title.empty();

    $.ajax({
      url: siteUrl + 'holiday/get_popup_images',
      data: 'acco_id='+$acco_id+'&img_id='+$img_id+'&hotel_name='+$hotel_name+'&table_name='+$table_name+'&id_column='+$id_column+'&active_day='+$active_day,
      dataType: 'json',
      type: 'POST',
      beforeSend: function() {
        // var content = $(".carousel-inner");
        // var title = $(".gallery-imgs .modal-title");
        // content.empty();  
        // title.empty();
      },
      success: function(data) {
        $('#img-repo').html(data.img_div);

        var id = data.img_id;  
        var repo = $("#img-repo .item");
        var repoCopy = repo.filter("#" + id).clone();
        var active = repoCopy.first();

        active.addClass("active");
        title.html(active.find("img").attr("title"));
        content.append(repoCopy);

        // show the modal
        $("#modal-gallery").modal("show");
      }
    });
  });
});
</script>
<script type="text/javascript">
/* when clicking a thumbnail */
$(".acco_label").click(function(){
  $acco_id = $(this).attr('acco_id');

  $.ajax({
    url: siteUrl + 'holiday/get_acco_desc',
    data: 'acco_id='+$acco_id,
    dataType: 'json',
    type: 'POST',
    success: function(data) {
      $('.acco-desc').html(data.acco_desc);
      $('.htl-title').html(data.hotel_name);
      // show the modal
      $("#modal-acco").modal("show");
    }
  });
});
</script>
<script type="text/javascript">
  // $(document).ready(function() {
  //   $("#maptab").on("shown.bs.tab", function(e) {
  //    var address = "<?php //echo $centercity; ?>";  
  //     $.ajax({
  //       url:"http://maps.googleapis.com/maps/api/geocode/json?address="+address+"&sensor=false",
  //       type: "POST",
  //       success:function(res){
  //          var lat=res.results[0].geometry.location.lat;
  //          var lng=res.results[0].geometry.location.lng;
  //          var center={lat,lng};
  //         google.maps.event.trigger(map, "resize");
  //        map.setCenter(center);
  //        map.setZoom(4);  
  //       }
  //     });
  //   });
  // });
</script>

<?php if(!empty($route_info)){ ?>
<script type="text/javascript">
var LocsD = [
  <?php
  for($j=0;$j<count($route_info);$j++){
    $transprtday = explode(',', $route_info[$j]->transport_day);
    $loc = explode(',', $route_info[$j]->from_location);
    if(count($transprtday)> 1){
      $dayc = count($transprtday)-1;
      $dayt = $transprtday[0].' - '.$transprtday[$dayc];
    } else {
      $dayt = $transprtday[0];
    }
    $html = '<td>DAY '.$dayt.'</td><td>'.$loc[0].'</td><td>'.$route_info[$j]->transport_mode.'</td><td>'.$route_info[$j]->starting_time.'</td><td>'.$route_info[$j]->travel_distance.'</td><td>'.$route_info[$j]->travel_time.'</td>';
  ?>
  // var trday = '<?php //echo $transprtday[0].' - '.$transprtday[$j]; ?>';
  {
    lat: '<?php echo $route_info[$j]->from_latitude; ?>',
    lon: '<?php echo $route_info[$j]->from_longitude; ?>',
    title: '<?php echo $html; ?>',
    html: '<div style="text-align:center"><b>Day '+'<?php echo $dayt; ?>'+'</b> - '+'<?php echo $loc[0]; ?>'+'</div>',
    icon:'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld='+'<?php echo $j+1 ?>'+'|f75c50|000000',
    stopover: true,
    // zoom: 1
  },
  <?php } ?>
];
// displayMap(LocsD);
$("#maptab").on("shown.bs.tab", function(e) {
  displayMap(LocsD);
});

function displayMap(LocsD) {
  
  var html_checks = {
    //required: called by Maplace.js to activate the current voice on menu
    activateCurrent: function(index) {
      // this.html_element.find("input[value='" + index + "']").attr('checked', true);
    },
    //required: called by Maplace.js to get the html of the menu
    getHtml: function() {
      var self = this,
      html = '<table class="table-route"><thead><tr><th>DAYS</th><th>Location</th><th>Transfer</th><th>Start</th><th>Distance</th><th>Time</th></tr></thead>';
      //if more than one location
      if(this.ln > 1) {
        html += '<tbody class="controls' + this.o.controls_cssclass + '">';
        //check "view all" link
        //use ShowOnMenu(index) to know if a location has to appear on menu
        if(this.ShowOnMenu(this.view_all_key)) {
          // html += '<tr><input type="radio" name="gmap" value="'+ this.view_all_key + '">' + this.o.view_all_text + '</tr>';

          // html += '<tr class="ctrl2" name="gmap" data-value="'+ this.view_all_key + '">' + this.o.view_all_text + '</tr>';
        }
        //iterate the locations
        for (var a = 0; a < this.ln; a++) {
          if(this.ShowOnMenu(a))
          // html += '<tr><input type="radio" name="gmap" value="' + (a+1) + '">'+ (this.o.locations[a].title || ('#' + (a+1))) + '</tr>';
          html += '<tr class="ctrl2" name="gmap" data-value="' + (a+1) + '">'+ (this.o.locations[a].title || ('#' + (a+1))) + '</tr>';
        }
        html += '</tbody></table>';
      }
      this.html_element = $('<div class="wrap_controls"></div>').append(html);
      //event on change
      //use ViewOnMap(index) to trigger the marker on map
      // this.html_element.find('input[type=radio]').bind('change', function() {
      //         self.ViewOnMap(this.value);
      // });
      this.html_element.find('.ctrl2').bind('click', function() {
        var val2 = $(this).attr('data-value');
        $('.ctrl2').removeClass('active');
        $(this).addClass('active');
        // alert(val2);
        self.ViewOnMap(val2);
      });
      return this.html_element;
    }
  };

  var maplace = new Maplace({
    map_div:'#gmap-list',
    generate_controls: true,
    controls_on_map: false,
    locations: LocsD,
    controls_div: '#controls-polyline',
    controls_type: 'checks',
    view_all_text: 'Start',
    map_options: {
      zoom: 5,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
    },
    type: 'polyline'
  }).Load();

  maplace.AddControl('checks', html_checks);
  maplace.Load({
    controls_type: 'checks',
  });
}

</script>
<?php } ?>