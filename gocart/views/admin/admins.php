<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete');?>');
}
</script>

<div style="text-align:right;">
	<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/admin/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_admin');?></a>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="ibox">
 			<div class="ibox-content">
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th><?php echo lang('firstname');?></th>
			<th><?php echo lang('lastname');?></th>
			<th><?php echo lang('email');?></th>
			<th><?php echo lang('username');?></th>
			<th><?php echo lang('access');?></th>
			<th><?php echo lang('branch');?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($admins as $admin):?>
		<tr>
			<td><?php echo $admin->firstname; ?></td>
			<td><?php echo $admin->lastname; ?></td>
			<td><a href="mailto:<?php echo $admin->email;?>"><?php echo $admin->email; ?></a></td>
			<td><?php echo $admin->username; ?></td>
			<td><?php echo $admin->access; ?></td>
			<th><?php echo (!empty($admin->branch_name) && isset($admin->branch_name)) ? $admin->branch_name : lang('no_branch') ; ?></th>
			<td>
				<div class="btn-group" style="float:right;">
					<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/admin/form/'.$admin->id);?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>	
					<?php
					$current_admin	= $this->session->userdata('admin');
					$margin			= 30;
					if ($current_admin['id'] != $admin->id): ?>
					<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/admin/delete/'.$admin->id); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
					<?php endif; ?>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
</div></div></div></div>