<link href="images/member.css" rel="stylesheet" type="text/css" />
           <div id="login">
            <h1   class="super colorA10" style="text-align:center">Find Password</h1>
            <form action="<?php echo site_url('member/password'); ?>" method="post">
            <table width="880" border="0" cellpadding="0" cellspacing="0" class="form color999" >
                <tbody>
                <?php if(isset($error)) :?>
                <tr><td colspan="3" align="center"><span class="colorA10"><?php echo $error; ?></span></td></tr>
                <?php endif;?>
                <tr>
                <td width="73" valign="middle" class="title color666">Email</td>
                <td colspan="2" class="input"><input value="<?php echo set_value('email'); ?>" name="email" id="email" type="text" autocomplete="off"></td>
                <td width="425" align="left" valign="middle" >&nbsp;Registered Email </td></tr>
                <?php if(($error = form_error('email')) || ($error = form_error('_check_password_email'))): ?>
                <tr>
                  <td align="right" valign="middle" class="title color666">&nbsp;</td>
                  <td colspan="3" valign="middle" class="input"><?php echo $error; ?></td>
                </tr>
                <?php  endif;?>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="3" align="left"><button type="submit" class="red white pointer strong">Send</button></td>
                </tr>
                </tbody></table>
    		</form>
            </div>
</div>