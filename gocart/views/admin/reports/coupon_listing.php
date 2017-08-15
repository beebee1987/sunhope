<div class="row">
	<div class="col-sm-10">
		<h2><?php echo lang('account_info') ?></h2>	
	</div>	
	<div class="col-sm-2">
		<?php if($this->auth->check_access('Admin')) : ?>	
			<a href="<?php echo site_url($this->config->item('admin_folder').'/reports/viewcouponpdf/'.$coupon_id.'/'.$card);?>" class="btn btn-warning btn-md">Download PDF</a>	
		<?php endif; ?>	
	</div>
</div>

<?php if(isset($customer) && !empty($customer)):?>
<table class="table table-striped table-hover" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan=2><?php echo lang('card')?>: <?php echo $customer['card']?> </td>
	</tr>
	<tr>
		<td colspan=2><?php echo lang('name')?>: <?php echo $customer['name']?></td>		
	</tr>	
</table>
<?php endif; ?>
<table class="table table-striped table-hover" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<?php /*<th>ID</th> uncomment this if you want it*/ ?>
			<th><?php echo lang('card');?></th>
			<th><?php echo lang('customer_name');?></th>
			<th><?php echo lang('coupon_name');?></th>
			<th><?php echo lang('coupon_code');?></th>
			<th><?php echo lang('qty_own');?></th>
			<th><?php echo lang('qty_used');?></th>
			<th><?php echo lang('balance');?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach($coupons as $coupon):								
		?>
		<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td><?php echo  $coupon->card; ?></td>
			<td><?php echo  $coupon->customer_name; ?></td>
			<td><?php echo  $coupon->coupon_name; ?></td>
			<td><?php echo $coupon->code; ?></a></td>
			<td><?php echo $coupon->qty; ?></a></td>
			<td><?php echo $coupon->used; ?></a></td>
			<?php 
				$balance = $coupon->qty - $coupon->used;
			?>
			<td><?php echo $balance ?></td>
		</tr>
		<?php endforeach;?>		
	</tbody>
</table>