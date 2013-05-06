<link href="images/member.css" rel="stylesheet" type="text/css" />
    <div class="indexleft">
        <!--二级分类-->
        <?php $this->load->view('member/left'); ?>
        
    </div><!--end indexleft-->
    <div class="indexright">
    <!--
       <div class="bg listbar">User Center</div>   
       <div  class="blank10"></div>   --> 
      <div class="shoppinglist" style="border:1px #ccc solid">
          <ul>
				<?php foreach ($list as $item): ?>
                <li>
                    <a href="<?php echo site_url('item/'.$item->iid); ?>" target="_blank">
                        <img  src="<?php echo isset($item->pic_url)  ? $item->pic_url."_b.jpg" : '' ; ?>"  width="170" height="161"/>
                    </a>
                    <p class="title"><a href="<?php echo site_url('item/'.$item->iid); ?>" target="_blank"><?php echo $item->title; ?></a></p>
                    <p class="price">$<?php echo dollar($item->price); ?><span style="float:right"><a href="javascript:void(0);" onclick="remove_favorite('<?php echo $item->iid; ?>',this)">delete</a></span></p>
                </li>
                <?php endforeach; ?>
           </ul>
           <div class="clear"></div>
 			<?php echo $pagination; ?>       
      </div>
     </div>
</div>
