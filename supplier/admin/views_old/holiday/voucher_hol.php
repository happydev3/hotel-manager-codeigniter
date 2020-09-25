<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/datepicker.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/font-awesome.min.css">
<div class="flightsContainer">
<div class="container">
<?php //$hol_id=$holidaydetails->holiday_id; 
//echo $hol_id;exit;
?>
<?php if(!empty($holiday_booking_info))
{ ?>
<?php $this->load->view('holiday/voucher_content_hol'); ?>

<table align="center" width="100%">
    <tr>
    <td bgcolor="#e7e7e7" align="center">
        <a href="" onclick="printIframe('loaderFrame');" title="print"><img src="<?php echo base_url(); ?>public/img/print_Icon.png" /></a>
        <a href="<?php echo site_url(); ?>/holiday/ticket_email?voucherId=<?php echo $holiday_booking_info->uniqueRefNo; ?>&hotelRefId=<?php $holiday_booking_info->uniqueRefNo; ?>" title="mail ticket"><img src="<?php echo base_url(); ?>public/img/mail_icon.png" /></a>
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
</div>
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
