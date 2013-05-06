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

                        <table class="info_table form" id="logistic_table">

						<?php if($action == 'list'): ?>
                            <tr><Td colspan="3">

                        <table cellpadding="0" cellspacing="0" width="100%">

                            <?php if($logistics): ?>

                                <?php foreach($logistics as $key=>$v): ?>

                                 <tr style="background:<?php echo $key%2 == 0 ? '#ffffff' : '#f7f7f7'; ?>">

                                    <td width="20">&nbsp;<?php echo $key+1; ?>.</td>

                                    <td class="break">
									<?php 
										$_address =  array();
										$_address[] = $v->name;
										$_address[] = $v->address;
										$_address[] = $v->city;
										$_address[] = $v->state;
										$_address[] = $country[$v->country];
										$_address[] = $v->postcode;
										$_address[] = $v->phone;
										echo implode(',', $_address);
									 ?>
									</td>

                                    <td width="100">

                                        <a href="<?php echo site_url('my/logistic/edit/'.$v->id); ?>">Edit</a>

                                        &nbsp;<a onclick="return confirm('Confirm delete?');" href="<?php echo site_url('my/logistic/del/'.$v->id); ?>">Delete</a>

                                    </td>

                                </tr>

                                <?php endforeach; ?>

                           <?php else: ?>

                                <tr><td colspan="3"><b>No address here? Create new address!</b></td></tr>                         

                           <?php endif; ?>

                           </table>

                          </Td></tr>

                           <?php if(count($logistics) < 10): ?>

                           		<tr><td colspan="3"><div class="addnew"><div class="op">Create new Address</div></div></td></tr>

                           		<form action="<?php echo site_url('my/logistic'); ?>" method="post" onsubmit="return checkform('logistic_table');" >

                                <input type="hidden" name="id" value="" />

                                <tr><td width="180">Recipient's name:</td><td colspan="2"><input type="text" name="logistics_name" value="" id="logistics_name" class="required" />*</td></tr>

                                <tr><td>Tel:</td><td colspan="2"><input type="text" name="logistics_phone" value="" id="logistics_phone" class="required" />*</td></tr>

                                <tr><td>Country:</td><td colspan="2">

                                	<select name="logistics_country">

                                    	<?php foreach($country as $k => $v): ?>

                                    	<option value="<?php echo $k; ?>" <?php echo ($k == $GLOBALS['member']->country) ? 'selected="selected"' : ''; ?>><?php echo $v; ?></option>

                                        <?php endforeach; ?>

                                    </select>

                                *</td></tr>

                                <tr><td>State:</td><td colspan="2"><input type="text" name="logistics_state" value="" id="logistics_state" class="required" />*</td></tr>

                                <tr><td>City:</td><td colspan="2"><input type="text" name="logistics_city" value="" id="logistics_city" class="required" />*</td></tr>

                                <tr><td>PostCode:</td><td colspan="2"><input type="text" name="logistics_postcode" value="" id="logistics_postcode" class="required" />*</td></tr>

                                <tr><td>Detailed Address:</td><td colspan="2"><input type="text" name="logistics_address" value="" id="logistics_address" class="required" />*</td></tr>

                                <tr><td colspan="3"><button type="submit" class="red white pointer strong">Submit</button></td></tr>

                                </form>

                           <?php endif; ?>

                       <?php elseif($action == 'edit') : ?>

                       		<form action="<?php echo site_url('my/logistic'); ?>" method="post" onsubmit="return checkform('logistic_table');">

                            <input type="hidden" name="id" value="<?php echo $logistic->id; ?>" />

                            <tr><td width="180">Recipient's name:</td><td colspan="2"><input type="text" name="logistics_name" value="<?php echo $logistic->name; ?>" id="logistics_name" class="required" />*</td></tr>

                            <tr><td>Tel:</td><td colspan="2"><input type="text" name="logistics_phone" value="<?php echo $logistic->phone; ?>" id="logistics_phone" class="required" />*</td></tr>

                            <tr><td>Country:</td><td colspan="2">

                            	<select name="logistics_country">

                                    	<?php foreach($country as $k => $v): ?>

                                    	<option value="<?php echo $k; ?>" <?php echo $k == $logistic->country ? 'selected="selected"' : ''; ?>><?php echo $v; ?></option>

                                        <?php endforeach; ?>

                                    </select>

                            *</td></tr>

                            <tr><td>State:</td><td colspan="2"><input type="text" name="logistics_state" value="<?php echo $logistic->state; ?>" id="logistics_state" class="required" />*</td></tr>

                            <tr><td>City:</td><td colspan="2"><input type="text" name="logistics_city" value="<?php echo $logistic->city; ?>" id="logistics_city" class="required" />*</td></tr>

                            <tr><td>PostCode:</td><td colspan="2"><input type="text" name="logistics_postcode" value="<?php echo $logistic->postcode; ?>" id="logistics_postcode" class="required" />*</td></tr>

                            <tr><td>Detailed Address:</td><td colspan="2"><input type="text" name="logistics_address" value="<?php echo $logistic->address; ?>" id="logistics_address" class="required" />*</td></tr>

                             <tr><td colspan="2"><button type="submit" class="red white pointer strong">Edit</button></td></tr>
                            </form>
                       <?php endif; ?>
                        </table>
                  </div>
</div>



