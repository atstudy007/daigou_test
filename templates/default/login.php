<link href="images/member.css" rel="stylesheet" type="text/css" />
           <div class="blank10"></div>
           <div id="login">
            <h1  class="super colorA10" style="text-align:center">Member Login</h1>
            <form action="<?php echo site_url('member/login').'?back='.(isset($back) ? $back : '') ?>" method="post">
            <table width="880" border="0" align="center" cellpadding="0" cellspacing="0" class="form color999" >
                <tbody>
                <?php if(isset($error)) :?>
                <tr><td colspan="3" align="center"><span class="colorA10"><?php echo $error; ?></span></td></tr>
                <?php endif;?>
                <tr>
                <td width="236" valign="middle" class="title color666">Email</td>
                <td colspan="2" class="input"><input value="<?php echo set_value('email'); ?>" name="email" id="email" type="text" autocomplete="off"></td>
                <td width="391" align="left" valign="middle" ><a style="color:green" href="<?php echo site_url('member/register'); ?>">Register</a></td></tr>
                <?php if($error = form_error('email')): ?>
                <tr>
                  <td align="right" valign="top" class="title color666">&nbsp;</td>
                  <td colspan="3" valign="top" class="input"><?php echo $error; ?></td>
                  </tr>
                <?php  endif;?>
                <tr>
                <td align="right" valign="middle" class="title color666">Password</td>
                <td colspan="2" valign="middle" class="input"><input type="password" id="userpass" name="userpass" maxlength="16" value=""></td>
                <td align="left" valign="middle"><a style="color:green" href="<?php echo site_url('member/password'); ?>">Lost Password?</a></td></tr>
                <?php if($error = form_error('userpass')): ?>
                <tr>
                  <td align="right" valign="top" class="title color666">&nbsp;</td>
                  <td colspan="3" valign="top" class=""><span class="input"><?php echo $error; ?></span></td>
                  </tr>
                <?php  endif;?>
                <tr>
                <td align="right" valign="middle" class="title color666">Captcha</td>
                <td width="92" valign="middle" class=""><input autocomplete="off" name="captcha" id="captcha" type="text" style="width:70px;" /></td>
                <td width="161" valign="top" class=""><img id="captcha_img" src="<?php echo site_url('common/captcha/show'); ?>" style="cursor:pointer" />
				<script language="javascript" src="<?php echo site_url('common/captcha/showjs'); ?>"></script></td>
                <td valign="top" class="">&nbsp;</td>
                </tr>
                <?php if($error = form_error('captcha').form_error('_check_captcha')): ?>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="3" align="left"><?php echo $error;  ?></td>
                  </tr>
                <?php endif; ?>
                <tr>
                <td align="right" valign="middle" class="title color666">Stay Login</td>
                <td colspan="11" valign="middle" class="">
                  <input type="checkbox" name="stay_login" value="yes" /></td>
                </tr>
                <tr>
                <td>　</td>
                <td colspan="2" align="center" valign="middle" height="50">
                	<button type="submit" class="red white pointer strong">Login</button>
                </td>
                <td>
                </td>
                  </tr>
              </tbody></table>
    		</form>
            </div>
</div>