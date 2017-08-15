<?php
	//set "code" for searches
	if(!$code)
	{
		$code = '';
	}
	else
	{
		$code = '/'.$code;
	}
	function sort_url($lang, $by, $sort, $sorder, $code, $admin_folder)
	{
		if ($sort == $by)
		{
			if ($sorder == 'asc')
			{
				$sort	= 'desc';
				$icon	= ' <i class="fa fa-chevron-up"></i>';
			}
			else
			{
				$sort	= 'asc';
				$icon	= ' <i class="fa fa-chevron-down"></i>';
			}
		}
		else
		{
			$sort	= 'asc';
			$icon	= '';
		}
			

		$return = site_url($admin_folder.'/point/branch_point/'.$by.'/'.$sort.'/'.$code);
		
		echo '<a href="'.$return.'">'.lang($lang).$icon.'</a>';

	}
	$admin_url = site_url($this->config->item('admin_folder')).'/';
if ($term):?>

<div class="alert alert-info">
	<?php echo sprintf(lang('search_returned'), intval($total));?>
</div>
<?php endif;?>

<style type="text/css">
	.pagination {
		margin:0px;
		margin-top:-3px;
	}
</style>
<div class="row">
	<div class="col-sm-12" style="border-bottom:1px solid #f5f5f5;">
		<div class="row">
			<div class="col-sm-4">
				<?php echo $this->pagination->create_links();?>&nbsp;
			</div>
			<div class="col-sm-8">
				<?php echo form_open($this->config->item('admin_folder').'/point/branch_point', 'class="form-inline" style="float:right"');?>
					 <div class="form-group">						
						<input id="start_top" name="start_top" value="" class="form-control" type="text" placeholder="Start Date"/>						
						<!--input id="start_top_alt" type="hidden" name="start_date" /-->
						<input id="end_top" value="" name="end_top" class="form-control" type="text"  placeholder="End Date"/>
						<!--input id="end_top_alt" type="hidden" name="end_date" /-->
				
						<!--input id="top" type="text" class="span2" name="term" placeholder="<?php echo lang('term')?>" /--> 

						<button class="btn btn-primary" name="submit" value="search"><?php echo lang('search')?></button>
						<button class="btn btn-success" name="submit" value="export"><?php echo lang('xml_export')?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php echo form_open($this->config->item('admin_folder').'/point/bulk_delete', array('id'=>'delete_form', 'onsubmit'=>'return submit_form();', 'class="form-inline"')); ?>


<div class="row">
	<div class="col-sm-12">
		<div class="ibox">
 			<div class="ibox-content">
<table class="table table-striped table-hover">
    <thead>
		<tr>
			<!--th><input type="checkbox" id="gc_check_all" /> <button type="submit" class="btn btn-small btn-danger"><i class="fa fa-trash icon-white"></i></button></th-->
			<th><?php echo sort_url('created', 'created', $sort_by, $sort_order, $code, $this->config->item('admin_folder')); ?></th>
			<th><?php echo sort_url('branch_name', 'branch_name', $sort_by, $sort_order, $code, $this->config->item('admin_folder')); ?></th>
			<th><?php echo sort_url('cost', 'cost', $sort_by, $sort_order, $code, $this->config->item('admin_folder')); ?></th>
			<th><?php echo sort_url('point', 'point', $sort_by, $sort_order, $code, $this->config->item('admin_folder')); ?></th>
			<th><?php echo sort_url('depoint','depoint', $sort_by, $sort_order, $code, $this->config->item('admin_folder')); ?></th>
			<!--th></th-->
	    </tr>
	</thead>

    <tbody>
	<?php echo (count($points) < 1)?'<tr><td style="text-align:center;" colspan="8">'.lang('no_points') .'</td></tr>':''?>
    <?php foreach($points as $point): 
		    $info_url = '';
		    if($point->point > 0):
		    	//future
		    	//$info_url = $admin_url.'point/topup_point_info/'.$point->id;		    
		    $info_url = $admin_url.'point/branch_point_info/'.$point->id;
		    elseif($point->depoint > 0):
		    	$info_url = "#";
		    endif;
    ?>
	<tr onclick="document.location = '<?php echo $info_url?>';">
		<!--td><input name="point[]" type="checkbox" value="<?php echo $point->id; ?>" class="gc_check"/></td-->
		<td style="white-space:nowrap"><?php echo date('d-m-y h:i a', strtotime($point->created)); ?></td>
		<td style="white-space:nowrap"><?php echo $point->branch_name ?></td>
		<td style="white-space:nowrap"><?php echo $point->cost ?></td>
		<td style="white-space:nowrap"><?php echo $point->point ?></td>
		<td style="white-space:nowrap"><?php echo $point->depoint ?></td>		
	</tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div></div></div></div>
</form>


<div id="saving_container" style="display:none;">
	<div id="saving" style="background-color:#000; position:fixed; width:100%; height:100%; top:0px; left:0px;z-index:100000"></div>
	<img id="saving_animation" src="<?php echo base_url('assets/img/storing_animation.gif');?>" alt="saving" style="z-index:100001; margin-left:-32px; margin-top:-32px; position:fixed; left:50%; top:50%"/>
	<div id="saving_text" style="text-align:center; width:100%; position:fixed; left:0px; top:50%; margin-top:40px; color:#fff; z-index:100001"><?php echo lang('saving');?></div>
</div>