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
                        <?php if ($order->status == ORDER_UNPAYED): ?>
                        	<a href="<?php echo site_url('pay/paypal/checkout/p/'.$order->id); ?>">
                                <img src="images/taobao/btn_xpressCheckout.gif" border="0" />
                            </a>
                            <span style="line-height:50px;color:red">Notice:extra fee (<b>3.9%+$0.3</b>) will be charged!</span>
                        <?php endif; ?>
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
                <div id="tabs">
                    <ul>
                      <li><a href="#tabs-1">Nunc tincidunt</a></li>
                      <li><a href="#tabs-2">Proin dolor</a></li>
                      <li><a href="#tabs-3">Aenean lacinia</a></li>
                    </ul>
                    <div id="tabs-1">
                      <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
                    </div>
                    <div id="tabs-2">
                      <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
                    </div>
                    <div id="tabs-3">
                      <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
                      <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
                    </div>
                </div>
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
