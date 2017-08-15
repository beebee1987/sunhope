

<div class="btn-group pull-right">
	<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/slider/form'); ?>"><i class="fa fa-plus-sign"></i> <?php echo lang('add_new_slider');?></a>	
</div>

<div class="row">
		<div class="col-sm-12">
			<div class="ibox">
 				<div class="ibox-content">
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th><?php echo lang('title');?></th>
			<th><?php echo lang('status');?></th>
			<th></th>
		</tr>
	</thead>
	
	
	<?php echo (count($sliders) < 1)?'<tr><td style="text-align:center;" colspan="3">'.lang('no_slider_or_links').'</td></tr>':''?>
	<?php if($sliders):?>
	<tbody>		
		<?php
		$GLOBALS['admin_folder'] = $this->config->item('admin_folder');		
		foreach($sliders as $slider){			
		?>
		<tr class="gc_row">
			<td>
				<?php echo $slider['title']; ?>
			</td>
			<td>
				<?php echo $slider['status']; ?>
			</td>
			<td>
				<div class="btn-group pull-right">
					<?php if(!empty($slider['url'])): ?>
						<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($GLOBALS['admin_folder'].'/slider/link_form/'.$slider['id']); ?>"><i class="fa fa-pencil"></i> <?php echo lang('edit');?></a>
						<a class="btn btn-white btn-bitbucket" href="<?php echo $slider['url'];?>" target="_blank"><i class="fa fa-play-circle"></i> <?php echo lang('follow_link');?></a>
					<?php else: ?>						
						<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($GLOBALS['admin_folder'].'/slider/form/'.$slider['id']); ?>"><i class="fa fa-pencil"></i> <?php echo lang('edit');?></a>						
					<?php endif; ?>
					<a class="btn btn-danger" href="<?php echo site_url($GLOBALS['admin_folder'].'/slider/delete/'.$slider['id']); ?>" onclick="return areyousure();"><i class="fa fa-trash icon-white"></i> <?php echo lang('delete');?></a>
				</div>
			</td>
		</tr>
		<?php		
		}
		?>
	</tbody>
	<?php endif;?>
</table>
</div></div></div></div>


<script>
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete_slider');?>');
}
</script>
