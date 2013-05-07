<div class="clear blank10"></div>
<!---底部-->
<div class="allbottom clearfix">
	<div class="wrap">
    		<?php $class_array = array(1=>'newuser', 2=>'transportation', 3=>'payment', 4=>'guide', 5=>'order', 6=>'customer', 7=>'tools'); ?>
    		<?php foreach ($class_array as $key => $class): ?>
            <div class="linkbox left <?php echo $key == 1 ? 'first' : ''; ?>">
                <div class="bg <?php echo $class; ?>"></div>
                <ul>
                	<?php foreach ($GLOBALS['footer_faq'] as $faq): ?>
                    <?php if ($faq->classid == $key): ?>
                    <li><a href="<?php echo site_url('guide/view/'.$faq->alias); ?>"><?php echo $faq->title; ?></a></li>
                    <?php array_shift($GLOBALS['footer_faq']); ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>
            <div class="clear blank20"></div>
        <!--footer nav-->
        <div class="footernav">
        	<a href="<?php echo site_url('sitemap'); ?>">Site Map</a>|
            <a href="<?php echo site_url('company/contact'); ?>">Contact Us</a>|
            <a href="<?php echo site_url('company/term-of-service'); ?>">Term of serivce</a>|
			<a target="_blank" href="http://www.facebook.com/agentinchina.taobao">agentinchina on facebook</a>|
			<a target="_blank" href="https://twitter.com/#">agentinchina on twitter</a>
        </div>
        <div class="blank10"></div>
        <div style="width:837px;margin:0 auto">
        	<img src="images/p.jpg" />
        </div>
        <div class="copyright">
        	Copyright © sgbabytree.com. Beijing ICP 12013394
        	
        </div>
        <div class="copyright">
			Address:3007 #03-454 Ubi Road 1,Singapore 408701
        </div>
    </div>
</div>
</body>
</html>