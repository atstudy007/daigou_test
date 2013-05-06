    <div class="indexleft">
        <?php $this->load->view('guide/guide_left'); ?>
    </div><!--end indexleft-->
    <div class="indexright">
      <div class="shoppinglist" style="border:1px #ccc solid">
          <table style="margin:0 auto" width="100%" border="0" align="center" cellpadding="0" cellspacing="2" bgcolor="#FFFFFF">
                <tbody>
                    <?php foreach($list as $v): ?>
                    <tr>
                      <td height="30" bgcolor="#FAFAFA">
                      　· 
                      <a href="<?php echo $v['type'] == 1 ? site_url('guide/view/'.$v['alias']) : $v['url'].'" target="_blank"'; ?>">
					  	<?php echo $v['title']; ?>
                      </a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
            	</tbody>
           </table>
      </div>
</div>

</div>
