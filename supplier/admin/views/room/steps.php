
<ul class="wizard_steps nav nav-pills">
  <li class="<?php if($steps == 1) echo 'active' ?>"><a href="<?php echo site_url() ?>room/edit_room?id=<?php echo $hotel_id ?>"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>General</small></span></a></li>
  <li  class="<?php if($steps == 2) echo 'active' ?>"><a href="<?php echo site_url() ?>room/edit_step2?id=<?php echo $hotel_id ?>"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Room Occupancy</small></span></a></li>
  <li  class="<?php if($steps == 3) echo 'active' ?>"><a href="<?php echo site_url() ?>room/edit_step3?id=<?php echo $hotel_id ?>"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Legacy</small></span></a></li>
  <li  class="<?php if($steps == 4) echo 'active' ?>"><a href="<?php echo site_url() ?>room/edit_step4?id=<?php echo $hotel_id ?>"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Gallery Images</small></span></a></li>
</ul>