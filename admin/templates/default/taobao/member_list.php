<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');?>
<div class="headbar">
    <div class="position"><span>商城管理</span><span>></span><span>会员管理</span><span>></span><span>会员列表</span></div>
    <div class="operating" style="position:relative; overflow:visible ">
        <a class="hack_ie" href="<?php echo backend_url('taobao/member/add'); ?>"><button class="operating_btn" type="button"><span class="addition">添加新用户</span></button></a>
        <a href="javascript:void(0)" onclick="$('#content_search_form').slideToggle('slow');" ><button class="operating_btn" type="button"><span class="remove">筛选</span></button></a>
        <div id="content_search_form">
            <form method="get" action="<?php echo backend_url('taobao/member/view'); ?>">
                <table class="form_table">
                    <colgroup><col width="150px"><col></colgroup><tbody>
                    <tr>
                        <td>用户UID</td>
                        <td><input type="text" class="small" name="uid" value="<?php echo isset($_REQUEST['uid']) ? $_REQUEST['uid'] : '';  ?>" /></td>
                    </tr>
                    <tr>
                        <td>用户名称</td>
                        <td><input type="text" class="normal" name="username" value="<?php echo isset($_REQUEST['username']) ? $_REQUEST['username'] : '';  ?>" /></td>
                    </tr>
                    <tr>
                        <td>用户邮箱</td>
                        <td><input type="text" class="normal" name="email" value="<?php echo isset($_REQUEST['email']) ? $_REQUEST['email'] : '';  ?>" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button class="submit" type="submit"><span>搜索</span></button></td>
                    </tr>
                </tbody></table>
            </form>
        </div>
    </div>
    <div class="field">
        <table class="list_table">
            <col width="40px" />
            <col />
            <thead>
                <tr>
                    <th></th>
                    <th>UID</th>
                    <th>用户名</th>
                    <th>EMAIL</th>
                    <th>积分</th>
                    <th>操作选项</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="content">
        <table id="list_table" class="list_table">
            <col width="40px" />
            <col />
            <tbody>
            <?php foreach($list as $v) : ?>
                <tr>
                    <td></td>
                    <td><?php echo $v->uid; ?></td>
                    <td><?php echo $v->username; ?></td>
                    <td><?php echo $v->email; ?></td>
                    <td><?php echo $v->credit + $v->invite_credit; ?></td>
                    <td>
                    	<?php if ($v->activated == 0): ?>
                        <a href="<?php echo backend_url('taobao/member/activate/'.$v->uid); ?>">激活用户</a>
                        <?php endif; ?>
                        <a href="<?php echo backend_url('taobao/member/edit/'.$v->uid); ?>"><img class="operator" src="images/icon_edit.gif" alt="修改" title="修改"></a>
                        <a class="confirm_delete" href="<?php echo backend_url('taobao/member/del/'.$v->uid); ?>"><img class="operator" src="images/icon_del.gif" alt="删除" title="删除"></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
</div>
<div class="pages_bar pagination"><?php echo $pagination; ?></div>
<script language="javascript">
    $('a.confirm_delete').click(function(){
        return confirm('是否要删除所选用户？');   
    });
</script>