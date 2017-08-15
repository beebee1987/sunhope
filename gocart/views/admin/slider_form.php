<?php 
	$f_image		= array('name'=>'image', 'id'=>'image');
?>

<?php echo form_open_multipart($this->config->item('admin_folder').'/slider/form/'.$id, 'class="form-horizontal"'); ?>
<div class="ibox-content">
<div class="row">
	<div class="col-lg-12">
		<div class="panel blank-panel">

			<div class="panel-heading">
				<div class="panel-title m-b-md">
					<h4><?php echo lang('news_form')?></h4>
				</div>
				<div class="panel-options">

					<ul class="nav nav-tabs">
						<li class="active"><a href="#content_tab" data-toggle="tab"><?php echo lang('content');?></a></li>
						<li><a href="#attributes_tab" data-toggle="tab"><?php echo lang('attributes');?></a></li>
						<li><a href="#seo_tab" data-toggle="tab"><?php echo lang('seo');?></a></li>
						<li><a href="#image_tab" data-toggle="tab"><?php echo lang('image');?></a></li>
						
					</ul>
				</div>
			</div>

			<div class="panel-body">

				<div class="tab-content">
				
				<div class="tab-pane active" id="content_tab">
			
			
					<div class="form-group"><label for="title" class="col-sm-2 control-label"><?php echo lang('title');?></label>
						<?php
						$data	= array('name'=>'title', 'value'=>set_value('title', $title), 'class'=>'form-control');
						echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
					</div>
					
				</div>
				<div class="tab-pane" id="attributes_tab">
						
					<div class="form-group"><label for="sequence" class="col-sm-2 control-label"><?php echo lang('sequence');?></label>	
						<?php
						$data	= array('name'=>'sequence', 'value'=>set_value('sequence', $sequence), 'class'=>'form-control');
						echo '<div class="col-sm-10">'.form_input($data).'</div>';
						?>
					</div>
					
					<div class="form-group">
					<label for="status" class="col-sm-2 control-label"><?php echo lang('status');?> </label>
						<?php
					 	$options = array(	 'Enable'		=> lang('enable')
											,'Disable'		=> lang('disable')
											);
						echo '<div class="col-sm-10">'.form_dropdown('status', $options, set_value('status',$status),'class="form-control m-b"').'</div>';
						?>
					</div>
				</div>
				
				<div class="tab-pane" id="seo_tab">
					<div class="form-group">
						<label for="code" class="col-sm-2 control-label"><?php echo lang('seo_title');?></label>
						<?php
						$data	= array('name'=>'seo_title', 'value'=>set_value('seo_title', $seo_title), 'class'=>'form-control');
						echo '<div class="col-sm-10">'.form_input($data).'</div>';
						?>
						<!--p class="help-block"><?php echo lang('meta_data_description');?></p-->
					</div>
					
					<div class="form-group">
					<label for="meta" class="col-sm-2 control-label"><?php echo lang('meta');?></label>
						<?php
						$data	= array('rows'=>'3', 'name'=>'meta', 'value'=>set_value('meta', html_entity_decode($meta)), 'class'=>'form-control');
						echo '<div class="col-sm-10">'.form_textarea($data).'</div>';
						?>
					</div>
				</div>
				
				<div class="tab-pane" id="image_tab">
					<div class="form-group">
					<label class="col-sm-4 control-label"><?php echo lang('best_photo_size')?>: <b><?php echo lang('width')?>: 720px, <?php echo lang('height')?>: 340px </b></label>
					</div>
					
					<div class="form-group">
					<?php echo '<div class="col-sm-10">'.form_upload($f_image).'</div>'; ?>
					</div>
					
					
					<?php if($id && $image != ''):?>
						<div style="text-align:center; padding:5px; border:1px solid #ccc;"><img src="<?php echo base_url($image);?>" width="100%" alt="current"/><br/><?php echo lang('current_file');?></div>
					<?php endif;?>			
					
				</div>
				
									
				</div>
				
				<div class="form-actions">
					<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
				</div>	

			</div>

		</div>
	</div>

</div>
</div>
</form>