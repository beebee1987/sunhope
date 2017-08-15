<?php $countries = config_item('country_list');  ?>
<link href="<?php echo base_url('assets/css/pdf.css') ?>" rel="stylesheet"/>
<style>
table {
	border-collapse: collapse;
	border-spacing: 0;
	width:100%;
}
.table-title{
	padding:0;	
}
.table-bordered td, .table-bordered th{
	border: 1px solid #ddd;
	padding: 8px;
	border-collapse: collapse;	
}
.table-bordered th{
	color: #fff;
}
body {
	font-size: 75%;
}
</style>

<?php 
	//$logo = get_siteconfig('logo');
	//$name = get_siteconfig('name');
	
?>

<div class="row">
	<div class="col-lg-12">
	<table width="100%">
	<tr>
		<td align="center" cellpadding="0" cellspacing="0" style="padding:0px">				
			<img src="<?php echo theme_img('logo.png') ?>" width="35%"/>								
		</td>
	</tr>					
	</table>
	</div>	
</div>
<hr/>
<div class="row">
	<div class="col-lg-12">
	<table width="100%">
	<tr>
		<td colspan=2 align="center"><h1>COUPON REPORT</h1></td>
	</tr>		
	</table>
	</div>
</div>
<div class="row">
<div class="col-lg-12">
<h2><?php echo lang('add_credit_trx') ?></h2>
<table class="table table-bordered">	
	<thead>
		<tr class="table_header">
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
		
</div>
</div>

