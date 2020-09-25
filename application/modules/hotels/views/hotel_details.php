<?php $this->load->view('home/header');?>
 <section id="add-banner">
    <div class="container">
      <div class="row2 add-banner"></div>
    </div>
  </section>

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
          <a href="result.html" class="transparent-btn full-width uppercase">Back to Search</a>
        </div>
        <div class="travelo-box2">
          <a class="button orange full-width btn-large">Book for AED 3,330</a>
        </div>
        <div class="travelo-box2">
          <label class="uppercase">Show on map</label>
          <img src="<?php echo base_url();?>/public/images/ritz.png" alt="" class="img-responsive">
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
        <article class="travelo-box2">
          <h2 class="box-title">Fairmont Dubai</h2>
          <div title="" class="five-stars-container" data-toggle="tooltip" data-placement="bottom" data-original-title="4 stars"><span class="five-stars" style="width: 80%;"></span></div>
          <small><i class="soap-icon-departure yellow-color"></i><span class="fourty-space"> Dubai, United Arab Emirates</span></small>
          <figure><img class="full-width" src="<?php echo base_url();?>/public/images/hotels/3.png" alt=""></figure>
          <div class="details">
          </div>
        </article>
        <article class="travelo-box2">
          <h2 class="box-title">Atlantis the Palm, Dubai</h2>
          <div title="" class="five-stars-container" data-toggle="tooltip" data-placement="bottom" data-original-title="4 stars"><span class="five-stars" style="width: 80%;"></span></div>
          <small><i class="soap-icon-departure yellow-color"></i><span class="fourty-space"> Dubai, United Arab Emirates</span></small>

          <figure><img class="full-width" src="<?php echo base_url();?>/public/images/hotels/4.png" alt=""></figure>
          <div class="details">
          </div>
        </article>
      </div>
      <div class="col-md-9">
        <div class="tab-container style1" id="hotel-main-content">
          <div class="tab-content">
            <div class="row2 tab-pane fade in active">
              <div id="photos-tab" class="row2 content-seperate">
                <article style="margin-bottom: 5px;">
                  <div class="details">
                    <h2 class="box-title pull-left">The Ritz-Carlton, Dubai<small><i class="soap-icon-departure yellow-color"></i><span class="fourty-space"> Jumeirah Beach Residence, Dubai</span></small></h2>
                    <div class="feedback clearfix text-right">
                      <div title="4 stars" class="five-stars-container" data-toggle="tooltip" data-placement="bottom"><span class="five-stars" style="width: 80%;"></span></div>
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
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/1.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/2.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/3.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/4.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/5.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/6.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/7.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/8.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/9.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/10.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/11.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/12.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/13.jpg" alt="" /></li>
                      </ul>
                    </div>
                    <div class="image-carousel style1" data-animation="slide" data-item-width="70" data-item-margin="10" data-sync="#all-photos .photo-gallery">
                      <ul class="slides">
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/1.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/2.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/3.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/4.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/5.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/6.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/7.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/8.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/9.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/10.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/11.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/12.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/13.jpg" alt="" /></li>
                      </ul>
                    </div>
                  </div>
                  <div id="food-drink" class="tab-pane fade">
                    <div class="photo-gallery style1" data-animation="slide" data-sync="#food-drink .image-carousel">
                      <ul class="slides">
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/1.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/2.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/3.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/4.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/5.jpg" alt="" /></li>
                      </ul>
                    </div>
                    <div class="image-carousel style1" data-animation="slide" data-item-width="70" data-item-margin="10" data-sync="#food-drink .photo-gallery">
                      <ul class="slides">
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/1.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/2.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/3.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/4.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/5.jpg" alt="" /></li>
                      </ul>
                    </div>
                  </div>
                  <div id="rooms-photos" class="tab-pane fade">
                    <div class="photo-gallery style1" data-animation="slide" data-sync="#rooms-photos .image-carousel">
                      <ul class="slides">
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/9.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/4.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/6.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/1.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/7.jpg" alt="" /></li>
                      </ul>
                    </div>
                    <div class="image-carousel style1" data-animation="slide" data-item-width="70" data-item-margin="10" data-sync="#rooms-photos .photo-gallery">
                      <ul class="slides">
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/9.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/4.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/6.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/1.jpg" alt="" /></li>
                        <li><img src="<?php echo base_url();?>/public/images/shortcodes/gallery-popup/thumbnail/7.jpg" alt="" /></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div id="description-tab" class="row2 content-seperate">
                <div class="row2 content-heading"><h4>Description</h4></div>
                <p>
                  Amid Dubai’s ever-climbing skyscrapers is an opportunity to experience the city’s unique perspective, one where tradition underlines modernity and it’s possible to find quiet while the world watches for the next innovation. Set within a low-rise, Mediterranean-style building, The Ritz-Carlton, Dubai sits along the beachfront JBR Walk, the UAE’s largest outdoor shopping and dining promenade, and offers Gulf views from each of its guest rooms and suites. Within our beautifully landscaped resort, guests will discover the hotel’s six swimming pools, nine bars and restaurants, a luxury spa and grand indoor and outdoor event spaces.<br><br>
                  Amid Dubai’s ever-climbing skyscrapers is an opportunity to experience the city’s unique perspective, one where tradition underlines modernity and it’s possible to find quiet while the world watches for the next innovation. Set within a low-rise, Mediterranean-style building, The Ritz-Carlton, Dubai sits along the beachfront JBR Walk, the UAE’s largest outdoor shopping and dining promenade, and offers Gulf views from each of its guest rooms and suites. Within our beautifully landscaped resort, guests will discover the hotel’s six swimming pools, nine bars and restaurants, a luxury spa and grand indoor and outdoor event spaces.<br><br>
                  Amid Dubai’s ever-climbing skyscrapers is an opportunity to experience the city’s unique perspective, one where tradition underlines modernity and it’s possible to find quiet while the world watches for the next innovation. Set within a low-rise, Mediterranean-style building, The Ritz-Carlton, Dubai sits along the beachfront JBR Walk, the UAE’s largest outdoor shopping and dining promenade, and offers Gulf views from each of its guest rooms and suites. Within our beautifully landscaped resort, guests will discover the hotel’s six swimming pools, nine bars and restaurants, a luxury spa and grand indoor and outdoor event spaces.
                </p>
              </div>
              <div id="meal-options" class="row2 content-seperate">
                <div class="row2 content-heading"><h4>Meal Options</h4></div>
                <div class="row">
                  <div class="col-sm-2">
                    <b>Breakfast:</b>
                  </div>
                  <div class="col-sm-6">
                    Continental, Full English/Irish, American, Buffet.
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-2">
                    <b>Restaurants:</b>
                  </div>
                  <div class="col-sm-6">
                    A la Carte
                  </div>
                </div>
              </div>
              <div id="edit-options" class="row2 content-seperate">
                <div class="row2 content-heading"><h4>Edit Options</h4></div>
                <div class="row2 edit-form">
                  <form action="result.html" method="post">
                    <div class="row">
                      <div class="form-group col-sm-6 col-md-5">
                        <div class="row">
                          <div class="col-xs-6">
                            <label>Check In</label>
                            <div class="datepicker-wrap">
                              <input type="text" name="date_from" class="input-text full-width" placeholder="mm/dd/yy" />
                            </div>
                          </div>
                          <div class="col-xs-6">
                            <label>Check Out</label>
                            <div class="datepicker-wrap">
                              <input type="text" name="date_to" class="input-text full-width" placeholder="mm/dd/yy" />
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
                        <button type="submit" class="full-width icon-check animated" data-animation-type="bounce" data-animation-duration="1">SEARCH</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div id="available_rooms" class="row2 content-seperate">
                <div class="row2 content-heading"><h4>Rooms Available</h4></div>
                <table class="table avail_rooms table-striped-column table-bordered" bgcolor="#f9d3b3" style="background-color: #f9d3b3">
                  <thead>
                    <tr bgcolor="#f5872e" style="color: #fff">
                      <th>Room Type</th>
                      <th>No. of Guests (Maximum)</th>
                      <th>Price</th>
                      <th>Inclusions</th>
                      <!-- <th>Rooms</th> -->
                      <th>Confirmation</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        Family Two Bedroom
                        <figure><img width="150" height="100" src="<?php echo base_url();?>/public/images/hotels/3.png" alt=""></figure>
                      </td>
                      <td>5 Guest + 2 Extra Bed</td>
                      <td>Pay Only<br>AED 3,330</td>
                      <td>
                        <ul>
                          <li>Special Condition</li>
                          <li>Breakfast Included</li>
                        </ul>
                      </td>
                      <!-- <td>
                        <select class="form-control">
                          <option>AED 3330</option>
                          <option>AED 3330</option>
                          <option>AED 3330</option>
                        </select>
                      </td> -->
                      <td>
                        <button class="btn">Reservation</button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Family Two Bedroom
                        <figure><img width="150" height="100" src="<?php echo base_url();?>/public/images/hotels/3.png" alt=""></figure>
                      </td>
                      <td>5 Guest + 2 Extra Bed</td>
                      <td>Pay Only<br>AED 3,330</td>
                      <td>
                        <ul>
                          <li>Special Condition</li>
                          <li>Breakfast Included</li>
                        </ul>
                      </td>
                      <!-- <td>
                        <select class="form-control">
                          <option>AED 3330</option>
                          <option>AED 3330</option>
                          <option>AED 3330</option>
                        </select>
                      </td> -->
                      <td>
                        <button class="btn">Reservation</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div id="facilities" class="row2 content-seperate hotel-amenities">
                <div class="row2 content-heading"><h4>Facilities</h4></div>
                <ul class="amenities clearfix style1">
                  <li class="col-md-4 col-sm-6">
                    <div class="icon-box style1"><i class="soap-icon-wifi"></i>WI_FI</div>
                  </li>
                  <li class="col-md-4 col-sm-6">
                    <div class="icon-box style1"><i class="soap-icon-swimming"></i>swimming pool</div>
                  </li>
                  <li class="col-md-4 col-sm-6">
                    <div class="icon-box style1"><i class="soap-icon-television"></i>television</div>
                  </li>
                  <li class="col-md-4 col-sm-6">
                    <div class="icon-box style1"><i class="soap-icon-coffee"></i>coffee</div>
                  </li>
                  <li class="col-md-4 col-sm-6">
                    <div class="icon-box style1"><i class="soap-icon-aircon"></i>air conditioning</div>
                  </li>
                  <li class="col-md-4 col-sm-6">
                    <div class="icon-box style1"><i class="soap-icon-fitnessfacility"></i>fitness facility</div>
                  </li>
                  <li class="col-md-4 col-sm-6">
                    <div class="icon-box style1"><i class="soap-icon-fridge"></i>fridge</div>
                  </li>
                  <li class="col-md-4 col-sm-6">
                    <div class="icon-box style1"><i class="soap-icon-winebar"></i>wine bar</div>
                  </li>
                  <li class="col-md-4 col-sm-6">
                    <div class="icon-box style1"><i class="soap-icon-smoking"></i>smoking allowed</div>
                  </li>
                </ul>
              </div>
              <div id="nearby" class="row2 content-seperate nearby-places">
                <div class="row2 content-heading"><h4>Places Nearby</h4></div>
                <ul class="check-square clearfix">
                  <li class="col-sm-6 col-md-4 active">Restaurant</li>
                  <li class="col-sm-6 col-md-4 active">Hospital</li>
                  <li class="col-sm-6 col-md-4 active">Airport</li>
                  <li class="col-sm-6 col-md-4 active">Railway Station</li>
                  <li class="col-sm-6 col-md-4 active">Schools</li>
                  <li class="col-sm-6 col-md-4 active">Temple</li>
                </ul>
              </div>
              <div id="terms" class="row2 content-seperate">
                <div class="row2 content-heading"><h4>Terms And Conditions</h4></div>
                  <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcorper vulputate nisi, et fringilla ante convallis quis. Nullam vel tellus non elit suscipit volutpat. Integer id felis et nibh rutrum dignissim ut non risus. In tincidunt urna quis sem luctus, sed accumsan magna pellentesque. Donec et iaculis tellus. Vestibulum ut iaculis justo, auctor sodales lectus. Donec et tellus tempus, dignissim maurornare, consequat lacus. Integer dui neque, scelerisque nec sollicitudin sit amet, sodales a erat. Duis vitae condimentum ligula. Integer eu mi nisl. Donec massa dui, commodo id arcu quis, venenatis scelerisque velit.
                    <br /><br />
                  Praesent eros turpis, commodo vel justo at, pulvinar mollis eros. Mauris aliquet eu quam id ornare. Morbi ac quam enim. Cras vitae nulla condimentum, semper dolor non, faucibus dolor. Vivamus adipiscing eros quis orci fringilla, sed pretium lectus viverra. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec nec velit non odio aliquam suscipit. Sed non neque faucibus, condimentum lectus at, accumsan enim. Fusce pretium egestas cursus. Etiam consectetur, orci vel rutrum volutpat, odio odio pretium nisiodo tellus libero et urna. Sed commodo ipsum ligula, id volutpat risus vehicula in. Pellentesque non massa eu nibh posuere bibendum non sed enim. Maecenas lobortis nulla sem, vel egestas dui ullamcorper ac.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
 <?php $this->load->view('home/footer');?> 