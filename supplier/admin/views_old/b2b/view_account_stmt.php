<?php $this->load->view('header'); ?>
<?php echo $this->load->view('left_panel'); ?>
<!--<div class="mainpanel">-->
<?php echo $this->load->view('top_panel'); ?>
<!--<style>
.paging_full_numbers {
line-height: 22px;
margin-top: 22px;
}
.mb30 {
margin-bottom: 30px;
/* height: 398px; */
min-height: 400px;
}
</style> -->

<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h2>Deposit/Withdraw <small>View Account Summary</small></h2>
              </div>
            </div>
            <div class="clearfix"></div>			
       <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
				    <?php if(!empty($agent_info)) {?>
				 <h2>Deposit/Withdraw <small>Account Balance</small></h2>
					<?php } ?>
                       <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
	<br/>
    <?php if(!empty($agent_info)) {?>
    <form class="form-horizontal" action="<?php echo site_url();?>/b2b/add_transaction_info" method="post">
	    <?php if(validation_errors() != ""){ ?>
        <div class="alert alert-error" style="background:red;color:#fff">
          <button class="close" data-dismiss="alert" type="button">×</button>
          <?php echo validation_errors();?>
        </div>
        <?php } ?>
         <div class="form-group">
          <label class="col-sm-3 control-label" for="focusedInput">Agent Number</label>
          <div class="col-sm-6">
            <div class="input-append">
              <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $agent_info->agent_no; ?>" disabled="">
              <input type="hidden" name="agent_id" value="<?php echo $agent_id; ?>" />
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label" for="focusedInput">Available Balance</label>
          <div class="col-sm-6">
            <div class="input-append">
              <input class="form-control" id="disabledInput" type="text" placeholder="<?php if(!empty($agent_acc_summary)) echo $agent_info->currency_type.' '.$agent_acc_summary[0]->available_balance; else echo $agent_info->currency_type.' 0.00'; ?>" disabled="">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label">Transaction Type</label>
          <div class="col-sm-6">
            <label class="radio">
              <div class="uniRadio" id="uniform-radio2">
                <span class="checked">
                  <input type="radio" id="radio1" checked="" value="deposit" class="uniform" name="transaction_type" style="opacity: 0;">
                </span>
              </div>
              Deposit Amount
            </label>
            <div style="clear:both"></div>
            <label class="radio">
              <div class="uniRadio" id="uniform-radio2">
                <span class="checked">
                  <input type="radio" id="radio2" value="withdraw" class="uniform" name="transaction_type" style="opacity: 0;">
                </span>
              </div>
              Withdraw Amount
            </label>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label" for="disabledInput">Amount Deposit/Withdraw *</label>
          <div class="col-sm-6">
            <input class="form-control" id="focusedInput" type="text" name="amount" value="<?php if(isset($amount))echo $amount; ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label" for="date01">Date of Deposit/Withdraw *</label>
          <div class="col-sm-6">
            <input type="text" class="datepick" id="datepicker" value="<?php if(isset($value_date))echo $value_date; ?>" name="value_date" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label" for="selectError2">Transaction Modes</label>
          <div class="col-sm-6">
            <select id="selectError2" class="form-control" name="transaction_mode" required>
              <option value="">Select Transaction Mode</option>
              <optgroup label="Transaction Modes">
                <option value="cash">Cash</option>
                <option value="NEFT">NEFT</option>
                <option value="RTGS">RTGS</option>
                <option value="cheque">Cheque/DD</option>
              </optgroup>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label" for="disabledInput">Bank </label>
          <div class="col-sm-6">
            <input class="form-control" id="focusedInput" type="text" name="bank" value="<?php if(isset($bank))echo $bank; ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label" for="disabledInput">Branch </label>
          <div class="col-sm-6">
            <input class="form-control" id="focusedInput" type="text" name="branch" value="<?php if(isset($branch))echo $branch; ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label" for="disabledInput">City </label>
          <div class="col-sm-6">
            <input class="form-control" id="focusedInput" type="text" name="city" value="<?php if(isset($city))echo $city; ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label" for="disabledInput">Transaction Id/Cheque No *</label>
          <div class="col-sm-6">
            <input class="form-control" id="focusedInput" type="text" name="transaction_id" value="<?php if(isset($transaction_id))echo $transaction_id; ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label" for="disabledInput">Remarks </label>
          <div class="col-sm-6">
            <input class="form-control" id="focusedInput" type="text" name="remarks" value="<?php if(isset($remarks))echo $remarks; ?>" required>
          </div>
        </div>
			<div class="ln_solid"></div>
			  <div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				 <button type="submit" class="btn btn-primary">Submit</button>
          <a href="<?php echo site_url();?>/b2b/agent_manager" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
				</div>
			  </div>
        
    </form>
	<div class="ln_solid"></div>
    <?php } ?>
	</div>
	</div>
	</div>
	</div>
    <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 <ul class="nav nav-tabs navbar-left nav-dark">
					  <li>
						<a class="tip btn btn-mini" href="<?php echo site_url();?>/b2b/create_agent" data-original-title="Create New Agent">
						  <img alt="" src="<?php echo base_url();?>public/img/icons/essen/16/business-contact.png">
						</a>
					  </li>&nbsp;&nbsp;&nbsp;
					  <li class="active">
						<a data-toggle="tab" href="#agent-list">Agent List</a>
					  </li>
					</ul>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                       <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
       <div class="tab-content mb30">
      <div class="tab-pane active" id="agent-list">
	   <?php if(!empty($agent_acc_summary)) {?>
	   <div class="table-responsive">
       <table id="datatable1" class="table">
          <thead>
            <tr>
              <th>SI.No</th>
              <th>Value Date</th>
              <th>Narration</th>
              <th>Transaction DateTime</th>
              <th>Deposit</th>
              <th>Withdraw</th>
              <th>Available_balance</th>
              <th>Status</th>
              <th>Remarks</th>
              <th>Actions</th>
            </tr>
          </thead>
          
		    <tbody>
            <?php for($i=0;$i<count($agent_acc_summary);$i++) {?>
            <tr>
              <td><?php echo $i+1;?></td>
              <td><?php echo $agent_acc_summary[$i]->value_date;?></td>
              <td class="center"><?php echo $agent_acc_summary[$i]->transaction_summary;?></td>
              <td class="center"><?php echo $agent_acc_summary[$i]->transaction_datetime;?></td>
              <td class="center"><?php echo $agent_acc_summary[$i]->deposit_amount;?></td>
              <td class="center"><?php echo $agent_acc_summary[$i]->withdraw_amount;?></td>
              <td class="center"><?php echo $agent_acc_summary[$i]->available_balance; ?></td>
              <td class="center"><?php echo $agent_acc_summary[$i]->status; ?></td>
              <td class="center"><?php echo $agent_acc_summary[$i]->remarks; ?></td>
              <td class="center">
                <?php
                if ($agent_acc_summary[$i]->status == 'Accepted' || $agent_acc_summary[$i]->status == 'Declined' ) {
                ?>
                <a class="tip btn btn-mini " href="javascript:void(0)" >
                </a>
                <?php
                } else {
                ?>
                <a class="tip btn btn-mini " href="<?php echo site_url(); ?>/b2b/deposit_approve/<?php echo $agent_acc_summary[$i]->acc_id; ?>/<?php echo $agent_acc_summary[$i]->agent_no; ?>" title="Approve" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="1" data-agent-id="<?php echo $agent_acc_summary[$i]->agent_id; ?>" >
                  <i class="glyphicon glyphicon-ok-sign"></i>
                </a>
                <a class="tip btn btn-mini " href="<?php echo site_url(); ?>/b2b/deposit_decline/<?php echo $agent_acc_summary[$i]->acc_id; ?>/<?php echo $agent_acc_summary[$i]->agent_no; ?>" title="Decline" data-rel="tooltip" data-base-url="<?php echo site_url(); ?>/" data-value="1" data-agent-id="<?php echo $agent_acc_summary[$i]->agent_id; ?>" >
                  <i class="glyphicon glyphicon-minus-sign"></i>
                </a>
                <?php
                }
                ?>
              </td>
            </tr>
			  
            <?php } ?>
			</tbody>
			</table>
			</div>
            <?php } else { ?>
            <div class="alert alert-error">
              <button class="close" data-dismiss="alert" type="button">×</button>
              <strong>Error!</strong>
              No Account Summary Found...
            </div>
            <?php } ?>
        
		
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
<?php echo $this->load->view('footer'); ?>
