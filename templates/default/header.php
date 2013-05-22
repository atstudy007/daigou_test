<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="wot-verification" content="edf20f2b1f5cba9120d7"/>
<meta name="norton-safeweb-site-verification" content="aap7qekz0zxg-mbun58o6swgas87v-ohva90j6z6p7rag-70347rh-l3j8f9zed62xn7yx716q2w7fez4mcu79rjz-quv2rmhjkfab1k7np4djbe3lffeaab6ss84aqo" />
<meta name="google-site-verification" content="5QY421EM-ouskn6vwousGQk5cjKK2o5V0W1mQknoszw" />
<?php if ($this->uri->segment(1) == FALSE): ?>
<meta name="Description" content="Taobao Agent frugirls.com is frugal taobao english online with 5% service charge and 50% postage fee. We are your private taobao english agent and assit you to buy from taobao." />
<?php endif; ?>
<title><?php echo $this->settings->item('site_name'); ?></title>
<base href="<?php echo base_url().'templates/'.$this->settings->item('site_theme').'/'; ?>" />
<link href="images/global.css" rel="stylesheet" type="text/css" />
<link href="images/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript">var base_url = '<?php echo base_url(); ?>';</script>
  
<!--[if IE 6]>
<script type="text/javascript" src="js/DD_belatedPNG.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('.pngfix');
</script> 
<![endif]-->
</head>

<body>
<div class="wrap">
	<div class="top clearfix">
    	<div class="nav">
        	<div class="bg n_l left"></div>
            <div class="n_c left">
            	<div class="left">
                	<ul>
                    	<?php if ( ! $GLOBALS['member']): ?>
                    	<li><a href="<?php echo site_url('member/login'); ?>">Sign In</a></li>
                        <li class="last"><a href="<?php echo site_url('member/register'); ?>">Register</a></li>
                        <?php else: ?>
                        <li class="last">Welcome: <?php echo $GLOBALS['member']->username; ?>,<a href="<?php echo site_url('member/logout'); ?>">Logout</a></li>
						<?php endif; ?>
                    </ul>
                </div>
                <div class="left" style="line-height:32px;margin-left:20px;"><img style="margin-top:10px;width:18px; height:12px" src="images/sg.gif" />&nbsp;<b>1SGD=<?php echo round($GLOBALS['taobao']['system']['rate'],2); ?>CNY</b></div>
                <div class="right">
                	<ul>
                    	<li><a href="<?php echo site_url(); ?>">Home</a></li>
                        <li><a href="<?php echo site_url('company/about'); ?>">About</a></li>
                        <li id="uc">
                        	<a href="<?php echo site_url('member/info'); ?>">My Acount</a>
                            <ul>
                            	<li><a href="<?php echo site_url('member/info'); ?>">Account Info</a></li>
                                <li><a href="<?php echo site_url('my/orders'); ?>">Purchase Orders</a></li>
                                <li><a href="<?php echo site_url('my/deliveries'); ?>">Delivery Orders</a></li>
                                <li><a href="<?php echo site_url('my/favorites'); ?>">Favorites</a></li>
                                <li><a href="<?php echo site_url('my/logistic'); ?>">Address Records</a></li>
                                <li><a href="<?php echo site_url('my/inviter'); ?>">Recommend to Friends</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo site_url('guide'); ?>">Help Center</a></li>
                        <li class="last"><a href="<?php echo site_url('guide/channel/tools'); ?>">Tools</a></li>
                    </ul>
                </div>
            </div>
            <div class="bg n_r left"></div>
            <div class="clear"></div>
        </div>
        <div class="bg cart">
        	<div class="item" >
            	<a id="topitem" href="<?php echo site_url('cart'); ?>">
                	Shopping Cart
                    <div class="cartdetail" id="cartdetail" style="display:none"></div>
                </a>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <!--logo 快速下订单 分享-->
    <div class="header">
    	<div class="logo left">
        	<a href="<?php echo site_url(); ?>"><img border="0" alt="frugirls.com logo" src="images/logo.png" /></a>
        </div>
        <div class="quickurl left clearfix">
        	<form method="post" action="<?php echo site_url('quick'); ?>">
            <div class="bg i_l left"></div>
            <div class="i_c left"><input type="text" id="quick_order_url" name="url" autocomplete="off" value="Please Enter Goods Url Here!"/></div>
            <div class="bg i_r left"></div>
            <div class="i_s left"><input type="submit" class="bg sub"  value=""/></div>
            </form>
            <div class="clear"></div>
        </div>
        <div class="share right" style="width:180px;padding-top:10px">
        	<?php $this->load->view('include/social_share'); ?>
            <div id="google_translate_element" style="padding:10px 0 0 10px"></div>
			<script>
                function googleTranslateElementInit() {
                  new google.translate.TranslateElement({
                    pageLanguage: 'zh-CN',
					layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                  }, 'google_translate_element');
                }
            </script>
            <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        </div>
        <div class="clear"></div>
    </div>
        <div class="bg menu">
    	<div class="allcategories left"  id="allcat" onclick="location='<?php echo site_url('sitemap'); ?>';">
        <?php if ($this->uri->rsegment(1) . '/' . $this->uri->rsegment(2) != 'home/index'): ?>
			<script language="javascript">
				$("#allcat").hover(function(){
					$("#allcat").css('z-index','14');
					$(".indexcat").css('z-index','14');
					$(".indexcat").show();		
				},function(){
					$(".indexcat").hide();			
				});
            </script>
            <div class="indexcat" style="display:none; position:absolute;top:47px;left:0px;" >
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
            <?php endif; ?>        
        </div>
        <div class="globalmenu left">
        	<ul>
                <li><a href="<?php echo site_url('guide/channel/payment-and-charge'); ?>">Payment & Charge</a></li>
                <li><a href="<?php echo site_url('guide/channel/transportation'); ?>">Transportion</a></li>
                <li><a href="<?php echo site_url('guide/channel/order-instruction'); ?>">Order Instruction</a></li>
                <li><a href="<?php echo site_url('guide/channel/customer-service'); ?>">Customer Service</a></li>
            </ul>
        </div>
        <div class="clear"></div>
   	</div>
    <!--搜索-->
    <div class="bg search">
    <form id="s8" method="get" target="_blank" action="<?php echo site_url('search'); ?>">
    	<div class="allcate">
        	<div class="catselect left" id="catselect"></div>
            <input type="hidden" value="all" id="catid" name="Cid"/>
        	<div class="catname left" id="search_cate">
				<?php $search_cid = $this->input->get('Cid') ? $this->input->get('Cid') : 'all';  ?>
               <span  id="catname"> <?php echo $search_cid == 'all' ? 'All Categories' : $GLOBALS['category']['all'][$search_cid]; ?></span>
                <div class="catlist" id="catlist" style="display:none;">
                <ul>
                    <li rel="all">All Categories</li>
                    <?php foreach ($GLOBALS['category']['relations'] as $cat): ?>
                    <li rel="<?php echo $cat['cid']; ?>">
                        <?php echo $GLOBALS['category']['all'][$cat['cid']]; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            </div>
            
        </div>
         
        <div class="keywords">
        	<input type="text" value="" name="Keyword" autocomplete="off"  />
       	</div>
        <div class="submit">
        	<input type="submit" value="" />
        </div>
    </form>
    </div>
	<div class="clear"></div>
    <!--
    <?php foreach($GLOBALS['category']['relations'] as $cat):  ?>
    <?php if($cat['children']): ?>
    <div id="secondcat_<?php echo $cat['cid'] ?>" class="indexsecondcat" style="display:none;">
    	<ul>
        <?php foreach ($cat['children'] as $cate): ?>
        	<li><a href="<?php echo site_url('category/'.$cate); ?>"><?php echo $GLOBALS['category']['all'][$cate]; ?></a></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    -->
	
