<h1><?php echo lang('custom_card') ?></h1>


<div class="span4">
			<div class="form-regist-container">
				<h4><?php echo lang('upload_logo')?></h4>
				
				<p>
				<a href="#" data-toggle="tooltip" data-placement="right" data-html="true" title="Member Card">	
					<div id="output">
						<?php if(!empty($image_card)){?>
								<div class="step-by-inner-img2">										
									<img src="<?php echo base_url($image_card)?>" alt="Member Card" class="member-card" style="width:280px; height:180px;" />
								</div>											
						<?php }else{?>
								<div class="step-by-inner-img2">										
									<img src="<?php echo base_url('assets/img/no_picture.png')?>" alt="Member Card" class="company-logo" style="width:280px; height:180px;" />
								</div>																					
						<?php }?>
					</div>
					
				</a>	
				</p>
				
				<p>
					<?php echo lang('best_photo_size')?> <b><?php echo lang('width')?>: 750px, <?php echo lang('height')?>: 340px </b>
				</p>
				<!-- The fileinput-button span is used to style the file input field as button -->
			    <span class="btn btn-success fileinput-button">
			        <i class="glyphicon glyphicon-plus"></i>
			        <span><?php echo lang('add_files')?>...</span>
			        <!-- The file input field used as target for the file upload widget -->
			        <input id="fileupload" type="file" name="userfile" multiple>
			    </span>
			    <br>
			    <br>
			    <!-- The global progress bar -->
			    <div id="progress" class="progress">
			        <div class="progress-bar progress-bar-success"></div>
			    </div>
			    <!-- The container for the uploaded files -->
			    <div id="files" class="files"></div>
			    <br>
			    <div class="panel panel-default">
			        <div class="panel-heading">
			            <h3 class="panel-title"><?php echo lang('upload_image_notes')?></h3>
			        </div>
			        <div class="panel-body">
			            <ul>
			            	<li><?php echo lang('best_photo_size')?> <b><?php echo lang('width')?>: 750px, <?php echo lang('height')?>: 340px </b></li> 
			            	<li><?php echo lang('max_file_size')?> <strong>5 MB</strong>.</li>
			                <li><?php echo lang('only_image_files')?>(<strong>JPG, GIF, PNG</strong>) <?php echo lang('allowed_in_background_image')?>.</li>
			                <li><?php echo lang('files_from_desktop')?></li>	                
			            </ul>
			        </div>
			    </div>
														
			</div>	
		
	</div>
								
