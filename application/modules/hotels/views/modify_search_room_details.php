<?php
   $this->load->model('Home/Home_Model');
   $country= $this->Home_Model->get_country();
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
 ?>
<section id="" class="push-top-20">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <section id="reservation-form" class="reservation-color-form pos-inside-slide">
          <div class="container-form-chose">
            <div class="row2 reservation-flight no-padding">
          <form id="hotels-tab"  action="<?php echo site_url();?>/hotels/results" class="tab-pane form-inline active"  method="post" name="reservationform">
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="dph3">Check-In</label>
                    <input name="checkIn" type="text" value="<?php echo $checkIn;?>" class="form-control" placeholder="Check-In" id="dph3" >
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                   <label for="dph4">Check-Out</label>
                    <input name="checkOut" type="text" value="<?php echo $checkOut;?>"  class="form-control" placeholder="Check-Out"  id="dph4" >
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="nationality">Nationality</label>              
                    <select name="nationality" class="form-control" required="">
                    <option value="">Select</option>
                    <?php foreach($country as $val){?>
                    <option value="<?php echo $val->country_code; ?>" <?php if($val->country_code==$nationality){ echo "selected"; }?>><?php echo $val->country_name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-2 adults-drop-wrapper">
                <label class="pax_label" for="noOfPassengers">No of Guests</label>
                <div class="form-control pax_input">
                  <input type="hidden" class="noOfPassengers" value="<?php echo $noOfPassengers;?>" class="passengers">
                  <span class="out passenger-text"><font class="totpax"><?php echo $noOfPassengers;?></font> Guest(s)</span>
                  <span class="out seprator-text">|</span>
                  <span class="out rooms-text"><font class="total_rooms"><?php echo $rooms;?></font> Room(s)</span>
                  <div class="adults-dropdown dropdown-menu select-passenger" style="display: none;">
                    <div class="row room1 no-padding">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label class="control-label">Rooms</label>
                          <div class="input-group">
                            <div class="passenger-inc-dec">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-minus-room btn-inc-dec" data-type="minus" data-field="quant[1]">
                                -
                                </button>
                              </span>
                              <input type="text" name="room_count" class="form-control input-number rooms-q" value="<?php echo $rooms;?>" min="1" max="9">
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
                          <label class="control-label">Adults</label>
                          <div class="input-group">
                            <div class="passenger-inc-dec">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec" data-type="minus" data-field="quant[1]">
                                -
                                </button>
                              </span>
                              <input type="text" name="adults[]" class="form-control input-number adultscount adults-q" value="<?php echo $adults;?>" min="1" max="9">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec" data-type="plus" data-field="quant[1]">
                                +
                                </button>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label class="control-label">Child(2-11)</label>
                          <div class="input-group">
                            <div class="passenger-inc-dec">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-minus btn-inc-dec childs" data-type="minus" data-field="quant[1]">
                                -
                                </button>
                              </span>
                              <input type="text" name="childs[]" class="form-control input-number childscount childs-q" value="<?php echo $childs;?>" min="0" max="9">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-plus btn-inc-dec childs" data-type="plus" data-field="quant[1]">
                                +
                                </button>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label class="control-label">Infant(0-1)</label>
                          <div>
                            <a href="#" class="small" data-value="infant" tabIndex="-1"><input type="checkbox" name="infant" value="1" <?php if($infant==1){echo "checked"; } ?>></a>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 childAgeBorder" style="display: none;"><hr></div>
                      <div class="col-sm-4 childAge1" id="childAge1_1" style="display: none;">
                        <div class="form-group">
                          <label class="control-label">Child 1 Age</label>
                          <div class="input-group">
                            <div class="passenger-inc-dec">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                -
                                </button>
                              </span>
                              <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge1" value="2" min="2" max="11" id="childs-age1_1">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                +
                                </button>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4 childAge2" id="childAge1_2" style="display: none;">
                        <div class="form-group">
                          <label class="control-label">Child 2 Age</label>
                          <div class="input-group">
                            <div class="passenger-inc-dec">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                -
                                </button>
                              </span>
                              <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge2" value="2" min="2" max="11" id="childs-age1_2">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                +
                                </button>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4 childAge3" id="childAge1_3" style="display: none;">
                        <div class="form-group">
                          <label class="control-label">Child 3 Age</label>
                          <div class="input-group">
                            <div class="passenger-inc-dec">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                -
                                </button>
                              </span>
                              <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge3" value="2" min="2" max="11" id="childs-age1_3">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                +
                                </button>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4 childAge4" id="childAge1_4" style="display: none;">
                        <div class="form-group">
                          <label class="control-label">Child 4 Age</label>
                          <div class="input-group">
                            <div class="passenger-inc-dec">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                -
                                </button>
                              </span>
                              <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge1" value="2" min="2" max="11" id="childs-age1_4">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                +
                                </button>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4 childAge5" id="childAge1_5" style="display: none;">
                        <div class="form-group">
                          <label class="control-label">Child 5 Age</label>
                          <div class="input-group">
                            <div class="passenger-inc-dec">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                -
                                </button>
                              </span>
                              <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge2" value="2" min="2" max="11" id="childs-age1_5">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                +
                                </button>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4 childAge6" id="childAge1_6" style="display: none;">
                        <div class="form-group">
                          <label class="control-label">Child 6 Age</label>
                          <div class="input-group">
                            <div class="passenger-inc-dec">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                -
                                </button>
                              </span>
                              <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge3" value="2" min="2" max="11" id="childs-age1_6">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                +
                                </button>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4 childAge7" id="childAge1_7" style="display: none;">
                        <div class="form-group">
                          <label class="control-label">Child 7 Age</label>
                          <div class="input-group">
                            <div class="passenger-inc-dec">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                -
                                </button>
                              </span>
                              <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge1" value="2" min="2" max="11" id="childs-age1_7">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                +
                                </button>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4 childAge8" id="childAge1_8" style="display: none;">
                        <div class="form-group">
                          <label class="control-label">Child 8 Age</label>
                          <div class="input-group">
                            <div class="passenger-inc-dec">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                -
                                </button>
                              </span>
                              <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge2" value="2" min="2" max="11" id="childs-age1_8">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-plus3 btn-inc-dec" data-type="plus" data-field="quant[1]">
                                +
                                </button>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4 childAge9" id="childAge1_9" style="display: none;">
                        <div class="form-group">
                          <label class="control-label">Child 9 Age</label>
                          <div class="input-group">
                            <div class="passenger-inc-dec">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number quont-minus3 btn-inc-dec" data-type="minus" data-field="quant[1]">
                                -
                                </button>
                              </span>
                              <input type="text" name="childs_ages_room1[]" class="form-control input-number childAge3" value="2" min="2" max="11" id="childs-age1_9">
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
              <div class="col-sm-2 colbtn">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block searchbtn">Update</button>
                </div>
              </div>
              <div class="clearfix"></div>
            </form>
       </div>
          </div>
        </section>
      </div>
    </div>
   
  </div>
</div>
 

 