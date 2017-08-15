<?php $admin_url = site_url($this->config->item('admin_folder')).'/';?>
<div class="row">
	<?php if($this->auth->check_access('Admin')) : ?>
	<div class="col-lg-3">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5><?php echo lang('common_manage_branch')?></h5>
			</div>
			<div class="ibox-content">
				<a href="<?php echo $admin_url?>branch/branch_form" class="btn btn-w-m btn-danger"><?php echo lang('common_add')?></a> <a
					href="<?php echo $admin_url?>branch" class="btn btn-w-m btn-info"><?php echo lang('common_view')?> </a>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="col-lg-3">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5><?php echo lang('common_consumption')?></h5>
			</div>
			<div class="ibox-content">
				<a href="<?php echo $admin_url?>credit/consume_form" class="btn btn-w-m btn-danger"><?php echo lang('common_add')?></a>
			</div>
		</div>
	</div>

	<div class="col-lg-3">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5><?php echo lang('common_manage_customer')?></h5>
			</div>
			<div class="ibox-content">
				<a href="<?php echo $admin_url?>customers" class="btn btn-w-m btn-info"><?php echo lang('common_view')?></a>
			</div>
		</div>
	</div>

	<div class="col-lg-3">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5><?php echo lang('common_check_point')?></h5>
			</div>
			<div class="ibox-content">
				<a href="<?php echo $admin_url?>point" class="btn btn-w-m btn-info"><?php echo lang('common_search')?></a>
			</div>
		</div>
	</div>

</div>

<div class="row">
	<div class="col-lg-3">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5><?php echo lang('common_manage_voucher')?></h5>
			</div>
			<div class="ibox-content">
				<a href="<?php echo $admin_url;?>vouchers/form" class="btn btn-w-m btn-danger"><?php echo lang('common_add')?></a>
				<a href="<?php echo $admin_url;?>vouchers" class="btn btn-w-m btn-info"><?php echo lang('common_view')?> </a>
			</div>
		</div>
	</div>

	<div class="col-lg-3">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5><?php echo lang('common_manage_coupon')?></h5>
			</div>
			<div class="ibox-content">
				<a href="<?php echo $admin_url;?>coupons/form" class="btn btn-w-m btn-danger"><?php echo lang('common_add')?></a>
				<a href="<?php echo $admin_url;?>coupons" class="btn btn-w-m btn-info"><?php echo lang('common_view')?> </a>
			</div>
		</div>
	</div>

	<div class="col-lg-3">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5><?php echo lang('common_topup_credit')?></h5>
			</div>
			<div class="ibox-content">
				<a href="<?php echo $admin_url?>credit/topup_credit_form" class="btn btn-w-m btn-danger"><?php echo lang('common_add')?></a>
			</div>
		</div>
	</div>
	<?php if($this->auth->check_access('Admin')) : ?>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><?php echo lang('common_reports')?></h5>
				</div>
				<div class="ibox-content">
					<a href="<?php echo $admin_url?>reports/monthly_reports" class="btn btn-w-m btn-info"><?php echo lang('common_view')?></a>
				</div>
			</div>
		</div>
	<?php endif;?>
</div>



<div class="row white-bg">
	<div class="ibox-title">
		<h5>
			<?php echo lang('recent_customers') ?>
		</h5>

	</div>

	<div class="full-height-scroll">
		<div class="table-responsive">
			<table class="table table-striped table-hover">

				<tbody>

					<?php foreach ($customers as $customer):?>
					<tr>
						<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
						<td><a data-toggle="tab" href="#contact-1" class="client-link"><?php echo  $customer->name; ?>
						</a></td>

						<td class="contact-type"><i class="fa fa-envelope"> </i></td>
						<td><a href="mailto:<?php echo  $customer->email;?>"><?php echo  $customer->email; ?>
						</a></td>

						<td><?php if($customer->active == 1)
						{
							echo '<td class="client-status"><span class="label label-primary">'.lang('yes').'</span></td>';
						}
						else
						{
							echo '<td class="client-status"><span class="label label-danger">'.lang('no').'</span></td>';
						}
						?>
						</td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12" style="text-align:center;">
		<a class="btn btn-danger btn-large" href="<?php echo site_url(config_item('admin_folder').'/customers');?>"><?php echo lang('view_all_customers');?></a>
	</div>
</div>














