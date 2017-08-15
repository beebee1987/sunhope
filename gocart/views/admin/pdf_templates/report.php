<?php $countries = config_item('country_list');  ?>
<link href="<?php echo base_url().CSSFOLDER; ?>style.css" rel="stylesheet"/>
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
	$logo = get_siteconfig('logo');
	$name = get_siteconfig('name');
	$gst = get_siteconfig('gst');
	$ssm = get_siteconfig('ssm');	
	$address = get_siteconfig('address');
	$postal_code = get_siteconfig('postal_code');
	$phone = get_siteconfig('phone');
	$fax = get_siteconfig('fax');	
	$email = get_siteconfig('email');
	$website = get_siteconfig('website');
?>

<div class="row">
	<div class="col-lg-12">
	<table width="100%">
	<tr>
		<td align="center" cellpadding="0" cellspacing="0" style="padding:0px">
			<?php 																					
			if($logo != ''){
			?>
			<img src="<?php echo base_url().UPLOADSDIR.$logo;?>" width="25%"/>
			<?php
			}
			?>
		</td>
	</tr>			
	<tr>			
		<td align="center" cellpadding="0" cellspacing="0" style="padding:0px; font-size:16px;"><?php echo $name ?> <span style="font-size:8px;">(<?php echo $ssm?>)</span></td>
	</tr>
	<tr>
		<td align="center" cellpadding="0" cellspacing="0" style="padding:0px; font-size:13px; font-weight: bold;"><?php echo (isset($gst) && !empty($gst)) ? 'GST ID No: '.$gst : '' ?></td>
	</tr>
	<tr>
		<td align="center" cellpadding="0" cellspacing="0" style="padding:0px; font-size:10px;"><span style="font-size:10px;"><?php echo $address ?></span></td>
	</tr>
	<tr>
		<td align="center" cellpadding="0" cellspacing="0" style="padding:0px; font-size:10px;"><span style="font-size:10px;">H/P: <?php echo isset($phone)&&!empty($phone) ? $phone : '-' ?></span> <!--span style="font-size:10px;">FAX: <?php echo isset($fax) && !empty($fax) ? $fax : '-' ?></span--> </td>
	</tr>					
	</table>
	</div>	
</div>
<hr/>
<div class="row">
	<div class="col-lg-12">
	<table width="100%">
	<tr>
		<td colspan=2 align="center"><h1>STATEMENT OF ACCOUNT</h1></td>
	</tr>	
	<tr>
		<td width="80%">		
			<p>Billed To : </p>
					
			<span style="font-size:12px;font-weight: bold"><?php echo isset($report_details[0]['invoice_client']) && !empty($report_details[0]['invoice_client']) ? $report_details[0]['invoice_client'] : '-'; ?> </span><span style="font-size:6px;"><?php echo isset($report_details[0]['invoice_client_ssm']) && !empty($report_details[0]['invoice_client_ssm']) ? '<span style="font-size:8px;">('.$report_details[0]['invoice_client_ssm'].')</span>' : ''; ?></span>			
			<p><?php echo isset($report_details[0]['invoice_client_address']) && !empty($report_details[0]['invoice_client_address']) ? $report_details[0]['invoice_client_address'] : '-'; ?></p>								
			<p>TEL: <?php echo isset($report_details[0]['invoice_client_phone']) && !empty($report_details[0]['invoice_client_phone']) ? $report_details[0]['invoice_client_phone'] : '-'; ?>  FAX: <?php echo isset($report_details[0]['invoice_client_fax'])&&!empty($report_details[0]['invoice_client_fax']) ? $report_details[0]['invoice_client_fax']: '-'; ?> </p>
			<p><span style="font-weight: bold">GST ID No: <?php echo isset($report_details[0]['invoice_client_gst']) && !empty($report_details[0]['invoice_client_gst']) ? $report_details[0]['invoice_client_gst'] : '-'; ?></span></p>			
			<!--p>Attn:</p-->																
		</td>
		<td width="20%">
			<p>Billing Date : <?php echo $bill_date ?></p>
		</td>
	</tr>
	</table>
	</div>
</div>
<div class="row">
<div class="col-lg-12">
<table class="table table-bordered">
	<thead>
	  <tr class="table_header">
	  	<th width="2%">No</th>
		<th width="15%">DATE</th>
		<!--th>INVOICE NUMBER</th-->		
		<th width="25%">DESCRIPTION</th>
		<th>QUANTITY</th>
		<th>KG</th>
		<th>UNIT PRICE</th>
		<th>DISCOUNT</th>
		<th>AMOUNT </th>		
	  </tr>
	</thead>
	<tbody>
<?php
if( isset($report_details) && !empty($report_details))
{
?>	
	
	<?php
	$amount = 0;
	$number = 0;
	foreach ($report_details as $count=>$invoice)
	{
		
		
	?>
	<tr class="transaction-row">
	<td><?php echo $number + 1 ?></td>
	<td><?php echo format_date($invoice['invoice_date']);?></td>
	<!--td><?php echo $invoice['invoice_number'];?></td-->	
	<td><?php echo $invoice['invoice_item'];?></td>
	<td><?php echo $invoice['invoice_item_quantity'];?></td>
	<td><?php echo $invoice['invoice_item_weight'];?></td>
	<td><?php echo $invoice['invoice_item_price'];?></td>
	<td><?php echo $invoice['invoice_item_discount'];?></td>
	<?php 
			//$amount += $invoice['invoice_amount'];
			$item_total = ($invoice['invoice_item_quantity'] * $invoice['invoice_item_weight'] * $invoice['invoice_item_price']) - $invoice['invoice_item_discount'];
			$amount += $item_total; 
	?>
	<td class="text-right" style="padding:0px;"><?php echo format_amount($item_total);?></td>			
	</tr>
	<?php
		$number++;
	}
	?>
	
	<tr class="transaction-row">
	  	<td colspan=6></td>
	  	<td class="text-right">Total:</td>
	  	<td class="text-right" style="padding:0px; font-size:14px;"><?php echo format_amount($amount) ?></td>
	</tr>
<?php 	
}
else
{
?>
<tr class="no-cell-border transaction-row">
<td colspan="3"> There are no records to display at the moment.</td>
</tr>
<?php
}
?>		
</table>
	
	
<table width="100%">
<tr>
	<td width="70%">
	<label class="control-label">This is computer generated document,</label>
	<br/><br/>
	no signature required<br/>
	................................................<br/>
	<i>Authorised Signature</i>				
	</td>
	
	<td width="30%">
		<label class="control-label">Client : <?php echo isset($report_details[0]['invoice_client']) && !empty($report_details[0]['invoice_client']) ? $report_details[0]['invoice_client'] : '-'; ?></label>
		<br/><br/><br/>
		................................................<br/>
		<i>Signature &amp; Stamp</i>		
	</td>
</tr>
</table>
		
</div>
</div>

