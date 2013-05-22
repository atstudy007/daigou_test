<link href="images/member.css" rel="stylesheet" type="text/css" />
    <div class="indexleft">
        <!--二级分类-->
        <?php $this->load->view('member/left'); ?>
        
    </div><!--end indexleft-->
    <div class="indexright">
      <div class="shoppinglist" style="border:1px #ccc solid">
            <h1  class="super colorA10">Order Detail:</h1>
            <table width="90%"  border="0" cellpadding="0" cellspacing="0" class="form color999" >
                <tr style="border-bottom:1px #cccccc solid">
                    <td class="color666" height="26"><b>No.</b></td>
                    <td class="color666" height="26"><?php echo $order->id;; ?></td>
                    <td class="color666" height="26"><b>Status</b></td>
                    <td class="color666" height="26">
                    	<?php echo $status[$order->status].'('.date('Y-m-d H:i:s',$order->status_time).')'; ?>
                    	<?php if ($order->status == ORDER_UNPAYED): ?>
                        <a href="<?php echo site_url('trade/cancel/p/'.$order->id); ?>" style="font-weight:bold;font-size:14px;color:#000000">Cancel</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr style="border-bottom:1px #cccccc solid">
                    <td class="color666" height="26"><b>Purchase Fee</b></td>
                    <td class="color666" height="26" colspan="1" valign="middle"><span class="price">S$<?php echo dollar($order->money); ?></span></td>
                    <td class="color666" height="26" colspan="2" valign="middle">
                    </td>
                </tr>
                <tr style="border-bottom:1px #cccccc solid">
                    <td class="color666" height="26"><b>Weight</b></td>
                    <td class="color666" height="26" colspan="3">
                        <?php echo $order->weight ? $order->weight.'KG' : '-'; ?>
                    </td>
                </tr>
            </table><br /><br />
            <h1  class="super colorA10">Payment: </h1>
            <table width="90%"  border="0" cellpadding="0" cellspacing="0" class="form color999" >
                <tr style="border-bottom:1px #cccccc solid">
                    <td class="color666" height="26"><b>Pay by PayPal:</b></td>
                    <td class="color666" height="26" colspan="2" valign="middle">
                        <?php if ($order->status == ORDER_UNPAYED): ?>
                        	<a href="<?php echo site_url('pay/paypal/checkout/p/'.$order->id); ?>">
                                <img src="images/taobao/btn_xpressCheckout.gif" border="0" />
                            </a>
                            <span style="line-height:50px;color:red">Notice:extra fee (<b>3.9%+$0.3</b>) will be charged!</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr style="border-bottom:1px #cccccc solid">
                    <td class="colorA10" height="26"><b>Or</b></td>
                </tr>
                <tr style="border-bottom:1px #cccccc solid">
                    <td class="colorA10" height="26"><b>Pay by iBanking:</b></td>
                    <td class="color666" height="26" colspan="2" valign="middle">
                        
                    </td>
                </tr>
                
            </table><br /><br />
            <h1  class="super colorA10">Products: </h1>
            <table width="90%"  border="0" cellpadding="0" cellspacing="0" class="form listtable" >
                <tr>
                 	<th class="color666">Product</th>
                    <th class="color666" height="26">Name</th>
                    <th class="color666">Price</th>
                    <th class="color666">Express Fee</th>
                    <th class="color666">Quantity</th>
                    <th class="color666">Property</th>
                </tr>
                <?php foreach($order->lists as $key=>$v): ?>
                 <tr style="background:<?php echo $key%2 == 0 ? '#ffffff' : '#f7f7f7'; ?>">
                <td><a href="<?php echo site_url('item/'.$v->productid); ?>"><img width="50" height="50" src="<?php echo $v->pic_url."_b.jpg"; ?>" /></a></td>
                    <td height="26"><a href="<?php echo site_url('item/'.$v->productid); ?>"><?php echo $v->name; ?></a></td>
                    <td>$<?php echo dollar($v->price); ?></td>
                    <td>$<?php echo dollar($v->express_fee); ?></td>
                    <td style="color:red"><?php echo $v->qty; ?></td>
                    <td><?php echo $v->options; ?></td>
                </tr>
                <?php endforeach;?>
            </table><br />
      </div>
      </div>

</div>
