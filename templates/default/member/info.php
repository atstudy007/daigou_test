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
                　        <table class="info_table">
                        	<tr>
                            	<td>Welcome : <b><?php echo $GLOBALS['member']->username; ?></b>(<?php echo $GLOBALS['member']->email; ?>)
                                </td>
                            </tr>
                            <tr>
                            	<td>Last Login IP : <b><?php echo $GLOBALS['member']->last_login_ip; ?></b>&nbsp;&nbsp;
                                    Last Login Time : <b><?php echo date('Y-m-d H:i:s', $GLOBALS['member']->last_login_time); ?></b></td>
                            </tr>
                            <tr>
                            	<td>
                                	Total points: <b><?php echo $GLOBALS['member']->credit + $GLOBALS['member']->invite_credit; ?></b>Consumption points: <b><?php echo $GLOBALS['member']->credit; ?></b>promotion points: <b><?php echo $GLOBALS['member']->invite_credit; ?></b>
                                    <a href="<?php echo site_url('my/history/credit'); ?>">Points Detail</a>
                                </td>
                            </tr>
                            <tr>
                            	<td>Your Member Level：<b><?php echo $GLOBALS['member']->level['name']; ?></b>,Your discount is <b><?php echo $GLOBALS['member']->level['discount']*100; ?>%</b>.<a href="<?php echo site_url('guide/view/points-and-promotion'); ?>">Points and Promotion</a></td>
                            </tr>
                        </table>
                        <form method="post" action="<?php echo site_url('member/info');  ?>" class="form">
                        <table class="info_table">
                        	<Tr><td colspan="3">
                            <div class="addnew"><div class="op">Account Information</div></div>
                            </td></Tr>
                        	<tr>
                            	<td>Email:</td>
                                <td><?php echo $GLOBALS['member']->email; ?></td>
                                <td width="30%">&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>Username:</td>
                                <td><?php echo $GLOBALS['member']->username; ?></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>Country</td>
                                <td>
                              		<select name="country">
                                    	<?php foreach($country as $k => $v): ?>
                                    	<option value="<?php echo $k; ?>" <?php echo set_select('country', $k, ($k == $GLOBALS['member']->country)); ?>><?php echo $v; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                            	<td>Current Password:</td>
                                <td><input name="old_pass" type="password" id="old_pass" maxlength="16" autocomplete="off" /></td>
                              <td></td>
                            </tr>
                            <?php if($error = form_error('old_pass').form_error('_check_userpass')): ?>
                            <tr>
                              <td>&nbsp;</td>
                              <td colspan="2"><?php echo $error; ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                            	<td>New Password:</td>
                                <td><input name="new_pass" type="password" id="new_pass" maxlength="16" autocomplete="off" /></td>
                                <td></td>
                            </tr>
                          <?php if($error = form_error('new_pass')): ?>
                          <tr>
                              <td>&nbsp;</td>
                              <td colspan="2"><?php echo $error; ?></td>
                          </tr>
                          <?php endif; ?>
                          <tr>
                            	<td>Confirm New Password</td>
                                <td><input name="new_pass_confirm" type="password" id="new_pass_confirm" maxlength="16" autocomplete="off" /></td>
    <td></td>
                            </tr>
                            <?php if($error = form_error('new_pass_confirm')): ?>
                            <tr>
                              <td align="center">&nbsp;</td>
                              <td colspan="2" align="left"><?php echo $error; ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                            	<td colspan="2" align="center"><button type="submit" class="red white pointer strong">Edit</button></td>
                                <td></td>
                            </tr>
                        </table>
                 </form>
                  </div>
</div>

</div>
