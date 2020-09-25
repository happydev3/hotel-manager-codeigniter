
<ul class="wizard_steps nav nav-pills">
  <li class="<?php if($steps == 1) echo 'active' ?>"><a href="<?php echo site_url() ?>specialoffer/edit_specialoffer?id=<?php echo $id ?>"><span class="step_no wizard-step">1</span><span class="step_descr">Step 1<br><small>General</small></span></a></li>
  <li  class="<?php if($steps == 2) echo 'active' ?>"><a href="<?php echo site_url() ?>specialoffer/edit_step2?id=<?php echo $id ?>"><span class="step_no wizard-step">2</span><span class="step_descr">Step 2<br><small>Period</small></span></a></li>
  <li  class="<?php if($steps == 3) echo 'active' ?>"><a href="<?php echo site_url() ?>specialoffer/edit_step3?id=<?php echo $id ?>"><span class="step_no wizard-step">3</span><span class="step_descr">Step 3<br><small>Condition</small></span></a></li>
  <li  class="<?php if($steps == 4) echo 'active' ?>"><a href="<?php echo site_url() ?>specialoffer/edit_step4?id=<?php echo $id ?>"><span class="step_no wizard-step">4</span><span class="step_descr">Step 4<br><small>Defination</small></span></a></li>
  <li class="<?php if($steps == 5) echo 'active' ?>"><a href="<?php echo site_url() ?>specialoffer/edit_step5?id=<?php echo $id ?>"><span class="step_no wizard-step">5</span><span class="step_descr">Step 5<br><small>Cancelation Policies</small></span></a></li>  
</ul>