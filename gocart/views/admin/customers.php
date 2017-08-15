<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete_customer');?>');
}
</script>



<div style="text-align:right;">

	<div class="row pull-right"> 
		<?php if($this->auth->check_access('Admin')) : ?>
			<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/customers/export_xml');?>"><i class="fa fa-download"></i> <?php echo lang('xml_download');?></a>
			<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/customers/get_subscriber_list');?>"><i class="fa fa-download"></i> <?php echo lang('subscriber_download');?></a>
		<?php endif; ?>
		<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/customers/form'); ?>"><i class="fa fa-plus-circle"></i> <?php echo lang('add_new_customer');?></a>
	</div>
	
	<div style="clear: both; padding:5px 0px;"></div>
		
	<div class="row">		 
		 <?php echo form_open($this->config->item('admin_folder').'/customers/', 'class="form-horizontal"'); ?>		 
				<!--input class="form-control"  type="text" name="name" id="name" placeholder="<?php echo lang('name');?>"/-->			
				<div class="col-sm-2 pull-right">
					<input class="btn btn-primary" type="submit" value="<?php echo lang('search');?>"/>
					<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/customers/index');?>">Reset</a>
				</div>
				<div class="col-sm-6 pull-right">
					<input class="form-control"  type="text" name="term" id="term" placeholder="<?php echo lang('search');?>"/>			
				</div>
				
				
		 </form>	
	</div>
</div>

    <div class="row">
		<div class="col-sm-12">
			<div class="ibox">
 				<div class="ibox-content">

<table>
<?php
	$page_links	= $this->pagination->create_links();
	
	if($page_links != ''):?>
	<tr><td colspan="5" style="text-align:center"><?php echo $page_links;?></td></tr>
	<?php endif;?> 				
</table>
 				
<table class="table table-striped table-hover">
	<thead>
		<tr>
			
			<?php
			if($by=='ASC')
			{
				$by='DESC';
			}
			else
			{
				$by='ASC';
			}
			?>
			
			<th><a href="<?php echo site_url($this->config->item('admin_folder').'/customers/index/name/');?>/<?php echo ($field == 'name')?$by:'';?>"><?php echo lang('name');?>
				<?php if($field == 'name'){ echo ($by == 'ASC')?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>';} ?> </a></th>						
			
			<th><a href="<?php echo site_url($this->config->item('admin_folder').'/customers/index/card/');?>/<?php echo ($field == 'card')?$by:'';?>"><?php echo lang('card');?>
				<?php if($field == 'card'){ echo ($by == 'ASC')?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>';} ?> </a></th>
			
			<th><a href="<?php echo site_url($this->config->item('admin_folder').'/customers/index/phone/');?>/<?php echo ($field == 'phone')?$by:'';?>"><?php echo lang('phone');?>
				<?php if($field == 'phone'){ echo ($by == 'ASC')?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>';} ?></a></th>
			
			<th><a href="<?php echo site_url($this->config->item('admin_folder').'/customers/index/email/');?>/<?php echo ($field == 'email')?$by:'';?>"><?php echo lang('email');?>
				<?php if($field == 'email'){ echo ($by == 'ASC')?'<i class="fa fa-sort-asc"></i>':'<i class="fa fa-sort-desc"></i>';} ?></a></th>
			<th><?php echo lang('active');?></th>
			<th></th>
		</tr>
	</thead>
	
	<tbody>

		<?php echo (count($customers) < 1)?'<tr><td style="text-align:center;" colspan="5">'.lang('no_customers').'</td></tr>':''?>
<?php foreach ($customers as $customer):?>
		<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td><?php echo  $customer->name; ?></td>
			<td><?php echo  $customer->card; ?></td>	
			<td><a href="tel:<?php echo  $customer->phone;?>"><?php echo  $customer->phone; ?></a></td>
			<td><a href="mailto:<?php echo  $customer->email;?>"><?php echo  $customer->email; ?></a></td>
			<td>
				<?php if($customer->active == 1)
				{
					echo 'Yes';
				}
				else
				{
					echo 'No';
				}
				?>
			</td>
			<td>
				<div class="btn-group" style="float:right">
					<a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/customers/form/'.$customer->id); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
					
					<!--a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder').'/customers/addresses/'.$customer->id); ?>"><i class="icon-envelope"></i> <?php echo lang('addresses');?></a-->
					
					<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/customers/delete/'.$customer->id); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
				</div>
			</td>
		</tr>
<?php endforeach;?>
		
	</tbody>
</table>
<table>
		<?php if($page_links != ''):?>
		<tr><td colspan="5" style="text-align:center"><?php echo $page_links;?></td></tr>
		<?php endif;?>
</table>
		</div>
			</div>
		</div>
	</div>
