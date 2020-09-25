<?php
  // echo $this->router->fetch_method();
  $this->load->model('home/Home_Model');
  if(($this->router->fetch_class()=='hotels')&&($this->router->fetch_method()=='index')) {
    $banners = $this->Home_Model->getBanners('1');
  } else if(($this->router->fetch_class()=='villa')&&($this->router->fetch_method()=='index')){
    $banners = $this->Home_Model->getBanners('2');
  } else if(($this->router->fetch_class()=='holiday')&&($this->router->fetch_method()=='index')){
    $banners = $this->Home_Model->getBanners('3');
  } else {
    $banners = $this->Home_Model->getBanners('4');
  }
?>
<header id="top" class="header" style="<?php if(!empty($banners)) echo 'background-image: url('.getLandingPageBackgroundImage($banners).')' ?>">
  <div class="text-vertical-center">
    <div class="col-lg-10 col-lg-offset-1">
      <section id="reservation-form" class="pos-inside-slide">
        <div class="row2 search-area no-padding">
          <ul class="nav nav-tabs">
            <li class="<?php if($this->router->fetch_class()=='home'||$this->router->fetch_class()=='hotels') echo 'active' ?>">
              <a href="#hotels" data-toggle="tab">Hotels</a>
            </li>
            <li class="<?php if($this->router->fetch_class()=='villa') echo 'active' ?>">
              <a href="#villas" data-toggle="tab">Villas</a>
            </li>
            <li class="<?php if($this->router->fetch_class()=='holiday') echo 'active' ?>">
              <a href="#tours" data-toggle="tab">Tours</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane <?php if($this->router->fetch_class()=='home'||$this->router->fetch_class()=='hotels') echo 'active' ?>" id="hotels">
              <form id="hotels-tab" class="tab-pane active" action="<?php echo site_url(); ?>hotels/results" method="post">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="sr-only" for="destination2">Destination</label>
                    <input type="text" name="cityName" class="form-control autocity" id="destination2" placeholder="Enter a City or Airport" autocomplete="off" onclick="this.select();" pop-type="hotels-tab" required="">
                    <input type="hidden" name="cityid" class="cityid" id="hotelcityid">
                  </div>
                  <span class="active_ajax" style="display: none;"></span>
                  <div class="ajax_dropdown"></div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label class="sr-only" for="dph1">Check-In</label>
                    <input name="checkIn" type="text" value="" class="form-control calendar autodate" placeholder="Check-in" id="dph1" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label class="sr-only" for="dph2">Check-Out</label>
                    <input name="checkOut" type="text" value="" class="form-control calendar" placeholder="Check-out"  id="dph2" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-sm-3 pax_drop">
                  <div class="form-group">
                    <!-- <label for="">No of Guests</label> -->
                    <span class="form-control c-round c-theme travellers-input" id="travellers-hotel">
                      <span class="adultsF travellers-input">1</span> adult,
                      <span class="childsF travellers-input">0</span> child,
                      <span class="room_countF travellers-input">1</span> Room
                    </span>
                  </div>
                  <div class="travellers-input-popup" id="travellers-hotel-popup">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    <!-- <label>Occupancy</label> -->
                    <div class="trip-options">
                      <p>Room - <span>1</span></p>
                      <div class="numstepper small-btns">
                        <button type="button" class="quantity-btn quantity-left-minus btn-number-rooms"  data-type="minus" data-field="room_count"></button>
                        <input type="text" name="room_count" class="quantity-input input-number multi" value="1" min="1" max="4">
                        <button type="button" class="quantity-btn quantity-right-plus btn-number-rooms" data-type="plus" data-field="room_count"></button>
                      </div>
                      <div class="clone-room">
                        <p class="rooms" style="display: none;">Room - <span>2</span></p>
                        
                        <div class="numstepper small-btns">
                          <p>Adults</p>
                          <button type="button" class="quantity-btn quantity-left-minus btn-number-arr" data-type="minus" data-field="adults">
                          </button>
                          <input type="text" name="adults[]" class="quantity-input input-number adults" value="1" min="1" max="3">
                          <button type="button" class="quantity-btn quantity-right-plus btn-number-arr" data-type="plus" data-field="adults">
                          </button>
                        </div>
                        
                        <div class="clone-item roomage">
                          <input type="hidden" class="roomsno" value="1">
                          <p style="display: none;">Child Age - <span>1</span></p>
                          <div class="numstepper small-btns">
                            <p>Children</p>
                            <button type="button" class="quantity-btn quantity-left-minus btn-number-multi roomAge" data-type="minus" data-field="childs">
                            </button>
                            <input type="text" name="childs[]" class="quantity-input input-number multi childs" value="0" min="0" max="3">
                            
                            <button type="button" class="quantity-btn quantity-right-plus btn-number-multi roomAge" data-type="plus" data-field="childs">
                            </button>
                          </div>
                        </div>
                        <div class="clonediv"></div>
                      </div>
                      <div class="clonediv-room"></div>
                    </div>
                  </div>
                </div>
                <!-- <div class="col-sm-1">
                  <div class="form-group">
                    <label class="sr-only" for="rooms">Rooms</label>
                    <select class="form-control" name="room_count" id="rooms">
                      <option value="1">1 Room</option>
                      <option value="2">2 Room</option>
                      <option value="3">3 Room</option>
                      <option value="4">4 Room</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-1">
                  <div class="form-group">
                    <label class="sr-only" for="adult">Adult</label>
                    <select class="form-control" name="adults[]" id="adult">
                      <option value="1">1 Adult</option>
                      <option value="2">2 Adults</option>
                      <option value="3">3 Adults</option>
                      <option value="4">4 Adults</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-1">
                  <div class="form-group">
                    <label class="sr-only" for="child">Children</label>
                    <select class="form-control" name="childs[]" id="child">
                      <option value="0">0 Child</option>
                      <option value="1">1 Child</option>
                      <option value="2">2 Child</option>
                      <option value="3">3 Child</option>
                    </select>
                  </div>
                </div> -->
                <div class="col-sm-2">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block searchbtn">Search</button>
                  </div>
                </div>
                <div class="clearfix"></div>
              </form>
            </div>
            <div class="tab-pane <?php if($this->router->fetch_class()=='villa') echo 'active' ?>" id="villas">
              <form id="villas-tab" class="tab-pane active" action="<?php echo site_url(); ?>villa/results" method="post">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="sr-only" for="villa_cityName">Destination</label>
                    <input type="text" name="cityName" class="form-control autocity" id="villa_cityName" placeholder="Enter a City or Airport" autocomplete="off" onclick="this.select();" pop-type="villas-tab" required="">
                    <input type="hidden" name="cityid" class="cityid" id="villacityid">
                  </div>
                  <span class="active_ajax" style="display: none;"></span>
                  <div class="ajax_dropdown"></div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label class="sr-only" for="dph1">From Date</label>
                    <input name="fromDate" type="text" value="" class="form-control calendar autodate" placeholder="From" id="dpv1" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label class="sr-only" for="dph2">To Date</label>
                    <input name="toDate" type="text" value="" class="form-control calendar" placeholder="To" id="dpv2" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-sm-3 pax_drop">
                  <div class="form-group">
                    <!-- <label for="">No of Guests</label> -->
                    <span class="form-control c-round c-theme travellers-input" id="travellers-villa">
                      <span class="bedroomsF travellers-input">1</span> bedrooms,
                      <span class="bathroomsF travellers-input">1</span> bathrooms,
                      <span class="guestsF travellers-input">1</span> guests
                    </span>
                  </div>
                  <div class="travellers-input-popup" id="travellers-villa-popup">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    <div class="clearfix"></div>
                    <div class="trip-options row no-padding">
                      <div class="numstepper small-btns col-sm-4">
                        <p>Bedrooms</p>
                        <button type="button" class="quantity-btn quantity-left-minus btn-number-v" data-type="minus" data-field="bedrooms">
                        </button>
                        <input type="text" name="bedrooms" class="quantity-input input-number-v bedrooms" value="1" min="1" max="20">
                        <button type="button" class="quantity-btn quantity-right-plus btn-number-v" data-type="plus" data-field="bedrooms">
                        </button>
                      </div>
                      <div class="numstepper small-btns col-sm-4">
                        <p>Bathrooms</p>
                        <button type="button" class="quantity-btn quantity-left-minus btn-number-v" data-type="minus" data-field="bathrooms">
                        </button>
                        <input type="text" name="bathrooms" class="quantity-input input-number-v bathrooms" value="1" min="1" max="20">
                        <button type="button" class="quantity-btn quantity-right-plus btn-number-v" data-type="plus" data-field="bathrooms">
                        </button>
                      </div>
                      <div class="numstepper small-btns col-sm-4">
                        <p>Guests</p>
                        <button type="button" class="quantity-btn quantity-left-minus btn-number-v" data-type="minus" data-field="guests">
                        </button>
                        <input type="text" name="guests" class="quantity-input input-number-v guests" value="1" min="1" max="20">
                        <button type="button" class="quantity-btn quantity-right-plus btn-number-v" data-type="plus" data-field="guests">
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block searchbtn">Search</button>
                  </div>
                </div>
                <div class="clearfix"></div>
              </form>
            </div>
            <div class="tab-pane <?php if($this->router->fetch_class()=='holiday') echo 'active' ?>" id="tours">
              <form id="tours-tab" class="tab-pane" action="<?php echo site_url();?>holiday/holidaysearch" method="post">
                <input type="hidden" value="1" name="holiday_type" id="holiday_type"/>
                <div class="col-sm-10">
                  <div class="form-group">
                    <label class="sr-only" for="hol_cityName">Destination</label>
                    <input type="text" name="cityName" class="form-control autocity" id="hol_cityName" placeholder="Destination" autocomplete="off" onclick="this.select();" pop-type="tours-tab" required="">
                    <input type="hidden" name="cityid" class="cityid" id="holicityid" />
                  </div>
                  <span class="active_ajax" style="display: none;"></span>
                  <div class="ajax_dropdown"></div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <button type="btn" class="btn btn-primary btn-block searchbtn">Search</button>
                  </div>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="col-sm-3" style="padding-right: 8px;">
                  <div class="form-group">
                    <label class="sr-only" for="dpt1">From Date</label>
                    <input name="fromDate" type="text" value="" class="form-control calendar autodate" placeholder="From" id="dpt1" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-sm-3" style="padding-left: 8px;">
                  <div class="form-group">
                    <label class="sr-only" for="dpt2">To Date</label>
                    <input name="toDate" type="text" value="" class="form-control calendar" placeholder="To"  id="dpt2" autocomplete="off" required>
                  </div>
                </div>
                <div class="clearfix"></div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</header>
