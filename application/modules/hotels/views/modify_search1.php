 <?php
 $nationality = $this->Home_Model->get_country();
  $session_data = $this->session->userdata('hotel_search_data');

$adults = $session_data['adults'];
$childs = $session_data['childs'];
$adult_extrabed = $session_data['adult_extrabed'];
$child_extrabed = $session_data['child_extrabed'];
$childs_ages = $session_data['childs_ages'];
$adults_count = $session_data['adults_count'];
$childs_count = $session_data['childs_count'];
$adult_extrabed_count = $session_data['adult_extrabed_count'];
$child_extrabed_count = $session_data['child_extrabed_count'];

 ?>       
              <div class="panel style1 arrow-right modify-panel">
                <h4 class="panel-title">
                <a data-toggle="collapse" href="#modify-search-panel" class="">Modify Search</a>
                </h4>
                <div id="modify-search-panel" class="panel-collapse collapse">
                  <div class="panel-content">
                   <form name="hotel_search" action="<?php echo site_url(); ?>hotels/results" method="post">
                      <div class="form-group">
                        <label>Location/Hotel Name</label>
                        <input type="text" class="input-text full-width" placeholder="Enter Location/Hotel Name" name="cityName" value="<?php echo $session_data['cityName'];?>" id="cityName"  required/>
                         <input type="hidden" name="cityid" id="cityid"  value="<?php echo $session_data['cityCode'];?>" required/>
                         <input type="hidden" name="hotelname" id="hotelname" value="<?php echo $session_data['hotelname'];?>" required />
                        <!-- <input type="hidden" id="hotelName" /> -->
                      </div>
                      <div class="form-group">
                        <label>check in</label>
                        <div class="datepicker-wrap">
                          <input type="text" name="checkIn"  value="<?php echo $session_data['checkIn'];?>" class="input-text full-width" placeholder="dd/mm/yy" required/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>check out</label>
                        <div class="datepicker-wrap">
                          <input type="text" name="checkOut"  value="<?php echo $session_data['checkOut'];?>" class="input-text full-width" placeholder="dd/mm/yy" required/>
                        </div>
                      </div>                 
                  <div class="form-group pax-select adults-drop-wrapper">
                        <div class="row">
                          <div class="col-xs-12">
                            <label>Guest(s) / Room(s)</label>
                            <div style="position: relative;">
                              <i class="fa fa-child" aria-hidden="true"></i>
                              <input type="text" id="noOfPassengers" value="1" class="form-control passengers no-input" placeholder="Passengers" readonly />
                              <span class="rooms-text"><span id="total_rooms">1</span> Room(s) |</span>
                              <span class="passenger-text">Guest(s) |</span>
                              <span class="extrabed-text"><span id="total_beds">0</span> extra bed(s)</span>
                      <div class="adults-dropdown dropdown-menu select-passenger hide" style="width: 550px;">
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
                              <div class="col-xs-2">
                                <div class="form-group">
                                  <label class="control-label invisible">Rooms</label>
                                  <div class="input-group">
                                    <label class="control-label">Room 1</label>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-2">
                                <div class="form-group">
                                  <label class="control-label">Adults</label>
                                  <div class="input-group">
                                    <div class="passenger-inc-dec">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec" data-type="minus" data-field="quant[1]">
                                        -
                                        </button>
                                      </span>
                                      <input type="text" name="adults[]" class="form-control input-number adultscount" value="1" min="1" max="3" id="adults-q">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec" data-type="plus" data-field="quant[1]">
                                        +
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-2">
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
                                  <label class="control-label">ExtraBed(Adults)</label>
                                  <div class="input-group">
                                    <div class="passenger-inc-dec">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-minus-e btn-inc-dec extrabeds" data-type="minus" data-field="quant[1]">
                                        -
                                        </button>
                                      </span>
                                      <input type="text" name="adult_extrabed[]" class="form-control input-number extrabedcount" value="0" min="0" max="3" id="extrabed-q">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-plus-e btn-inc-dec extrabeds" data-type="plus" data-field="quant[1]">
                                        +
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3">
                                <div class="form-group">
                                  <label class="control-label">ExtraBed(Child)</label>
                                  <div class="input-group">
                                    <div class="passenger-inc-dec">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-minus-e btn-inc-dec extrabeds" data-type="minus" data-field="quant[1]">
                                        -
                                        </button>
                                      </span>
                                      <input type="text" name="child_extrabed[]" class="form-control input-number extrabedcount" value="0" min="0" max="3" id="extrabed-q">
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
                                      <input type="text" name="childs_ages_room1[]" class="form-control input-number" value="1" min="1" max="11" id="childs-age1">
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
                                      <input type="text" name="childs_ages_room1[]" class="form-control input-number" value="1" min="1" max="11" id="childs-age2">
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
                                      <input type="text" name="childs_ages_room1[]" class="form-control input-number" value="1" min="1" max="11" id="childs-age3">
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
                              <div class="col-xs-2">
                                <div class="form-group">
                                  <label class="control-label invisible">Rooms</label>
                                  <div class="input-group">
                                    <label class="control-label">Room 2</label>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-2">
                                <div class="form-group">
                                  <label class="control-label">Adults</label>
                                  <div class="input-group">
                                    <div class="passenger-inc-dec">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec" data-type="minus" data-field="quant[1]">
                                        -
                                        </button>
                                      </span>
                                      <input type="text" name="adults[]" class="form-control input-number adultscount" value="1" min="1" max="3" id="adults-q2">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec" data-type="plus" data-field="quant[1]">
                                        +
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-2">
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
                                  <label class="control-label">ExtraBed(Adults)</label>
                                  <div class="input-group">
                                    <div class="passenger-inc-dec">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-minus-e btn-inc-dec extrabeds" data-type="minus" data-field="quant[1]">
                                        -
                                        </button>
                                      </span>
                                      <input type="text" name="adult_extrabed[]" class="form-control input-number extrabedcount" value="0" min="0" max="3" id="extrabed-q">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-plus-e btn-inc-dec extrabeds" data-type="plus" data-field="quant[1]">
                                        +
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3">
                                <div class="form-group">
                                  <label class="control-label">ExtraBed(Child)</label>
                                  <div class="input-group">
                                    <div class="passenger-inc-dec">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-minus-e btn-inc-dec extrabeds" data-type="minus" data-field="quant[1]">
                                        -
                                        </button>
                                      </span>
                                      <input type="text" name="child_extrabed[]" class="form-control input-number extrabedcount" value="0" min="0" max="3" id="extrabed-q">
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
                                      <input type="text" name="childs_ages_room2[]" class="form-control input-number" value="1" min="1" max="11" id="childs-age1">
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
                                      <input type="text" name="childs_ages_room2[]" class="form-control input-number" value="1" min="1" max="11" id="childs-age2">
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
                                      <input type="text" name="childs_ages_room2[]" class="form-control input-number" value="1" min="1" max="11" id="childs-age3">
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
                              <div class="col-xs-2">
                                <div class="form-group">
                                  <label class="control-label invisible">Rooms</label>
                                  <div class="input-group">
                                    <label class="control-label">Room 3</label>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-2">
                                <div class="form-group">
                                  <label class="control-label">Adults</label>
                                  <div class="input-group">
                                    <div class="passenger-inc-dec">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec" data-type="minus" data-field="quant[1]">
                                        -
                                        </button>
                                      </span>
                                      <input type="text" name="adults[]" class="form-control input-number adultscount" value="1" min="1" max="3" id="adults-q3">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec" data-type="plus" data-field="quant[1]">
                                        +
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-2">
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
                                  <label class="control-label">ExtraBed(Adults)</label>
                                  <div class="input-group">
                                    <div class="passenger-inc-dec">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-minus-e btn-inc-dec extrabeds" data-type="minus" data-field="quant[1]">
                                        -
                                        </button>
                                      </span>
                                      <input type="text" name="adult_extrabed[]" class="form-control input-number extrabedcount" value="0" min="0" max="3" id="extrabed-q">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-plus-e btn-inc-dec extrabeds" data-type="plus" data-field="quant[1]">
                                        +
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3">
                                <div class="form-group">
                                  <label class="control-label">ExtraBed(Child)</label>
                                  <div class="input-group">
                                    <div class="passenger-inc-dec">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-minus-e btn-inc-dec extrabeds" data-type="minus" data-field="quant[1]">
                                        -
                                        </button>
                                      </span>
                                      <input type="text" name="child_extrabed[]" class="form-control input-number extrabedcount" value="0" min="0" max="3" id="extrabed-q">
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
                                      <input type="text" name="childs_ages_room3[]" class="form-control input-number" value="1" min="1" max="11" id="childs-age1">
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
                                      <input type="text" name="childs_ages_room3[]" class="form-control input-number" value="1" min="1" max="11" id="childs-age2">
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
                                      <input type="text" name="childs_ages_room3[]" class="form-control input-number" value="1" min="1" max="11" id="childs-age3">
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
                              <div class="col-xs-2">
                                <div class="form-group">
                                  <label class="control-label invisible">Rooms</label>
                                  <div class="input-group">
                                    <label class="control-label">Room 4</label>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-2">
                                <div class="form-group">
                                  <label class="control-label">Adults</label>
                                  <div class="input-group">
                                    <div class="passenger-inc-dec">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec" data-type="minus" data-field="quant[1]">
                                        -
                                        </button>
                                      </span>
                                      <input type="text" name="adults[]" class="form-control input-number adultscount" value="1" min="1" max="3" id="adults-q4">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec" data-type="plus" data-field="quant[1]">
                                        +
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-2">
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
                                  <label class="control-label">ExtraBed(Adults)</label>
                                  <div class="input-group">
                                    <div class="passenger-inc-dec">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-minus-e btn-inc-dec extrabeds" data-type="minus" data-field="quant[1]">
                                        -
                                        </button>
                                      </span>
                                      <input type="text" name="adult_extrabed[]" class="form-control input-number extrabedcount" value="0" min="0" max="3" id="extrabed-q">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-plus-e btn-inc-dec extrabeds" data-type="plus" data-field="quant[1]">
                                        +
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                               <div class="col-xs-3">
                                <div class="form-group">
                                  <label class="control-label">ExtraBed(Child)</label>
                                  <div class="input-group">
                                    <div class="passenger-inc-dec">
                                      <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number quont-minus-e btn-inc-dec extrabeds" data-type="minus" data-field="quant[1]">
                                        -
                                        </button>
                                      </span>
                                      <input type="text" name="child_extrabed[]" class="form-control input-number extrabedcount" value="0" min="0" max="3" id="extrabed-q">
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
                                      <input type="text" name="childs_ages_room4[]" class="form-control input-number" value="1" min="1" max="11" id="childs-age1">
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
                                      <input type="text" name="childs_ages_room4[]" class="form-control input-number" value="1" min="1" max="11" id="childs-age2">
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
                                      <input type="text" name="childs_ages_room4[]" class="form-control input-number" value="1" min="1" max="11" id="childs-age3">
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
                      
                <div class="form-group">                              
                      <label>Nationality</label>
                      <div class="">
                        <select class="form-control" name="nationality" required>
                          <option value="">Select Nationality</option>
                          <?php foreach ($nationality as $val) { ?>
                              <option value="<?php echo $val->country_code; ?>" <?php if($val->country_code=="AE"){ echo "Selected";}?>><?php echo $val->country_name; ?></option>

                          <?php } ?>
                       </select>
                      </div>
                    </div>
                   <div class="form-group">  
                      <label>Country of Residence</label>
                      <div class="">
                        <select class="form-control" name="res_nationality" required>
                          <option value="">Select Country of Residence</option>
                          <?php foreach ($nationality as $val1) { ?>
                              <option value="<?php echo $val1->country_code; ?>" <?php if($val1->country_code=="AE"){ echo "Selected";}?>><?php echo $val1->country_name; ?></option>

                          <?php } ?>
                       </select>
                      </div>
                    </div>
                  
                      <br />
                      <button type="submit" class="button btn-small full-width text-uppercase">search</button>
                    </form>
                  </div>
                </div>
              </div>
              
             