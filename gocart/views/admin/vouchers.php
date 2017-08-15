<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete_voucher');?>');
}
</script>

<div style="text-align:right;">
	<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/vouchers/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_voucher');?></a>
</div>

<div class="row">
		<div class="col-sm-12">
			<div class="ibox">
 				<div class="ibox-content">
<table class="table table-striped table-hover">
	<thead>
		<tr>
		  <th><?php echo lang('code');?></th>
		  <th><?php echo lang('name');?></th>
		  <th><?php echo lang('point_consume');?></th>
		  <th><?php echo lang('credit_consume');?></th>		  
		  <th><?php echo lang('branch');?></th>
		  
		  <!--th><?php echo lang('usage');?></th-->
		  <th></th>
		</tr>
	</thead>
	<tbody>
	<?php echo (count($vouchers) < 1)?'<tr><td style="text-align:center;" colspan="4">'.lang('no_vouchers').'</td></tr>':''?>
<?php foreach ($vouchers as $voucher):?>
		<tr>
			<td><?php echo  $voucher->code; ?></td>
			<td><?php echo  $voucher->name; ?></td>
			<td><?php echo  $voucher->point_consume; ?></td>
			<td><?php echo  $voucher->credit_consume; ?></td>
			<td><?php echo  $voucher->branch_name; ?></td>
			<!--td>
			  <?php echo  $voucher->num_uses ." / ". $voucher->max_uses; ?>
			</td-->
			<td>
				<div class="btn-group" style="float:right;">
					<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/vouchers/form/'.$voucher->id); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
					<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/vouchers/delete/'.$voucher->id); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
				</div>
			</td>
	  </tr>
<?php endforeach; ?>
	</tbody>
</table>
</div></div></div></div>