<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete_message');?>');
}
</script>

<!-- <div style="text-align:right;">
	<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/messages/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_message');?></a>
</div> -->

<div class="row">
		<div class="col-sm-12">
			<div class="ibox">
 				<div class="ibox-content">
<table class="table table-striped table-hover">
	<thead>
		<tr>
		  <th><?php echo lang('name');?></th>
		  <th><?php echo lang('email');?></th>
		  <th><?php echo lang('message');?></th>
		  <th><?php echo lang('created_date');?></th>
		  <th></th>
		</tr>
	</thead>
	<tbody>
	<?php echo (count($messages) < 1)?'<tr><td style="text-align:center;" colspan="4">'.lang('no_messages').'</td></tr>':''?>
<?php foreach ($messages as $message):?>
		<tr>
			<td><?php echo  $message['name']; ?></td>
			<td><?php echo  $message['email']; ?></td>
			<td><?php echo  $message['message']; ?></td>
			<td><?php echo  $message['created_date']; ?></td>
			<td>
				<div class="btn-group" style="float:right;">
					<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/messages/form/'.$message['id']); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
					<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/messages/delete/'.$message['id']); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
				</div>
			</td>
	  </tr>
<?php endforeach; ?>
	</tbody>
</table>
</div></div></div></div>