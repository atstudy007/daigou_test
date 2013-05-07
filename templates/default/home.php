    <div class="indexleft">
        <!--二级分类-->
        <div class="indexcat">
            <ul id="indexcat">
            	<?php foreach($GLOBALS['category']['relations'] as $num=>$cat): ?>
                <?php if($num > 15) break; ?>
                <li id="top_category_<?php echo $cat['cid']; ?>" <?php if($cat['children']): ?>class="hoverable"<?php endif; ?>>
					<a href="<?php echo site_url('category/'.$cat['cid']); ?>">
						<?php echo $GLOBALS['category']['all'][$cat['cid']]; ?>
                    </a>
                     <?php if($cat['children']): ?>
                            <ul class="indexsecondcat">
							<?php foreach ($cat['children'] as $cate): ?>
                                <li><a href="<?php echo site_url('category/'.$cate); ?>"><?php echo $GLOBALS['category']['all'][$cate]; ?></a></li>
                            <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
       
        <div  class="blank10"></div>
        <div class="box" style="height:120px;">
        	<div class="bg boxcat">
                <span class="right more"><a href="<?php echo site_url('partners'); ?>">more</a></span>
                Hot Sites
            </div>
            <ul style="padding:8px">
                    <li style="float:left"><a href="http://www.taobao.com/" target="_blank">
                        <img src="images/partners/taobao.jpg" width="85" height="35" border="0"></a></li>
                    <li style="float:left"><a href="http://www.dangdang.com" target="_blank">
                        <img src="images/partners/dangdang.jpg" width="85" height="35" border="0"></a></li>
                    <li style="float:left"><a href="http://www.eachnet.com" target="_blank">
                        <img src="images/partners/eachnet.jpg" width="85" height="35" border="0"></a></li>
                    <li style="float:left"><a href="http://www.360buy.com" target="_blank">
                        <img src="images/partners/jingdong.jpg" width="85" height="35" border="0"></a></li>
            </ul>
        </div>
         <div  class="blank10"></div>
          <div class="box" style="">
        	<div class="bg boxcat">
            	<span class="right more"><a href="<?php echo site_url('news'); ?>">more</a></span>News
            </div>
            <ul style="font-size:12px;padding:4px;line-height:14px;">
            	<?php foreach ($news as $v): ?>
                <li style="padding:4px;"><a href="<?php echo site_url('news/'.$v->id); ?>"><?php echo $v->title ?></a>&nbsp;[<?php echo date('Y-m-d', $v->create_time); ?>]</li>
       			<?php endforeach; ?>
            </ul>
        </div>
        <div  class="blank10"></div>
        <?php $this->load->view('include/service_box'); ?>
         <div  class="blank10"></div>
         <div class="box">
        	<div class="bg boxcat">
               <span class="right more"><a href="<?php echo site_url('article'); ?>">more</a></span>Articles
            </div>
            <ul style="font-size:12px;padding:4px;line-height:14px;">
                <?php foreach ($articles as $v): ?>
                <li style="padding:4px;"><a href="<?php echo site_url('article/'.$v->id); ?>"><?php echo $v->title ?></a>&nbsp;[<?php echo date('Y-m-d', $v->create_time); ?>]</li>
       			<?php endforeach; ?>
       		</ul>
        </div>
    </div><!--end indexleft-->
    <div class="indexright">
    	<!--滚动图片-->
    	<div id="slider" class="left">
			<ul>				
            	<?php foreach ($sliders as $slider): ?>
				<li>
                	<a href="<?php echo $slider->link; ?>">
                		<img src="<?php echo $slider->image; ?>" alt="<?php echo $slider->title; ?>" />
                    </a>
                </li>
                <?php endforeach; ?>
			</ul>
		</div>
        <script type="text/javascript" src="js/easySlider1.5.js"></script>
        <script language="javascript">
			$("#slider").easySlider({
				speed: 800,
				auto: true,
				pause: 3000,
				continuous: true 
			});
        </script>
        <div class="box right" style="width:200px;height:238px;">
        	<div class="bg boxcat">Testimonials</div>
            <div style="width:200px;height:204px;overflow:hidden" id="marquee_container">
                <div id="ticker1" style="width: 203px;">
                    <ul>
                    <?php foreach ($rates as $rate): ?>
                            <li style="width: 198px; padding: 5px 5px; margin-bottom: 5px;">
                                <h4 style="font-size: 12px;font-weight:bold"><?php echo $rate->username; ?>&nbsp;&nbsp;<?php echo $country[$rate->country]; ?></h4>
                                <?php echo $rate->rate_description; ?>
                            </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <div id="ticker2" style="width: 203px;"></div>
            </div>
            <script type="text/javascript">
				var speed = 50;
				var ticker2 = $("#ticker2");
				var ticker1 = $("#ticker1");
				var marquee_container = $("#marquee_container");
				ticker2.html(ticker1.html()); 
				ticker1.css("height", ticker1.height());
				ticker2.css("height",ticker1.height());
				function marquee() {
					if (ticker2.offset().top - marquee_container.offset().top <= 0) {
						marquee_container.scrollTop(marquee_container.scrollTop() - ticker1.height());
					} else {
						marquee_container.scrollTop(marquee_container.scrollTop() + 1);
					}
				}
				var marquee_timer = setInterval(marquee, speed); //设置定时器
				marquee_container.mouseenter(function () { clearInterval(marquee_timer); });
				marquee_container.mouseleave(function (){ marquee_timer = setInterval(marquee, speed); });
			</script>
        </div>
        
        <div class="clear blank10"></div>
        
        <div class="bg step pngfix">
        	<?php foreach ($GLOBALS['view']['guide'] as $k => $v): ?>
            <div class="stepbox <?php echo $k == count($GLOBALS['view']['guide']) ? 'last' : '';  ?>">
            	<div class="title"><a href="<?php echo $v['link']; ?>"><?php echo $v['title']; ?></a></div>
                <div class="desc"><?php echo $v['txt']; ?></div>
            </div>
            <?php endforeach; ?>
            <div class="clear"></div>
        </div>
        <div class="clear blank10"></div>
        
        <!--hot shopping-->
        <div class="hotshopping">
        	<div class="cat"><div class="bg catname left"></div><div class="more right"><a href="<?php echo site_url('hot'); ?>">more</a></div></div>
            <div class="list">
            	<ul>
				<!--
                <?php foreach($items as $item): ?>
                	<li>
                    	<a href="<?php echo site_url('item/'.$item->num_iid); ?>"><img  src="<?php echo $item->pic_url."_b.jpg"; ?>"  width="170" height="161"/></a>
                        <p class="title">
                        	<a href="<?php echo site_url('item/'.$item->num_iid); ?>"><?php if (isset($items_en[''.$item->num_iid]) && $items_en[''.$item->num_iid]): ?>
                            <?php echo $items_en[''.$item->num_iid]; ?>
							<?php else: ?>
                            <?php echo $item->title; ?>
							<?php endif; ?></a>
                        </p>
                        <p class="price">Price:$<?php echo dollar($item->price); ?></p>
                        <p class="bought">(<?php echo $item->volume; ?> customers bought)</p>
                    </li>
                <?php endforeach; ?>
                -->
                <li>
                    	<a href="http://www.sgbabytree.com/item/19225199585.html">
                        <img width="170" height="161" src="http://img01.taobaocdn.com/bao/uploaded/i1/14015020146611373/T1AKJBXthfXXXXXXXX_!!0-item_pic.jpg_310x310.jpg">
                        </a>
                        <p class="title"><a href="http://www.sgbabytree.com/item/19225199585.html">2013春装新款韩版白色蕾丝连衣裙 韩版修身中袖雪纺打底裙子</a></p>
                        <p class="price">$14</p>
                        <p class="bought">(14073 customers bought)</p>
                 </li>
                 <li>
                    	<a href="http://www.sgbabytree.com/item/19361679087.html">
                        <img width="170" height="161" src="http://img03.taobaocdn.com/bao/uploaded/i3/14732020464720518/T1mNtKXvBcXXXXXXXX_!!0-item_pic.jpg_310x310.jpg">
                        </a>
                        <p class="title"><a href="http://www.sgbabytree.com/item/19361679087.html">潮流女装13新品春装韩版衣服修身蕾丝泡泡长袖V领连衣裙森女裙子</a></p>
                        <p class="price">$12</p>
                        <p class="bought">(113 customers bought)</p>
                  </li> 
                    <li>
                    	<a href="http://www.sgbabytree.com/item/18188100698.html">
                        <img width="170" height="161" src="http://img03.taobaocdn.com/bao/uploaded/i3/T1QL_mXX8fXXbpMZo._081513.jpg_310x310.jpg">
                        </a>
                        <p class="title"><a href="http://www.sgbabytree.com/item/18188100698.html">2双包邮 新款春秋老北京布鞋子女单鞋蝴蝶结平跟软底平底鞋糖果色</a></p>
                        <p class="price">$6</p>
                        <p class="bought">(66 customers bought)</p>
                    </li>
                       <!--10-->
                    <li>
                    	<a href="http://www.sgbabytree.com/item/14776027910.html">
                        <img width="170" height="161" src="http://img02.taobaocdn.com/bao/uploaded/i2/T12_K0XiFmXXcgC8A4_054020.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://www.sgbabytree.com/item/14776027910.html">2012最新款婚纱 韩版甜美公主蓬蓬裙婚纱 韩式齐地抹胸婚纱礼服</a></p>
                        <p class="price">$48.06</p>
                        <p class="bought">(215 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://www.sgbabytree.com/item/14782262215.html">
                        <img width="170" height="161" src="http://img02.taobaocdn.com/bao/uploaded/i2/11093021401955433/T11Hd8XytXXXXXXXXX_!!0-item_pic.jpg_310x310.jpg">
                        </a>
                        <p class="title"><a href="http://www.sgbabytree.com/item/14782262215.html">小包包2013新款韩版春夏潮女士包时尚女包小包单肩斜跨包两用包邮</a></p>
                        <p class="price">$11</p>
                        <p class="bought">(236customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://www.sgbabytree.com/item/12423449544.html">
                        <img width="170" height="161" src="http://img02.taobaocdn.com/bao/uploaded/i2/T1vBUgXXReXXa95kwY_030248.jpg_460x460.jpg">
                        </a>
                        <p class="title"><a href="http://www.sgbabytree.com/item/12423449544.html">喜向红2013春款女装衣服韩版潮长袖t恤女款修身条纹打底衫女长袖</a></p>
                        <p class="price">$10</p>
                        <p class="bought">(35customers bought)</p>
                    </li>
                     <li>
                    	<a href="http://www.sgbabytree.com/item/12224681317.html">
                        <img width="170" height="161" src="http://img01.taobaocdn.com/bao/uploaded/i1/13930019740649056/T1zO4oXtXfXXXXXXXX_!!0-item_pic.jpg_460x460.jpg">
                        </a>
                        <p class="title"><a href="http://www.sgbabytree.com/item/12224681317.html">时装周OSA女装衣服韩版中长款包臀打底衫春夏季T恤 女 长袖T11024</a></p>
                        <p class="price">$12</p>
                        <p class="bought">(78customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://www.sgbabytree.com/item/20866444684.html">
                        <img width="170" height="161" src="http://img02.taobaocdn.com/imgextra/i2/1024357221/T2bkC2XataXXXXXXXX_!!1024357221.jpg_310x310.jpg">
                        </a>
                        <p class="title"><a href="http://www.sgbabytree.com/item/20866444684.html">2013夏季新款女包复古韩版单肩包休闲柳丁包时尚潮鳄鱼纹小包包邮</a></p>
                        <p class="price">$21</p>
                        <p class="bought">(124 customers bought)</p>
                    </li>
                     <li>
                    	<a href="http://www.sgbabytree.com/item/17763162470.html">
                        <img width="170" height="161" src="http://img01.taobaocdn.com/bao/uploaded/i1/12259021491785391/T1Mct9XBNbXXXXXXXX_!!0-item_pic.jpg_460x460.jpg">
                        </a>
                        <p class="title"><a href="http://www.sgbabytree.com/item/17763162470.html">依然纯2013夏季女装新款韩版修身大码气质蕾丝雪纺连衣裙短袖裙子</a></p>
                        <p class="price">$17.74</p>
                        <p class="bought">(135 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://www.sgbabytree.com/item/17422734719.html">
                        <img width="170" height="161" src="http://img03.taobaocdn.com/bao/uploaded/i3/15506020057106908/T1sH0zXsBeXXXXXXXX_!!0-item_pic.jpg_310x310.jpg">
                        </a>
                        <p class="title"><a href="http://www.sgbabytree.com/item/17422734719.html">猪猪 2013新款春装女装衣服 亮闪亲纱质花瓣领打底衫T恤</a></p>
                        <p class="price">$4</p>
                        <p class="bought">(1432 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://www.sgbabytree.com/item/23606028379.html">
                        <img width="170" height="161" src="http://img01.taobaocdn.com/bao/uploaded/i1/18670020969144836/T1z2NVXqxXXXXXXXXX_!!0-item_pic.jpg_310x310.jpg">
                        </a>
                        <p class="title"><a href="http://www.sgbabytree.com/item/23606028379.html">蘑菇街2013夏款小背心潮女衣服装批发厂家直批韩版姐妹装闺蜜装</a></p>
                        <p class="price">$17.74</p>
                        <p class="bought">(1267 customers bought)</p>
                    </li>
                   <li>
                    	<a href="http://www.sgbabytree.com/item/17430817400.html">
                        <img width="170" height="161" src="http://img02.taobaocdn.com/bao/uploaded/i2/18554021963695742/T1_jNzXqJdXXXXXXXX_!!0-item_pic.jpg_310x310.jpg">
                        </a>
                        <p class="title"><a href="http://www.sgbabytree.com/item/17430817400.html">淘派热卖包包2012新款女包韩版潮特价单肩斜跨时尚百搭流苏黑色大</a></p>
                        <p class="price">$31.94</p>
                        <p class="bought">(13679 customers bought)</p>
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>