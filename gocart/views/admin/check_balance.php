<div class="row">
</div>
<div class="row">
	<div class="col-sm-12" style="border-bottom:1px solid #f5f5f5;">
		<div class="row">			
			<div class="col-sm-12">

		<?php echo form_open($this->config->item('admin_folder').'/credit/check_balance', 'class="form-inline" style="float:right"');?>
			<input class="form-control"  type="text" name="card" id="card" placeholder="<?php echo lang('card');?>"/>								
			<input class="btn btn-primary" type="submit" value="<?php echo lang('check');?>"/>
		</form>
	</div>
</div></div></div>


<div class="row">
	<div class="col-sm-12">
		<div class="ibox">
 			<div class="ibox-content">

<table class="table table-striped table-hover">    
    <tbody>	
	<tr>
		<td style="white-space:nowrap"><?php echo lang('credit_balance')?></td>
		<td style="white-space:nowrap"><?php echo (isset($credit_balance) && !empty($credit_balance)) ? $credit_balance : '0.00' ?></td>			
	</tr>
	
	<tr>
		<td style="white-space:nowrap"><?php echo lang('point_balance')?></td>
		<td style="white-space:nowrap"><?php echo (isset($point_balance) && !empty($point_balance)) ? $point_balance : '0.00' ?></td>			
	</tr>
	
    </tbody>
</table>
</div></div></div></div>

