<?php if (!empty($mapdata)) { ?>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyDeUwdR-UuKgln4vKhkhiK4MDBzmAN-a2M&callback=initialize"></script>
<script type="text/javascript">
function initialize() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map-view"), mapOptions);
    map.setTilt(20);
      var latitude;
      var longitude;  
  <?php
  $markers=$infoWindowContent='';
  for ($k = 0; $k < count($mapdata); $k++) {
    if(!empty($mapdata[$k])){
      if($mapdata[$k]->latitude!=0 && $mapdata[$k]->longitude!=0){
        $gttd='';
        if ($mapdata[$k]->hotimage != '') 
        {
          $image_name = explode(',', $mapdata[$k]->hotimage);
          $gttd =  $image_name[0];
        } 
        $result=$mapdata[$k];
        $desc=preg_replace('/\s\s+/', ' ',str_replace('"','\\"',str_replace("'","\\'",trim($result->short_desc))));

        $total_cost = $result->total_cost;
        $total_discount = $result->discount;
        $admin_discount = $result->discount_value;
        $supplier_discount = $total_discount - $admin_discount;

        $offer = $offers = $memberpr = $ribbonclass = '';
        if($admin_discount > 0){
          $discount_type = $result->discount_type;
          $member_discount = $result->member_discount;
          if($discount_type==2){
            $offer = $member_discount.'% off';
            if($supplier_discount > 0) {
              $offer = $member_discount.'% extra off';
            }
          } else {
            $offer = '$'.$member_discount.' off';
            if($supplier_discount > 0) {
              $offer = '$'.$member_discount.' extra off';
            }
          }
        }

        if($offer != ''){
          $ribbonclass = 'ribbon-box';
          $offers = '<div class="ribbon-box" style="min-height: 30px;"><div class="ribbon-container nocurve" style="top: 0;"><a href="#" class="member_href '.checkLogin()['logged_class'].'" data-toggle="modal" data-target="#modalLogin">'.$offer.'</a></div></div>';

          $memberpr = '<div class="ribbon-container"><a href="#" class="member_href '.checkLogin()['logged_class'].'" data-toggle="modal" data-target="#modalLogin">Member Price Available</a></div>';
        }

        $per_night_cost = round(($total_cost/$result->nights));
        $per_night_sup_cost = round((($total_cost+$supplier_discount)/$result->nights));
        $per_night_adm_cost = round((($total_cost+$admin_discount)/$result->nights));
        $per_night_org_cost = round((($total_cost+$total_discount)/$result->nights));

        $org = '';
        if($per_night_org_cost > $per_night_adm_cost){
          $org = '<div style="text-decoration: line-through;"><i class="fa fa-dollar"></i>'.number_format($per_night_org_cost,2).' USD</div>';
        }

        $pricetag = '<h4 class="price-tag" style="margin-top: 0">'.$org.'<div class="'.checkLogin()['logged_class'].' logout_total"><i class="fa fa-dollar"></i>'.number_format($per_night_adm_cost,2).' USD</div><div class="'.checkLogin()['logged_class'].' login_total"><i class="fa fa-dollar"></i>'.number_format($per_night_cost,2).' USD</div><small>per night</small></h4>';

        if(($k+1)==count($mapdata)){  ?>
       		latitude=<?php echo $mapdata[$k]->latitude;?>;
       		longitude=<?php echo $mapdata[$k]->longitude;?>;
       		<?php 
          $markers.="['".$mapdata[$k]->hotel_name .",".$mapdata[$k]->location."',".$mapdata[$k]->latitude.','.$mapdata[$k]->longitude."]";
          $infoWindowContent.="['<div style=\"opacity: 1;\">'+
              '<div class=\"container-fluid hotel-info-tooltip\" style=\"padding-left: 15px;padding-right: 15px;width: 500px;\">'+
                '<div class=\"row\">'+
                  '<div class=\"result-header\">'+
                    '<div class=\"col-xs-4\" style=\"padding:0\">'+
                      '<div class=\"result-thumbnail vertical-space-base ".$ribbonclass."\">'+
                        '<a href=\"".site_url()."/hotels/details/".base64_encode($result->session_id."/".$result->uniqueRefNo."/".$result->search_id."/".$result->hotel_code."/". base64_encode("hotel_crs"))."\"><img class=\"img-responsive\" src=\"".get_image_aws($gttd)."\" style=\"width: 100%;height: 120px;\"></a>'+
                      '".$memberpr."</div>'+
                      '<div class=\"row vertical-space-large\">'+
                        '<div class=\"col-xs-12 col-md-12\">".$pricetag."'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                    '<div class=\"col-xs-8\">'+
                      '<div class=\"row\">'+
                        '<div class=\"col-xs-12\">'+
                          '<div class=\"result-title-group\">'+
                            '<a href=\"".site_url()."/hotels/details/".base64_encode($result->session_id."/".$result->uniqueRefNo."/".$result->search_id."/".$result->hotel_code."/". base64_encode("hotel_crs"))."\">'+
                              '<span class=\"result-hotel-name lead-text-default\">'+
                                '<span style=\"font-size: 1.5em;color: #372b45;font-weight: bolder;\">".$result->hotel_name."</span>'+
                              '</span>'+
                            '</a>'+
                            '<span class=\"result-accommodation-type lead-text-default\"></span> '+
                            '<span class=\"star star".$result->star."\"></span>'+
                          '</div>".$offers."'+
                        '</div>'+
                      '</div>'+
                      '<div class=\"row vertical-space-large\">'+
                        '<div class=\"col-xs-12 col-md-12\">'+
                          '<div>".$desc."</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                  '</div>'+
                '</div>'+
              '</div>'+
            '</div>']";
        } else {
          $markers.="['".$mapdata[$k]->hotel_name .",".$mapdata[$k]->location."',".$mapdata[$k]->latitude.','.$mapdata[$k]->longitude."],";
          $infoWindowContent.="['<div style=\"opacity: 1;\">'+
              '<div class=\"container-fluid hotel-info-tooltip\" style=\"padding-left: 15px;padding-right: 15px;width: 500px;\">'+
                '<div class=\"row\">'+
                  '<div class=\"result-header\">'+
                    '<div class=\"col-xs-4\">'+
                      '<div class=\"result-thumbnail vertical-space-base ".$ribbonclass." \">'+
                        '<a href=\"".site_url()."/hotels/details/".base64_encode($result->session_id."/".$result->uniqueRefNo."/".$result->search_id."/".$result->hotel_code."/". base64_encode("hotel_crs"))."\">'+
                          '<img class=\"img-responsive\" src=\"".get_image_aws($gttd)."\" style=\"width: 100%;height: 120px;\">'+
                        '</a>'+
                      '".$memberpr."</div>'+
                      '<div class=\"row vertical-space-large\">'+
                        '<div class=\"col-xs-12 col-md-12\">".$pricetag."'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                    '<div class=\"col-xs-8\">'+
                      '<div class=\"row\">'+
                        '<div class=\"col-xs-12\">'+
                          '<div class=\"result-title-group\">'+
                            '<a href=\"".site_url()."/hotels/details/".base64_encode($result->session_id."/".$result->uniqueRefNo."/".$result->search_id."/".$result->hotel_code."/". base64_encode("hotel_crs"))."\">'+
                              '<span class=\"result-hotel-name lead-text-default\">'+
                                '<span style=\"font-size: 1.5em;color: #372b45;font-weight: bolder;\">".$result->hotel_name."</span>'+
                              '</span>'+
                            '</a>'+
                            '<span class=\"result-accommodation-type lead-text-default\"></span> '+
                            '<span class=\"star star".$result->star."\"></span>'+
                          '</div>".$offers."'+
                        '</div>'+
                      '</div>'+
                      '<div class=\"row vertical-space-large\">'+
                        '<div class=\"col-xs-12 col-md-12\">'+
                          '<div>".$desc."</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                  '</div>'+
                '</div>'+
              '</div>'+
            '</div>'],";
        }

      } 
    }
  }
  $marker="[".$markers."]";
  $infoWindow_content="[".$infoWindowContent."]";
  // echo $markers.'<br>'.$infoWindowContent; exit; 
  ?> 
   var markers = <?php echo $marker;?>;
   var infoWindowContent = <?php echo $infoWindow_content;?>;  
    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    // Loop through our array of markers & place each one on the map  


  for( i = 0; i < markers.length; i++ ) {
      var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
      bounds.extend(position);
      marker = new google.maps.Marker({
          position: position,
          map: map,
          title: markers[i][0],
         icon: 'http://www.google.com/mapfiles/markerH.png'
      });


      
      // Allow each marker to have an info window    
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
              infoWindow.setContent(infoWindowContent[i][0]);
              infoWindow.open(map, marker);
          }
      })(marker, i));

      // Automatically center the map fitting all markers on the screen
      map.fitBounds(bounds);
  }

  // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
   var centerlt = new google.maps.LatLng(latitude,longitude);
   
  var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
      this.setZoom(13);
      this.setCenter(centerlt);
      google.maps.event.removeListener(boundsListener);
  });

}
   $(".map-view").css('min-height','400px');
   $(".map-view").css('margin-top','20px');
   $(".map-view").css('position','relative');
   $(".map-view").css('overflow','hidden');
   $("#show_result").css('overflow','inherit');
 </script>
 <?php  } ?>
 