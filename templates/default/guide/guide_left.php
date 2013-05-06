		<div class="ralatedcat">
        	<div class="bg catname">FAQ</div>
        </div>
        <?php foreach($guide['guide'] as $v): ?>
        <div  class="blank10"></div>
        <div class="box">
        	<div class="bg boxcat" onclick="$(this).next().toggle();"><a href="<?php echo site_url('guide/channel/'.$v['alias']); ?>"><?php echo $v['name']; ?></a></div>
            <div class="info_left" style="border:none">
                <ul>
                	<?php foreach ($GLOBALS['footer_faq'] as $faq): ?>
                    <?php if ($faq->classid == $v['classid']): ?>
                    <li><a href="<?php echo site_url('guide/view/'.$faq->alias); ?>"><?php echo $faq->title; ?></a></li>
					<?php endif; ?>
                    <?php endforeach; ?>
                </ul>
        	</div>
		</div>
        <?php endforeach; ?>
