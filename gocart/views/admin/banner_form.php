<?php
$name			= array('name'=>'name', 'value' => set_value('name', $name), 'class'=>'form-control');
$enable_date	= array('name'=>'enable_date', 'id'=>'enable_date', 'class'=>'form-control', 'value'=>set_value('enable_on', set_value('enable_date', $enable_date)));
$disable_date	= array('name'=>'disable_date', 'id'=>'disable_date', 'class'=>'form-control','value'=>set_value('disable_on', set_value('disable_date', $disable_date)));
$f_image		= array('name'=>'image', 'id'=>'image', 'class'=>'form-control');
$link			= array('name'=>'link', 'value' => set_value('link', $link), 'class'=>'form-control',);	
$new_window		= array('name'=>'new_window', 'value'=>1, 'checked'=>set_checkbox('new_window', 1, $new_window));
?>
<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?php echo lang('banner_form')?></h5>                            
                        </div>
                        <div class="ibox-content">
                        
<?php echo form_open_multipart(config_item('admin_folder').'/banners/banner_form/'.$banner_collection_id.'/'.$banner_id, 'class="form-horizontal"'); ?>
	
	<div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('name');?></label>
		<?php
		echo '<div class="col-sm-10">'.form_input($name).'</div>'; ?>
	</div>
	<div class="hr-line-dashed"></div>
			
			
	<div class="form-group">
		<label for="link" class="col-sm-2 control-label"><?php echo lang('link');?></label>
		<?php echo '<div class="col-sm-10">'.form_input($link).'</div>'; ?>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div>
	<div class="form-group" id="enable_date">
		<label class="col-sm-2 control-label" for="enable_date"><?php echo lang('enable_date');?></label>
		<?php echo '<div class="col-sm-4 input-group date"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>'.form_input($enable_date).'</div>'; ?>
	</div>
	
	<div class="form-group" id="disable_date">
		<label class="col-sm-2 control-label" for="disable_date"><?php echo lang('disable_date');?> </label>
		<?php echo '<div class="col-sm-4 input-group date"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>'.form_input($disable_date).'</div>'; ?>
	</div>
	
	
	<div class="hr-line-dashed"></div>

	<div class="form-group">
		<label class="col-sm-2 control-label checkbox">&nbsp;</label>
		<div class="col-sm-10">
			<div class="checkbox">
				<label class="checkbox"> 
			<?php echo form_checkbox($new_window).' '.lang('new_window'); ?>
				</label>
			</div>
		</div>
	</div>

	<div class="hr-line-dashed"></div>

	<div class="form-group" id="image">
		<label class="col-sm-2 control-label image" for="image"><?php echo lang('image');?> </label>
		<?php echo '<div class="col-sm-10">'.form_upload($f_image).'</div>'; ?>
	</div>
	
	<div class="hr-line-dashed"></div>
	
	<?php if($banner_id && $image != ''):?>
	<div style="text-align:center; padding:5px; border:1px solid #ccc;" class="col-sm-12"><img src="<?php echo base_url('uploads/'.$image);?>" width="100%" alt="current"/><br/><label for="link" class="control-label"><?php echo lang('current_file');?></label></div>
	<?php endif;?>

	<div class="col-sm-12">
		&nbsp;
	</div>
	
	<div class="form-group form-actions">
		<div class="col-sm-4 col-sm-offset-2">
			<!--button class="btn btn-white" type="submit">Cancel</button-->
			<input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>">
		</div>
	</div>

</form>
</div></div></div></div>
<script type="text/javascript">		
	$('form').submit(function() {
		$('.btn').attr('disabled', true).addClass('disabled');
	});
</script>
