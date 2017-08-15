<?php 
	$current_admin	= $this->session->userdata('admin');
?>
<?php						
	if ($current_admin['branch'] == 0): 
?>
<div style="text-align:right;">
	<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/branch/branch_form/');?>"><i class="fa fa-plus-sign"></i> <?php echo lang('add_new_branch');?></a>
</div>
<?php 
	endif;
?>

<div class="row">
		<div class="col-sm-12">
			<div class="ibox">
 				<div class="ibox-content">
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th><?php echo lang('branch_name');?></th>
			<th><?php echo lang('active');?></th>
			
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php echo (count($branches) < 1)?'<tr><td style="text-align:center;" colspan="6">'.lang('no_branch').'</td></tr>':''?>
<?php foreach ($branches as $branch):
		
?>
		<tr>
			<td>
				<?php echo $branch['name']; ?>
			</td>			
			
			<td>
				<?php echo $branch['active'];?>				
			</td>
			
			<td>
				<div class="btn-group" style="float:right">
				
					<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/branch/branch_form/'.$branch['id'].'/'.$branch['id']);?>"><i class="fa fa-pencil"></i> <?php echo lang('edit');?></a>
					<?php						
						if ($current_admin['branch'] == 0): 
					?>
					<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/branch/delete_branch/'.$branch['id'].'/'.$branch['id']);?>" onclick="return areyousure();"><i class="fa fa-trash icon-white"></i> <?php echo lang('delete');?></a>
					<?php endif; ?>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
</div></div></div></div>

<script>
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete_branch');?>');
}
</script>

