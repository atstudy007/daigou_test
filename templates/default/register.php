<link href="images/member.css" rel="stylesheet" type="text/css" />
<div id="login">
            <h1  class="super colorA10" style="text-align:center">Member Register</h1>
            <form action="<?php echo site_url('member/register'); ?>" method="post" onsubmit="if($('#accept_terms').attr('checked')){return true;}else{alert('Please agree with our service terms!');return false;}">
            <table width="695" border="0" align="center" cellpadding="0" cellspacing="0" class="form color999" >
                <tbody>
                <tr>
                <td width="254" align="left" valign="middle" class="title color666">Email</td>
                <td colspan="2" valign="middle" class="input"><input value="<?php echo set_value('email'); ?>" autocomplete="off" name="email" id="email" type="text"></td>
<td width="7" align="left" valign="middle" ></td>
                </tr>
                <?php if ( $error = form_error('email').form_error('_check_email')): ?>
                            <tr>
                              <td align="right" valign="middle" class="title color666">&nbsp;</td>
                              <td colspan="3" valign="middle" class="input"><?php echo $error; ?></td>
                            </tr>
                <?php endif; ?>
                            <tr>
                <td align="right" valign="middle" class="title color666">Password</td>
                <td colspan="2" valign="middle" class="input"><input autocomplete="off" type="password" id="userpass" name="userpass" maxlength="16" value=""></td>
                <td align="left" valign="middle"></td>
                            </tr>
                            <?php if ( $error = form_error('userpass')): ?>
                            <tr>
                              <td align="right" valign="middle" class="title color666">&nbsp;</td>
                              <td colspan="3" valign="middle" class="input"><?php echo $error; ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                <td align="right" valign="middle" class="title color666">Confirm Password</td>
                <td colspan="2" valign="middle" class="input"><input autocomplete="off" type="password" id="userpass_confirm" name="userpass_confirm" maxlength="16" value=""></td>
                <td align="left"></td>
                            </tr>
                            <?php if ( $error = form_error('userpass_confirm')): ?>
                            <tr>
                              <td align="right" valign="middle" class="title color666">&nbsp;</td>
                              <td colspan="3" valign="middle" class="input"><?php echo $error; ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                             <td align="right" valign="middle" class="title color666">Username</td>
                              <td colspan="2" valign="middle" class="input"><input  autocomplete="off" type="text" id="username" name="username" maxlength="16" value="<?php echo set_value('username'); ?>"></td>
                            <td align="left" valign="middle" ></td>
                            </tr>
                            <?php if ( $error = form_error('username').form_error('_check_username')): ?>
                            <tr>
                              <td align="right" valign="middle" class="title color666">&nbsp;</td>
                              <td colspan="3" valign="middle" class="input"><?php echo $error; ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                              <td align="right" valign="middle" class="title color666">Country</td>
                              <td colspan="3" valign="middle" class="input">
                              		<select name="country">
                                    	<?php foreach($country as $k => $v): ?>
                                    	<option value="<?php echo $k; ?>" <?php echo set_select('country', $k); ?>><?php echo $v; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                              </td>
                            </tr>
                            <tr>
                              <td align="right" valign="middle" class="title color666">Inviter</td>
                              <td colspan="2" valign="middle" class="input"><input  type="text" id="inviter" name="inviter" maxlength="255" value="<?php echo set_value('inviter'); ?>" />
                              5% service fee for your 1st order!</td>
                              <td align="left" valign="middle" ></td>
                            </tr>                          
                            <tr>
                              <td align="right" valign="middle" class="title color666">Address</td>
                              <td colspan="2" valign="middle" class="input"><input  type="text" id="address" name="address" maxlength="20" value="" />
                              Your mail address.</td>
                              <td align="left" valign="middle" ></td>
                            </tr>
                            <?php if ( $error = form_error('address')): ?>
                            <tr>
                              <td align="right" valign="middle" class="title color666">&nbsp;</td>
                              <td colspan="3" valign="middle" class="input"><?php echo $error; ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                              <td align="right" valign="middle" class="title color666">Phone</td>
                              <td colspan="2" valign="middle" class="input"><input  type="text" id="phone" name="phone" maxlength="16" value="" />
                              Your phone number.</td>
                              <td align="left" valign="middle" ></td>
                            </tr>
                            <?php if ( $error = form_error('phone')): ?>
                            <tr>
                              <td align="right" valign="middle" class="title color666">&nbsp;</td>
                              <td colspan="3" valign="middle" class="input"><?php echo $error; ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                <td align="right" valign="middle" class="title color666">Captcha</td>
                <td width="96" valign="middle" class=""><input autocomplete="off" name="captcha" id="captcha" type="text" style="width:70px;" />
				</td>
                <td width="338" valign="middle" class=""><img id="captcha_img" src="<?php echo site_url('common/captcha/show'); ?>" style="cursor:pointer" />
				<script language="javascript" src="<?php echo site_url('common/captcha/showjs'); ?>"></script></td>
                <td valign="top" class="">&nbsp;</td>
                            </tr>
                             <?php if ( $error = form_error('_check_captcha').form_error('captcha')): ?>
                            <tr>
                              <td>&nbsp;</td>
                              <td colspan="3" align="left" valign="top"><?php echo $error; ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                              <td>&nbsp;</td>
                              <td colspan="3" align="left" valign="top">
                                <input type="checkbox" id="accept_terms" value="1" />Agreed with our <a target="_blank" href="<?php echo site_url('company/term-of-service'); ?>">terms of service!</a>
                              </td>
                            </tr>
                            <tr>
                <td>&nbsp;</td>
                <td colspan="2" align=""><button type="submit" class="red white pointer strong">Register</button></td>
                <td>&nbsp;</td>
                            </tr>
                        </tbody></table>
    			</form>
          </div>
</div>