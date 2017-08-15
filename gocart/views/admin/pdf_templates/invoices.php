<?php $countries = config_item('country_list');  ?>
<link href="<?php echo base_url().CSSFOLDER; ?>style.css" rel="stylesheet"/>
<style>
table {
	border-collapse: collapse;
	border-spacing: 0;
	width:100%;
}
.table-bordered td, .table-bordered th{
	border: 1px solid #ddd;
	padding: 8px;
	border-collapse: collapse;
	
}
.table-bordered th{
	color: #bce8f1;
}
body {
	font-size: 80%;
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
		<!--td>
			<?php
			 $class = ($invoice_details['invoice_details']->invoice_status == 'UNPAID') ? 'invoice_status_cancelled' : 'invoice_status_paid';
			  ?>
			<div class="<?php echo $class; ?>"> <?php echo $invoice_details['invoice_details']->invoice_status; ?></div>
		</td-->
	</tr>
	<tr>			
		<td align="center" cellpadding="0" cellspacing="0" style="padding:0px; font-size:16px;"><?php echo $name ?> <span style="font-size:8px;"><?php echo (isset($ssm) && !empty($ssm)) ? '('.$ssm.')' : '' ?></span></td>
	</tr>
	<!--tr>
		<td align="center" cellpadding="0" cellspacing="0" style="padding:0px; font-size:13px; font-weight: bold;">GST ID No: <?php echo $gst ?></td>
	</tr-->
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
		<td colspan=2 align="center"><h1>Invoice</h1></td>
	</tr>
	
	<tr>
		<td width="70%">		
			<p>Billed To : </p>
			<span style="font-size:12px;font-weight: bold"><?php echo $invoice_details['invoice_details']->client_name; ?> </span><span style="font-size:6px;"><?php echo isset($invoice_details['invoice_details']->client_ssm) && !empty($invoice_details['invoice_details']->client_ssm) ? '<span style="font-size:8px;">('.$invoice_details['invoice_details']->client_ssm.')</span>' : ''; ?></span>			
			<p><?php echo $invoice_details['invoice_details']->client_address; ?></p>								
			<p>TEL: <?php echo isset($invoice_details['invoice_details']->client_phone) && !empty($invoice_details['invoice_details']->client_phone) ? $invoice_details['invoice_details']->client_phone : '-'; ?>  FAX: <?php echo isset($invoice_details['invoice_details']->client_fax)&&!empty($invoice_details['invoice_details']->client_fax) ? $invoice_details['invoice_details']->client_fax : '-'; ?> </p>
			<!--p><span style="font-weight: bold">GST ID No: <?php echo isset($invoice_details['invoice_details']->client_gst) && !empty($invoice_details['invoice_details']->client_gst) ? $invoice_details['invoice_details']->client_gst : '-'; ?></span></p-->
			<p>Attn:</p>
		</td>				
		<td>		
			<p>Invoice No. : <?php echo $invoice_details['invoice_details']->invoice_number; ?></p>
			<p>Date : <?php echo format_date($invoice_details['invoice_details']->invoice_date_created); ?></p>			
			<!--p>Page: of 1</p-->								
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
	  	<th style="color: #bce8f1">NO</th>
		<th style="color: #bce8f1">ITEM</th>
		<th>DESCRIPTION</th>
		<!--th>TAX </th-->
		<th>QUANTITY</th>
		<th class="text-right">UNIT PRICE (RM)</th>
		<th class="text-right">WEIGHT (KG)</th>
		<th class="text-right">DISCOUNT (RM)</th>
		<th class="text-right">SUB TOTAL (RM)</th>
	  </tr>
	</thead>
	<tbody>
	<?php
	$numberItem = 0;
	foreach ($invoice_details['invoice_items'] as $count=>$item)
	{?>
	<tr class="transaction-row">
	<td><?php echo $numberItem + 1 ?></td>
	<td><?php echo $item['item_name'];?></td>
	<td><?php echo $item['item_description'];?></td>
	<!--td><?php echo ($item['item_taxrate_id'] !=0 ) ? $item['tax_rate_name'].' - '.$item['tax_rate_percent'].'%' : '0.00%';?></td-->
	<td style="text-align:center"><?php echo $item['item_quantity'];?></td>
	<td class="text-right" style="width: 13%"><?php echo number_format($item['item_price'], 2); ?></td>
	<td class="text-right" style="width: 13%"><?php echo number_format($item['item_weight'], 2); ?></td>
	<td class="text-right" style="width: 10%"><?php echo number_format($item['item_discount'], 2); ?></td>
	<td class="text-right" style="width: 14%"><?php echo number_format($item['item_price']*$item['item_quantity']-$item['item_discount'], 2); ?></td>
	</tr>
	<?php 
		$numberItem++;
	}
	?>
	
	<!--tr><td colspan="5" class="text-right">ITEMS TOTAL COST : </td><td class="text-right"><label><?php echo format_amount($invoice_details['invoice_totals']['item_total']);?></label></td></tr-->
	<!--tr><td colspan="5" class="text-right no-border">TOTAL TAX : </td><td class="text-right no-border"><label><?php echo format_amount($invoice_details['invoice_totals']['tax_total']);?></label></td></tr-->
	<tr><td colspan="7" class="text-right no-border">SUB TOTAL : </td><td class="text-right invoice_amount_due"><label><?php echo format_amount($invoice_details['invoice_totals']['sub_total']);?></label></td></tr>
	<tr><td colspan="7" class="text-right no-border">INVOICE DISCOUNT : </td><td class="text-right no-border"><label><?php echo format_amount($invoice_details['invoice_details']->invoice_discount);?></label></td></tr>
	<tr><td colspan="7" class="text-right no-border">TOTAL AMOUNT : </td><td class="text-right no-border"><label><?php echo format_amount( $invoice_details['invoice_totals']['item_total'] - $invoice_details['invoice_details']->invoice_discount) ?></label></td></tr>
	<!--tr><td colspan="5" class="text-right no-border">AMOUNT PAID : </td><td class="text-right no-border invoice_amount_paid"><label><?php echo format_amount($invoice_details['invoice_totals']['amount_paid']);?></label></td></tr-->
	<!--tr><td colspan="5" class="text-right no-border">AMOUNT DUE : </td><td class="text-right invoice_amount_due"><label><?php echo format_amount($invoice_details['invoice_totals']['amount_due']);?></label></td-->
	</tr>
	
	
	<tr class="table_header"><td colspan="8"></td></tr>
	</table>
	<h4>Invoice Terms </h4>
	<i><?php echo $invoice_details['invoice_details']->invoice_terms; ?></i>
	<br/><br/>
	
	
	
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
			<label class="control-label">Client : <?php echo $invoice_details['invoice_details']->client_name; ?></label>
			<br/><br/><br/>
			................................................<br/>
			<i>Signature &amp; Stamp</i>		
		</td>
	</tr>
	</table>
	
	
</div>
</div>

