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
		<td colspan=2 align="center"><h1>PRINT STATEMENT</h1></td>
	</tr>		
	</table>
	</div>
</div>
<div class="row">
<div class="col-lg-12">
<h2><?php echo lang('account_info') ?></h2>

<?php if(isset($customer) && !empty($customer)):?>
<table class="table table-striped table-hover" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<td colspan=2><?php echo lang('card')?>: <?php echo $customer['card']?> </td>
		</tr>
		<tr>
			<td colspan=2><?php echo lang('name')?>: <?php echo $customer['name']?></td>		
		</tr>
		<tr>
			<td colspan=2><?php echo lang('credit_balance')?>: <?php echo (isset($credit_balance['credit_amt']) && !empty($credit_balance['credit_amt'])) ? $credit_balance['credit_amt'] : '0.00'; ?> </td>		
		</tr>
		<tr>
			<td colspan=2><?php echo lang('point_balance')?>: <?php echo (isset($point_balance['point_amt']) && !empty($point_balance['point_amt'])) ? $point_balance['point_amt'] : '0.00'; ?></td>
		</tr>
	</thead>
</table>
<?php endif;?>

	
<table class="table table-bordered">
<thead>
	<tr class="table_header">
		<?php /*<th>ID</th> uncomment this if you want it*/ ?>
		<th><?php echo lang('date_transaction');?></th>
		<th><?php echo lang('debit');?></th>
		<th><?php echo lang('credit');?></th>
		<th><?php echo lang('balance');?></th>
	</tr>
</thead>
<?php if(isset($credits) && !empty($credits)):?>
<tbody>
	<?php 
		$total_amount_in = 0;
		$total_amount_out = 0;
		$balance = 0;
		foreach($credits as $credit):
			$total_amount_in += $credit->in;
			$total_amount_out += $credit->out;
			$balance += $credit->in;
			$balance -= $credit->out;
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
		<td><?php echo  $credit->in; ?></td>
		<td><?php echo $credit->out; ?></a></td>
		<td><?php echo $balance ?></td>
	</tr>
	<?php endforeach;?>
	<tr>
		
		<td style="text-align:right"><b><?php echo lang('total') ?></b></td>
		<td><b><?php echo $total_amount_in ?></b></td>
		<td><b><?php echo $total_amount_out ?></b></td>
		<td></td>
	</tr>
</tbody>
<?php else: ?>
<tbody>
	<tr>
		<td colspan=4>
			<p><?php echo lang('no_record_found')?></p>	
		</td>			
<?php endif;?>
		</tr>
	</tbody>
</table>

		
</div>
</div>

