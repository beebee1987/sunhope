<div class="row">
	<div class="span6">
		<h3><?php echo lang('monthly_trx');?></h3>
	</div>
	<div class="span6">
		<form class="form-inline pull-right">
			<input class="form-control"  type="text" name="start" id="datepicker1" placeholder="<?php echo lang('from');?>"/>			
			<input class="form-control"  type="text" name="end" id="datepicker2" placeholder="<?php echo lang('to');?>"/>			
			
			<input class="btn btn-primary" type="button" value="<?php echo lang('get_monthly_trx');?>" onclick="get_monthly_trx()"/>
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
	$.post('<?php echo site_url($this->config->item('admin_folder').'/reports/monthly_trx');?>',{start:$('#datepicker1').val(), end:$('#datepicker2').val()}, function(data){
		$('#monthly_trx').html(data);
		setTimeout('hide_animation()', 500);
	});
}

function get_monthly_sales()
{
	show_animation();
	$.post('<?php echo site_url($this->config->item('admin_folder').'/reports/sales');?>',{year:$('#sales_year').val()}, function(data){
		$('#sales_container').html(data);
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