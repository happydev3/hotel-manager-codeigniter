      <?php  $gttd='';
              if ($result->hotimage != '') 
              {
                $image_name = explode(',', $result->hotimage);
                $gttd =  $image_name[0];
              } 
        ?>
       <div style="opacity: 1;">
                <div class="container-fluid hotel-info-tooltip">
                    <div class="row">
                        <div class="result-header">
                            <div class="col-xs-3">
                                <div class="result-thumbnail vertical-space-base">
                                    <a href="<?php echo site_url().'/hotels/details/'.base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->hotel_code.'/'. base64_encode('fitruums')); ?>">
                                        <img class="img-responsive img-map-responsive" src="//www.sunhotels.net/SunHotels.net/HotelInfo/hotelImage.aspx?id=<?php echo $gttd;?>">
                                    </a>
                                </div>
                                <div class="row vertical-space-large">
                                    <div class="col-xs-12 col-md-12"> 
                                        <div class="text-right">
                                            <span>From </span><span class="h4"><?php echo $result->total_cost; ?></span><span><?php echo $result->currency; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="result-title-group">
                                            <a href="<?php echo site_url().'/hotels/details/'.base64_encode($result->session_id.'/'.$result->uniqueRefNo.'/'.$result->search_id.'/'.$result->hotel_code.'/'. base64_encode('fitruums')); ?>">
                                                <span class="result-hotel-name lead-text-default">
                                                    <span class="result-one-line-text">
                                                        <?php echo $result->hotel_name; ?>
                                                    </span>
                                                </span>
                                            </a>
                                            <span class="result-accommodation-type lead-text-default">
                                                
                                            </span>
                                            <span class="result-rating">
                                             
                                            </span>
                                        </div>
                                        <div>
                                            <strong><?php echo $result->location; ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="row vertical-space-large">
                                    <div class="col-xs-12 col-md-12">
                                        <div>
                                           <?php echo $result->description; ?>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>