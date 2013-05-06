<link href="images/member.css" rel="stylesheet" type="text/css" />
           <div id="login">
            <h1  class="super colorA10">Shopping Cart</h1>
            <?php if($checkout['total'] > 0) : ?>
            <form action="<?php echo site_url('my/cart') ?>" method="post" id="cart_form">
            <table  border="0" cellpadding="0" cellspacing="0" class="form color999 listtable" >
                <tbody>
                <tr style="border-bottom:1px #cccccc solid">
                	<Th>Product</Th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Property</th>
                    <th>Total</th>
                    <th>Express fee</th>
                    <th>&nbsp;</th>
                </tr>
                 <?php foreach($checkout['sellers'] as $key=>$seller): ?>
                 <tr style="background:#f5f5f5; ?>">
                 	<td colspan="20">Seller : <a href="<?php echo site_url('shop/'.urlencode($key)); ?>"><b><?php echo $key; ?></b></a></td>
                 </tr>
                 <?php foreach($seller['rows'] as $row_key=>$row): ?>
                 <tr id="<?php echo $row; ?>" style="background:#ffffff" >
                	<td><a href="<?php echo site_url('item/'.$checkout['cart'][$row]['info']->num_iid); ?>"><img src="<?php echo $checkout['cart'][$row]['info']->pic_url."_b.jpg"; ?>"  width="50" height="50" border="0" /></a></td>
                    <td><a href="<?php echo site_url('item/'.$checkout['cart'][$row]['info']->num_iid); ?>"><?php echo $checkout['cart'][$row]['info']->title; ?></a></td>
                    <td>$<?php echo dollar($checkout['cart'][$row]['info']->price); ?></td>
                    <td style="color:red"><input type="text" name="qty[]" style="width:20px" value="<?php echo $checkout['cart'][$row]['qty']; ?>" /><?php echo ($checkout['cart'][$row]['info']->can_buy ? '' : 'Short Inventory:'.$checkout['cart'][$row]['info']->num); ?></td>
                    <td><?php echo $checkout['cart'][$row]['options']; ?></td>
                    <td>$<?php echo dollar($checkout['cart'][$row]['info']->_cash); ?></td>
                    <?php if ($row_key == 0):  ?>
                    <td rowspan="<?php echo count($seller['rows']); ?>">$<?php echo dollar($seller['express_fee']); ?></td>
                    <?php endif; ?>
                    <td><a href="javascript:void(0)" onclick="del_cart('<?php echo $row; ?>');">Remove</a><input type="hidden" name="id[]" value="<?php echo $row; ?>" /></td>
                </tr>	
				 <?php endforeach; ?>
                 <?php endforeach; ?>
                <tr >
                	<td colspan="8" align="right">
						Total:
                        <b class="price">
                        	$<?php echo $checkout['total_cash'] > 0 ? dollar($checkout['total_cash']) : ''  ; ?>
                        </b></td>
                       
                </tr>
                <tr>
                <td colspan="8" align="center">　
                  <button type="submit" class="red white pointer strong">Save</button>
                  <?php if($GLOBALS['member']): ?>
                  <?php if($checkout['can_buy']): ?>
                      <button type="button" class="red white pointer strong" onclick="if (confirm('confirm to purchase?')){location='<?php echo site_url('trade/checkout'); ?>';}">Generate Order</button>
                  <?php else: ?>
                        <?php echo ($checkout['can_qty_buy'] ? '' : 'No enough inventory!'); ?>
                  <?php endif; ?>
                <?php else : ?>
                    <button type="button" onclick="location='<?php echo site_url('member/login'); ?>'" class="red white pointer strong">Login to Proceed</button>
                <?php endif; ?>
                </td>
                </tr>
               </tbody>
           </table>
    		</form>
          <?php else: ?>
          	<div align="center">No item in your shopping cart!</div>
          <?php endif; ?>
            </div>
                
</div>
<script> 
$(document).ready(function() { 
	$('listtable tr:even').addClass('oushu'); //奇偶变色，添加样式 
}); 
</script> 
        <!--end of main -->