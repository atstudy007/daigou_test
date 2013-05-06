<link href="images/member.css" rel="stylesheet" type="text/css" />
           <div id="login">
            <?php if (isset($msg) AND $msg): ?>
            	<p style="padding:20px;color:red;font-size:14px;font-weight:bold"><?php echo $msg; ?></p>
			<?php endif; ?>
            <h1  class="super colorA10">Delivery Confirmation</h1>
            <form action="<?php echo site_url('trade/delivery/create') ?>" method="post" onsubmit="return check_delivery_form();">
            <input name="express" value="<?php echo $express; ?>" type="hidden" />
            <input name="country" value="<?php echo $country; ?>" type="hidden" />
            <table  border="0" cellpadding="0" cellspacing="0" class="form listtable" >
                <tr>
                	<td><b>Express</b></td>
                    <td class="color666">
						<?php echo $express; ?>&nbsp;(Delivery will take <?php echo $express_data['days']; ?>)<br />
                    	First：<?php echo $express_data['kg'] ?>Kg<br />
                        First postage：$<?php echo dollar($express_data['fee']); ?><br />
                        Continued postage：$<?php echo dollar($express_data['extra']); ?><br />
                        Max weight：<?php echo $express_data['max'] ?>Kg
                    </td>
                </tr>
                <tr>
                	<td><b>Country</b></td>
                    <td class="color666"><?php echo $countries[$country]; ?></td>
                </tr>
                <tr>
                	<td><b>Weight</b></td>
                    <td class="color666"><?php echo $weight; ?>KG</td>
                </tr>
                <tr>
                	<td><b>Purchase Fee</b></td>
                    <td class="color666">$<?php echo dollar($money); ?></td>
                </tr>
                <tr>
                	<td><b>Service Fee</b></td>
                    <td class="color666" style="font-weight:bold">
                    	<?php $_discount = 1; ?>
                    	<?php if (isset($GLOBALS['member']->level['discount']) AND $GLOBALS['member']->level['discount'] > 0):?>
                        <p>You are <?php echo $GLOBALS['member']->level['name'] ?>,your service discount is <?php echo $GLOBALS['member']->level['discount']*100; ?>%.</p>
                        <?php $_discount *= $GLOBALS['member']->level['discount']; ?>
						<?php endif; ?>
                        <?php if ($is_first_service_discount): ?>
                        <p>You can have extra service discount <?php echo $GLOBALS['taobao']['system']['invite']*100; ?>% this time.</p>
                        <?php $_discount *= $GLOBALS['taobao']['system']['invite']; ?>
						<?php endif; ?>
                        $<?php echo $_service_fee = dollar(get_service_fee(TRUE, $money, $_discount)); ?>
                    </td>
                </tr>
                <tr>
                	<td><b>Tax Fee</b></td>
                    <td class="color666" style="font-weight:bold">$<?php echo dollar($money * $GLOBALS['taobao']['system']['tax']); ?></td>
                </tr>
                <tr>
                    <td><b>Express Fee</b></td>
                    <td class="color666" style="font-weight:bold">$<?php echo dollar($detail_money); ?></td>
                </tr>
           </table><br /><br />
           <h1  class="super colorA10">Express Fee Detail</h1>
           <table  border="0" cellpadding="0" cellspacing="0" class="form listtable" >
                <tr>
                    <th>Package</th>
                    <th class="color666" height="26">Weight</th>
                    <th class="color666">Express Fee</th>
                </tr>
                <?php if ( ! $overweight): ?>
                <tr>
                    <td>1</td>
                    <td class="color666" height="26"><?php echo $weight; ?>KG</td>
                    <td class="color666">$<?php echo dollar(express_calculator($weight, $express_data)); ?></td>
                </tr>
                <?php else: ?>
                <?php foreach ($detail as $_k => $d): ?>
                <tr>
                    <td><?php echo $_k+1; ?></td>
                    <td class="color666" height="26"><?php echo $d; ?>KG</td>
                    <td class="color666">$<?php echo dollar(express_calculator($d, $express_data)); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
           </table><br /><br />
           <h1 class="super colorA10">Order Detail</h1>
           <table  border="0" cellpadding="0" cellspacing="0" class="form listtable" >
                <tr style="border-bottom:1px #cccccc solid">
                    <th>Order No.</th>
                    <th class="color666" height="26">Product</th>
                    <th class="color666" height="26">Name</th>
                    <th class="color666">Price</th>
                    <th class="color666">Express Fee</th>
                    <th class="color666">Quantity</th>
                    <th class="color666">Property</th>
                </tr>
				<?php foreach ($orders as $order): ?>
                <tr style="background:#f7f7f7;">
                	<td>No.<?php echo $order->id; ?></td>
                    <td colspan="6">
                    <input type="hidden" name="order[]" value="<?php echo $order->id; ?>"/>
                    </td>
                </tr>
					<?php foreach($order->lists as $v): ?>
                    <tr style="border-bottom:1px #cccccc solid">
                    <td>&nbsp;</td>
                         <td><a href="<?php echo site_url('item/'.$v->productid); ?>"><img width="50" height="50" src="<?php echo $v->pic_url."_b.jpg"; ?>" /></a></td>
                        <td height="26"><a href="<?php echo site_url('item/'.$v->productid); ?>"><?php echo $v->name; ?></a></td>
                        <td>$<?php echo dollar($v->price); ?></td>
                        <td>$<?php echo dollar($v->express_fee); ?></td>
                        <td style="color:red"><?php echo $v->qty; ?></td>
                        <td><?php echo $v->options; ?></td>
                        
                    </tr>
                    <?php endforeach;?>      
                <?php endforeach; ?>
           </table><br /><br />
           <h1 class="super colorA10">Select Address</h1>
           <table  border="0" cellpadding="0" cellspacing="0" class="form listtable" >
                <tr>
                    <td><b>Select Address</b></td>
                    <td class="color666" height="26">
                    	<p>Make sure you have address in country:<b><?php echo $countries[$country]; ?></b></p>
                    	<?php foreach($logistics as $v): ?>
                    	<p class="break"><input type="radio" name="logistics" value="<?php echo $v->id ?>" <?php echo $v->country == $country ? '' : 'disabled="disabled"'; ?>  />
                        <?php echo $v->name.','.$countries[$v->country].'&nbsp;'.$v->state.'&nbsp;'.$v->city.$v->address.','.$v->phone; ?></p>
                        <?php endforeach; ?>
                        <hr />
                        <p><input type="radio" name="logistics" value="new" />Use New Address</p>
                        <table style="width:650px;display:none" id="new_address">
                        	<tr>
                            	<td>Recipient's name:</td>
                                <td><input name="logistics_name" class="address_required" style="width:300px" />*</td>
                            </tr>
                            <tr>
                            	<td>Tel:</td>
                                <td><input name="logistics_phone" class="address_required" style="width:300px" />*</td>
                            </tr>
                            <tr>
                            	<td>State:</td>
                                <td><input name="logistics_state" class="address_required"  style="width:300px"/>*</td>
                            </tr>
                            <tr>
                            	<td>City:</td>
                                <td><input name="logistics_city" class="address_required" style="width:300px" />*</td>
                            </tr>
                            <tr>
                            	<td>PostCode:</td>
                                <td><input name="logistics_postcode" class="address_required" style="width:300px" />*</td>
                            </tr>
                            <tr>
                            	<td>Detailed Address:</td>
                                <td><input name="logistics_address" class="address_required" style="width:300px" />*</td>
                            </tr>
                            
                        </table>
                    </td>
                </tr>
                <td colspan="6" align="center">
                  <button type="submit" class="red white pointer b">Go</button>
                </td>
                </tr>
           </table>
    		</form>
            </div>
                
</div>
<script language="javascript">
	$('input[name="logistics"]').change(function(){
		if ($(this).val() == 'new')
		{
			$('#new_address').show();	
		}
		else
		{
			$('#new_address').hide();		
		}
	});
	function check_delivery_form()
	{
		target = $('input[name="logistics"]:checked').val();
		if (target == 'new')
		{
			flag = true;
			$('.address_required').each(function(i,v){
				if ($(v).val() == '')
				{
					alert('Please fill in address form!');
					flag = false;
					return false;	
				}
			});
			return flag;
		}
		else
		{
			if ( ! target)
			{
				alert('Please select address!');	
				return false;
			}
		}
		return true;
	}
</script>