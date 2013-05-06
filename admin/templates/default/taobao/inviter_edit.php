<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');?>
<div class="headbar">
    <div class="position"><span>商城管理</span><span>></span><span>推广管理</span><span>></span><span>编辑推广员</span></div>
</div>
<div class="content_box">
    <div class="content form_content">
        <form action="<?php echo backend_url('taobao/inviter/edit/'.$inviter->uid); ?>"  method="post">
            <table class="form_table">
                <col width="150px" />
                <col />
                <tr>
                    <th> 用户UID：</th>
                    <td><input type="text" class="normal" name="uid" value="<?php echo $inviter->uid; ?>" disabled="disabled" /></td>
                </tr>
                <tr>
                    <th> 用户名称：</th>
                    <td><input type="text" class="normal" name="username" value="<?php echo $inviter->username; ?>" disabled="disabled" /></td>
                </tr>
                <tr>
                    <th> Paypal：</th>
                    <td><input type="text" class="normal" name="paypal" value="<?php echo $inviter->paypal; ?>" />必填且必须是有效的EMAIL格式</td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button class="submit" type='submit'><span>编辑推广员</span></button>
                    </td>
                </tr>
            </table>
        </form>
        
    </div>
</div>