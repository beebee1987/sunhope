<?php if(!empty($category->description)): ?>
<div class="row">
    <div class="span12"><?php echo $category->description; ?></div>
</div>
<?php endif; ?>
        

    
    <?php
    $cols = 4;
    if(isset($category)):?>
        <?php if(isset($this->categories[$category->id] ) && count($this->categories[$category->id]) > 0): $cols=3; ?>
            <div class="span3">
                <ul class="nav nav-list well">
                    <li class="nav-header">
                    <?php echo lang('subcategories'); ?>
                    </li>
            
                    <?php foreach($this->categories[$category->id] as $subcategory):?>
                        <li><a href="<?php echo site_url(implode('/', $base_url).'/'.$subcategory->slug); ?>"><?php echo $subcategory->name;?></a></li>
                    <?php endforeach;?>
                </ul>
            </div>
        
           
        <?php endif;?>
    <?php endif;?>
    
    <?php if($cols == 4):?>
       
    <?php endif;?>
    
    <?php if(count($products) == 0):?>
        <h2 style="margin:50px 0px; text-align:center;">
            <?php echo lang('no_products');?>
        </h2>
    <?php elseif(count($products) > 0):?>


	<div style="margin-top: 20px; margin-bottom: 50px">
			
			<div class="<?php echo ($cols == 4)?'span9':'span6';?>">
				<?php echo $this->pagination->create_links();?>
				&nbsp;
			</div>
			<div class="pull-right">
				<select class="form-control " id="sort_products"
					onchange="window.location='<?php echo site_url(uri_string());?>/'+$(this).val();">
					<option value=''>
						<?php echo lang('default');?>
					</option>
					<option
					<?php echo(!empty($_GET['by']) && $_GET['by']=='name/asc')?' selected="selected"':'';?>
						value="?by=name/asc">
						<?php echo lang('sort_by_name_asc');?>
					</option>
					<option
					<?php echo(!empty($_GET['by']) && $_GET['by']=='name/desc')?' selected="selected"':'';?>
						value="?by=name/desc">
						<?php echo lang('sort_by_name_desc');?>
					</option>
					<option
					<?php echo(!empty($_GET['by']) && $_GET['by']=='price/asc')?' selected="selected"':'';?>
						value="?by=price/asc">
						<?php echo lang('sort_by_price_asc');?>
					</option>
					<option
					<?php echo(!empty($_GET['by']) && $_GET['by']=='price/desc')?' selected="selected"':'';?>
						value="?by=price/desc">
						<?php echo lang('sort_by_price_desc');?>
					</option>
				</select>
			</div>
		
	</div>

	<div class="userJumbotron">

		<div class="btn-group">
			<a href="#" id="list" class="btn btn-primary btn-sm"><span
				class="glyphicon glyphicon-th-list"></span>&nbsp;List</a> <a
				href="#" id="grid" class="btn btn-default btn-sm"><span
				class="glyphicon glyphicon-th"></span>&nbsp;Grid</a>
		</div>


		<div id="products" class="row list-group">
		
		<?php
            
            $itm_cnt = 1;
            foreach($products as $product):
                if($itm_cnt == 1):?>
                    
                <?php endif;?>
				
		
		
		<?php
		$photo  = theme_img('no_picture.png', lang('no_image_available'));
		$product->images    = array_values($product->images);

		if(!empty($product->images[0]))
		{
			$primary    = $product->images[0];
			foreach($product->images as $photo)
			{
				if(isset($photo->primary))
				{
					$primary    = $photo;
				}
			}

			$photo  = '<img class="group list-group-image" src="'.base_url('uploads/images/thumbnails/'.$primary->filename).'" alt="'.$product->seo_title.'"/>';
		}
		?>

		<div class="item  col-xs-4 col-lg-4">
			
				<?php echo $photo?>

				<h4 class="group inner list-group-item-heading">
					<a
						href="<?php echo site_url(implode('/', $base_url).'/'.$product->slug); ?>"><?php echo $product->name;?>
					</a>
				</h4>
				<p class="group inner list-group-item-text">
					<?php if($product->excerpt != ''): ?>
					<?php echo $product->excerpt; ?>
					<?php endif; ?>
				</p>
			
		</div>


		<?php endforeach;?>	


		</div>
	
	</div>

	<?php endif;?>
    
