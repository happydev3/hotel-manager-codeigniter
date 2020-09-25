<?php $this->load->view('home/header');
        $hotel_search_data=$this->Hotels_Model->check_hotel_search_data($ses_id,$refNo);
        $search_data=json_decode($hotel_search_data->search_data,true);
       $infant=isset($search_data['infant'])?$search_data['infant']:'0';
       $cityName=isset($search_data['cityName'])?$search_data['cityName']:'';
       $cityCode=isset($search_data['cityCode'])?$search_data['cityCode']:'';
       $nationality=isset($search_data['nationality'])?$search_data['nationality']:'';
       $checkIn=isset($search_data['checkIn'])?$search_data['checkIn']:'';
       $checkOut=isset($search_data['checkOut'])?$search_data['checkOut']:'';  
       $rooms=isset($search_data['rooms'])?$search_data['rooms']:1;  
       $adults=isset($search_data['adults'][0])?$search_data['adults'][0]:1;  
       $childs=isset($search_data['childs'][0])?$search_data['childs'][0]:0;  
       $childs_ages=isset($search_data['childs_ages'][0])?$search_data['childs_ages'][0]:'';   
       $ages=array();
       $noOfPassengers=$adults+$childs;  
   if ($childs != 0)
   { 
      $ages = explode(',', $childs_ages);
   }
        $star=$hotelDetails->star;
        $similar_data = $this->Hotels_Model->all_fetch_search_result($ses_id, $offset = 0, 2,'','',$star);  

      // echo "<pre> 132".$ses_id; print_r($similar_data); exit;   
?>
<link href="<?php echo base_url();?>public/css/hotel_details.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>public/vendor/grid_gallery/images-grid.css">
<?php $this->load->view('modify_search_details'); ?>
<?php 
$distances=json_decode($hotelDetails->distances,true);
$distances_str='';
if(!empty($hotelDetails->distances))
{
  foreach($distances as $key=>$val)
  {
     $distances_str.=$val.' from '.$key.' | ';
  }
}
  $address='';
             if($hotelDetails->street1!="")
              {
                 $address.=$hotelDetails->street1.', ';
              }
               if($hotelDetails->street2!="")
              {
                 $address.=$hotelDetails->street2.', ';
              }
                if($hotelDetails->city!="")
              {
                 $address.=$hotelDetails->city.', ';
              }
                if($hotelDetails->state!="")
              {
               $address.=$hotelDetails->state.', ';
              }
                if($hotelDetails->country!="")
              {
                 $address.=$hotelDetails->country;
              }
               if($hotelDetails->zipcode!="")
              {
                 $address.=' - '.$hotelDetails->zipcode;
              }
?>

<section id="hotel-details-section" class="push-top-20 hotel-details-section">
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <div class="hotel-details">
          <h3><?php echo $hotelDetails->hotel_name.', '.$hotelDetails->city_name;  ?> <span class="star star5"></span></h3>
          <small><?php echo $address;  ?> | <?php echo $distances_str;?></small>
        </div>
      </div>
      <div class="col-md-2">
        <div class="wish-heart">
          <span class="fa fa-heart wish-list <?php if($hotelDetails->wish_list==1){echo "active"; } ?>" data-val="<?php echo base64_encode($hotelDetails->hotel_code.'/'. base64_encode('fitruums').'/'.$hotelDetails->search_id.'/'.$hotelDetails->session_id); ?>" title="Add to favorite"></span>&nbsp;
          <span class="fa fa-pencil my-remarks help-tip" title="My remarks">
            <div class="medium">
              <ol>
                <li>Lorem ipsum dolor sit amet, consectetuer elit.</li>
                <li>Aliquam tincidunt mauris eu risus.</li>
                <li>Vestibulum auctor dapibus neque.</li>
              </ol>
            </div>
          </span>
        </div>
      </div>
      <div class="col-md-5"> 
        <div class="price-details">
          <h2 class="price-tag"><small>from </small><?php echo $hotelDetails->xml_currency; ?><span><?php echo $hotelDetails->total_cost; ?></span></h2>
          <div class="push-top-5">
            <small>Last booking 11 min ago &nbsp;&nbsp;&nbsp;</small>
            <a id="jump_rooms2" href="#htl-rooms" class="btn book-btn">Book Now <span class="fa fa-caret-down"></span></a>
          </div>
        </div>
      </div>
    </div>

<div class="row push-top-20">
      <div class="col-md-8">
        <div id="gallery-div"></div>
      </div>
      <div class="col-md-4">
        <div class="row2">
           <iframe src = "https://maps.google.com/maps?q=<?php  echo $hotelDetails->latitude;?>,<?php  echo $hotelDetails->longitude;?>&hl=es;z=14&amp;output=embed" width="100%" height="180" frameborder="0" style="border:0" allowfullscreen></iframe>
        <!--   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.986908732085!2d139.73531131465973!3d35.67732433779478!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188c792e155829%3A0x7d67cda3b625bebb!2sAkasaka-Excel+Hotel-Tokyu!5e0!3m2!1sen!2sin!4v1513834308961" width="100%" height="180" frameborder="0" style="border:0" allowfullscreen></iframe> -->
        </div>
      <?php if(!empty($hotelDetails->trustYouID)){ ?>
       <a id="jump_reviews2" href="#htl-reviews" title="Click to see the full review" style="text-decoration: none;">
         <div class="row2">       
            <iframe src = "https://api.trustyou.com/hotels/<?php echo $hotelDetails->trustYouID; ?>/seal.html?size=m"  allowtransparency="true" frameborder="0" height="56" scrolling="no" width="205"></iframe>  
        </div>
        <div class="row2">
             <iframe src = "https://api.trustyou.com/hotels/<?php echo $hotelDetails->trustYouID; ?>/traveler_distribution.html" width="100%" height="180" frameborder="0" style="border:0" allowfullscreen></iframe> 
        </div>
      </a>
      <?php } ?>     
      </div>
    </div>

    <div class="row push-top-20">
      <div class="col-md-12 feature-list">
        <ul>
          <li>
            <button type="button" class="feature-btn"><span class="fa fa-train"></span></button>
            <label class="control-label feature-label">Within 5 minutes of Station</label>
          </li>
          <li>
            <button type="button" class="feature-btn"><span class="fa fa-ban"></span></button>
            <label class="control-label feature-label">Non-smoking Rooms Available</label>
          </li>
          <li>
            <button type="button" class="feature-btn"><span class="fa fa-language"></span></button>
            <label class="control-label feature-label">Foreign Language Support</label>
          </li>
          <li>
            <button type="button" class="feature-btn"><span class="fa fa-bus"></span></button>
            <label class="control-label feature-label">Airport Limousine Bus Stop</label>
          </li>
          <li>
            <button type="button" class="feature-btn"><span class="fa fa-desktop"></span></button>
            <label class="control-label feature-label">Internate Available</label>
          </li>
          <li>
            <button type="button" class="feature-btn"><span class="fa fa-wifi"></span></button>
            <label class="control-label feature-label">Wifi Available</label>
          </li>
        </ul>
      </div>
    </div>
    <div class="row push-top-20">
      <div class="container fixed-tab">
        <div class="row">
          <div class="col-md-12">
            <div class="ajax-tab text-left">
              <ul>
                <li><a class="active" href="#htl-rooms">Rooms</a></li>
                <li><a href="#htl-desc">Hotel Description</a></li>
                 <?php  if(!empty($hotelDetails->trustYouID)){ ?>
                <li><a href="#htl-reviews">Reviews</a></li>
                <?php } ?>
                <li><a href="#htl-amenities">Amenities</a></li>
                <li><a href="#htl-policies">Policies</a></li>
                <li><a href="#htl-blogs">Blog Post</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="push-top-20 detail-content">
      <div id="htl-rooms" class="room-details">
        <h3 class="accordions-heading" title="Click to hide or show">Rooms <span class="fa fa-angle-down pull-right"></span></h3>
        <div id="rooms_info" class="accordions-content">
          <div class="change-rooms">
            <form id="hotels-tab"  action="<?php echo site_url().'/hotels/hotelroomdetails/'.base64_encode($hotelDetails->session_id.'/'.$hotelDetails->uniqueRefNo.'/'.$hotelDetails->search_id.'/'.$hotelDetails->hotel_code.'/'. base64_encode('fitruums')); ?>" class="tab-pane form-inline active"  method="post" name="reservationform">
            <div class="row small-padding">
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="dph5">Check-In</label>
                  <input name="checkIn" type="text" value="<?php echo $checkIn;?>" class="form-control" placeholder="Check-In" id="dph5" autocomplete="off">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label for="dph6">Check-Out</label>
                      <input name="checkOut" type="text" value="<?php echo $checkOut;?>" class="form-control" placeholder="Check-Out"  id="dph6" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="invisible">1 Night</label>
                      <input name="night" type="text" value="1 Night" class="form-control" autocomplete="off" style="background: transparent;border: none;box-shadow: none;cursor: default;padding: 0;margin: 0" readonly="">
                      <input type="hidden" name="results_id" value="<?php echo base64_encode($this->session->session_id.'/'.$newuniqueRefNo.'/'.''.'/'.$hotelDetails->hotel_code.'/'. base64_encode('fitruums').'/'.$hotelDetails->city_code); ?>">
                      <input type="hidden" name="nationality" value="<?php echo $nationality; ?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group indi-room">
                  <label class="control-label">Rooms</label>
                  <div class="input-group">
                    <div class="passenger-inc-dec">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-default btn-number quont-minus-room btn-inc-dec" data-type="minus" data-field="quant[1]">
                        -
                        </button>
                      </span>
                      <input type="text" name="room_count" class="form-control input-number rooms-q" value="1" min="1" max="9">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-default btn-number quont-plus-room btn-inc-dec" data-type="plus" data-field="quant[1]">
                        +
                        </button>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label pax_label">Guests Per Room</label>
                  <div class="pax_input form-control input-group">
                    <span class="out passenger-text"><font class="totAdult">1</font> Adult(s)</span>
                    <span class="out seprator-text">|</span>
                    <span class="out rooms-text"><font class="totChild">0</font> Child(s)</span>
                    <div class="adults-dropdown dropdown-menu select-passenger" style="display: none;">
                      <div class="row room1 no-padding">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label class="control-label">Adults</label>
                            <div class="input-group">
                              <div class="passenger-inc-dec">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec adults" data-type="minus" data-field="quant[1]">
                                  -
                                  </button>
                                </span>
                                <input type="text" name="adults[]" class="form-control input-number adultscount adults-q" value="1" min="1" max="9">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec adults" data-type="plus" data-field="quant[1]">
                                  +
                                  </button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label class="control-label">Child(0-17)</label>
                            <div class="input-group">
                              <div class="passenger-inc-dec">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec childs" data-type="minus" data-field="quant[1]">
                                  -
                                  </button>
                                </span>
                                <input type="text" name="childs[]" class="form-control input-number childscount childs-q" value="0" min="0" max="9">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec childs" data-type="plus" data-field="quant[1]">
                                  +
                                  </button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-12 childAgeBorder" style="display: none;"><hr></div>
                        <div class="col-sm-4 childAge1 childAge1_1" style="display: none;">
                          <div class="form-group">
                            <label class="control-label">Child 1 Age</label>
                            <div class="input-group">
                              <div class="passenger-inc-dec">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                  -
                                  </button>
                                </span>
                                <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge1 childs-age1_1" value="2" min="2" max="17">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                  +
                                  </button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4 childAge2 childAge1_2" style="display: none;">
                          <div class="form-group">
                            <label class="control-label">Child 2 Age</label>
                            <div class="input-group">
                              <div class="passenger-inc-dec">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                  -
                                  </button>
                                </span>
                                <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge2 childs-age1_2" value="2" min="2" max="17">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                  +
                                  </button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4 childAge3 childAge1_3" style="display: none;">
                          <div class="form-group">
                            <label class="control-label">Child 3 Age</label>
                            <div class="input-group">
                              <div class="passenger-inc-dec">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                  -
                                  </button>
                                </span>
                                <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge3 childs-age1_3" value="2" min="2" max="17">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                  +
                                  </button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4 childAge4 childAge1_4" style="display: none;">
                          <div class="form-group">
                            <label class="control-label">Child 4 Age</label>
                            <div class="input-group">
                              <div class="passenger-inc-dec">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                  -
                                  </button>
                                </span>
                                <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge4 childs-age1_4" value="2" min="2" max="17">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                  +
                                  </button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4 childAge5 childAge1_5" style="display: none;">
                          <div class="form-group">
                            <label class="control-label">Child 5 Age</label>
                            <div class="input-group">
                              <div class="passenger-inc-dec">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                  -
                                  </button>
                                </span>
                                <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge5 childs-age1_5" value="2" min="2" max="17">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                  +
                                  </button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4 childAge6 childAge1_6" style="display: none;">
                          <div class="form-group">
                            <label class="control-label">Child 6 Age</label>
                            <div class="input-group">
                              <div class="passenger-inc-dec">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                  -
                                  </button>
                                </span>
                                <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge6 childs-age1_6" value="2" min="2" max="17">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                  +
                                  </button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4 childAge7 childAge1_7" style="display: none;">
                          <div class="form-group">
                            <label class="control-label">Child 7 Age</label>
                            <div class="input-group">
                              <div class="passenger-inc-dec">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                  -
                                  </button>
                                </span>
                                <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge7 childs-age1_7" value="2" min="2" max="17">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                  +
                                  </button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4 childAge8 childAge1_8" style="display: none;">
                          <div class="form-group">
                            <label class="control-label">Child 8 Age</label>
                            <div class="input-group">
                              <div class="passenger-inc-dec">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                  -
                                  </button>
                                </span>
                                <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge8 childs-age1_8" value="2" min="2" max="17">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                  +
                                  </button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4 childAge9 childAge1_9" style="display: none;">
                          <div class="form-group">
                            <label class="control-label">Child 9 Age</label>
                            <div class="input-group">
                              <div class="passenger-inc-dec">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                  -
                                  </button>
                                </span>
                                <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge9 childs-age1_9" value="2" min="2" max="17">
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
                      <div class="row no-padding">
                        <div class="col-sm-12">
                          <div class="rightalign">
                            <button type="button" class="done2 btn btn-primary">Done</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label class="invisible" style="width: 100%">Update</label>
                  <button class="btn btn-black">Update</button>
                </div>
              </div>
             </form>
            </div>
          </div>
          <?php $this->load->view('rooms_available'); ?>
        </div>
      </div>
      <div id="htl-desc">
        <h3 class="accordions-heading" title="Click to hide or show">Hotel Description <span class="fa fa-angle-down pull-right"></span></h3>
        <div class="white-box accordions-content">
          <div class="reviews_text row">
            <div class="col-md-3 col-xs-2 col-sm-2" id="details185">
              <p><i class="fa fa-check"></i> &nbsp;Opened <span>2015</span></p>
            </div>
            <div class="col-md-3 col-xs-2 col-sm-2" id="child_policy185">
              <p><i class="fa fa-check"></i> &nbsp;Number of rooms <span>970</span></p>
            </div>
            <div class="col-md-3 col-xs-3 col-sm-3" id="cancel_policy185">
              <p><i class="fa fa-check"></i> &nbsp; Redecorated <span>2015</span></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p><?php  echo strip_tags(html_entity_decode($hotelDetails->description));?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <iframe src = "https://maps.google.com/maps?q=<?php  echo $hotelDetails->latitude;?>,<?php  echo $hotelDetails->longitude;?>&hl=es;z=14&amp;output=embed" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
           <!--    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.986908732085!2d139.73531131465973!3d35.67732433779478!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188c792e155829%3A0x7d67cda3b625bebb!2sAkasaka-Excel+Hotel-Tokyu!5e0!3m2!1sen!2sin!4v1513834308961" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe> -->
            </div>
          </div>
        </div>
      </div>
      <?php  if(!empty($hotelDetails->trustYouID)){ ?>
      <div id="htl-reviews">
        <h3 class="accordions-heading" title="Click to hide or show">Hotel Reviews <span class="fa fa-angle-down pull-right"></span></h3>
        <div class="white-box accordions-content">  
          <div class="row">
            <div class="btn-group-vertical col-md-3 pull-left">
                <button id="ar" type="button" class="btn btn-default btn-sm loadIFrame">Arabic</button>
                <button id="zh" type="button" class="btn btn-default btn-sm loadIFrame">Chinese</button>
                <button id="zht" type="button" class="btn btn-default btn-sm loadIFrame">Chinese (traditional)</button>
                <button id="cs" type="button" class="btn btn-default btn-sm loadIFrame">Czech</button>
                <button id="da" type="button" class="btn btn-default btn-sm loadIFrame">Danish</button>
                <button id="nl" type="button" class="btn btn-default btn-sm loadIFrame">Dutch</button>
                <button id="en" type="button" class="btn btn-default btn-sm loadIFrame">English</button>
                <button id="fi" type="button" class="btn btn-default btn-sm loadIFrame">Finnish</button>
                <button id="fr" type="button" class="btn btn-default btn-sm loadIFrame">French</button>
                <button id="de" type="button" class="btn btn-default btn-sm loadIFrame">German</button>
                <button id="el" type="button" class="btn btn-default btn-sm loadIFrame">Greek</button>
                <button id="he" type="button" class="btn btn-default btn-sm loadIFrame">Hebrew</button>
                <button id="id" type="button" class="btn btn-default btn-sm loadIFrame">Indonesian</button>
                <button id="it" type="button" class="btn btn-default btn-sm loadIFrame">Italian</button>
                <button id="ja" type="button" class="btn btn-default btn-sm loadIFrame">Japanese</button>
                <button id="ko" type="button" class="btn btn-default btn-sm loadIFrame">Korean</button>
                <button id="ms" type="button" class="btn btn-default btn-sm loadIFrame">Malay</button>
                <button id="no" type="button" class="btn btn-default btn-sm loadIFrame">Norwegian</button>
                <button id="pl" type="button" class="btn btn-default btn-sm loadIFrame">Polish</button>
                <button id="pt" type="button" class="btn btn-default btn-sm loadIFrame">Portuguese</button>
                <button id="pt-BR" type="button" class="btn btn-default btn-sm loadIFrame">Portuguese (Brasilian)</button>
                <button id="ru" type="button" class="btn btn-default btn-sm loadIFrame">Russian</button>
                <button id="es" type="button" class="btn btn-default btn-sm loadIFrame">Spanish</button>
                <button id="sv" type="button" class="btn btn-default btn-sm loadIFrame">Swedish</button>
                <button id="th" type="button" class="btn btn-default btn-sm loadIFrame">Thai</button>
                <button id="tr" type="button" class="btn btn-default btn-sm loadIFrame">Turkish</button>
                <button id="vi" type="button" class="btn btn-default btn-sm loadIFrame">Vietnamese</button>
              </div>
              <div class="col-md-9 iframe-wrapper">
                <iframe id="ReviewSummary" src="//api.trustyou.com/hotels/<?php echo $hotelDetails->trustYouID; ?>/tops_flops.html?lang=en"  frameBorder=0 width="100%"
            height="1200px" allowtransparency="true"></iframe>
              </div>
            </div>      
        </div>
      </div>
      <?php } ?>
      <div id="htl-amenities">
        <h3 class="accordions-heading" title="Click to hide or show">Hotel Amenities <span class="fa fa-angle-down pull-right"></span></h3>
        <div class="white-box hotel-dtls-amenities accordions-content">
          <div class="row">
            <div class="col-md-3">
              <h4>General</h4>
            </div>
            <div class="col-md-9">
              <ul>
                 <?php
                 $hotels_amenities = explode(',', $hotelDetails->features);
                if(!empty($hotels_amenities)){
                  for($l=0;$l<count($hotels_amenities);$l++)                
                 {
                    if(!empty($hotels_amenities[$l])){                
                ?>
                   <li><span>&raquo;</span><?php echo ucfirst($hotels_amenities[$l]); ?>
                  </li>
                  <?php } } }?>   
               
              </ul>
            </div>
          </div>      
        </div>
      </div>
      <div id="htl-policies">
        <h3 class="accordions-heading" title="Click to hide or show">Hotel Policies <span class="fa fa-angle-down pull-right"></span></h3>
        <div class="white-box accordions-content">
          <div class="hotel-policies">
            <div class="row">
              <div class="col-md-2 col-sm-4">
                <h6>Check-in &amp; Check-out</h6>
              </div>
              <div class="col-md-10 col-sm-8">
                <p>Check-in: from 14:00 Check-out: before 11:00</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-4">
                <h6>Children and Extra Beds</h6>
              </div>
              <div class="col-md-10 col-sm-8">
                <p>Children over 12 year(s) old will be charged the adult fee.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam consequuntur necessitatibus quas voluptate ipsa iste cumque dicta totam deserunt repellat. Tenetur inventore, doloribus hic nesciunt nobis repudiandae non mollitia molestias!</p>
                <p>Children and Extra Beds:</p>
                <div class="grey-box">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td><i class="fa fa-child"></i> Children between 0-12 year(s) old</td>
                        <td>Free Bed-share</td>
                        <td>Breakfast: Not included</td>
                        <td>Max 1 child(ren) per room</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-4">
                <h6>Dining</h6>
              </div>
              <div class="col-md-10 col-sm-8">
                <p>Western breakfast</p>
                <p>Buffet breakfast JPY 2,600</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-4">
                <h6>Pets</h6>
              </div>
              <div class="col-md-10 col-sm-8">
                <p>No pets allowed</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="htl-blogs">
        <h3 class="accordions-heading" title="Click to hide or show">Hotel Blogs<span class="fa fa-angle-down pull-right"></span></h3>
        <div class="white-box accordions-content">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim, ea libero odit ipsum, quisquam saepe dolor quibusdam nobis harum vel, minima, sit numquam cum doloremque dicta. Unde ut maxime deserunt! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, incidunt, reiciendis? Voluptas, deserunt nihil consequatur minima provident! Cupiditate amet dignissimos repellendus maxime laboriosam qui atque tenetur enim, ratione illum, commodi.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="cart-msg" id='msg'></div>
<a href="#" id="back-top" title="Back To Top" class=""></a>
 <?php $this->load->view('home/footer');?>
<script src="<?php echo base_url();?>public/vendor/grid_gallery/images-grid.js"></script>
 <script>
  $(document).ready(function () {
    $('.accordions-heading').each(function () {
      var $this = $(this);
      $this.click(function () {
        if ($this.next('.accordions-content').is(':visible')) {
          $this.next('.accordions-content').slideUp('slow');
          $this.find('span').removeClass('fa-angle-down').addClass('fa-angle-right');
        } else {
          $this.next('.accordions-content').slideDown('slow');
          $this.find('span').removeClass('fa-angle-right').addClass('fa-angle-down');
        }
      });
    });
  });
</script> 
<script type="text/javascript">
var header = $(".fixed-tab");
var posFromTop = header.offset().top;

$(window).on("scroll", function(e) {
  var scrollTop = $(window).scrollTop();
  if(scrollTop > posFromTop) {
    header.addClass("fixed");
    $('.detail-content').addClass("fixed");
  } else {
    header.removeClass("fixed");
    $('.detail-content').removeClass("fixed");
  }
});
</script>
 <script type="text/javascript">
$(document).ready(function () {
    $(document).on("scroll", onScroll);
    //smoothscroll
    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        $(document).off("scroll");
        
        $('a').each(function () {
            $(this).removeClass('active');
        })
        $(this).addClass('active');
      
        var target = this.hash;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 600, 'linear', function () {
            window.location.hash = target;
            $(document).on("scroll", onScroll);
        });
    });
});

function onScroll(event){
  var scrollPos = $(document).scrollTop();
  $('.ajax-tab a').each(function () {
    var currLink = $(this);
    var refElement = $(currLink.attr("href"));
    var headerheight = $(".fixed-tab").height()+35;
    if (refElement.position().top - headerheight <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
        $('.ajax-tab ul li a').removeClass("active");
        currLink.addClass("active");
    }
    else{
        // currLink.removeClass("active");
    }
  });
}
</script>

  <?php  if(!empty($hotelDetails->trustYouID)){ ?>
<script type="text/javascript">
    $(document).ready(function(){
      var active = null;
      var iframe = $("#ReviewSummary");
      var current_widget = 'http://api.trustyou.com/hotels/<?php echo $hotelDetails->trustYouID; ?>/tops_flops.html?lang=';
      
      
      $(document).on("click", ".loadIFrame:not(.active)", function(){
        /* we need that kind of selector in order to filter the active button */
        if(active != null){
          active.removeClass("active");
        }
        active = $(this);
        active.addClass('active');
        var lang = active.attr('id');
        iframe.attr('src', current_widget + lang);
      });
    });
</script>

<?php } ?>

<script type="text/javascript">
  $(document).ready(function () {
      $(document).on("scroll", onScroll);
      //smoothscroll
      $('.ajax-tab a[href^="#"], #jump_rooms2,#jump_reviews2').on('click', function (e) {
          e.preventDefault();
          $(document).off("scroll");
          
          $('.ajax-tab a').each(function () {
              $(this).removeClass('active');
          })
          $(this).addClass('active');
        
          var target = this.hash;
          $target = $(target);
          $('html, body').stop().animate({
              'scrollTop': $target.offset().top
          }, 600, 'linear', function () {
              window.location.hash = target;
              $(document).on("scroll", onScroll);
          });
      });
  });

  function onScroll(event){
    var scrollPos = $(document).scrollTop();
    $('.ajax-tab a').each(function () {
      var currLink = $(this);
      var refElement = $(currLink.attr("href"));
      var headerheight = $(".fixed-tab").height()+35;
      if (refElement.position().top - headerheight <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
          $('.ajax-tab ul li a').removeClass("active");
          currLink.addClass("active");
      }
      else{
          // currLink.removeClass("active");
      }
    });
  }
</script>

<script type="text/javascript">
  $('.modifySearch').on('click', function(){
    $('#reservation-form').slideToggle();
  })
</script>

<script type="text/javascript">
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
</script>
 <?php  if ($hotelDetails->images != '') { ?>
 <?php  $Images = explode(',', $hotelDetails->images); ?>
<script>
  var images = [
           <?php  foreach ($Images as $img) { ?>
            '//www.sunhotels.net/SunHotels.net/HotelInfo/hotelImage.aspx?id=<?php echo $img; ?>&full=1',
           <?php }  ?>  
          ];
  

  $(function() {

      $('#gallery-div').imagesGrid({
          images: images,
       
          align: false,
          getViewAllText: function(imgsCount) { return 'All photos' }
      });

  });
</script>
 <?php  } ?>  


