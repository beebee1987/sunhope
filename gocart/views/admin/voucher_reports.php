<div class="row">
<div class="col-sm-12">
		<h3><?php echo lang('voucher_report');?></h3>
</div>
</div>
<div class="row no-print">
	
	<div class="col-sm-12">
		
		<form class="form-inline pull-left"'>
									
			<input class="form-control"  type="text" name="customer_card" id="customer_card" placeholder="<?php echo lang('card');?>"/>			
			
			<div class="form-group">
             	<!--label class="col-sm-2 control-label" for="voucher_name"><?php echo lang('voucher_name');?></label-->
            	<div class="controls">
					<?php echo '<div class="col-sm-10">'.form_dropdown('voucher_id', $vouchers, set_value('voucher_id',$voucher_id), 'id="voucher_id" class="form-control m-b"').'</div>';; ?>
				</div>
			 </div>
			
					
			<input class="btn btn-primary" type="button" value="<?php echo lang('get_daily_trx');?>" onclick="get_voucher_listing()"/>
		</form>
	</div>
</div>

 <div class="row">
		<div class="col-sm-12">
			<div class="ibox">
 				<div class="ibox-content">
	<div class="span12" id="voucher_listing"></div>
</div></div></div></div>



<script type="text/javascript">

function get_voucher_listing()
{
	show_animation();

	
		$.post('<?php echo site_url($this->config->item('admin_folder').'/reports/voucher_listing');?>',{customer_card:$('#customer_card').val(), voucher_id:$('#voucher_id').val()}, function(data){
			$('#voucher_listing').html(data);
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