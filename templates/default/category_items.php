    <div class="indexleft">
        <!--二级分类-->
        <div class="ralatedcat">
        	<div class="bg catname">Top 10 List</div>
            <ul class="allofitems clearfix">
            	<?php if (isset($top10->taobaoke_items->taobaoke_item)): ?>
				<?php foreach ($top10->taobaoke_items->taobaoke_item as $_item): ?>
                <li class="small">
                	<a href="<?php echo site_url('item/'.$_item->num_iid); ?>"><img src="<?php echo $_item->pic_url."_b.jpg"; ?>" width="60" height="60" /></a>
                	<p class="title break"><a href="<?php echo site_url('item/'.$_item->num_iid); ?>"><?php echo $_item->title; ?></a></p>
                    <p class="price">Price:<b>$<?php echo dollar($_item->price); ?></b></p>
                    <p class="bought">Sold:<?php echo $_item->volume; ?></p>
                </li>
                <?php endforeach; ?>
                <?php endif; ?>
            </ul>
            <div class="clear"></div>
        </div>
    </div><!--end indexleft-->
    <div class="indexright">
       <?php $this->load->view('list_bar'); ?>      
       <div  class="blank10"></div>     
            <div class="shoppinglist">
            	<ul>
                	<?php if (isset($provider->taobaoke_items->taobaoke_item)): ?>
                    <?php foreach ($provider->taobaoke_items->taobaoke_item as $item): ?>
                    <li>
                    	<a href="<?php echo site_url('item/'.$item->num_iid); ?>">
                        <img  src="<?php echo isset($item->pic_url)  ? $item->pic_url."_b.jpg" : '' ; ?>"  width="170" height="161"/>
                        </a>
                        <p class="title"><a href="<?php echo site_url('item/'.$item->num_iid); ?>"><?php echo $item->title; ?></a></p>
                        <p class="price">$<?php echo dollar($item->price); ?></p>
                        <p class="bought">(<?php echo $item->volume; ?> customers bought)</p>
                    </li>
                    <?php endforeach; ?>
                    <?php endif;?>
                </ul>
            </div>
            <div class="clear"></div>
 			<?php echo $pagination; ?>
       </div>
</div>
