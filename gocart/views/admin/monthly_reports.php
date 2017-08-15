<div class="row">
	<div class="col-sm-5">
		<h3><?php echo lang('daily_trx');?></h3>
	</div>
	<div class="col-sm-7">
		
		<form class="form-inline pull-right"'>
			
			<select name="year" id="year" class="form-control m-b">
				<option value="2015">2015</option>
				<option value="2015">2016</option>
				<option value="2015">2017</option>
				<option value="2015">2018</option>
				<option value="2015">2019</option>
			</select>
			
			<select name="month" id="month" class="form-control m-b">
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
					
			<input class="btn btn-primary" type="button" value="<?php echo lang('get_daily_trx');?>" onclick="get_monthly_trx()"/>
		</form>
	</div>
</div>

 <div class="row">
		<div class="col-sm-12">
			<div class="ibox">
 				<div class="ibox-content">
	<div class="span12" id="monthly_trx"></div>
</div></div></div></div>



<script type="text/javascript">

function get_monthly_trx()
{
	show_animation();
	
	$.post('<?php echo site_url($this->config->item('admin_folder').'/reports/monthly_trx');?>',{year:$('#year').val(), month:$('#month').val(), card:$('#card').val()}, function(data){
		$('#monthly_trx').html(data);
		setTimeout('hide_animation()', 500);
	});
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

</script>

<div id="saving_container" style="display:none;">
	<div id="saving" style="background-color:#000; position:fixed; width:100%; height:100%; top:0px; left:0px;z-index:100000"></div>
	<img id="saving_animation" src="<?php echo base_url('assets/img/storing_animation.gif');?>" alt="saving" style="z-index:100001; margin-left:-32px; margin-top:-32px; position:fixed; left:50%; top:50%"/>
	<div id="saving_text" style="text-align:center; width:100%; position:fixed; left:0px; top:50%; margin-top:40px; color:#fff; z-index:100001"><?php echo lang('loading');?></div>
</div>