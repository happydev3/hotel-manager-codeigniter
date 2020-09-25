<?php $this->load->view('home/header');?>
<?php
        $session_data = $this->session->userdata('hotel_search_data');
        $star=$hotelDetails->star;
        $sessId=$this->session->session_id; 
        $similar_data = $this->Hotels_Model->all_fetch_search_result($sessId, $offset = 0, 2,'','',$star);  
 
?> 

<section id="content">
  <div class="container">
    <div class="row2 detail-menu-wrapper">
      <nav class="custom-tab" role="navigation">
        <ul class="menu">
          <li class="menu-item-has-children">
            <a id="jump_available_rooms" href="#available_rooms" href="#">Available Rooms</a>
          </li>
          <li class="menu-item-has-children">
            <a id="jump_faclities" href="#facilities">Facilities</a>
          </li>
          <li class="menu-item-has-children">
            <a id="jump_nearby" href="#nearby">Places Nearby</a>
          </li>
          <li class="menu-item-has-children">
            <a id="jump_terms" href="#terms">Terms And Conditions</a>
          </li>
        </ul>
      </nav>
    </div>
    <div class="row2" id="main2">
      <div class="sidebar col-md-3">
        <div class="travelo-box2">
          <a href="" onclick="window.history.back();" class="transparent-btn full-width uppercase">Back to Search</a>
        </div>
        <div class="travelo-box2">
          <a class="button orange full-width btn-large">Book for <!-- AED 3,330 --><?php echo $hotelDetails->xml_currency . ' ' .round(($hotelDetails->total_cost)); ?></a>
        </div>
        <div class="travelo-box2">
          <label class="uppercase">Show on map</label>
         
        </div>
        <div class="travelo-box2 fac-box">
         <label class="uppercase">Top Facilities</label>
          <ul>        
          <li><i class="soap-icon-wifi"></i><span>Free Wifi</span></li>   
          <li><i class="soap-icon-fitnessfacility"></i><span>Fitness</span></li>
            <li><i class="soap-icon-breakfast"></i><span>Breakfast</span></li>
            <li><i class="soap-icon-television"></i><span>Television</span></li>
            <li><i class="soap-icon-plane-right"></i><span>Airport</span></li>
            <li><i class="soap-icon-parking"></i><span>Parking</span></li>
            <li><i class="soap-icon-smoking"></i><span>Free Wifi</span></li>
            <li><i class="soap-icon-family"></i><span>Family</span></li>
          </ul>
        </div>
        <div class="travelo-box2">
          <button class="button orange uppercase full-width btn-large">Similar Properties</button>
        </div>
        <?php 
         for($i=0;$i<5;$i++){
          if(!empty($similar_data[$i]) && $similar_data[$i]->hotel_name!=$hotelDetails->hotel_name){           
               if ($similar_data[$i]->image != '') {
                    $image_name = explode(',', $similar_data[$i]->image);
                    $gttd =  $image_name[0];
                  }

          ?>
        <article class="travelo-box2">        
          <h2 class="box-title"><?php echo $similar_data[$i]->hotel_name.' , '.$similar_data[$i]->city_name;  ?></h2>
          <div title="" class="five-stars-container" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $similar_data[$i]->star;?> stars"><span class="five-stars" style="width:<?php echo ($similar_data[$i]->star*20).'%';?>;"></span></div>
          <small><i class="soap-icon-departure yellow-color"></i><span class="fourty-space"><?php echo $similar_data[$i]->location.' , '.$similar_data[$i]->city_name;?></span></small>
          <form  method="post" action="<?php echo site_url(); ?>hotels/details" onclick="this.submit();">
          <figure>
            <?php if (getimagesize($gttd) !== false) { ?>
               <img src="<?php echo $gttd; ?>" style="cursor:pointer" class="full-width" alt="<?php echo $similar_data[$i]->hotel_name; ?>" title="<?php echo $similar_data[$i]->hotel_name; ?>" />
               <?php } else { ?>
                <img style="cursor:pointer" class="full-width"  src="<?php echo base_url();?>public/images/hotels/4.png" alt="<?php echo $similar_data[$i]->hotel_name; ?>" title="<?php echo $similar_data[$i]->hotel_name; ?>" style="pointer:cursor;" />
               <?php } ?>
         </figure>
          <div class="details">
          </div>
       <input type="hidden" name="callBackId" value="<?php echo base64_encode('fitruums'); ?>" />
      <input type="hidden" name="hotelCode" value="<?php echo $similar_data[$i]->hotel_code; ?>" />
      <input type="hidden" name="searchId" value="<?php echo $similar_data[$i]->search_id; ?>" />
           </form>
        </article>
        <?php } } ?>

       <!--  <article class="travelo-box2">
          <h2 class="box-title">Fairmont Dubai</h2>
          <div title="" class="five-stars-container" data-toggle="tooltip" data-placement="bottom" data-original-title="4 stars"><span class="five-stars" style="width: 80%;"></span></div>
          <small><i class="soap-icon-departure yellow-color"></i><span class="fourty-space"> Dubai, United Arab Emirates</span></small>
          <figure><img class="full-width" src="<?php echo base_url();?>public/images/hotels/3.png" alt=""></figure>
          <div class="details">
          </div>
        </article>
        <article class="travelo-box2">
          <h2 class="box-title">Atlantis the Palm, Dubai</h2>
          <div title="" class="five-stars-container" data-toggle="tooltip" data-placement="bottom" data-original-title="4 stars"><span class="five-stars" style="width: 80%;"></span></div>
          <small><i class="soap-icon-departure yellow-color"></i><span class="fourty-space"> Dubai, United Arab Emirates</span></small>

          <figure><img class="full-width" src="<?php echo base_url();?>public/images/hotels/4.png" alt=""></figure>
          <div class="details">
          </div>
        </article> -->
      </div>
      <div class="col-md-9">
        <div class="tab-container style1" id="hotel-main-content">
          <div class="tab-content">
            <div class="row2 tab-pane fade in active">
              <div id="photos-tab" class="row2 content-seperate">
                <article style="margin-bottom: 5px;">
                  <div class="details">
                    <h2 class="box-title pull-left"><!-- The Ritz-Carlton, Dubai --><?php echo $hotelDetails->hotel_name.', '.$hotelDetails->city_name;  ?><small><i class="soap-icon-departure yellow-color"></i><span class="fourty-space"><!--  Jumeirah Beach Residence, Dubai -->
                      <?php echo $address.' , '.$hotelDetails->city_name;?>
                    </span></small></h2>
                    <div class="feedback clearfix text-right">
                      <div title="4 stars" class="five-stars-container" data-toggle="tooltip" data-placement="bottom"><span class="five-stars" style="width:<?php echo ($star*20).'%';?>;"></span></div>
                    </div>
                  </div>
                </article>
                <article class="row2" style="margin-bottom: 5px;">
                  <ul class="sync_images tabs">
                    <li class="active"><a class="button orange full-width btn-large" data-toggle="tab" href="#all-photos">All</a></li>
                    <li><a class="button orange full-width btn-large" data-toggle="tab" href="#food-drink">Food &amp; Drink</a></li>
                    <li><a class="button orange full-width btn-large" data-toggle="tab" href="#rooms-photos">Rooms</a></li>
                    <li style="float: right;padding-right: 0;"><a id="jump_room" href="#available_rooms" class="button orange full-width btn-large">Select Rooms</a></li>
                  </ul>
                </article>
                <div class="tab-content">
                  <div id="all-photos" class="tab-pane fade in active">
                    <div class="photo-gallery style1" data-animation="slide" data-sync="#all-photos .image-carousel">
                      <ul class="slides">
                        <?php                       
                        if ($hotelDetails->images != '') {
                        $Images = explode(',', $hotelDetails->images);        
                        foreach ($Images as $img) {
                        if (strpos($img, "http") !== false) { ?>
                       <li><img src="//www.sunhotels.net/SunHotels.net/HotelInfo/hotelImage.aspx?id=<?php echo $img; ?>&full=1" alt="<?php echo $hotelDetails->hotel_name.', '.$hotelDetails->city_name;?>"  style="height: 449px;"/></li>  <?php  }} ?>
                      </ul>
                    </div>
                    <div class="image-carousel style1" data-animation="slide" data-item-width="70" data-item-margin="10" data-sync="#all-photos .photo-gallery">
                      <ul class="slides">
                      <?php                       
                        if ($hotelDetails->images != '') {
                        $Images = explode(',', $hotelDetails->images);        
                        foreach ($Images as $img) {?>
                    
                       <li><img src="//www.sunhotels.net/SunHotels.net/HotelInfo/hotelImage.aspx?id=<?php echo $img; ?>" alt="<?php echo $hotelDetails->hotel_name.', '.$hotelDetails->city_name;?>" /></li>
                       <?php } } ?>
                      </ul>
                    </div>
                  </div>
                  <div id="food-drink" class="tab-pane fade">
                    <div class="photo-gallery style1" data-animation="slide" data-sync="#food-drink .image-carousel">
                      <ul class="slides">
                     <?php                       
                        if ($hotelDetails->images != '') {
                        $Images = explode(',', $hotelDetails->images);        
                        foreach ($Images as $img) {?>
                    
                       <li><img src="//www.sunhotels.net/SunHotels.net/HotelInfo/hotelImage.aspx?id=<?php echo $img; ?>&full=1" alt="<?php echo $hotelDetails->hotel_name.', '.$hotelDetails->city_name;?>" style="height: 449px;" /></li><?php } } ?>
                      </ul>
                    </div>
                    <div class="image-carousel style1" data-animation="slide" data-item-width="70" data-item-margin="10" data-sync="#food-drink .photo-gallery">
                      <ul class="slides">
                      <?php                       
                        if ($hotelDetails->images != '') {
                        $Images = explode(',', $hotelDetails->images);        
                        foreach ($Images as $img) {?>
                    
                       <li><img src="//www.sunhotels.net/SunHotels.net/HotelInfo/hotelImage.aspx?id=<?php echo $img; ?>" alt="<?php echo $hotelDetails->hotel_name.', '.$hotelDetails->city_name;?>" /></li>
                       <?php } } ?>
                      </ul>
                    </div>
                  </div>
                  <div id="rooms-photos" class="tab-pane fade">
                    <div class="photo-gallery style1" data-animation="slide" data-sync="#rooms-photos .image-carousel">
                      <ul class="slides">
                      <?php                       
                        if ($hotelDetails->images != '') {
                        $Images = explode(',', $hotelDetails->images);        
                        foreach ($Images as $img) {?>                    
                       <li><img src="//www.sunhotels.net/SunHotels.net/HotelInfo/hotelImage.aspx?id=<?php echo $img; ?>&full=1" alt="<?php echo $hotelDetails->hotel_name.', '.$hotelDetails->city_name;?>" style="height: 449px;" /></li><?php }}  ?>
                      </ul>
                    </div>
                    <div class="image-carousel style1" data-animation="slide" data-item-width="70" data-item-margin="10" data-sync="#rooms-photos .photo-gallery">
                      <ul class="slides">
                       <?php                       
                        if ($hotelDetails->images != '') {
                        $Images = explode(',', $hotelDetails->images);        
                        foreach ($Images as $img) {?>                    
                       <li><img src="//www.sunhotels.net/SunHotels.net/HotelInfo/hotelImage.aspx?id=<?php echo $img; ?>" alt="<?php echo $hotelDetails->hotel_name.', '.$hotelDetails->city_name;?>"  /></li>
                       <?php } } ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div id="description-tab" class="row2 content-seperate">
                <div class="row2 content-heading"><h4>Description</h4></div>
                <p>
                <?php  echo strip_tags(html_entity_decode($hotelDetails->description));               
                ?></p>
              </div>
           
              <div id="edit-options" class="row2 content-seperate">
                <div class="row2 content-heading"><h4>Edit Options</h4></div>
                <div class="row2 edit-form">
                  <form action="<?php echo site_url(); ?>hotels/results" method="post">
                    <div class="row">
                      <div class="form-group col-sm-6 col-md-5">
                        <div class="row">
                          <div class="col-xs-6">
                            <label>Check In</label>
                            <div class="datepicker-wrap"> 
                             <input type="text" name="checkIn" class="input-text full-width" placeholder="dd/mm/yy" />
                            </div>
                          </div>
                          <div class="col-xs-6">
                            <label>Check Out</label>
                            <div class="datepicker-wrap">
                              <input type="text" name="checkOut" class="input-text full-width" placeholder="dd/mm/yy" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-sm-6 col-md-5 pax-select adults-drop-wrapper">
                        <div class="row">
                          <div class="col-xs-12">
                            <label>Guest(s) / Room(s)</label>
                            <div style="position: relative;">
                              <i class="fa fa-child" aria-hidden="true"></i>
                              <input type="text" id="noOfPassengers" value="1" class="form-control passengers no-input" placeholder="Passengers" readonly />
                              <span class="rooms-text"><span id="total_rooms">1</span> Room(s) |</span>
                              <span class="passenger-text">Guest(s) |</span>
                              <span class="extrabed-text"><span id="total_beds">0</span> extra bed(s)</span>
                              <div class="adults-dropdown dropdown-menu select-passenger hide">
                                <div class="col-sm-12">
                                  <div class="room1 parents" id="room1" room-count="1">
                                    <div class="col-xs-12 form-inline">
                                      <label style="margin-right: 15px;">Rooms</label>
                                      <div class="form-group">
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus2 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="room_count" class="form-control input-number" value="1" min="1" max="4" id="rooms-q">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus2 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3">
                                      <div class="form-group">
                                        <label class="control-label invisible">Rooms</label>
                                        <div class="input-group">
                                          <label class="control-label">Room 1</label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3">
                                      <div class="form-group">
                                        <label class="control-label">Adults</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="adults[]" class="form-control input-number adultscount" value="1" min="1" max="4" id="adults-q">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3">
                                      <div class="form-group">
                                        <label class="control-label">Child(0-11)</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec childs" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="childs[]" class="form-control input-number childscount" value="0" min="0" max="3" id="childs-q">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec childs" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3">
                                      <div class="form-group">
                                        <label class="control-label">Extra Beds</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus-e btn-inc-dec extrabeds" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="extrabeds[]" class="form-control input-number extrabedcount" value="0" min="0" max="1" id="extrabed-q">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus-e btn-inc-dec extrabeds" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3" id="childAge1" style="display: none;">
                                      <div class="form-group">
                                        <label class="control-label">Child 1 Age</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="childs_ages_room1[]" class="form-control input-number" value="0" min="0" max="11" id="childs-age1">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3" id="childAge2" style="display: none;">
                                      <div class="form-group">
                                        <label class="control-label">Child 2 Age</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="childs_ages_room1[]" class="form-control input-number" value="0" min="0" max="11" id="childs-age2">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3" id="childAge3" style="display: none;">
                                      <div class="form-group">
                                        <label class="control-label">Child 3 Age</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="childs_ages_room1[]" class="form-control input-number" value="0" min="0" max="11" id="childs-age3">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="room2 parents" id="room2" room-count="2" style="display: none;">
                                    <div class="col-xs-3">
                                      <div class="form-group">
                                        <label class="control-label invisible">Rooms</label>
                                        <div class="input-group">
                                          <label class="control-label">Room 2</label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3">
                                      <div class="form-group">
                                        <label class="control-label">Adults</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="adults[]" class="form-control input-number adultscount" value="1" min="1" max="4" id="adults-q2">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3">
                                      <div class="form-group">
                                        <label class="control-label">Child(0-11)</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec childs" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="childs[]" class="form-control input-number childscount" value="0" min="0" max="3" id="childs-q2">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec childs" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3">
                                      <div class="form-group">
                                        <label class="control-label">Extra Beds</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus-e btn-inc-dec extrabeds" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="extrabeds[]" class="form-control input-number extrabedcount" value="0" min="0" max="1" id="extrabed-q">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus-e btn-inc-dec extrabeds" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3" id="childAge1" style="display: none;">
                                      <div class="form-group">
                                        <label class="control-label">Child 1 Age</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="childs_ages_room2[]" class="form-control input-number" value="0" min="0" max="11" id="childs-age1">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3" id="childAge2" style="display: none;">
                                      <div class="form-group">
                                        <label class="control-label">Child 2 Age</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="childs_ages_room2[]" class="form-control input-number" value="0" min="0" max="11" id="childs-age2">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3" id="childAge3" style="display: none;">
                                      <div class="form-group">
                                        <label class="control-label">Child 3 Age</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="childs_ages_room2[]" class="form-control input-number" value="0" min="0" max="11" id="childs-age3">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="room3 parents" id="room3" room-count="3" style="display: none;">
                                    <div class="col-xs-3">
                                      <div class="form-group">
                                        <label class="control-label invisible">Rooms</label>
                                        <div class="input-group">
                                          <label class="control-label">Room 3</label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3">
                                      <div class="form-group">
                                        <label class="control-label">Adults</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="adults[]" class="form-control input-number adultscount" value="1" min="1" max="4" id="adults-q3">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3">
                                      <div class="form-group">
                                        <label class="control-label">Child(0-11)</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec childs" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="childs[]" class="form-control input-number childscount" value="0" min="0" max="3" id="childs-q3">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec childs" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3">
                                      <div class="form-group">
                                        <label class="control-label">Extra Beds</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus-e btn-inc-dec extrabeds" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="extrabeds[]" class="form-control input-number extrabedcount" value="0" min="0" max="1" id="extrabed-q">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus-e btn-inc-dec extrabeds" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3" id="childAge1" style="display: none;">
                                      <div class="form-group">
                                        <label class="control-label">Child 1 Age</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="childs_ages_room3[]" class="form-control input-number" value="0" min="0" max="11" id="childs-age1">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3" id="childAge2" style="display: none;">
                                      <div class="form-group">
                                        <label class="control-label">Child 2 Age</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="childs_ages_room3[]" class="form-control input-number" value="0" min="0" max="11" id="childs-age2">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3" id="childAge3" style="display: none;">
                                      <div class="form-group">
                                        <label class="control-label">Child 3 Age</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="childs_ages_room3[]" class="form-control input-number" value="0" min="0" max="11" id="childs-age3">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="room4 parents" id="room4" room-count="4" style="display: none;">
                                    <div class="col-xs-3">
                                      <div class="form-group">
                                        <label class="control-label invisible">Rooms</label>
                                        <div class="input-group">
                                          <label class="control-label">Room 4</label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3">
                                      <div class="form-group">
                                        <label class="control-label">Adults</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="adults[]" class="form-control input-number adultscount" value="1" min="1" max="4" id="adults-q4">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3">
                                      <div class="form-group">
                                        <label class="control-label">Child(0-11)</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec childs" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="childs[]" class="form-control input-number childscount" value="0" min="0" max="3" id="childs-q4">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec childs" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3">
                                      <div class="form-group">
                                        <label class="control-label">Extra Beds</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus-e btn-inc-dec extrabeds" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="extrabeds[]" class="form-control input-number extrabedcount" value="0" min="0" max="1" id="extrabed-q">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus-e btn-inc-dec extrabeds" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3" id="childAge1" style="display: none;">
                                      <div class="form-group">
                                        <label class="control-label">Child 1 Age</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="childs_ages_room4[]" class="form-control input-number" value="0" min="0" max="11" id="childs-age1">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3" id="childAge2" style="display: none;">
                                      <div class="form-group">
                                        <label class="control-label">Child 2 Age</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="childs_ages_room4[]" class="form-control input-number" value="0" min="0" max="11" id="childs-age2">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-3" id="childAge3" style="display: none;">
                                      <div class="form-group">
                                        <label class="control-label">Child 3 Age</label>
                                        <div class="input-group">
                                          <div class="passenger-inc-dec">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                              -
                                              </button>
                                            </span>
                                            <input type="text" name="childs_ages_room4[]" class="form-control input-number" value="0" min="0" max="11" id="childs-age3">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                              +
                                              </button>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <div class="col-sm-9 hidden-xs"></div>
                                      <div class="col-sm-3 col-xs-12">
                                        <button type="button" class="done2 book-now">Confirm</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      
                      <div class="form-group col-sm-6 col-md-2 fixheight">
                        <label class="hidden-xs">&nbsp;</label>
                         <input type="hidden" name="cityName" id="cityName" class="input-text full-width" value="<?php echo $session_data['cityName']; ?>" />
                        <input type="hidden" name="cityid" id="cityid" value="<?php echo $session_data['cityCode']; ?>" />
                        <button type="submit" class="full-width icon-check animated" data-animation-type="bounce" data-animation-duration="1">SEARCH</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div id="available_rooms" class="row2 content-seperate">
                <div class="row2 content-heading"><h4>Rooms Available</h4></div>
                <div id="rooms_info">
                <?php $this->load->view('rooms_available'); ?>
                  </div>
                </div>
              </div>
              <div id="facilities" class="row2 content-seperate hotel-amenities">
                <div class="row2 content-heading"><h4>Facilities</h4></div>
                <ul class="amenities clearfix style1">
                <?php
                 $hotels_amenities = $this->Hotels_Model->get_fitruums_hotels_amenities($hotelDetails->hotel_code);
                if(!empty($hotels_amenities)){
                  for($l=0;$l<count($hotels_amenities);$l++)                
                 {
                    if(!empty($hotels_amenities[$l])){                
                ?>
                  <li class="col-md-4 col-sm-6">
                    <div class="icon-box style1"><?php echo $hotels_amenities[$l]->amenity_name; ?></div>
                  </li>
                  <?php } } }?>
              
                </ul>
              </div>
         
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
 <?php $this->load->view('home/footer');?> 
 
 <script type="text/javascript">
    var callbackId = '<?php echo base64_encode('fitruums'); ?>';
    var sessionId = '<?php echo $hotelDetails->session_id; ?>';
    var searchId = '<?php echo $hotelDetails->search_id; ?>';
    var hotelId = '<?php echo $hotelDetails->hotel_code; ?>';
    var latitude = '<?php echo $hotelDetails->latitude; ?>';
    var longitude = '<?php echo $hotelDetails->longitude; ?>';
    var city = '<?php echo $hotelDetails->city_name; ?>';

</script>

