<link href="images/member.css" rel="stylesheet" type="text/css" />
    <div class="indexleft">
        <!--二级分类-->
        <?php $this->load->view('member/left'); ?>
        
    </div><!--end indexleft-->
    <div class="indexright">
    <!--
       <div class="bg listbar">User Center</div>   
       <div  class="blank10"></div>   --> 
      <div class="shoppinglist" style="border:1px #ccc solid">
                        <table class="info_table form">
                        <form method="get" action="<?php echo site_url('my/deliveries'); ?>">
                        <tr>
                        	<td colspan="10">Order NO.: <input name="orderid" value="<?php echo (isset($_REQUEST['orderid']) ? $_REQUEST['orderid'] : ''); ?>"  />
                            Status: <select name="status">
                                	<?php foreach($status as $k=>$v): ?>
                                	<option <?php echo $k==$current ? 'selected="selected"' : ''; ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <input type="submit" value="Search" />
                            <b></b>
                            </td>
                        </tr>
                        </form>
                        <Tr><td colspan="10"><table class="listtable" cellpadding="0" cellspacing="0">
                        <tr>
                            <th>Order NO.</th>
                            <th>Fee</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                        <?php foreach($orders as $key => $v): ?>
                       <tr style="background:<?php echo $key%2 == 0 ? '#ffffff' : '#f7f7f7'; ?>">
                            <td><?php echo $v->id; ?></td>
                            <td>$<?php echo dollar($v->service_fee+$v->tax_fee+$v->ship_fee); ?></td>
                            <td><?php  echo $status[$v->status].'('.date('Y-m-d H:i:s',$v->status_time).')'; ?></td>
                            <td><a href="<?php echo site_url('my/delivery/'.$v->id); ?>">View Detail</a></td>
                        </tr>
                        <?php endforeach; ?>
                        </table></td></Tr>
                        <?php if($pagination): ?>
                        <tr><td colspan="10"><?php echo $pagination; ?></td></tr>
                        <?php endif;?>
                        </table>
                 	 	</div>
</div>
        
<!--end of main -->