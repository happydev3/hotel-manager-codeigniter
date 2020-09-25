<?php  $this->load->view('footermodal'); ?>
<?php
  $date = date("Y-m-d"); 
  $mod_date_in = strtotime($date . "+ 1 days");
  $cin_date = date("d/m/Y", $mod_date_in);
  $mod_date_out = strtotime($date . "+ 2 days");
  $cout_date = date("d/m/Y", $mod_date_out);
  $random_search = '<input type="hidden" name="checkIn" value="' . $cin_date . '" /><input type="hidden" name="checkOut" value="' . $cout_date . '" /><input type="hidden" name="room_count" value="1" /><input type="hidden" name="adults[]" value="1" /><input type="hidden" name="adults[]" value="1" /><input type="hidden" name="adults[]" value="1" /><input type="hidden" name="adults[]" value="1" /><input type="hidden" name="childs[]" value="0" /><input type="hidden" name="childs[]" value="0" /><input type="hidden" name="childs[]" value="0" /><input type="hidden" name="childs[]" value="0" />';
  $random_search_v = '<input type="hidden" name="fromDate" value="' . $cin_date . '" /><input type="hidden" name="toDate" value="' . $cout_date . '" /><input type="hidden" name="bedrooms" value="1" /><input type="hidden" name="bathrooms" value="1" /><input type="hidden" name="guests" value="1" />';
?>
<style type="text/css">
  .button_link{
    padding: 5px 0;
    display: inline-block;
    border: none;
    background: none;
    margin: 0;
    color: #fff;
    font-size: 13px;
    opacity: 0.9;
    line-height: 1.9;
  }
  .button_link:focus, .button_link:hover {
    text-decoration: underline;
  }
</style>
<div id="footer">
  <footer>
    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="subfooter">
              <div class="top-footer">
                <div class="row no-padding">
                  <div class="col-md-8">
                    <div class="row no-padding">
                      <div class="col-sm-4 footer-links">
                        <h4>Hotels in Jamaica</h4>
                        <ul class="row no-padding">
                          <li class="col-xs-12">
                            <form role="form" action="<?php echo site_url(); ?>hotels/results" method="post">
                              <input type="hidden" name="cityid" value="21057">
                              <input type="hidden" name="cityName" value="Montego Bay, Jamaica">
                              <?php  echo $random_search; ?>
                              <button class="button_link" type="submit">Hotels in Montego Bay Jamaica</button>
                            </form>
                          </li>
                          <li class="col-xs-12">
                            <form role="form" action="<?php echo site_url(); ?>hotels/results" method="post">
                              <input type="hidden" name="cityid" value="21060">
                              <input type="hidden" name="cityName" value="Ocho Rios, Jamaica">
                              <?php  echo $random_search; ?>
                              <button class="button_link" type="submit">Hotels in Ocho Rios Jamaica</button>
                            </form>
                          </li>
                          <li class="col-xs-12">
                            <form role="form" action="<?php echo site_url(); ?>hotels/results" method="post">
                              <input type="hidden" name="cityid" value="21059">
                              <input type="hidden" name="cityName" value="Negril, Jamaica">
                              <?php  echo $random_search; ?>
                              <button class="button_link" type="submit">Hotels in Negril Jamaica</button>
                            </form>
                          </li>
                          <li class="col-xs-12">
                            <form role="form" action="<?php echo site_url(); ?>hotels/results" method="post">
                              <input type="hidden" name="cityid" value="21064">
                              <input type="hidden" name="cityName" value="Port Antonio, Jamaica">
                              <?php  echo $random_search; ?>
                              <button class="button_link" type="submit">Hotels in Portland Jamaica</button>
                            </form>
                          </li>
                          <li class="col-xs-12">
                            <form role="form" action="<?php echo site_url(); ?>hotels/results" method="post">
                              <input type="hidden" name="cityid" value="21052">
                              <input type="hidden" name="cityName" value="Kingston, Jamaica">
                              <?php  echo $random_search; ?>
                              <button class="button_link" type="submit">Hotels in Kingston Jamaica</button>
                            </form>
                          </li>
                          <li class="col-xs-12">
                            <form role="form" action="<?php echo site_url(); ?>hotels/results" method="post">
                              <input type="hidden" name="cityid" value="21080">
                              <input type="hidden" name="cityName" value="Treasure Beach, Jamaica">
                              <?php  echo $random_search; ?>
                              <button class="button_link" type="submit">Hotels in Treasure Beach Jamaica</button>
                            </form>
                          </li>
                        </ul>
                      </div>
                      <div class="col-sm-4 footer-links">
                        <h4>Villas in Jamaica</h4>
                        <ul class="row no-padding">
                          <li class="col-xs-12">
                            <form role="form" action="<?php echo site_url(); ?>villa/results" method="post">
                              <input type="hidden" name="cityid" value="21057">
                              <input type="hidden" name="cityName" value="Montego Bay, Jamaica">
                              <?php  echo $random_search_v; ?>
                              <button class="button_link" type="submit">Villas in Montego Bay Jamaica</button>
                            </form>
                          </li>
                          <li class="col-xs-12">
                            <form role="form" action="<?php echo site_url(); ?>villa/results" method="post">
                              <input type="hidden" name="cityid" value="21060">
                              <input type="hidden" name="cityName" value="Ocho Rios, Jamaica">
                              <?php  echo $random_search_v; ?>
                              <button class="button_link" type="submit">Villas in Ocho Rios Jamaica</button>
                            </form>
                          </li>
                          <li class="col-xs-12">
                            <form role="form" action="<?php echo site_url(); ?>villa/results" method="post">
                              <input type="hidden" name="cityid" value="21043">
                              <input type="hidden" name="cityName" value="Discovery Bay, Jamaica">
                              <?php  echo $random_search_v; ?>
                              <button class="button_link" type="submit">Villas in Discovery Bay Jamaica</button>
                            </form>
                          </li>
                          <li class="col-xs-12">
                            <form role="form" action="<?php echo site_url(); ?>villa/results" method="post">
                              <input type="hidden" name="cityid" value="21064">
                              <input type="hidden" name="cityName" value="Port Antonio, Jamaica">
                              <?php  echo $random_search_v; ?>
                              <button class="button_link" type="submit">Villas in Portland Jamaica</button>
                            </form>
                          </li>
                          <li class="col-xs-12">
                            <form role="form" action="<?php echo site_url(); ?>villa/results" method="post">
                              <input type="hidden" name="cityid" value="21052">
                              <input type="hidden" name="cityName" value="Kingston, Jamaica">
                              <?php  echo $random_search_v; ?>
                              <button class="button_link" type="submit">Villas in Kingston Jamaica</button>
                            </form>
                          </li>
                          <li class="col-xs-12">
                            <form role="form" action="<?php echo site_url(); ?>villa/results" method="post">
                              <input type="hidden" name="cityid" value="21080">
                              <input type="hidden" name="cityName" value="Treasure Beach, Jamaica">
                              <?php  echo $random_search_v; ?>
                              <button class="button_link" type="submit">Villas in Treasure Beach Jamaica</button>
                            </form>
                          </li>
                        </ul>
                      </div>
                      <div class="col-sm-4 footer-links">
                        <h4>Start your vacation</h4>
                        <ul class="row no-padding">
                          <li class="col-xs-12">
                            <a href="<?php echo site_url() ?>hotels">Hotels</a>
                          </li>
                          <li class="col-xs-12">
                            <a href="<?php echo site_url() ?>villa">Villas</a>
                          </li>
                          <li class="col-xs-12">
                            <a href="<?php echo site_url() ?>holiday">Tours</a>
                          </li>
                          <li class="col-xs-12">
                            <a href="//discover.vacaymenow.com/" target="_blank">Discover Jamaica</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="row no-padding">
                      <div class="col-md-12 footer-links">
                        <p>Sign up for email-only Coupon, Special Offers and promotions.</p>
                        <ul class="row no-padding">
                          <li class="col-xs-12">
                            <form action="<?php echo site_url() ?>home/subscribe" method="post">
                              <div class="input-group subscribe">
                                <input type="email" name="email" class="form-control" placeholder="Enter your email address" required>
                                <span class="input-group-btn">
                                  <button type="submit" class="btn btn-primary">SUBSCRIBE</button>
                                </span>
                              </div>
                            </form>
                          </li>
                          <li class="col-xs-12">
                            <h4>Vacaymenow.com</h4>
                          </li>
                          <li class="col-xs-12 seperator">
                            <a href="https://partner.vacaymenow.com/about-us">About Vacaymenow</a>|
                            <a href="https://discover.vacaymenow.com">Discover Jamaica</a>|
                            <!-- <a href="#">Customer Support</a>| -->
                            <a href="<?php echo site_url() ?>home/termsCondition">Terms &amp; Conditions</a>|
                            <a href="<?php echo site_url() ?>home/privacyPolicy">Privacy Policy</a>|
                            <a href="tel:13022124246"><i class="fa fa-phone"></i> 1-302-212-4246</a>
                          </li>
                          <li class="col-xs-12 social-media">
                            <ul>
                              <li>
                                <a target="_blank" href="https://facebook.com/vacaymenow" class="facebook" title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                              </li>
                              <li>
                                <a target="_blank" href="https://instagram.com/vacaymenow" class="instagram" title="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                              </li>
                              <li>
                                <a target="_blank" href="https://twitter.com/vacaymenow" class="twitter" title="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                              </li>
                              <li>
                                <a target="_blank" href="https://www.youtube.com/channel/UCQ0-e0PMKNyaDI_lp8_TFRA" class="youtube" title="youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bottom-footer">
                <div class="row">
                  <div class="col-sm-12 copyrights">
                    <ul>
                      <li>
                        <p>® <?php echo Date('Y') ?> Vacaymenow. All rights reserved. Use of this website constitutes acceptance of the Vacaymenow <a href="javascript:;" target="_blank">User Agreement</a> and <a href="<?php echo site_url() ?>home/privacyPolicy" target="_blank">Privacy Policy</a></p>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</div>

<script type="text/javascript" src="<?php echo base_url() ?>public/js/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>public/js/jquery.easing.1.3.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>public/js/waypoints.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/jquery.flexslider-min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/megamenu/travel-mega-menu.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/paxdrop/paxdrop.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/paxdrop/paxdrop_villa.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/script.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/custom.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/vendor/parsley/modalparsley.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/userlogin.js"></script>

<!-- Custom Theme JavaScript -->
<script type="text/javascript">
(function () {
  // store the slider in a local variable
  var $window = $(window),
  flexslider;
  // tiny helper function to add breakpoints
  function getGridSize() {
    return (window.innerWidth < 600) ? 1 : (window.innerWidth < 900) ? 2 : 3;
  }
  $window.load(function () {
    $('.flexslider').flexslider({
      animation: "slide",
      animationLoop: true,
      touch: true,
      controlNav: false,
      keyboard: true,
      move: 0,
      prevText: "",
      nextText: "",
      slideshow: false,
      itemWidth: 205,
      itemMargin: 10,
      minItems: getGridSize(), // use function to pull in initial value
      maxItems: getGridSize() // use function to pull in initial value
    });
  });
  // check grid size on resize event
  /*$window.resize(function () {
      var gridSize = getGridSize();
      flexslider.vars.minItems = gridSize;
      flexslider.vars.maxItems = gridSize;
  });*/
}());
</script>
</html>