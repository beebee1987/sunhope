<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete_client');?>');
}
</script>

<div style="text-align:right;">
	<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/clients/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_client');?></a>
</div>

<div class="row">
		<div class="col-sm-12">
			<div class="ibox">
 				<div class="ibox-content">
<table class="table table-striped table-hover">
	<thead>
		<tr>
		  <th width="20%"><?php echo lang('logo');?></th>
		  <th><?php echo lang('company');?></th>
		  <th><?php echo lang('email');?></th>
		  <th><?php echo lang('phone');?></th>
		  <th></th>
		</tr>
	</thead>
	<tbody>
	<?php echo (count($clients) < 1)?'<tr><td style="text-align:center;" colspan="4">'.lang('no_clients').'</td></tr>':''?>
<?php foreach ($clients as $client):?>
		<tr>
			<td><img src="<?php echo base_url($client->logo);?>" width="50%" alt="current"/></td>
			<td><?php echo  $client->company; ?></td>
			<td><?php echo  $client->email; ?></td>
			<td><?php echo  $client->phone; ?></td>
			<td>
				<div class="btn-group" style="float:right;">
					<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/clients/form/'.$client->id); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
					<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/clients/delete/'.$client->id); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
				</div>
			</td>
	  </tr>
<?php endforeach; ?>
	</tbody>
</table>
</div></div></div></div>