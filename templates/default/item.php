</div><!--view 开始-->
<div class="blank10"></div>
<div class="wrap">
	<?php $breadcrumb = count($item->category_sequence); ?>
	<ul class="breadcrumb">
      <li>
        <a href="<?php echo site_url(); ?>">Home</a> <span class="divider">></span> 
      </li>
      <li>
        <a href="<?php echo site_url('sitemap'); ?>">All Categories</a> <?php if ($breadcrumb > 0): ?><span class="divider">></span> <?php endif; ?>
      </li>
      <?php foreach ($item->category_sequence as $k => $cate): ?>
      <li>
        <a href="<?php echo site_url('category/'.$cate['cid']); ?>"><?php echo $cate['name_en']; ?></a> 
        <?php if ($breadcrumb <> $k+1): ?>
        <span class="divider">></span>
        <?php endif; ?>
      </li>
      <?php endforeach; ?>
    </ul>
    <div class="blank10"></div>
    <div class="showleft left">
    	<div class="product">
        	<div class="product_box">
        		<div class="picshow left">
                	<div class="l left">
                    	<a href="<?php echo $pic_url = (isset($item->pic_url) ? $item->pic_url : ''); ?>" class="zoom">
                        	<img src="<?php echo $pic_url = (isset($item->pic_url) ? $item->pic_url : ''); ?>" id="productpic" />
                    	</a>
                    </div>
                    <link href="js/zoomy/zoomy.css" rel="stylesheet" type="text/css" />
					<script language="javascript" src="js/zoomy/zoomy.min.js"></script>
                    <script language="javascript">
						function _zoomy()
						{
							$('.zoom').zoomy('mouseover',
							{
								clickable: false,
								zoomSize: 150 
							});
						}
						function _change_zoomy(url)
						{
							_parent = $('#productpic').parent().parent();
							$('#productpic').remove();
							_parent.html('<a href="'+url+'" class="zoom"><img id="productpic" src="'+url+'" /></a>');
							_zoomy();
						}
						$(function(){_zoomy();});
                	</script>
                    <div class="r right">
                        <div class="prev" id="prev_btn"></div>
                        <div class="images_wrapper">
                            <style>
								.jcarousel-clip-vertical {height:156px;}
							</style>
                            <ul id="thumbpic">
                            　　　 <?php if (isset($item->item_imgs->item_img)) : ?>
                                <?php foreach ($item->item_imgs->item_img as $img): ?>
                                <li><img onclick="_change_zoomy(this.src);" src="<?php echo $img->url; ?>" /></li>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="next" id="next_btn"></div>
                    </div>
                    <script language="javascript" src="js/jcarousel/jquery.jcarousel.min.js"></script>
                    <script language="javascript">
							function mycarousel_initCallback(carousel) {
								jQuery('#next_btn').bind('click', function() {
									carousel.next();
									return false;
								});
							
								jQuery('#prev_btn').bind('click', function() {
									carousel.prev();
									return false;
								});
							};
							$('#thumbpic').jcarousel({vertical:true,buttonNextHTML:'',buttonPrevHTML:'',scroll: 1,initCallback: mycarousel_initCallback});
							$('#thumbpic').css('margin-top',-10);
                    </script>
                    <div class="clear blank10"></div>
                    <div class="plugin">
                    	<p style="padding-left:20px"><a target="_blank" href="<?php echo isset($item->taobaoke->click_url) ? $item->taobaoke->click_url : $item->detail_url; ?>">View Original URL on Taobao</a></p>
                        <p style="padding-left:55px"><a target="_blank" href="javascript:void(0);" onclick="add_favorite({'iid':'<?php echo $item->num_iid; ?>','title':'<?php echo $item->title; ?>','price':'<?php echo $item->price; ?>','pic_url':'<?php echo $pic_url; ?>','url':'<?php echo $item->detail_url; ?>'});">Add to Favorite</a></p>
                        <div style="padding:20px 0px 0 30px;">
                        	<?php $this->load->view('include/social_share'); ?>
                        </div>
                    </div>
                </div>
                <div class="pro_list right">
                	<ul>
                    	<li class="bold"><?php echo $item->title; ?></li>
                        <li class="bold">Price:&nbsp;<span class="red">$<?php echo dollar($item->price); ?></span></li>
                        <li class="bold">Express:&nbsp;<span class="red">$<?php echo dollar($item->express_fee); ?></span></li>
                    </ul>
                    <div class="other_pro clearfix">
                    	<ul>
                        	<li><em class="icon1"></em><a target="_blank" href="<?php echo site_url('guide/view/color-chart'); ?>">Color Chart</a></li>
                            <li><em class="icon2"></em><a target="_blank" href="<?php echo site_url('guide/view/size-conversion'); ?>">Size</a></li>
                            <li><em class="icon3"></em><a target="_blank" href="<?php echo site_url('guide/view/return-policy'); ?>">Return policy</a></li>
                            <li><em class="icon4"></em><a target="_blank" href="<?php echo site_url('guide/view/cost-calculator'); ?>">Cost Calculator</a></li>
                            <li><em class="icon5"></em><a target="_blank" href="<?php echo site_url('guide/view/weight-estimation'); ?>">Weight Estimation</a></li>
                            <li><em class="icon6"></em><a target="_blank" href="<?php echo site_url('guide'); ?>">FAQ</a></li>
                        </ul>
                    </div>
                    <ul>
                        <li><span class="bold">Location:</span>&nbsp;<?php echo $item->location->state; ?>-<?php echo $item->location->city; ?></li>
                        <li><span class="bold">Quantity:</span>&nbsp;<input style="width:40px;margin-top:5px;"　type="text" name="qty" id="qty" value="1" autocomplete="off" />(Inventory:<?php echo $item->num; ?>)</li>
                    </ul>
                    <?php if ($item->dealt_property['color']): ?>
                    <div class="property_container">
                    	<table width="100%">
                        	<tr>
                            	<td width="50" valign="top"><b>&nbsp;&nbsp;Color:</b></td>
                                <td>
                                	<?php foreach($item->dealt_property['color'] as $key=>$color): ?>
                                    	<a href="javascript:void(0);" class="property_color" id="<?php echo $key; ?>"><?php echo $color; ?></a>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <?php endif; ?>
                    <?php if ($item->dealt_property['size']): ?>
                    <div class="property_container">
                    	<table width="100%">
                        	<tr>
                            	<td width="50" valign="top"><b>&nbsp;&nbsp;Size:</b></td>
                                <td>
                                	<?php foreach($item->dealt_property['size'] as $key=>$size): ?>
                                    	<a href="javascript:void(0);" class="property_size" id="<?php echo $key; ?>"><?php echo $size; ?></a>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <?php endif; ?>
                    <div class="blank20"></div>
                    <div class="opbutton">
                    	<?php if($item->approve_status == 'onsale'): ?>
                        <div class="bg buynow left" onclick="add_cart(<?php echo $item->num_iid; ?>, <?php echo $item->num; ?>, 1);"></div>
                        <div class="bg addcart left" onclick="add_cart(<?php echo $item->num_iid; ?>, <?php echo $item->num; ?>);"></div>
                        <?php else: ?>
                        All Sold Out ! 
                        <?php endif; ?>
                        <div class="clear"></div>
                    </div>
                    <div class="blank10"></div>
                </div>
                <div class="clear"></div>
       		</div><!--end showproduct-->
           
        </div><!--end product-->
         <div class="blank10"></div> 
        <div class="productdetail">
            <div class="bg cat"></div>
            <div class="cont">
            　　　　<?php if ($item->dealt_property['view']): ?>
            	<div class="blank10"></div>
                <div id="attributes" class="attributes" style="display: block; ">
                    <ul class="attributes-list">
                          <?php foreach ($item->dealt_property['view'] as $v): ?>
                          <li title="<?php echo $label=implode('&nbsp;', $v['values']); ?>">
						  		<b><?php echo $v['name']; ?></b>:<?php echo $label; ?>
                          </li>
                          <?php endforeach; ?>
                   　</ul>
                </div>
                <div class="blank10"></div>
                <?php endif; ?>
                <div style="padding:0 15px 20px;">
                <?php echo $item->desc; ?>
                </div>
            </div>
        </div>
    </div><!--end showleft-->
    <div class="showright right">
    	<div class="shopinfo">
        	<div class="bg cat"></div>
             <div class="blank6"></div> 
             <?php if ($item->shop): ?>
             <div><img  src="images/taobao/level_<?php echo $item->shop->seller_credit->level; ?>.gif" /></div>
             <div class="blank6"></div> 
             <ul>
             	<li><dl>Store Name:</dl><dt><?php echo $item->shop->nick; ?></dt></li>
                <li><dl>Positive Rating:</dl><dt>
				<?php 
				if($item->shop->seller_credit->total_num > 0)
				{
					echo round($item->shop->seller_credit->score / $item->shop->seller_credit->total_num , 2)*100;	
				}
				else
				{
					echo '0';	
				}
				?>
                %</dt></li>
                <li><dl>Location:</dl>
                <dt><?php echo isset($item->shop->location->state) ? $item->shop->location->state  : ''; ?></dt></li>
             </ul>
             <?php endif; ?>
             <div class="clear"></div> 
        </div>
        <div class="blank10"></div> 
        <?php if (isset($item->shop_items->items->item)): ?>
        <div class="box">
        	<div class="bg boxcat">Other Items</div>
            <ul class="allofitems clearfix">
            	<?php foreach ($item->shop_items->items->item as $_item): ?>
                <li>
                	<a href="<?php echo site_url('item/'.$_item->num_iid); ?>"><img src="<?php echo $_item->pic_url."_b.jpg"; ?>" width="60" height="60" /></a>
                	<p class="title break"><a href="<?php echo site_url('item/'.$_item->num_iid); ?>"><?php echo $_item->title; ?></a></p>
                    <p class="price">Price:<b>$<?php echo dollar($_item->price); ?></b></p>
                    <p class="bought">Sold:<?php echo $_item->volume; ?></p>
                </li>
                <?php endforeach; ?>
            </ul>
            <div class="clear"></div>
            <div class="more2 right"><a href="<?php echo site_url('shop/'.urlencode($item->shop->nick)); ?>">more>></a></div>
            <div class="blank6"></div>
        </div>
        <?php endif; ?>
    </div>
    <div class="clear"></div>
</div>
<script language="javascript">
	var skus = {};
<?php 
	foreach ($item->skus as $sku)
	{
		echo 'skus["'.$sku->properties.'"]='.$sku->quantity.';';	
	}
 ?>
	function check_qty()
	{
		var _sku = new Array();
		if ($('.property_color.property_selected').length == 1)
		{
			_sku.push($('.property_color.property_selected').attr('id'));	
		}
		if ($('.property_size.property_selected').length == 1)
		{
			_sku.push($('.property_size.property_selected').attr('id'));	
		}
		_sku = _sku.join(';');
		
		if (typeof(skus[_sku]) != "undefined")
		{
			if (skus[_sku] <= 0)
			{
				$('.property_color.property_selected').removeClass('property_selected').addClass('property_disabled');
				$('.property_size.property_selected').removeClass('property_selected').addClass('property_disabled');	
			}
		}
	}
	
	$(function()
	{
		$('.property_color').click(function()
		{
			$('.property_color').removeClass('property_selected').removeClass('property_disabled');
			$(this).addClass('property_selected');		
			check_qty();
		});	
		$('.property_size').click(function()
		{
			$('.property_size').removeClass('property_selected').removeClass('property_disabled');;
			$(this).addClass('property_selected');
			check_qty();	
		});	
	});
</script>