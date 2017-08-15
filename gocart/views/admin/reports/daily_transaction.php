<div class="row">
	<div class="col-sm-10">
		<h2><?php echo lang('add_credit_trx') ?></h2>
	</div>

	<div class="col-sm-2">
	<?php if($this->auth->check_access('Admin')) : ?>	
		<a href="<?php echo site_url($this->config->item('admin_folder').'/reports/viewdailypdf/'.$start.'/'.$end);?>" class="btn btn-warning btn-md">Download PDF</a>	
	<?php endif; ?>
	</div>

</div>

<table class="table table-striped table-hover" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<?php /*<th>ID</th> uncomment this if you want it*/ ?>
			<th><?php echo lang('date_transaction');?></th>
			
			<th><?php echo lang('card');?></th>
			<th><?php echo lang('card_name');?></th>			
			<th><?php echo lang('topup_amount');?></th>
			<th><?php echo lang('credit');?></th>
			<th><?php echo lang('branch');?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$total_amount_in = 0;
			
			foreach($credits_in as $credit):
				$total_amount_in += $credit->in;
		?>
		<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td>
				<?php 
					//echo  $credit->created; 
					$datetime = new DateTime($credit->created);
					$date = $datetime->format('d-m-Y');
					$time = $datetime->format('H:i:s');
					
					if($time == "00:00:00"){
						echo $date;
					}else{
						echo $date.' '.$time;
					}
					
				?>			
			</td>						
			<td><?php echo  $credit->customer_card; ?></td>
			<td><?php echo  $credit->customer_name; ?></td>
			<td><?php echo  $credit->cost; ?></td>
			<td><?php echo $credit->in; ?></a></td>
			<td><?php echo $credit->branch_name; ?></td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td><b><?php echo lang('total') ?></b></td>
			<td><b><?php echo $total_amount_in ?></b></td>
			<td></td>
			
		</tr>
	</tbody>
</table>

<h2><?php echo lang('deduct_credit_trx') ?></h2>
<table class="table table-striped table-hover" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<?php /*<th>ID</th> uncomment this if you want it*/ ?>
			<th><?php echo lang('date_transaction');?></th>
			<th><?php echo lang('card');?></th>
			<th><?php echo lang('card_name');?></th>			
			<th><?php echo lang('topup_amount');?></th>
			<th><?php echo lang('credit');?></th>
			<th><?php echo lang('branch');?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$total_amount_out = 0;
			foreach($credits_out as $credit):
				$total_amount_out += $credit->out;
		?>
		<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td>
				<?php 
					//echo  $credit->created; 					
					$datetime = new DateTime($credit->created);
					$date = $datetime->format('d-m-Y');
					$time = $datetime->format('H:i:s');
						
					if($time == "00:00:00"){
						echo $date;
					}else{
						echo $date.' '.$time;
					}
				?>			
			</td>
			<td><?php echo  $credit->customer_card; ?></td>
			<td><?php echo  $credit->customer_name; ?></td>
			<td><?php echo  $credit->cost; ?></td>
			<td><?php echo $credit->out; ?></a></td>
			<td><?php echo $credit->branch_name; ?></td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td><b><?php echo lang('total') ?></b></td>
			<td>
				<b><?php echo $total_amount_out ?></b>
			</td>
			<td></td>
		</tr>
	</tbody>
</table>

<h2><?php echo lang('add_point_trx') ?></h2>
<table class="table table-striped table-hover" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<?php /*<th>ID</th> uncomment this if you want it*/ ?>
			<th><?php echo lang('date_transaction');?></th>
			<th><?php echo lang('card');?></th>
			<th><?php echo lang('card_name');?></th>			
			<th><?php echo lang('point');?></th>
			<th><?php echo lang('branch');?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$total_amount_in = 0;
			
			foreach($points_in as $point):
				$total_amount_in += $point->point;
		?>
		<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td>
				<?php 
					//echo  $point->created;
					$datetime = new DateTime($point->created);
					$date = $datetime->format('d-m-Y');
					$time = $datetime->format('H:i:s');
					
					if($time == "00:00:00"){
						echo $date;
					}else{
						echo $date.' '.$time;
					}								
				?>
			</td>
			<td><?php echo $point->customer_card; ?></td>
			<td><?php echo $point->customer_name; ?></td>
			<td><?php echo $point->point; ?></a></td>
			<td><?php echo $point->branch_name; ?></td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td></td>
			<td></td>
			<td><b><?php echo lang('total') ?></b></td>
			<td><b><?php echo $total_amount_in ?></b></td>
			<td></td>
		</tr>
	</tbody>
</table>

<h2><?php echo lang('deduct_point_trx') ?></h2>
<table class="table table-striped table-hover" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<?php /*<th>ID</th> uncomment this if you want it*/ ?>
			<th><?php echo lang('date_transaction');?></th>
			<th><?php echo lang('card');?></th>
			<th><?php echo lang('card_name');?></th>			
			<th><?php echo lang('point');?></th>
			<th><?php echo lang('branch');?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$total_amount_out = 0;
			foreach($points_out as $point):
				$total_amount_out += $point->depoint;
		?>
		<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td><?php 
					//echo  $point->created;
					$datetime = new DateTime($point->created);
					$date = $datetime->format('d-m-Y');
					$time = $datetime->format('H:i:s');
					
					if($time == "00:00:00"){
						echo $date;
					}else{
						echo $date.' '.$time;
					}								
				?>
			</td>	
			<td><?php echo $point->customer_card; ?></td>
			<td><?php echo $point->customer_name; ?></td>		
			<td><?php echo $point->depoint; ?></a></td>
			<td><?php echo $point->branch_name; ?></td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td></td>
			<td></td>
			<td><b><?php echo lang('total') ?></b></td>
			<td>
				<b><?php echo $total_amount_out ?></b>
			</td>
			<td></td>
		</tr>
	</tbody>
</table>


<h2><?php echo lang('voucher_credit') ?></h2>
<table class="table table-striped table-hover" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<?php /*<th>ID</th> uncomment this if you want it*/ ?>
			<th><?php echo lang('date_transaction');?></th>
			<th><?php echo lang('card');?></th>
			<th><?php echo lang('card_name');?></th>			
			<th><?php echo lang('voucher');?></th>
			<th><?php echo lang('credit');?></th>
			<th><?php echo lang('branch');?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$total_amount_out = 0;
			foreach($credit_voucher_out as $credit):
				$total_amount_out += $credit->out;
		?>
		<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td><?php 
					//echo  $credit->created;
					$datetime = new DateTime($credit->created);
					$date = $datetime->format('d-m-Y');
					$time = $datetime->format('H:i:s');
					
					if($time == "00:00:00"){
						echo $date;
					}else{
						echo $date.' '.$time;
					}								
				?>
			</td>	
			<td><?php echo $credit->customer_card; ?></td>
			<td><?php echo $credit->customer_name; ?></td>	
			<td><?php echo $credit->voucher_name; ?></td>
			<td><?php echo $credit->out; ?></a></td>
			<td><?php echo $credit->branch_name; ?></td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td><b><?php echo lang('total') ?></b></td>
			<td>
				<b><?php echo $total_amount_out ?></b>
			</td>
			<td></td>
		</tr>
	</tbody>
</table>

<h2><?php echo lang('voucher_point') ?></h2>
<table class="table table-striped table-hover" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<?php /*<th>ID</th> uncomment this if you want it*/ ?>
			<th><?php echo lang('date_transaction');?></th>
			<th><?php echo lang('card');?></th>
			<th><?php echo lang('card_name');?></th>			
			<th><?php echo lang('voucher');?></th>
			<th><?php echo lang('point');?></th>
			<th><?php echo lang('branch');?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$total_amount_out = 0;
			foreach($point_voucher_out as $point):
				$total_amount_out += $point->depoint;
		?>
		<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td><?php 
					//echo  $point->created;
					$datetime = new DateTime($point->created);
					$date = $datetime->format('d-m-Y');
					$time = $datetime->format('H:i:s');
					
					if($time == "00:00:00"){
						echo $date;
					}else{
						echo $date.' '.$time;
					}								
				?>
			</td>	
			<td><?php echo $point->customer_card; ?></td>
			<td><?php echo $point->customer_name; ?></td>	
			<td><?php echo $point->voucher_name; ?></td>
			<td><?php echo $point->depoint; ?></a></td>
			<td><?php echo $point->branch_name; ?></td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td><b><?php echo lang('total') ?></b></td>
			<td>
				<b><?php echo $total_amount_out ?></b>
			</td>
			<td></td>
		</tr>
	</tbody>
</table>
