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
                        <form method="get" action="<?php echo site_url('my/orders'); ?>">
                        <tr>
                        	<td colspan="10">Order NO.: <input name="orderid" value="<?php echo (isset($_REQUEST['orderid']) ? $_REQUEST['orderid'] : ''); ?>"  />
                            Status:<select name="status">
                                	<?php foreach($status as $k=>$v): ?>
                                	<option <?php echo $k==$current ? 'selected="selected"' : ''; ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <input type="submit" value="Search" />
                            <b></b>
                            </td>
                        </tr>
                        </form>
                        <?php if ($this->nsession->flashdata('msg'))://如果有提示信息则显示 ?>
                        <tr>
                            	<td colspan="10" style="color:red"><?php echo $this->nsession->flashdata('msg'); ?></td>
                            </tr>
                        <?php endif; ?>
                        <form method="post" action="<?php echo site_url('trade/delivery'); ?>">
                            <tr>
                                <td colspan="10">
                                	Country:
                                    <select name="country">
                                    	<option value="false">--select country--</option>
                                        <!--
                                    	<?php foreach($country as $k => $v): ?>
                                    	<option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                        <?php endforeach; ?>
                                        -->
                                        <option value="SGP" >Singapore</option>
                                    </select>
                                    Express:
                                    <select name="express">	
                                    	<option value="false">--select express--</option>
                                    	<option value="EMS">EMS</option>
                                        <option value="UPS">UPS</option>
                                        <option value="DHL">DHL</option>
                                        <option value="FedEx">FedEx</option>
                                        <option value="TNT">TNT</option>
                                        <option value="Air-Small">Air-Small</option>
                                        <option value="Air-Express">Air-Express</option>
                                        <option value="SAL">SAL</option>
                                    </select>
                                    <input type="submit" value="Delivery" />
                                    &nbsp;
                                    <a href="<?php echo site_url('guide/view/shipping-price'); ?>" target="_blank">Shipping Price</a>
                                </td>
                            </tr>
                            <Tr><td colspan="10">
                            <table class="listtable" cellpadding="0" cellspacing="0">
                            <tr>
                            	<th>&nbsp;</th>
                                <th>Order NO.</th>
                                <th>Fee</th>
                                <th>Weight</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </tr>
                            <?php foreach($orders as $key => $v): ?>
                            <tr style="background:<?php echo $key%2 == 0 ? '#ffffff' : '#f7f7f7'; ?>">
                            	<td>
                                    <input type="checkbox" name="order[]" value="<?php echo $v->id; ?>" <?php echo $v->status == ORDER_ARRIVED && $v->weight ? '' : 'disabled="disabled"';?> />
                                </td>
                                <td><?php echo $v->id; ?></td>
                                <td>S$<?php echo dollar($v->money); ?></td>
                                <td><?php echo $v->weight ? $v->weight.'Kg' : '-'; ?></td>
                                <td><?php  echo $status[$v->status].'('.date('Y-m-d H:i:s',$v->status_time).')'; ?></td>
                                <td><a href="<?php echo site_url('my/order/'.$v->id); ?>">View Detail</a></td>
                            </tr>
                            <?php endforeach; ?>
                            </table></td></Tr>
                        </form>
                        <?php if($pagination): ?>
                        <tr><td colspan="10"><?php echo $pagination; ?></td></tr>
                        <?php endif;?>
                        </table>
                 	 	</div>
</div>
        
<!--end of main -->