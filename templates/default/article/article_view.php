    <div class="indexleft">
        <div class="ralatedcat">
        	<div class="bg catname"><a href="<?php echo site_url('article'); ?>">Articles Center</a></div>
            <?php $this->load->view('include/service_box'); ?>
        </div>
    </div><!--end indexleft-->
    <div class="indexright" >
      <div class="shoppinglist" style="padding-top:0">
          <div class="bg listbar" style="line-height:22px;">
          	<?php echo $article['title']; ?>
          </div>
          <div style="line-height:25px;padding-top:20px;">
          	<?php echo $article['content']; ?>
          </div>
      </div>
</div>

</div>
