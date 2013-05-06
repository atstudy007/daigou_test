<link href="images/member.css" rel="stylesheet" type="text/css" />
           <div id="login">
            <h1  class="super colorA10" style="text-align:center">Change Password</h1>
            <form action="<?php echo $post_url; ?>" method="post">
            <table width="880" border="0" cellpadding="0" cellspacing="0" class="form color999" >
                <tbody>
                <?php if(isset($error)) :?>
                <tr><td colspan="3" align="center"><span class="colorA10"><?php echo $error; ?></span></td></tr>
                <?php endif;?>
                <tr>
                <td align="right" valign="middle" class="title color666">Password</td>
                <td colspan="2" valign="middle" class="input"><input autocomplete="off" type="password" id="userpass" name="userpass" maxlength="16" value=""></td>
                <td align="left" valign="middle">&nbsp;</td>
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
                <td align="left">　</td>
                            </tr>
                            <?php if ( $error = form_error('userpass_confirm')): ?>
                            <tr>
                              <td align="right" valign="middle" class="title color666">&nbsp;</td>
                              <td colspan="3" valign="middle" class="input"><?php echo $error; ?></td>
                            </tr>
                            <?php endif; ?>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="3" align="left"><button type="submit" class="red white pointer strong">Change</button></td>
                </tr>
                </tbody></table>
    		</form>
            </div>
</div>