
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
                            <h5><?php echo lang('project_category_form')?></h5>                            
                        </div>
                        
                        <div class="ibox-content">

                        <?php echo form_open_multipart($this->config->item('admin_folder').'/projectcategorys/form/'.$id, 'class="form-horizontal"'); ?>                                               
                        
						  
						  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('category_name');?></label>
							<?php
							$data	= array('name'=>'name', 'value'=>set_value('name', $name), 'class'=>'form-control');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						 </div>
						 
						 <div class="hr-line-dashed"></div>
						 
						
						 <div class="form-group"><label class="col-sm-2 control-label" for="desc"><?php echo lang('desc');?></label>
														
							<textarea class="input-block-level" id="summernote" name="desc" rows="5">
                        		<?php echo set_value('desc', $desc) ?>
                        	</textarea>
							
						 </div>	
						
							
						
						
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