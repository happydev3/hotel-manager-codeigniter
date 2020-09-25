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
        if($mapdata[$k]->latitude!=0&&$mapdata[$k]->longitude!=0){
           $gttd='';
              if ($mapdata[$k]->hotimage != '') 
              {
                $image_name = explode(',', $mapdata[$k]->hotimage);
                $gttd =  $image_name[0];
              } 
           $result=$mapdata[$k];
          $desc=preg_replace('/\s\s+/', ' ',str_replace('"','\\"',str_replace("'","\\'",trim($result->description))));

      if(($k+1)==count($mapdata)){  ?>
         latitude=<?php echo $mapdata[$k]->latitude;?>;
         longitude=<?php echo $mapdata[$k]->longitude;?>;
        <?php 
        $markers.="['".$mapdata[$k]->villa_name .",".$mapdata[$k]->location."',".$mapdata[$k]->latitude.','.$mapdata[$k]->longitude."]";
        $infoWindowContent.="['<div style=\"opacity: 1;\"><div class=\"container-fluid villa-info-tooltip\" style=\"padding-left: 15px;padding-right: 15px;width: 500px;\"><div class=\"row\"><div class=\"result-header\"><div class=\"col-xs-3\"><div class=\"result-thumbnail vertical-space-base\"><a href=\"".site_url()."/villa/details/".base64_encode($result->session_id."/".$result->uniqueRefNo."/".$result->search_id."/".$result->villa_code."/". base64_encode("villa_crs"))."\"><img class=\"img-responsive\" src=\"".get_image_aws($gttd)."\" style=\"width: 100px;height: 80px;\"></a></div><div class=\"row vertical-space-large\"><div class=\"col-xs-12 col-md-12\"><div class=\"text-right\"><span>From </span><span class=\"h4\">".number_format($result->total_cost)."</span><span>".$result->currency."</span></div></div></div></div><div class=\"col-xs-9\"><div class=\"row\"><div class=\"col-xs-12\"><div class=\"result-title-group\"><a href=\"".site_url()."/villa/details/".base64_encode($result->session_id."/".$result->uniqueRefNo."/".$result->search_id."/".$result->villa_code."/". base64_encode("villa_crs"))."\"><span class=\"result-villa-name lead-text-default\"><span style=\"font-size: 1.5em;color: #372b45;font-weight: bolder;\">".$result->villa_name."</span></span></a><span class=\"result-accommodation-type lead-text-default\"></span><span class=\"star star".$result->star."\"></span></div></div></div><div class=\"row vertical-space-large\"><div class=\"col-xs-12 col-md-12\"><div>".$desc."</div></div></div></div></div></div></div></div>']";
        }  else {
       $markers.="['".$mapdata[$k]->villa_name .",".$mapdata[$k]->location."',".$mapdata[$k]->latitude.','.$mapdata[$k]->longitude."],";
        $infoWindowContent.="['<div style=\"opacity: 1;\"><div class=\"container-fluid villa-info-tooltip\" style=\"padding-left: 15px;padding-right: 15px;width: 500px;\"><div class=\"row\"><div class=\"result-header\"><div class=\"col-xs-3\"><div class=\"result-thumbnail vertical-space-base\"><a href=\"".site_url()."/villa/details/".base64_encode($result->session_id."/".$result->uniqueRefNo."/".$result->search_id."/".$result->villa_code."/". base64_encode("villa_crs"))."\"><img class=\"img-responsive\" src=\"".get_image_aws($gttd)."\" style=\"width: 100px;height: 80px;\"></a></div><div class=\"row vertical-space-large\"><div class=\"col-xs-12 col-md-12\"><div class=\"text-right\"><span>From </span><span class=\"h4\">".number_format($result->total_cost)."</span><span>".$result->currency."</span></div></div></div></div><div class=\"col-xs-9\"><div class=\"row\"><div class=\"col-xs-12\"><div class=\"result-title-group\"><a href=\"".site_url()."/villa/details/".base64_encode($result->session_id."/".$result->uniqueRefNo."/".$result->search_id."/".$result->villa_code."/". base64_encode("villa_crs"))."\"><span class=\"result-villa-name lead-text-default\"><span style=\"font-size: 1.5em;color: #372b45;font-weight: bolder;\">".$result->villa_name."</span></span></a><span class=\"result-accommodation-type lead-text-default\"></span><span class=\"star star".$result->star."\"></span></div></div></div><div class=\"row vertical-space-large\"><div class=\"col-xs-12 col-md-12\"><div>".$desc."</div></div></div></div></div></div></div></div>'],";
        }  } } }
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
 