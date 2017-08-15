
<div style="text-align:right;">
<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/company/company_form/');?>"><i class="fa fa-plus-sign"></i> <?php echo lang('add_new_company');?></a>
</div>

<div class="row">
		<div class="col-sm-12">
			<div class="ibox">
 				<div class="ibox-content">
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th><?php echo lang('company_name');?></th>
			<th><?php echo lang('contact');?></th>
			<th><?php echo lang('address');?></th>			
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php echo (count($companies) < 1)?'<tr><td style="text-align:center;" colspan="6">'.lang('no_company').'</td></tr>':''?>
<?php foreach ($companies as $company):
		
?>
		<tr>
			<td>
				<?php echo $company['company_name']; ?>
			</td>
			
			<td>
				<?php echo  $company['phone']; ?><br/>				
			</td>
			
			<td>
				<?php echo $company['address'];?>				
			</td>
			
			<td>
				<div class="btn-group" style="float:right">
				
					<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/company/company_form/'.$company['id'].'/'.$company['id']);?>"><i class="fa fa-pencil"></i> <?php echo lang('edit');?></a>
					
					<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/company/delete_company/'.$company['id'].'/'.$company['id']);?>" onclick="return areyousure();"><i class="fa fa-trash icon-white"></i> <?php echo lang('delete');?></a>
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
	return confirm('<?php echo lang('confirm_delete_company');?>');
}
</script>