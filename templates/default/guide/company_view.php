    <div class="indexleft">
        <div class="ralatedcat">
        	<div class="bg catname">Company</div>
            <ul class="normal">
            	<?php foreach($left as $k => $v): ?>
            	<li <?php echo $alias == $k ? 'class="hover"' : ''; ?>><a href="<?php echo site_url('company/'.$k); ?>"><?php echo $v; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div><!--end indexleft-->
    <div class="indexright" >
      <div class="shoppinglist" style="padding-top:0">
          <div style="line-height:25px;padding-top:20px;">
          	<?php echo $content->content; ?>
          </div>
      </div>
</div>

</div>
