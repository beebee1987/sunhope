
<?php
$name			= array('name'=>'name', 'value' => set_value('name', $name), 'class'=>'form-control');
?>


<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?php echo lang('customer_details')?></h5>
                            
                        </div>
                        <div class="ibox-content">
                        
<?php echo form_open_multipart(config_item('admin_folder').'/banners/banner_collection_form/'.$banner_collection_id, 'class="form-horizontal"'); ?>
				
	<div class="form-group"><label class="col-sm-2 control-label" for="title"><?php echo lang('name');?></label>
	<?php	
	echo '<div class="col-sm-10">'.form_input($name).'</div>'; ?>
    </div>
    <div class="hr-line-dashed"></div>

	<div class="form-actions">
		<input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>"/>
	</div>
</form>
</div></div></div></div>