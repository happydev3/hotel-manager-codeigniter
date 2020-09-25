          <?php for($i=0;$i<count($result);$i++){ ?>
          <div class="col-sm-12 padd-l5 padd-r5">
            <div class="box-wrapper flexrow">
              <div class="pack_img">
                <?php
                 // $str=base_url().'supplier/'.$result[$i]->thumb_img;
                 $str=get_image_aws($result[$i]->thumb_img);
                 if(getimagesize($str) !== false) {  ?> 
                 <img src="<?php echo $str; ?>" alt="" class="img-responsive" style="height:164px;" />
                 <?php } else { ?>              
                  <img src="<?php echo get_image_aws('public/img/noimage.jpg') ?>" alt="" class="img-responsive" style="width:294px;height:164px;" />
                <?php } ?>            
              </div>
              <div class="description">
               <h4 class="holiday_name"><?php echo $result[$i]->holiday_name; ?></h4>
                <p class="short_desc"><?php  echo $result[$i]->short_desc; ?> </p>
                <div class="row margin-t-10">
                  <div class="col-sm-12">
                    <span class="theme_name package_theme">Theme : <span class="text-red">
                       <?php 
                        $themes=explode(',',$result[$i]->themes);
                        $theme_str=array();
                        for($k=0;$k<count($themes);$k++)
                        {
                          if(!empty($themelistarrary[$themes[$k]])){
                           $theme_str[]=$themelistarrary[$themes[$k]];   
                          }
                        }
                        echo implode(', ', array_slice($theme_str, 0, 2)); ?>
                    </span></span>
                  </div>
                </div>
                <div class="row margin-t-10">
                  <div class="col-lg-5 col-md-7 col-sm-6 col-xs-7">
                    <div class="first_r">
                      <span>Reviews </span>&nbsp;<span class="star star<?php echo $result[$i]->star_rating; ?>"></span>
                    </div>
                  </div>
             <!--      <div class="col-lg-7 col-md-5 col-sm-6 col-xs-5">
                    <a href="#">
                      <span class="like_share p_like"></span>
                    </a>
                    <a href="#">
                      <span class="like_share p_share"></span>
                    </a>
                  </div> -->
                </div>
              </div>
              <div class="pack_price">
                <div class="first">
                  <span>From</span>
                  <span><sup>INR </sup><strong><?php echo $result[$i]->pp_price; ?></strong></span>
                </div>
                <div class="middle">
                  <span><?php echo substr($result[$i]->duration,0,1); ?></span>
                  <span>Days</span>
                </div>
                <div class="last">
                  <a href="<?php echo site_url(); ?>holiday/holidaydetails/<?php echo $result[$i]->id; ?>" class="explore-btn">
                    <span>Explore</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>   
      