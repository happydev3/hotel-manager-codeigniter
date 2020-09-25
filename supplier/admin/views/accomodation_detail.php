<?php $this->load->view('header'); ?>
 <?php echo $this->load->view('left_panel'); ?>
<?php echo $this->load->view('top_panel'); ?>
<!-- <link href="css/custom.css" rel="stylesheet"> -->
<link href="<?php echo base_url(); ?>public/themetemplate/vendors/bootstrap-wysiwyg/css/style.css" rel="stylesheet"/>
<div class="right_col" role="main">
          <ol class="breadcrumb" style="margin: 0px 0px 0px 0px; padding-left: 0px">
          <li class="breadcrumb-item"><a href="#">Accomodation</a>
          </li>
          <li class="breadcrumb-item"><a href="#">Non Api Configuration</a>
          </li>
          <li class="breadcrumb-item"><a href="#">Add your property details</a>
          </li>
        </ol>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Add your property details</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <!-- Smart Wizard -->
                <div id="wizard" class="form_wizard wizard_horizontal">
                  <ul class="wizard_steps">
                    <li>
                      <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr" >
                                              <small>Basic Info</small>
                                          </span>
                          </a>
                    </li>
                    <li>
                      <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr" >
                                              <small>Hotel Contacts</small>
                                          </span>
                          </a>
                    </li>
                    <li>
                      <a href="#step-3">
                            <span class="step_no">3</span>
                            <span class="step_descr" >
                                              <small>Policies</small>
                                          </span>
                          </a>
                    </li>
                    <li>
                      <a href="#step-4">
                            <span class="step_no">4</span>
                            <span class="step_descr" >
                                              <small>Hotel Amenities</small>
                                          </span>
                          </a>
                    </li>
                    <li>
                      <a href="#step-5">
                            <span class="step_no">5</span>
                            <span class="step_descr" >
                                              <small>Room</small>
                                          </span>
                          </a>
                    </li>
                    <li>
                      <a href="#step-6">
                            <span class="step_no">6</span>
                            <span class="step_descr">
                                              <small>Dining & Bar</small>
                                          </span>
                          </a>
                    </li>
                    <li>
                      <a href="#step-7">
                            <span class="step_no">7</span>
                            <span class="step_descr">
                                              <small>Activities</small>
                                          </span>
                          </a>
                    </li>
                    <li>
                      <a href="#step-8">
                            <span class="step_no">8</span>
                            <span class="step_descr">
                                              <small>Common Areas</small>
                                          </span>
                          </a>
                    </li>
                    <li>
                      <a href="#step-9">
                            <span class="step_no">9</span>
                            <span class="step_descr">
                                              <small>Business Centers</small>
                                          </span>
                          </a>
                    </li>
                  </ul>
                  <div id="step-1">
                    <div class="x_panel">
                      <div class="x_content">
                        <form class="form-horizontal form-label-left">
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                              <label for="">Property Name</label>
                              <input type="text" placeholder="" class="form-control">
                          </div>
                          <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                              <label for="">Property Type</label>
                              <select class="form-control">
                                <option>Choose option</option>
                                <option>Home Stay</option>
                                <option>Apartments</option>
                                <option>Luxury Camp</option>
                                <option>Tanted Camp</option>
                                <option>Luxury Lodge</option>
                                <option>Safari Lodge</option>
                                <option>Hotel</option>
                                <option>Resort</option>
                                <option>Havelli</option>
                                <option>Villa</option>
                                <option>Heritage Hotel</option>
                                <option>Cottage</option>
                                </select>
                          </div>
                          <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                           <div class="x_content">
                              <label for="">Star Ratings</label>
                              <div class="clearfix"></div>
                              <div class="starrr stars-existing" data-rating='4'></div>
                              <!--Rating is <span class="stars-count-existing">4</span> star(s)-->
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                            <label for="">Total No. of Rooms</label>
                            <input type="text" placeholder="Total Number of Rooms" class="form-control">
                          </div>
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <label for="">Address</label>
                            <textarea id="message" required class="form-control" name="message" ></textarea>
                          </div>
                          <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                            <label for="">City / Town</label>
                            <select class="form-control">
                              <option>Choose option</option>
                              <option>Option one</option>
                              <option>Option two</option>
                              <option>Option three</option>
                              <option>Option four</option>
                            </select>
                          </div>
                          <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                            <label for="">State</label>
                            <select class="form-control">
                              <option>Choose option</option>
                              <option>Option one</option>
                              <option>Option two</option>
                              <option>Option three</option>
                              <option>Option four</option>
                            </select>
                          </div>
                          <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                            <label for="">Zip Code / Pincode</label>
                            <input type="text" placeholder="Zip Code" class="form-control">
                          </div>
                          <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                              <div class="multi-field-wrapper" id="PhoneNumber">
                                <label for="">Phone number</label> <button type="button" class="add-field fa fa-plus-square"></button>
                                <div class="multi-fields" id="Phone1" style="width:250px; height: 80px; overflow:auto">
                                  <div class="multi-field" id="Phone1_1">
                                    <input type="text" placeholder="Phone Number" name="phoneNo[]">
                                    <button type="button" class="remove-field fa fa-minus-square"></button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group" >
                              <div class="multi-field-wrapper" id="ReservationPhoneNumber">
                                <label for="">Reservation Phone number</label> <button type="button" class="add-field fa fa-plus-square "></button>
                                <div class="multi-fields" id="Phone2" style="width:250px; height: 80px; overflow:auto">
                                  <div class="multi-field" id="Phone2_2">
                                    <input type="text" placeholder="Res. Phone Number" name="reservationPhoneNo[]">
                                    <button type="button" class="remove-field fa fa-minus-square"></button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group" style="overflow: all;"></div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group pull-left">
                              <label for="">Email Id</label>
                              <input type="text" placeholder="Hotel Email Address" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                              <div class="multi-field-wrapper" id="ReservationEmailAddress">
                                <label for="">Reservation Email Id.</label> <button type="button" class="add-field fa fa-plus-square "></button>
                                <div class="multi-fields" id="Email2" style="width:250px; height: 80px; overflow:auto">
                                  <div class="multi-field" id="Email2_2">
                                    <input type="text" placeholder="Res. Email Addr" name="reservationPhoneNo[]">
                                    <button type="button" class="remove-field fa fa-minus-square"></button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group" style="overflow: all;"></div>
  <!--                            <div class="col-md-12 col-sm-12 col-xs-12 form-group  ">
                                <label for="">Themes</label>
                                <p class="checkbox-container form-control">
                                  <input type="checkbox" name="hobbies[]" id="hobby1" value="ski" data-parsley-mincheck="2" required class="flat "/> Swimming Pool
                                  <br/><br/>
                                  <input type="checkbox" name="hobbies[]" id="hobby2" value="run" class="flat "/> Fitness Center
                                  <br/>
                                  <br/>
                                  <input type="checkbox" name="hobbies[]" id="hobby3" value="eat" class="flat "/> SPA Sauna
                                  <br/><br/>
                                  <input type="checkbox" name="hobbies[]" id="hobby4" value="sleep" class="flat "/> Hot Spring Bath
                                  <br/><br/>
                                  <input type="checkbox" name="hobbies[]" id="hobby1" value="ski" data-parsley-mincheck="2" required class="flat "/> Swimming Pool
                                  <br/><br/>
                                  <input type="checkbox" name="hobbies[]" id="hobby2" value="run" class="flat "/> Fitness Center
                                  <br/>
                                  <br/>
                                  <input type="checkbox" name="hobbies[]" id="hobby3" value="eat" class="flat "/> SPA Sauna
                                  <br/><br/>
                                  <input type="checkbox" name="hobbies[]" id="hobby4" value="sleep" class="flat "/> Hot Spring Bath
                                  <p>
                              </div>
  -->
                              <div class="col-md-8 col-sm-12 col-xs-12 form-group pull-left"> 
                              <label class="pull-left">Themes</label>
                                <div class="col-md-8 col-sm-12 col-xs-12 form-group" style="width:500px; height: 150px; overflow:auto">
                                  <div class="col-md-4 col-sm-12 col-xs-12 form-group" >
                                        <label class="">
                                          <input type="checkbox" name="Themes1_1" value="option1_1" class="flat"> 
                                          Option one one
                                        </label>
                                        <label class="">
                                          <input type="checkbox" name="Themes1_2" value="option1_2" class="flat">
                                          Option two 
                                        </label>
                                        <label class="">
                                          <input type="checkbox" name="Themes1_3" value="option1_3" class="flat">
                                          Option three
                                        </label>
                                          <label class="">
                                          <input type="checkbox" name="Themes1_4" value="option1_4" class="flat">
                                          Option three
                                        </label>
                                        <label class="">
                                          <input type="checkbox" name="Themes1_4" value="option1_4" class="flat">
                                          Option three
                                        </label>
                                        <label class="">
                                          <input type="checkbox" name="Themes1_4" value="option1_4" class="flat">
                                          Option three
                                        </label>
                                      </div>
                                      <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                        <label class="">
                                          <input type="checkbox" name="Themes2_1" value="option2_1" class="flat">
                                          Option two one 
                                        </label>
                                        <label class="">
                                          <input type="checkbox" name="Themes2_2" value="option2_2" class="flat">
                                          Option two 
                                        </label>
                                        <label class="">
                                          <input type="checkbox" name="Themes2_3" value="option2_3" class="flat">
                                          Option three
                                        </label>
                                        <label class="">
                                          <input type="checkbox" name="Themes2_4" value="option2_4" class="flat">
                                          Option three
                                        </label>
                                      </div>
                                  <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                        <label class="">
                                          <input type="checkbox" name="Themes2_1" value="option2_1" class="flat">
                                          Option two one 
                                        </label>
                                        <label class="">
                                          <input type="checkbox" name="Themes2_2" value="option2_2" class="flat">
                                          Option two 
                                        </label>
                                        <label class="">
                                          <input type="checkbox" name="Themes2_3" value="option2_3" class="flat">
                                          Option three
                                        </label>
                                        <label class="">
                                          <input type="checkbox" name="Themes2_4" value="option2_4" class="flat">
                                          Option three
                                        </label>
                                      </div>
                                </div>
                                </div>
<!--
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group  ">
                              <label for="">Langauge</label>
                              <p class="checkbox-container form-control">
                                <input type="checkbox" name="hobbies[]" id="hobby1" value="ski" data-parsley-mincheck="2" required class="flat "/> English
                                <br/><br/>
                                <input type="checkbox" name="hobbies[]" id="hobby2" value="run" class="flat "/> Spanish
                                <br/>
                                <br/>
                                <input type="checkbox" name="hobbies[]" id="hobby3" value="eat" class="flat "/> French
                                <br/><br/>
                                <input type="checkbox" name="hobbies[]" id="hobby4" value="sleep" class="flat "/> Polish
                                <br/><br/>
                                <input type="checkbox" name="hobbies[]" id="hobby1" value="ski" data-parsley-mincheck="2" required class="flat "/> German
                                <br/><br/>
                                <input type="checkbox" name="hobbies[]" id="hobby2" value="run" class="flat "/> Japanese
                                <br/>
                                <br/>
                                <input type="checkbox" name="hobbies[]" id="hobby3" value="eat" class="flat "/> Chinese
                                <br/><br/>
                                <input type="checkbox" name="hobbies[]" id="hobby4" value="sleep" class="flat "/> Korean
                                <p>
                            </div>
  -->
                            <div>
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group textarea.tinymce">
                              <label for="">Description</label>
                              <textarea id="content" name="content" class="tinymce" style="width:100%">
        </textarea>
                              </div>
                            </div>                             
                          </form>
                    </div></div>
                  </div>
                    <div id="step-2">
                      <div class="row">
              <div class="col-md-12 contentl-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                   <div class="col-md-3 col-sm-8 col-xs-12">
                          <select class="form-control">
                            <option selected="selected">Select Department</option>
                            <option>Accounts</option>
                            <option>Revenue</option>
                            <option>Marketing</option>
                            <option>Operations</option>
                          </select>
                        </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th> Name</th>
                          <th>Designation</th>
                          <th>Landline No.</th>
                          <th>Mobile No.</th>
                          <th>Email Id</th>
                          <th>Activate/Deactivate</th>
                          <th>Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                      <tr>
                          <td>Sandeep Sharma</td>
                          <td>Owner</td>
                          <td>+91 2225252525 - ext 1343</td>
                          <td>+91 9225252525</td>
                          <td>sandeep.sharma@imperialhotels.com</td>
                          <td align="center"><input type="checkbox" class="flat"  disabled="true"></input></td>
                          <td align="center"><span class="fa fa-edit fa-2x" ></span></td>
                        </tr>
                        <tr>
                          <td>Mahindra Sawant</td>
                          <td>GM</td>
                          <td>+91 2225252525 - ext 1343</td>
                          <td>+91 9225252525</td>
                          <td>sandeep.sharma@imperialhotels.com</td>
                          <td align="center"><input type="checkbox" class="flat"  disabled="true"></input></td>
                          <td align="center"><span class="fa fa-edit fa-2x" ></span></td>
                        </tr>
                        <tr>
                          <td>Priya Nair</td>
                          <td>Accounts</td>
                          <td>+91 2225252525 - ext 1343</td>
                          <td>+91 9225252525</td>
                          <td>sandeep.sharma@imperialhotels.com</td>
                          <td align="center"><input type="checkbox" class="flat"  disabled="true" checked></input></td>
                          <td align="center"><span class="fa fa-edit fa-2x" ></span></td>
                        </tr>
                        <tr>
                          <td>Sanjeev Kumar</td>
                          <td>Sales Assistant</td>
                          <td>+91 2225252525 - ext 1343</td>
                          <td>+91 9225252525</td>
                          <td>sandeep.sharma@imperialhotels.com</td>
                          <td align="center"><input type="checkbox" class="flat"  disabled="true" checked></input></td>
                          <td align="center"><span class="fa fa-edit fa-2x" ></span></td>
                        </tr>
                        <tr>
                          <td>Manoj Seth</td>
                          <td>Sales Assitant</td>
                          <td>+91 2225252525 - ext 1343</td>
                          <td>+91 9225252525</td>
                          <td>sandeep.sharma@imperialhotels.com</td>
                          <td align="center"><input type="checkbox" class="flat"  disabled="true"></input></td>
                          <td align="center"><span class="fa fa-edit fa-2x" ></span></td>
                        </tr>
                        <tr>
                          <td>Saniya Menon</td>
                          <td>Marketing</td>
                          <td>+91 2225252525 - ext 1343</td>
                          <td>+91 9225252525</td>
                          <td>sandeep.sharma@imperialhotels.com</td>
                          <td align="center"><input type="checkbox" class="flat"  disabled="true"></input></td>
                          <td align="center"><span class="fa fa-edit fa-2x" ></span></td>
                        </tr>
                        <tr>
                          <td>Sandeep Sharma</td>
                          <td>Marketing</td>
                          <td>+91 2225252525 - ext 1343</td>
                          <td>+91 9225252525</td>
                          <td>sandeep.sharma@imperialhotels.com</td>
                          <td align="center"><input type="checkbox" class="flat"  disabled="true" checked></input></td>
                          <td align="center"><span class="fa fa-edit fa-2x" ></span></td>
                        </tr>
                        <tr>
                          <td>Mahindra Sawant</td>
                          <td>Sales Assistant</td>
                          <td>+91 2225252525 - ext 1343</td>
                          <td>+91 9225252525</td>
                          <td>sandeep.sharma@imperialhotels.com</td>
                          <td align="center"><input type="checkbox" class="flat"  disabled="true" checked></input></td>
                          <td align="center"><span class="fa fa-edit fa-2x" ></span></td>
                        </tr>
                        <tr>
                          <td>Sanjeev Kumar</td>
                          <td>Accountant</td>
                          <td>+91 2225252525 - ext 1343</td>
                          <td>+91 9225252525</td>
                          <td>sandeep.sharma@imperialhotels.com</td>
                          <td align="center"><input type="checkbox" class="flat"  disabled="true"></input></td>
                          <td align="center"><span class="fa fa-edit fa-2x" ></span></td>
                        </tr>
                        <tr>
                          <td>Priya Nair</td>
                          <td>Accountant</td>
                          <td>+91 2225252525 - ext 1343</td>
                          <td>+91 9225252525</td>
                          <td>sandeep.sharma@imperialhotels.com</td>
                          <td align="center"><input type="checkbox" class="flat"  disabled="true"></input></td>
                          <td align="center"><span class="fa fa-edit fa-2x" ></span></td>
                        </tr>
                        <tr>
                          <td>Saniya Menon</td>
                          <td>Revenue</td>
                          <td>+91 2225252525 - ext 1343</td>
                          <td>+91 9225252525</td>
                          <td>sandeep.sharma@imperialhotels.com</td>
                          <td align="center"><input type="checkbox" class="flat"  disabled="true" checked></input></td>
                          <td align="center"><span class="fa fa-edit fa-2x" ></span></td>
                        </tr>
                        <tr>
                          <td>Mahindra Sawant</td>
                          <td>Sales Assistant</td>
                          <td>+91 2225252525 - ext 1343</td>
                          <td>+91 9225252525</td>
                          <td>sandeep.sharma@imperialhotels.com</td>
                          <td align="center"><input type="checkbox" class="flat"  disabled="true" checked></input></td>
                          <td align="center"><span class="fa fa-edit fa-2x" ></span></td>
                        </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
        <!--Suhas-->
<div class="x_panel">
              <div class="x_title">
                <h2>Add New Contact </h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                  <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                    <input type="text" placeholder="Name " class="form-control">
                  </div>
                  <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                    <!--<input type="text" placeholder=".col-md-3" class="form-control"> -->
                    <select class="form-control" >
                            <option>Select Department</option>
                            <option>Marketing</option>
                            <option>Revenue</option>
                            <option>Accounts</option>
                            </select>
                  </div>
                  <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                    <select class="form-control" >
                            <option>Select Designation</option>
                            <option>Manager</option>
                            <option>Sales executive</option>
                            <option>Sales accounts</option>
                            </select>
                  </div>
                  <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                           <input type="text" placeholder="Mobile no " class="form-control">
                  </div>
                  <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                           <input type="text" placeholder="Landline no " class="form-control">
                  </div>
                   <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                           <input type="text" placeholder="ext " class="form-control">
                  </div>
                 <div class="col-md-3 col-sm-12 col-xs-12 form-group pull-right"> 
                    <input type="checkbox" class="flat" />
                    <label class=""> Active / Inactive</label>
                    <button type="button" class="btn btn-success btn-sm pull-right"><span class="fa fa-plus"></span>Add</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
                    </div>
                    <div id="step-3">
                      <div class="x_panel">
                      <div class="x_content">
                        <div class="col-md-8">
                          <form class="form-horizontal form-label-left">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                              <label for="">Property Name</label>
                              <input type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                              <label for="">Property Type</label>
                              <select class="form-control">
                                <option>Choose option</option>
                                <option>Option one</option>
                                <option>Option two</option>
                                <option>Option three</option>
                                <option>Option four</option>
                              </select>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                              <label for="">Star Rating</label>
                              <select class="form-control">
                                <option>Choose option</option>
                                <option>Option one</option>
                                <option>Option two</option>
                                <option>Option three</option>
                                <option>Option four</option>
                              </select>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                              <label for="">Total No. of Rooms</label>
                              <input type="text" placeholder=".col-md-4" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                              <label for="">Phone number</label>
                              <input type="text" placeholder=".col-md-4" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                              <label for="">Reservation Phone No.</label>
                              <input type="text" placeholder=".col-md-4" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12" style="margin-top:30px;  ">
                              <i class="fa fa-plus-square fa-2x "></i>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                              <label for="">Email Id</label>
                              <input type="text" placeholder=".col-md-4" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                              <label for="">Reservation Email Id.</label>
                              <input type="text" placeholder=".col-md-4" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12" style="margin-top:30px;  ">
                              <i class="fa fa-plus-square fa-2x "></i>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                              <label for="">Address</label>
                              <textarea id="message" required class="form-control" name="message" ></textarea>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                              <label for="">City / Town</label>
                              <select class="form-control">
                                <option>Choose option</option>
                                <option>Option one</option>
                                <option>Option two</option>
                                <option>Option three</option>
                                <option>Option four</option>
                              </select>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                              <label for="">State</label>
                              <select class="form-control">
                                <option>Choose option</option>
                                <option>Option one</option>
                                <option>Option two</option>
                                <option>Option three</option>
                                <option>Option four</option>
                              </select>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                              <label for="">Zip Code / Pincode</label>
                              <input type="text" placeholder=".col-md-4" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group  ">
                              <label for="">Themes</label>
                              <p class="checkbox-container form-control">
                                <input type="checkbox" name="hobbies[]" id="hobby1" value="ski" data-parsley-mincheck="2" required class="flat "/> Swimming Pool
                                <br/><br/>
                                <input type="checkbox" name="hobbies[]" id="hobby2" value="run" class="flat "/> Fitness Center
                                <br/>
                                <br/>
                                <input type="checkbox" name="hobbies[]" id="hobby3" value="eat" class="flat "/> SPA Sauna
                                <br/><br/>
                                <input type="checkbox" name="hobbies[]" id="hobby4" value="sleep" class="flat "/> Hot Spring Bath
                                <br/><br/>
                                <input type="checkbox" name="hobbies[]" id="hobby1" value="ski" data-parsley-mincheck="2" required class="flat "/> Swimming Pool
                                <br/><br/>
                                <input type="checkbox" name="hobbies[]" id="hobby2" value="run" class="flat "/> Fitness Center
                                <br/>
                                <br/>
                                <input type="checkbox" name="hobbies[]" id="hobby3" value="eat" class="flat "/> SPA Sauna
                                <br/><br/>
                                <input type="checkbox" name="hobbies[]" id="hobby4" value="sleep" class="flat "/> Hot Spring Bath
                                <p>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                              <label>Add New Themes 1</label>
                              <input type="text" placeholder=".col-md-4" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                              <label>Add New Themes 2</label>
                              <input type="text" placeholder=".col-md-4" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12" style="margin-top:30px;  ">
                              <i class="fa fa-plus-square fa-2x "></i>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group  ">
                              <label for="">Langauge</label>
                              <p class="checkbox-container form-control">
                                <input type="checkbox" name="hobbies[]" id="hobby1" value="ski" data-parsley-mincheck="2" required class="flat "/> English
                                <br/><br/>
                                <input type="checkbox" name="hobbies[]" id="hobby2" value="run" class="flat "/> Spanish
                                <br/>
                                <br/>
                                <input type="checkbox" name="hobbies[]" id="hobby3" value="eat" class="flat "/> French
                                <br/><br/>
                                <input type="checkbox" name="hobbies[]" id="hobby4" value="sleep" class="flat "/> Polish
                                <br/><br/>
                                <input type="checkbox" name="hobbies[]" id="hobby1" value="ski" data-parsley-mincheck="2" required class="flat "/> German
                                <br/><br/>
                                <input type="checkbox" name="hobbies[]" id="hobby2" value="run" class="flat "/> Japanese
                                <br/>
                                <br/>
                                <input type="checkbox" name="hobbies[]" id="hobby3" value="eat" class="flat "/> Chinese
                                <br/><br/>
                                <input type="checkbox" name="hobbies[]" id="hobby4" value="sleep" class="flat "/> Korean
                                <p>
                            </div>
                            <di
                              <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                              <label for="">Plot on Map</label>
                              </div>
                          </form>
                      </div>
                    </div>
                    </div>
                    <div id="step-4">
                      <h2 class="StepTitle">Hotel Amenities</h2>
                    </div>
                    <div id="step-5">
                      <h2 class="StepTitle">Rooms</h2>
                    </div>
                    <div id="step-6">
                      <h2 class="StepTitle">Dining & Bar</h2>
                    </div>
                    <div id="step-7">
                      <h2 class="StepTitle">Activities</h2>
                    </div>
                    <div id="step-8">
                      <h2 class="StepTitle">Common Areas</h2>
                    </div>
                    <div id="step-9">
                      <h2 class="StepTitle">Business Centers</h2>
                    </div>
                  </div>
                  <!-- End SmartWizard Content -->
                </div>
              </div>
            </div>
          </div>
</div>
<?php echo $this->load->view('footer'); ?>
    <?php //include 'common/script.php';?>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>public/themetemplate/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>public/themetemplate/vendors/nprogress/nprogress.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="<?php echo base_url(); ?>public/themetemplate/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <script src="<?php echo base_url(); ?>public/themetemplate/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>public/themetemplate/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/themetemplate/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>public/themetemplate/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url(); ?>public/themetemplate/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url(); ?>public/themetemplate/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
     <!-- starrr -->
    <script src="<?php echo base_url(); ?>public/themetemplate/vendors/starrr/dist/starrr.js"></script>
    <script src="<?php echo base_url(); ?>public/themetemplate/vendors/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
    <!-- Flot -->
    <!-- /Flot -->
    <!-- JQVMap -->
    <!-- /JQVMap -->
    <!-- Skycons -->
    <!-- /Skycons -->
    <!-- Doughnut Chart -->
    <!-- /Doughnut Chart -->
    <!-- bootstrap-daterangepicker -->
    <!-- /bootstrap-daterangepicker -->
    <!-- gauge.js -->
    <!-- /gauge.js -->
    <!-- jQuery Smart Wizard -->
    <script>
      $( document ).ready( function () {
        $( '#wizard' ).smartWizard();
        $( '#wizard_verticle' ).smartWizard( {
          transitionEffect: 'slide'
        } );
        $( '.buttonNext' ).addClass( 'btn btn-success' );
        $( '.buttonPrevious' ).addClass( 'btn btn-primary' );
        $( '.buttonFinish' ).addClass( 'btn btn-default' );
      } );
    </script>
    <!-- /jQuery Smart Wizard -->
     <!-- Datatables -->
        <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };
        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({
          keys: true
        });
        $('#datatable-responsive').DataTable();
        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });
        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });
        var $datatable = $('#datatable-checkbox');
        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });
        TableManageButtons.init();
      });
    </script>
    <!-- /Select2 -->
<!-- Starrr -->
    <script>
      $(document).ready(function() {
        $(".stars").starrr();
        $('.stars-existing').starrr({
          rating: 4
        });
        $('.stars').on('starrr:change', function (e, value) {
          $('.stars-count').html(value);
        });
        $('.stars-existing').on('starrr:change', function (e, value) {
          $('.stars-count-existing').html(value);
        });
      });
    </script>
    <!-- /Starrr -->
<script>
    $('#PhoneNumber').each(function() {
    var $wrapper = $('#Phone1', this);
    $(".add-field", $(this)).click(function(e) {
        $('#Phone1_1:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
    });
    $('.multi-field .remove-field', $wrapper).click(function() {
        if ($('.multi-field', $wrapper).length > 1)
            $(this).parent('.multi-field').remove();
    });
});
    $('#ReservationPhoneNumber').each(function() {
    var $wrapper = $('#Phone2', this);
    $(".add-field", $(this)).click(function(e) {
        $('#Phone2_2:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
    });
    $('.multi-field .remove-field', $wrapper).click(function() {
        if ($('.multi-field', $wrapper).length > 1)
            $(this).parent('.multi-field').remove();
    });
});
    $('#ReservationEmailAddress').each(function() {
    var $wrapper = $('#Email2', this);
    $(".add-field", $(this)).click(function(e) {
        $('#Email2_2:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
    });
    $('.multi-field .remove-field', $wrapper).click(function() {
        if ($('.multi-field', $wrapper).length > 1)
            $(this).parent('.multi-field').remove();
    });
});
    </script>
<!-- Load jQuery build -->
<!-- TinyMCE WYSWYG -->
<script>
        $(function() {
                $('textarea.tinymce').tinymce({
                        // Location of TinyMCE script
                        script_url : 'vendors/tinymce/js/tinymce/tinymce.min.js',
                        // General options
                        theme : "modern",
                        plugins : "pagebreak,table,save,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,template",
                        // Theme options
                        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
                        theme_advanced_toolbar_location : "top",
                        theme_advanced_toolbar_align : "left",
                        theme_advanced_statusbar_location : "bottom",
                        theme_advanced_resizing : true
                });
        });
</script>
