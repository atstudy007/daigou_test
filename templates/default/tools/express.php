<link href="images/member.css" rel="stylesheet" type="text/css" />
           <div id="login">
            <h1  class="super colorA10" style="text-align:center">Cost Calculator</h1>
            <?php if (isset($form_ok)): ?>
            <table  border="0" cellpadding="0" cellspacing="0" class="form listtable" id="result" >
            	<?php if ($error): ?>
                <tr><td colspan="10"><span style="font-weight:bold;color:red"><?php echo $error; ?></span></td></tr>
                <?php else: ?>
                <?php $total = $fee; ?>
                <tr>
                	<td><span style="font-weight:bold;">Result</span></td>
                	<td align="right"><a href="javascript:void(0);" onclick="$('#result').remove();">close</a></td>
                </tr>
                <tr>
                	<td><b>Purchase Fee</b></td>
                    <td class="color666">$<?php echo $fee; ?></td>
                </tr>
                <tr>
                	<td><b>Service Fee</b></td>
                    <td class="color666">$<?php echo $_service_fee = dollar(get_service_fee(TRUE, $fee*$GLOBALS['taobao']['system']['rate'])); $total+=$_service_fee;?></td>
                </tr>
                <tr>
                	<td><b>Tax Fee</b></td>
                    <td class="color666">$<?php echo $_tax_fee = round($fee * $GLOBALS['taobao']['system']['tax'],2); $total+=$_tax_fee;?></td>
                </tr>
                <tr>
                	<td><b>Express</b></td>
                    <td class="color666">
                    	<table  border="0" cellpadding="0" cellspacing="0" style="width:650px;" >
                        	<tr>
                            	<th>Company</th>
                                <th>First</th>
                                <th>First postage</th>
                                <th>Continued postage</th>
                                <th>Max weight</th>
                            </tr>
                            <tr>
                            	<td><?php echo $this->input->post('express'); ?></td>
                                <td><?php echo $express_data['kg'] ?>Kg</td>
                                <td>$<?php echo dollar($express_data['fee']); ?></td>
                                <td>$<?php echo dollar($express_data['extra']); ?></td>
                                <td><?php echo $express_data['max'] ?>Kg</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                	<td><b>Package Fee</b></td>
                    <td class="color666">
                    	<table  border="0" cellpadding="0" cellspacing="0" style="width:650px;" >
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
                                <?php $total += dollar($detail_money); ?>
                           </table>
                    </td>
                </tr>
                <tr>
                	<td><b>Total</b></td>
                    <td class="color666">$<?php echo $total;?></td>
                </tr>
				<?php endif; ?>
            </table>
            <?php endif; ?>
            <div class="blank10"></div>
            <form action="<?php echo site_url('tool/cost_calculator'); ?>" method="post">
            <table  border="0" cellpadding="0" cellspacing="0" class="form listtable" >
                <tr><td colspan="10">Total cost = Purchase fee(items fee + domestic shipping fees)  + service fee + tax fee + international shipping fee</td></tr>
                <tr>
                	<td><b>Purchase Fee</b></td>
                    <td class="color666"><input name="fee" value="<?php echo set_value('fee', 0); ?>" style="width:300px;" />&nbsp;USD</td>
                </tr>
                <tr>
                	<td><b>Package Weight</b></td>
                    <td class="color666"><input name="weight" value="<?php echo set_value('weight', 0); ?>" style="width:300px;" />&nbsp;KG</td>
                </tr>
                <tr>
                	<td><b>Select Country</b></td>
                    <td class="color666">
                    	<select name="country">
							<?php foreach($country as $k => $v): ?>
                            <option value="<?php echo $k; ?>" <?php echo set_select('country', $k); ?>><?php echo $v; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><b>Select Express</b></td>
                    <td class="color666">
                    	<select name="express">	
                            <option value="EMS" <?php echo set_select('express', 'EMS'); ?>>EMS</option>
                            <option value="UPS" <?php echo set_select('express', 'UPS'); ?>>UPS</option>
                            <option value="DHL" <?php echo set_select('express', 'DHL'); ?>>DHL</option>
                            <option value="FedEx" <?php echo set_select('express', 'FedEx'); ?>>FedEx</option>
                            <option value="TNT">TNT</option>
                            <option value="Air-Small">Air-Small</option>
                            <option value="Air-Express">Air-Express</option>
                            <option value="SAL">SAL</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                    <td class="color666"><button type="submit" class="red white pointer strong">Calculate</button></td>
                </tr>
           </table>
           </form>
            </div>
                
</div>