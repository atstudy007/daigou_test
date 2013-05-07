    <div class="indexleft">
        <div class="ralatedcat">
        	<div class="bg catname"><a href="<?php echo site_url('news'); ?>">News Center</a></div>
            <?php $this->load->view('include/service_box'); ?>
        </div>
    </div><!--end indexleft-->
    <div class="indexright">
      <div class="shoppinglist" style="border:1px #ccc solid">
          <table style="margin:0 auto" width="100%" border="0" align="center" cellpadding="0" cellspacing="2" bgcolor="#FFFFFF">
                <tbody>
                    <?php foreach($news as $v): ?>
                    <tr>
                      <td height="30" bgcolor="#FAFAFA">
                      　· 
                      <a href="<?php echo site_url('news/'.$v->id); ?>">
					  	<?php echo $v->title; ?>
                      </a>
                      &nbsp;[<?php echo date('Y-m-d H:i:s', $v->create_time); ?>]
                      </td>
                    </tr>
                    <?php endforeach; ?>
            	</tbody>
           </table>
      </div>
</div>

</div>
