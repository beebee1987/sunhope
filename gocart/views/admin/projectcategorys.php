<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete_category');?>');
}
</script>

<div style="text-align:right;">
	<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/projectcategorys/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_category');?></a>
</div>

<div class="row">
		<div class="col-sm-12">
			<div class="ibox">
 				<div class="ibox-content">
<table class="table table-striped table-hover">
	<thead>
		<tr>
		  <th><?php echo lang('name');?></th>
		  <th><?php echo lang('description');?></th>
		  <th></th>
		</tr>
	</thead>
	<tbody>
	<?php echo (count($projectscategorys) < 1)?'<tr><td style="text-align:center;" colspan="4">'.lang('no_project_category').'</td></tr>':''?>
<?php foreach ($projectscategorys as $projectcategory):?>
		<tr>
			<td><?php echo  $projectcategory->name; ?></td>
			<td><?php echo  $projectcategory->desc; ?></td>
			<td>
				<div class="btn-group" style="float:right;">
					<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/projectcategorys/form/'.$projectcategory->id); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
					<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/projectcategorys/delete/'.$projectcategory->id); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
				</div>
			</td>
	  </tr>
<?php endforeach; ?>
	</tbody>
</table>
</div></div></div></div>