<div class="row">
<div class="col-sm-12">
		<h3><?php echo lang('print_statement');?></h3>
</div>
</div>
<div class="row no-print">
	
	<div class="col-sm-12">
		
		<form class="form-inline pull-left"'>
			
			From Year
			<select name="from_year" id="from_year" class="form-control m-b">
				<option value="2015">2015</option>
				<option value="2015">2016</option>
				<option value="2015">2017</option>
				<option value="2015">2018</option>
				<option value="2015">2019</option>
			</select>
			
			From Month
			<select name="from_month" id="from_month" class="form-control m-b">
				<option value="1"><?php echo lang('january') ?></option>
				<option value="2"><?php echo lang('february')?></option>
				<option value="3"><?php echo lang('march')?></option>
				<option value="4">April</option>
				<option value="5">May</option>
				<option value="6">June</option>
				<option value="7">July</option>
				<option value="8">August</option>
				<option value="9">September</option>
				<option value="10">October</option>
				<option value="11">November</option>
				<option value="12">December</option>
				
			</select>
			
			To Year
			<select name="to_year" id="to_year" class="form-control m-b">
				<option value="2015">2015</option>
				<option value="2015">2016</option>
				<option value="2015">2017</option>
				<option value="2015">2018</option>
				<option value="2015">2019</option>
			</select>
			
			From Month
			<select name="to_month" id="to_month" class="form-control m-b">
				<option value="1"><?php echo lang('january') ?></option>
				<option value="2"><?php echo lang('february')?></option>
				<option value="3"><?php echo lang('march')?></option>
				<option value="4">April</option>
				<option value="5">May</option>
				<option value="6">June</option>
				<option value="7">July</option>
				<option value="8">August</option>
				<option value="9">September</option>
				<option value="10">October</option>
				<option value="11">November</option>
				<option value="12">December</option>
				
			</select>
			
			<input class="form-control"  type="text" name="card" id="card" placeholder="<?php echo lang('card');?>"/>			
					
			<input class="btn btn-primary" type="button" value="<?php echo lang('get_daily_trx');?>" onclick="get_print_statement()"/>
		</form>
	</div>
</div>

 <div class="row">
		<div class="col-sm-12">
			<div class="ibox">
 				<div class="ibox-content">
	<div class="span12" id="print_statement"></div>
</div></div></div></div>



<script type="text/javascript">

function get_print_statement()
{
	show_animation();

	var from = new Date($('#from_year').val(), $('#from_month').val()-1, '01');  // -1 because months are from 0 to 11
	var to   = new Date($('#to_year').val(), $('#to_month').val()-1, '31');	


	if($('#card').val() == '')
	{
		alert('Please insert card number');
		setTimeout('hide_animation()', 500);
		return;
	}
	
	
	if(to >= from)
	{
		$.post('<?php echo site_url($this->config->item('admin_folder').'/reports/print_statement');?>',{from_year:$('#from_year').val(), from_month:$('#from_month').val(), to_year:$('#to_year').val(), to_month:$('#to_month').val(), card:$('#card').val()}, function(data){
			$('#print_statement').html(data);
			setTimeout('hide_animation()', 500);
		});
	}else
	{
		alert('Date filtering is invalid , please check.');
		setTimeout('hide_animation()', 500);
	}
}

function show_animation()
{
	$('#saving_container').css('display', 'block');
	$('#saving').css('opacity', '.8');
}

function hide_animation()
{
	$('#saving_container').fadeOut();
}

function print_content()
{
	window.print();	
}
</script>

<div id="saving_container" style="display:none;">
	<div id="saving" style="background-color:#000; position:fixed; width:100%; height:100%; top:0px; left:0px;z-index:100000"></div>
	<img id="saving_animation" src="<?php echo base_url('assets/img/storing_animation.gif');?>" alt="saving" style="z-index:100001; margin-left:-32px; margin-top:-32px; position:fixed; left:50%; top:50%"/>
	<div id="saving_text" style="text-align:center; width:100%; position:fixed; left:0px; top:50%; margin-top:40px; color:#fff; z-index:100001"><?php echo lang('loading');?></div>
</div>