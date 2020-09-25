<?php $this->load->view('home/header'); ?>
<div class="bottomSection">
    <div class="container">
        <div class="col-md-12 white-container">
            <div class="row">
                <div class="col-md-12 border0">
                    <h2><i class="fa fa-money"></i> Booking Cancel Details</h2>
                </div>
            </div>
            <form class="form-horizontal" action="<?php echo site_url(); ?>hotels/cancel_voucher_confirm/<?php //echo $bookdetails->Booking_RefNo; ?>/<?php //echo $bookdetails->uniqueRefNo ?>/confirm" enctype="multipart/form-data" method="post">
                <fieldset>
                    <input type="hidden" name="case" value="confirm"/>
                    <input type="hidden" name="api" value="gta"/>
                    <input type="hidden" name="bookrefno" value="<?php //echo $bookdetails->uniqueRefNo; ?>" />
                    <legend>Cancellation Information</legend>
                    <div class="control-group warning">
                        <label class="control-label" for="focusedInput"> Reference No</label>
                        <div class="controls">
                            <?php //echo $bookdetails->uniqueRefNo; ?>
                        </div>
                    </div>
                    <div class="control-group warning">
                        <label class="control-label" for="focusedInput">Booking_reference_ID</label>
                        <div class="controls">
                            <?php //echo $bookdetails->Booking_RefNo; ?>
                        </div>
                    </div>
                    <div class="control-group warning">
                        <label class="control-label" for="focusedInput">Cancellation</label>
                        <div class="controls">
                            <?php //echo $cancelpolicy; ?>
                        </div>
                    </div>
                    <div class="form-actions">
                        DO YOU WANT TO CONTINUE: <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                    <div class="form-actions">
                        <a href="<?php echo site_url(); ?>home/print_ticket"> <span  class="btn btn-primary">Back</span></a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('home/footer'); ?>
</body>
</html>