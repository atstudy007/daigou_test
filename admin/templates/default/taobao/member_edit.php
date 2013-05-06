<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');?>
<div class="headbar">
    <div class="position"><span>商城管理</span><span>></span><span>会员管理</span><span>></span><span>修改会员</span></div>
</div>
<div class="content_box">
    <div class="content form_content">
        <form action="<?php echo backend_url('taobao/member/edit/'.$member->uid); ?>"  method="post">
            <table class="form_table">
                <col width="150px" />
                <col />
                <tr>
                    <th> 用户名称：</th>
                    <td><?php echo $member->username; ?></td>
                </tr>
                <tr>
                    <th> 用户EMAIL：</th>
                    <td><?php echo $member->email; ?></td>
                </tr>
                <tr>
                    <th>用户信息详情</th>
                    <td>
                        注册IP：<?php echo $member->reg_ip; ?>( <?php echo date("Y-m-d H:i:s",$member->reg_time); ?>)<br />
                        最后登录IP：<?php echo $member->last_login_ip; ?>(<?php echo date("Y-m-d H:i:s",$member->last_login_time); ?>)<br />
                        登录次数：<?php echo $member->login_times; ?><br />
                        当前积分：<?php echo $member->credit; ?><br />
                    </td>
                </tr>
                <tr>
                    <th> 用户密码：</th>
                    <td><input type="text" class="normal" name="userpass" />不修改密码不要填写</td>
                </tr>
                <tr>
                    <th>消费积分</th>
                    <td><input type="text" disabled="disabled" class="small" name="credit" value="<?php echo $member->credit; ?>" /></td>
                </tr>
                <tr>
                    <th>推广积分</th>
                    <td><input type="text" disabled="disabled" class="small" name="credit" value="<?php echo $member->invite_credit; ?>" /><a href="<?php echo backend_url('taobao/inviter/history/credit/'.$member->uid); ?>">查看积分获取详情</a></td>
                </tr>
                <tr>
                    <th> 所在地：</th>
                    <td>
                        <select name="country">
                            <?php foreach($country as $k => $v): ?>
                                <option value="<?php echo $k; ?>" <?php echo $k == $member->country ? 'selected="selected"' : '' ; ?>><?php echo $v; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button class="submit" type='submit'><span>更新用户信息</span></button>
                    </td>
                </tr>
            </table>
        </form>
        
    </div>
</div>