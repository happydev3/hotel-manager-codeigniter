<ul class="bread pull-right" style="color:#fff;">
			<li>
				<span>Admin Group <b><?php echo $this->Home_Model->get_group($this->session->userdata('admin_group')); ?></b></span>
			</li>
			<li><span>&nbsp;||&nbsp;</span>
			</li>
<!--			<li>
				<span>Available Pins <b><?php //echo $this->Home_Model->get_max_admin_pins(); ?></b></span>
			</li>-->
			<li><span>&nbsp;||&nbsp;</span>
			</li>
			<li>
				<span>Available Balance <b><?php echo $this->Home_Model->get_admin_available_balance($this->session->userdata('admin_id')); ?></b></span>
			</li>			
</ul>