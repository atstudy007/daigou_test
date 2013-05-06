</div><!--view 开始-->
<div class="blank10"></div>
<div class="wrap">
    <div class="showleft left">
    	<!--end product-->
        <?php $this->load->view('list_bar'); ?>      
        <div  class="blank10"></div>
        <div class="shoppinglist">
            <ul>
                <?php if (isset($provider->items->item)): ?>
                <?php foreach ($provider->items->item as $item): ?>
                <li style="padding:10px 10px">
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
    </div><!--end showleft-->
    <div class="showright right">
    	<div class="shopinfo">
        	<div class="bg cat"></div>
             <div class="blank6"></div> 
             <?php if ($provider->shop): ?>
             <div><img  src="images/taobao/level_<?php echo $provider->shop->seller_credit->level; ?>.gif" /></div>
             <div class="blank6"></div> 
             <ul>
             	<li><dl>Store Name:</dl><dt><?php echo $provider->shop->nick; ?></dt></li>
                <li><dl>Positive Rating:</dl><dt>
				<?php 
				if($provider->shop->seller_credit->total_num > 0)
				{
					echo round($provider->shop->seller_credit->score / $provider->shop->seller_credit->total_num , 2)*100;	
				}
				else
				{
					echo '0';	
				}
				?>
                %</dt></li>
                <li><dl>Location:</dl>
                <dt><?php echo isset($provider->shop->location->state) ? $provider->shop->location->state  : ''; ?></dt></li>
             </ul>
             <?php endif; ?>
             <div class="clear"></div> 
        </div>
        <div class="blank10"></div> 
    </div>
    <div class="clear"></div>
</div>