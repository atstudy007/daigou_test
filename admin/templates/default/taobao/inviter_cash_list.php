<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');?>
<div class="headbar">
    <div class="position"><span>商城管理</span><span>></span><span>推广管理</span><span>></span><span>推广员提现记录</span></div>
    <div class="operating" style="position:relative; overflow:visible ">
        <a href="javascript:void(0)" onclick="$('#content_search_form').slideToggle('slow');" ><button class="operating_btn" type="button"><span class="addition">添加新提现</span></button></a>
        <div id="content_search_form">
            <form method="post" action="<?php echo backend_url('taobao/inviter/cash/'); ?>"  onsubmit="return confirm('确定要提交吗？此操作会记录操作员信息');">
                <table class="form_table">
                    <colgroup><col width="150px"><col></colgroup><tbody>
                    <tr>
                        <td>用户UID</td>
                        <td><input type="text" class="small" name="uid" value="" />*必填</td>
                    </tr>
                    <tr>
                        <td>提现金额</td>
                        <td><input type="text" class="normal" name="cash" value="" />*必填</td>
                    </tr>
                    <tr>
                        <td>说明</td>
                        <td><input type="text" class="normal" name="description" value="" />*必填</td>
                    </tr>
                    <tr>
                        <td>paypal订单号</td>
                        <td><input type="text" class="normal" name="paypal" value="" />*必填</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button class="submit" type="submit"><span>添加</span></button></td>
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
                    <th>提现会员UID</th>
                    <th>提现时间</th>
                    <th>提现说明</th>
                    <th>Paypal订单号</th>
                    <th>提现金额</th>
                    <th>操作管理员</th>
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
                    <td><?php echo date('Y-m-d H:i:s', $v->timeline); ?></td>
                    <td><?php echo $v->description; ?></td>
                    <td><?php echo $v->paypal; ?></td>
                    <td>$<?php echo $v->cash; ?></td>
                    <td><?php echo $v->admin; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
</div>
<?php echo str_replace("pagination", "pages_bar pagination", $pagination); ?>