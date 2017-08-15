
<?php 
	$f_image		= array('name'=>'image', 'id'=>'image');
?>


<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                    
                    	<!--div class="alert alert-info" style="text-align:center;">
							<strong><?php echo sprintf(lang('times_used'), @$num_uses);?></strong>
						</div-->
                    
                        <div class="ibox-title">
                            <h5><?php echo lang('coupon_form')?></h5>                            
                        </div>
                        
                        <div class="ibox-content">

                        <?php echo form_open_multipart($this->config->item('admin_folder').'/coupons/form/'.$id, 'class="form-horizontal"'); ?>                                               
                        
                         <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('coupon_code');?></label>
							<?php
							$data	= array('name'=>'code', 'value'=>set_value('code', $code), 'class'=>'form-control');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						  </div>
						  
						  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('coupon_name');?></label>
							<?php
							$data	= array('name'=>'name', 'value'=>set_value('name', $name), 'class'=>'form-control');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						 </div>
						 
						 <div class="hr-line-dashed"></div>
                        
                          <?php
							$current_admin	= $this->session->userdata('admin');
							if ($current_admin['branch'] == 0): 
						  ?>
						  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('branch');?></label>
							<?php echo '<div class="col-sm-10">'.form_dropdown('branch_id', $branches, set_value('branch_id',$branch_id), 'class="form-control m-b"').'</div>'; ?>
						  </div>
						 <?php endif;?>
						 
						 <!--div class="form-group"><label class="col-sm-2 control-label" for="max_uses"><?php echo lang('max_uses');?></label>
							<?php
							$data	= array('name'=>'max_uses', 'value'=>set_value('max_uses', $max_uses), 'class'=>'form-control');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						 </div>
                        
                        <div class="form-group"><label class="col-sm-2 control-label" for="max_product_instances"><?php echo lang('limit_per_order');?></label>
							<?php
							$data	= array('name'=>'max_product_instances', 'value'=>set_value('max_product_instances', $max_product_instances), 'class'=>'form-control');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						 </div-->
						 
						 <div class="form-group"><label class="col-sm-2 control-label" for="start_date"><?php echo lang('enable_on');?></label>
							<?php
							$data	= array('name'=>'start_date', 'id'=>'datepicker1', 'value'=>set_value('start_date', reverse_format_malaysia($start_date)), 'class'=>'form-control');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						 </div>
						 
						 <div class="form-group"><label class="col-sm-2 control-label" for="end_date"><?php echo lang('disable_on');?></label>
							<?php
							$data	= array('name'=>'end_date', 'id'=>'datepicker2', 'value'=>set_value('end_date', reverse_format_malaysia($end_date)), 'class'=>'form-control');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						 </div>
						 
						 <!--div class="form-group"><label class="col-sm-2 control-label" for="reduction_type"><?php echo lang('reduction_type');?></label>
							
							<?php	$options = array(
			                  'percent'  => lang('percentage'),
							  'fixed' => lang('fixed')
			               	);
							?>
							<?php echo '<div class="col-sm-10">'.form_dropdown('reduction_type', $options, $reduction_type, 'class="form-control"').'</div>'; ?>
						 	
						 </div>		 
						 
						 <div class="form-group"><label class="col-sm-2 control-label" for="reduction_amount"><?php echo lang('reduction_amount');?></label>
							<?php
							$data	= array('name'=>'reduction_amount', 'id'=>'reduction_amount', 'value'=>set_value('reduction_amount', $reduction_amount), 'class'=>'form-control');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						 </div-->		
						 
						 <!--div class="form-group"><label class="col-sm-2 control-label" for="point_consume"><?php echo lang('point_consume');?></label>
							<?php
							$data	= array('name'=>'point_consume', 'id'=>'point_consume', 'value'=>set_value('point_consume', $point_consume), 'class'=>'form-control');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						 </div-->		 
						
						 <div class="form-group"><label class="col-sm-2 control-label" for="desc"><?php echo lang('desc');?></label>
														
							<textarea class="input-block-level" id="summernote" name="desc" rows="5">
                        		<?php echo set_value('desc', $desc) ?>
                        	</textarea>
							
						 </div>	
						 
						 
						
						
							<!-- div class="form-group">
							<label class="col-sm-4 control-label"><?php echo lang('best_photo_size')?>: <b><?php echo lang('width')?>: 640px, <?php echo lang('height')?>: 500px </b></label>
							</div-->
							
							<div class="form-group"><label class="col-sm-2 control-label" for="point_consume"><?php echo lang('image');?></label>
								<?php echo '<div class="col-sm-10">'.form_upload($f_image).'</div>'; ?>
							</div>
							
							
							<?php if($id && $image != ''):?>
								<div style="text-align:center; padding:5px; border:1px solid #ccc;"><img src="<?php echo base_url($image);?>" width="100%" alt="current"/><br/><?php echo lang('current_file');?></div>
							<?php endif;?>			
							
						
						
						 <div class="form-actions">
								<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
						 </div>
                        
                        </form>
                       
                        
                        </div>
                        
                     </div>
                </div>
</div>     


<script type="text/javascript">




</script>