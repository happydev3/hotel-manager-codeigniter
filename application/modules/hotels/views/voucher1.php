<?php $this->load->view('home/header'); ?>
<script type = "text/javascript" >
  function changeHashOnLoad() {
  window.location.href += "#";
  setTimeout("changeHashAgain()", "50");
  }
  function changeHashAgain() {
  window.location.href += "1";
  }
  var storedHash = window.location.hash;
  window.setInterval(function () {
  if (window.location.hash != storedHash) {
  window.location.hash = storedHash;
  }
  }, 50);
</script>
<script>
  function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
 <body onload="changeHashOnLoad();">
<section id="content">
    <div class="container">
      <div class="row2 traveller-details">  
 <?php //echo '<pre>'; print_r($hotel_booking_info); exit; ?>
	<?php if(!empty($hotel_booking_info)) {?>
      <?php //echo '<pre>'; print_r($hotel_booking_info); exit; ?>

<?php $this->load->view('voucher_content'); ?>


<table align="center" width="100%">
  <?php if($hotel_booking_info->api=='gta') { ?>
     <tr>
         <td bgcolor="#f7f7f7" colspan="4"><b>Emergency Contact Numbers</b></td>
  </tr>
  <tr bgcolor="#e7e7e7">
      <td ><b>Contact Number</b></td>
  </tr>
  <tr bgcolor="#f7f7f7">
      <td>+971 4 456 99 44</td>
  </tr>
    <?php } ?>
    <tr>
    <td bgcolor="#e7e7e7" align="center" colspan="4" style="font-size: 25px;">
	<a target="_blank" onclick="printContent('printArea')" href="JavaScript:void(0);"  title="print"><i class="fa fa-print"></i></a>
<a href="<?php echo base_url(); ?>" title="home"><i class="fa fa-home"></i></a>

    </td>
  </tr>
</table>

<?php }else{ ?>

<table align="center" width="100%">
    <tr>
    <td bgcolor="#e7e7e7" align="center">

		<h3>Sorry, No Voucher is Availbale.. Please try for another voucher...</h3>

    </td>
  </tr>
</table>

<?php } ?>


</div>
</div>
</section>

<?php $this->load->view('home/footer'); ?>



<script>
function printIframe(id)
{
var iframe = document.frames ? document.frames[id] : document.getElementById(id);
var ifWin = iframe.contentWindow || iframe;
ifWin.focus();
ifWin.printMe();
return false;
}
</script>
