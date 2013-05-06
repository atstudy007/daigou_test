    <div class="blank10"></div>
    <ul class="breadcrumb">
              <li>
                <a href="<?php echo site_url(); ?>">Home</a> <span class="divider">></span> 
              </li>
              <li>
                <a href="<?php echo site_url('sitemap'); ?>">All Categories</a> 
              </li>
     </ul>
     <div class="blank10"></div>
    <div id="sitemap">
        <div class="sitemap_lists">
        	<div class="sitemap_list">
            	<?php foreach($GLOBALS['category']['relations'] as $num=>$cat): ?>
                <ul>
                	<li><a class="sitemap_title" href="<?php echo site_url('category/'.$cat['cid']); ?>"><?php echo $GLOBALS['category']['all'][$cat['cid']]; ?></a></li>
                    <li class="sitemap_detail">
                        <ul>
                            <li>
                                <?php if($cat['children']): ?>
                                <?php foreach ($cat['children'] as $cate): ?>
                                <a href="<?php echo site_url('category/'.$cate); ?>"><?php echo $GLOBALS['category']['all'][$cate]; ?></a>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </li>
                </ul>   
                <?php endforeach; ?>             
            </div><!--end cat_list-->         
        </div>
</div>