<?php echo $this->load->view('header') ?>
</head>
<?php //echo $this->load->view('subheader') ?>
<?php
$supplier_id = $this->session->userdata('supplier_id');
$CI = & get_instance();
$CI->load->model('supplier_info');
$supdata['supplier_info'] = $CI->supplier_info->get_spec($supplier_id);
// echo '<pre>';print_r($data['supplier_info']);exit;
?>
<?php echo $this->load->view('top_panel',$supdata) ?>
<?php echo $this->load->view('left_panel',$supdata) ?>
<?php echo $this->load->view('subfooter') ?>
<?php echo $this->load->view($sub_view); ?>
</div>
</body>
</html>