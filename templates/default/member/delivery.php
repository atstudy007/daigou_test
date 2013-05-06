<link href="images/member.css" rel="stylesheet" type="text/css" />
    <div class="indexleft">
        <!--二级分类-->
        <?php $this->load->view('member/left'); ?>
        
    </div><!--end indexleft-->
    <div class="indexright">
      <div class="shoppinglist" style="border:1px #ccc solid">
             <h1  class="super colorA10">Delivery Order Detail:</h1>
            <table width="90%"  border="0" cellpadding="0" cellspacing="0" class="form color999 listtable" >
                <tr style="border-bottom:1px #cccccc solid">
                <td class="color666" height="26"><b>No.</b></td>
                    <td class="color666" height="26"><?php echo $order->id;; ?></td>
                <td class="color666" height="26"><b>Status</b></td>
                    <td class="color666" height="26">
                    	<?php echo $status[$order->status].'('.date('Y-m-d H:i:s',$order->status_time).')'; ?>
                    	<?php if ($order->status == DELIVERY_UNPAYED): ?>
                        <a style="font-weight:bold;font-size:14px;color:#000000" onclick="return confirm('are you sure to cancel the order?');" href="<?php echo site_url('trade/cancel/d/'.$order->id); ?>">Cancel</a>
                        <?php elseif ($order->status == DELIVERY_SHIPMENT_DONE): ?>
                        <a style="font-weight:bold;font-size:14px;color:#000000" onclick="return confirm('are you sure to confirm?');" href="<?php echo site_url('trade/confirm/'.$order->id); ?>">Confirm</a>
						<?php endif; ?>
                    </td>
                </tr>
                <tr style="border-bottom:1px #cccccc solid">
                    <td class="color666" height="26"><b>Fee</b></td>
                    <td class="color666" height="26" colspan="3">
                    	service fee : <span class="price">$<?php echo dollar($order->service_fee); ?></span><br />
                        tax fee : <span class="price">$<?php echo dollar($order->tax_fee); ?></span><br />
                        express fee : <span class="price">$<?php echo dollar($order->ship_fee); ?></span><br />
                        Total : <span class="price">$<?php echo dollar($order->service_fee + $order->tax_fee + $order->ship_fee); ?></span><br />
						<?php if ($order->status == DELIVERY_UNPAYED): ?>
                        	<a href="<?php echo site_url('pay/paypal/checkout/d/'.$order->id); ?>">
                                <img src="images/taobao/btn_xpressCheckout.gif" border="0" style="width:145px;height:42px" />
                            </a>
                            <br />
                            <span style="line-height:50px;color:red">Notice:extra fee (<b>3.9%+$0.3</b>) will be charged!</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr style="border-bottom:1px #cccccc solid">
                    <td class="color666" height="26"><b>Express Company</b></td>
                    <td class="color666" height="26" colspan="3"><?php echo $order->logistics; ?></td>
                </tr>
                <tr style="border-bottom:1px #cccccc solid">
                    <td class="color666" height="26"><b>Address</b></td>
                    <td class="color666" height="26" colspan="3"><?php echo $order->logistics_info; ?></td>
                </tr>
                <tr style="border-bottom:1px #cccccc solid">
                    <td class="color666" height="26"><b>Express Detail.</b></td>
                    <td class="color666" height="26" colspan="3">
                    	<table width="100%" cellpadding="0" cellspacing="0">
                        	<tr>
                            	<td height="26"></td>
                                <td><b>Weight</b></td>
                                <td><b>Fee</b></td>
                                <td><b>Track No.</b></td>
                            </tr>
                            <?php $track_no = @unserialize($order->logistics_no); ?>
                            <?php foreach ($order->packages as $k => $package): ?>
                            <tr>
                            	<td height="26">package <?php echo $k + 1; ?></td>
                                <td><?php echo $package['weight']; ?>kg</td>
                                <td>$<?php echo dollar($package['money']); ?></td>
                                <td>
                                	<?php if ($order->status >= DELIVERY_SHIPMENT_DONE): ?>
                                    <?php echo isset($track_no[$k]) ? $track_no[$k] : '' ; ?>
									<?php else: ?>
                                    -
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php $query_urls = array(
										'EMS'=>'http://www.ems-tracking.net/',
										'UPS'=>'http://www.ups.com/WebTracking/track?loc=en_US&WT.svl=PriNav',
										'DHL'=>'http://www.dhl.com/en/express/tracking.html',
										'FedEx'=>'http://www.fedex.com/Tracking',
										'TNT'=>'http://lit2.tnt.com.cn/tracker/trackandtraceInit.do',
										'Air-Small'=>'http://intmail.183.com.cn/item/itemStatusQuery.do',
										'Air-Express'=>'http://intmail.183.com.cn/item/itemStatusQuery.do',
										'SAL'=>'http://intmail.183.com.cn/item/itemStatusQuery.do'
									);
							?>
                            <?php if ($order->logistics): ?>
                            <tr>
                            	<td><a href="<?php echo $query_urls[$order->logistics]; ?>" target="_blank">Express Tracking</a></td>
                            </tr>
                            <?php endif; ?>
                        </table>
                    </td>
                </tr>
            </table><br />
<br />

             <h1  class="super colorA10">Products: </h1>
           
             <?php foreach($order->lists as $v): ?>
              <table width="90%"  border="0" cellpadding="0" cellspacing="0" class="form color999 listtable" >
                <tr style="border-bottom:1px #cccccc solid">
                    <th class="color666" height="26" colspan="5">Order No. : <?php echo $v->id; ?></th>
                   
                </tr>
               
                <tr style="border-bottom:1px #cccccc solid">

                    <td height="26" colspan="10">
                   	  <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="form " >
                      <tr style="border-bottom:1px #cccccc solid">
                      <td class="color666"> <b>Product</b></td>
                        <td class="color666" height="26"><b>Name</b></td>
                        <td class="color666"><b>Price</b></td>
                        <td class="color666"><b>Express Fee</b></td>
                        <td class="color666"><b>Quantity</b></td>
                        <td class="color666"><b>Property</b></td>
                    </tr>
                      <?php foreach($v->lists as $vv): ?>
                    <tr style="border-bottom:1px #cccccc solid">
                    <td><a href="<?php echo site_url('item/'.$vv->productid); ?>"><img width="50" height="50" src="<?php echo $vv->pic_url."_b.jpg"; ?>" /></a></td>
                        <td ><a href="<?php echo site_url('item/'.$vv->productid); ?>"><?php echo $vv->name; ?></a></td>
                        <td>$<?php echo dollar($vv->price); ?></td>
                        <td>$<?php echo dollar($vv->express_fee); ?></td>
                        <td style="color:red"><?php echo $vv->qty; ?></td>
                        <td><?php echo $vv->options; ?></td>
                    </tr>
                   
                    <?php endforeach;?>
                      </table>
                   </td>
                </tr>
                </table>
					            <br />
<br />
 
                <?php endforeach;?>
            <br />
<br />

    <h1  class="super colorA10">Testimonials details: <a name="#rate" id="rate">&nbsp;</a></h1>
			<?php if ($order->status == DELIVERY_EVALUATED): ?>
            <table width="90%"  border="0" cellpadding="0" cellspacing="0" class="form color999" >
                <tr style="border-bottom:1px #cccccc solid">
                    <td class="color666" height="26">Satisfaction</td>
                    <td class="color666" height="26"><?php echo $order->rate_score; ?></td>
                </tr>
                <tr style="border-bottom:1px #cccccc solid">
                    <td class="color666" height="26">Description</td>
                    <td class="color666" height="26"><?php echo $order->rate_description; ?></td>
                </tr>
            </table>
            <?php elseif($order->status == DELIVERY_CONFIRMED): ?>
            <form action="<?php echo site_url('trade/rate/'.$order->id); ?>" method="post">
            <table width="90%"  border="0" cellpadding="0" cellspacing="0" class="form color999" >
                <tr style="border-bottom:1px #cccccc solid">
                    <td class="color666" height="26">Satisfaction</td>
                    <td class="color666" height="26">
                    	<select name="score">
                        	<option value="1">Very poor</option>
                            <option value="2">Poor</option>
                            <option value="3">Average</option>
                            <option value="4">Good</option>
                            <option value="5" selected="selected">Very good</option>
                        </select>
                    </td>
                </tr>
                <tr style="border-bottom:1px #cccccc solid">
                    <td class="color666" height="26">Description</td>
                    <td class="color666" height="26">
                        <textarea name="description" style="width:500px;height:200px"></textarea>
                    </td>
                </tr>
                <tr style="border-bottom:1px #cccccc solid">
                    <td class="color666" height="26" colspan="2">
                    	<input type="submit" value="submit" />
                    </td>
                </tr>
            </table>
            </form>
			<?php else: ?>
            <h1  class="super colorA10">No Testimonials</h1>
			<?php endif; ?>
            
      </div>
      </div>

</div>
