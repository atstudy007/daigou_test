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
                    	<a href="http://127.0.0.50:82/item/15642142992.html">
                        <img width="170" height="161" src="http://img03.taobaocdn.com/bao/uploaded/i3/11180019879503670/T1ktoiXkFaXXXXXXXX_!!0-item_pic.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/15642142992.html">包邮2012秋冬新款冬女裙韩版大码女装长袖修身打底裙冬款连衣裙</a></p>
                        <p class="price">$6.45</p>
                        <p class="bought">(14073 customers bought)</p>
                 </li>
                 <li>
                    	<a href="http://127.0.0.50:82/item/15154733294.html">
                        <img width="170" height="161" src="http://img03.taobaocdn.com/bao/uploaded/i3/T1YPzxXf4eXXa0tYUU_013741.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/15154733294.html">外滩衣元素 秋冬新款风衣女韩版女装外套 女 双排扣修身女式风衣</a></p>
                        <p class="price">$27.35</p>
                        <p class="bought">(4511 customers bought)</p>
                  </li> 
                  <li>
                    	<a href="http://127.0.0.50:82/item/19912884621.html">
                        <img width="170" height="161" src="http://img04.taobaocdn.com/bao/uploaded/i4/T1gibVXalcXXXbeto1_040547.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/19912884621.html">毛衣 男 外套 开衫羊毛衫加厚羊绒衫男士毛衫秋冬男装外套 针织衫</a></p>
                        <p class="price">$44.84</p>
                        <p class="bought">(6331 customers bought)</p>
                    </li>
                  <li>
                    	<a href="http://127.0.0.50:82/item/10077655193.html">
                        <img width="170" height="161" src="http://img04.taobaocdn.com/bao/uploaded/i4/T1bwT.Xn4XXXa1YUZV_021943.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/10077655193.html">玛珂米索男士保罗衫 秋冬新款加厚半高领立领Polo衫 7折</a></p>
                        <p class="price">$40.16</p>
                        <p class="bought">(59 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/16943368006.html">
                        <img width="170" height="161" src="http://img01.taobaocdn.com/bao/uploaded/i1/T1bF52XbdhXXaLcYI7_063654.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/16943368006.html">2012秋装新品 百搭全蕾丝镂空雕花吊带背心 女 打底背心 小吊带</a></p>
                        <p class="price">$2.5</p>
                        <p class="bought">(547 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/19622268390.html">
                        <img width="170" height="161" src="http://img03.taobaocdn.com/bao/uploaded/i3/T1k6v6XdhcXXaf95jX_085511.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/19622268390.html">晴天季节秋冬款修身PU水洗女士皮衣大码显瘦QT12060</a></p>
                        <p class="price">$72.42</p>
                        <p class="bought">(1885 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/19253280652.html">
                        <img width="170" height="161" src="http://img04.taobaocdn.com/bao/uploaded/i4/14389027924536429/T1na62XaVlXXXXXXXX_!!0-item_pic.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/19253280652.html">莱寇皮草外套 2012新款特价兔毛貉子毛领拼接皮草外套修身A-226</a></p>
                        <p class="price">$68.06</p>
                        <p class="bought">(4972 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/19465784791.html">
                        <img width="170" height="161" src="http://img02.taobaocdn.com/bao/uploaded/i2/T1UM_GXdhiXXaqgaYb_092828.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/19465784791.html">千百怡恋 中老年女装秋装新品女长款外套中年女装妈妈装秋装外套</a></p>
                        <p class="price">$48.06</p>
                        <p class="bought">(9353 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/16102309305.html">
                        <img width="170" height="161" src="http://img01.taobaocdn.com/bao/uploaded/i1/T16XbTXfXgXXXF.CkV_021621.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/16102309305.html">【VIP专享】西服套装韩版结婚新郎礼服正品 商务套西正装西装黑色</a></p>
                        <p class="price">$96.45</p>
                        <p class="bought">(574 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/4778638515.html">
                        <img width="170" height="161" src="http://img03.taobaocdn.com/bao/uploaded/i3/T12tbPXf4jXXahSAgU_015417.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/4778638515.html">正品包邮三粒扣纯黑色男士西服套装商务休闲新郎结婚绅士修身西装</a></p>
                        <p class="price">$46.59</p>
                        <p class="bought">(656 customers bought)</p>
                    </li>
                       <!--10-->
                    <li>
                    	<a href="http://127.0.0.50:82/item/14776027910.html">
                        <img width="170" height="161" src="http://img02.taobaocdn.com/bao/uploaded/i2/T12_K0XiFmXXcgC8A4_054020.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/14776027910.html">2012最新款婚纱 韩版甜美公主蓬蓬裙婚纱 韩式齐地抹胸婚纱礼服</a></p>
                        <p class="price">$48.06</p>
                        <p class="bought">(2195 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/8734531473.html">
                        <img width="170" height="161" src="http://img01.taobaocdn.com/bao/uploaded/i1/T1K6_HXXhnXXaS9I2b_093407.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/8734531473.html">包邮 秋冬新款 毛衣 女韩版宽松女装中长款外套针织衫打底衫毛衣</a></p>
                        <p class="price">$16.13</p>
                        <p class="bought">(35952 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/16118170707.html">
                        <img width="170" height="161" src="http://img04.taobaocdn.com/bao/uploaded/i4/T1mTHTXnhlXXaR_ow3_051446.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/16118170707.html">包邮2012秋冬新品韩版热卖大码女装带帽字母套头百搭加绒长款卫衣</a></p>
                        <p class="price">$17.74</p>
                        <p class="bought">(19464 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/15534394290.html">
                        <img width="170" height="161" src="http://img03.taobaocdn.com/bao/uploaded/i3/T19WDTXa0eXXbaSPzX_085651.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/15534394290.html">打底衫 2012秋冬装新品韩版大码修身高领长袖打底衫女t恤款T上衣</a></p>
                        <p class="price">$15.81</p>
                        <p class="bought">(23090 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/19887860787.html">
                        <img width="170" height="161" src="http://img03.taobaocdn.com/bao/uploaded/i3/T16yvWXftjXXbyEuU9_103243.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/19887860787.html">2011大码女装秋冬装新款保暖不倒绒打底裤女士加厚加绒九分女裤子</a></p>
                        <p class="price">$7.39</p>
                        <p class="bought">(52089 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/14926307294.html">
                        <img width="170" height="161" src="http://img03.taobaocdn.com/bao/uploaded/i3/T1..DxXc8pXXX9fvTb_124048.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/14926307294.html">包邮 Notyet帆布鞋男 高帮韩版潮男鞋 潮流板鞋男棉鞋 男士休闲鞋</a></p>
                        <p class="price">$31.94</p>
                        <p class="bought">(4762 customers bought)</p>
                    </li>
                   <li>
                    	<a href="http://127.0.0.50:82/item/16129990587.html">
                        <img width="170" height="161" src="http://img02.taobaocdn.com/bao/uploaded/i2/T1fgfCXb8iXXc_D0wU_013945.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/16129990587.html">Mr.ing袋鼠阿酷 时尚潮流保暖加绒情侣高帮工装短雪地靴F1202^@^</a></p>
                        <p class="price">$74.03</p>
                        <p class="bought">(3808 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/13229218357.html">
                        <img width="170" height="161" src="http://img01.taobaocdn.com/bao/uploaded/i1/T1N2zWXiljXXc.Umw6_063015.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/13229218357.html">no1dara 秋冬装韩版男毛衣 男装针织衫 男假两件毛线衣 男士毛衣</a></p>
                        <p class="price">$31.94</p>
                        <p class="bought">(19461 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/15816445809.html">
                        <img width="170" height="161" src="http://img03.taobaocdn.com/bao/uploaded/i3/T1NeojXXpdXXcYEA34_053637.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/15816445809.html">昂达V702双核版 8G 7寸双核平板1024*600平板电脑【限量送耳机】</a></p>
                        <p class="price">$96.61</p>
                        <p class="bought">(1546 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/14002341549.html">
                        <img width="170" height="161" src="http://img04.taobaocdn.com/bao/uploaded/i4/T1FkmWXXRbXXXf5J39_103136.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/14002341549.html">现金返还！包邮7寸16G纯平平板电脑领秀D8安卓4.03无线3G上网</a></p>
                        <p class="price">$49.84</p>
                        <p class="bought">(2513 customers bought)</p>
                    </li>
                    <!--20-->
                    <li>
                    	<a href="http://127.0.0.50:82/item/4239480343.html">
                        <img width="170" height="161" src="http://img01.taobaocdn.com/bao/uploaded/i1/T1i_H5XjJjXXbRo3ZW_023553.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/4239480343.html">沙雅利 民族复古女人内衣 桑蚕丝彩绘性感真丝肚兜丁字裤套装</a></p>
                        <p class="price">$14.19</p>
                        <p class="bought">(89 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/17806975684.html">
                        <img width="170" height="161" src="http://img01.taobaocdn.com/bao/uploaded/i1/T18Wz6XdpeXXbj4hwZ_032520.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/17806975684.html">可爱女款 夏威夷风 牛奶冰丝波点性感蕾丝少女内衣文胸套装</a></p>
                        <p class="price">$15.97</p>
                        <p class="bought">(2481 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/15641647863.html">
                        <img width="170" height="161" src="http://img01.taobaocdn.com/bao/uploaded/i1/T171qUXbXtXXXAFLDb_124028.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/15641647863.html">【棉之乐】 大气英伦风 格子 全棉 纯棉 男士手帕手绢</a></p>
                        <p class="price">$2.42</p>
                        <p class="bought">(66 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/10056511276.html">
                        <img width="170" height="161" src="http://img04.taobaocdn.com/bao/uploaded/i4/T1qb99XX8fXXXSzPo7_065242.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/10056511276.html">XINCLUBNA 【满50包邮】男士西装衬衫口袋巾 方巾 胸巾 手帕F02</a></p>
                        <p class="price">$1.61</p>
                        <p class="bought">(72 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/15328279244.html">
                        <img width="170" height="161" src="http://img01.taobaocdn.com/bao/uploaded/i1/T1pbweXhxhXXXBYOQ1_041546.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/15328279244.html">艾得莱德 白银银条 千足银999纯银银锭 白银银砖投资收藏银块10克</a></p>
                        <p class="price">$32.26</p>
                        <p class="bought">(93 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/15890763772.html">
                        <img width="170" height="161" src="http://img03.taobaocdn.com/bao/uploaded/i3/T14ULfXcNuXXXeW1s1_040706.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/15890763772.html">艾得莱德 投资银条 龙年千足银999纯银刻字银锭 50克白银银砖礼物</a></p>
                        <p class="price">$154.84</p>
                        <p class="bought">(5 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/12788609831.html">
                        <img width="170" height="161" src="http://img02.taobaocdn.com/bao/uploaded/i2/T1v5jBXiNlXXbe34Lb_094309.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/12788609831.html">孕妇连裤袜秋冬打底裤加大码孕妇打底袜孕妇丝袜厚孕晚期孕妇袜子</a></p>
                        <p class="price">$4.52</p>
                        <p class="bought">(464 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/10783089000.html">
                        <img width="170" height="161" src="http://img01.taobaocdn.com/bao/uploaded/i1/T1EsnyXltcXXbFOXE0_033842.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/10783089000.html">小哈健 超人气孕妇帽子产妇帽 月子帽 孕妇帽 月子帽 月子必备</a></p>
                        <p class="price">$3.23</p>
                        <p class="bought">(489 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/18993344882.html">
                        <img width="170" height="161" src="http://img03.taobaocdn.com/bao/uploaded/i3/T1KUrsXb8tXXb6DGcY_025337.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/18993344882.html">【伊优诺克】M魔法消息钟 夜光电子闹钟 （万年历温度表贪睡钟）</a></p>
                        <p class="price">$10.65</p>
                        <p class="bought">(24 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/15211067507.html">
                        <img width="170" height="161" src="http://img04.taobaocdn.com/bao/uploaded/i4/T1dy95XiBaXXbBfag5_054614.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/15211067507.html">8折~高档象牙瓷座钟 欧式家居客厅装饰时钟表 时尚创意陶瓷台钟</a></p>
                        <p class="price">$50.32</p>
                        <p class="bought">(11 customers bought)</p>
                    </li>
                     <!--30-->
                     <li>
                    	<a href="http://127.0.0.50:82/item/6339744051.html">
                        <img width="170" height="161" src="http://img04.taobaocdn.com/bao/uploaded/i4/T1kh_1Xk8lXXbx2O3__110020.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/6339744051.html">爱华仕拉杆包 拉杆箱男 大容量旅行箱包拉杆 女旅行袋 可调节大小</a></p>
                        <p class="price">$56.29</p>
                        <p class="bought">(1852 customers bought)</p>
                    </li>
                    <li>
                    	<a href="http://127.0.0.50:82/item/13765300203.html">
                        <img width="170" height="161" src="http://img02.taobaocdn.com/bao/uploaded/i2/T1lATvXnRiXXXPZ_3._083601.jpg_b.jpg">
                        </a>
                        <p class="title"><a href="http://127.0.0.50:82/item/13765300203.html">淘派热卖包包2012新款女包韩版潮特价单肩斜跨时尚百搭流苏黑色大</a></p>
                        <p class="price">$31.94</p>
                        <p class="bought">(13679 customers bought)</p>
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>