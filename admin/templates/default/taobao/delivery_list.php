<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');?>
<div class="headbar">
    <div class="position"><span>商城管理</span><span>></span><span>订单管理</span><span>></span><span>转运订单列表</span></div>
    <div class="operating" style="position:relative; overflow:visible ">
        <a href="javascript:void(0)" onclick="multi_delete();"><button class="operating_btn" type="button"><span class="delete">批量删除</span></button></a>
        <a href="javascript:void(0)" onclick="$('#content_search_form').slideToggle('slow');" ><button class="operating_btn" type="button"><span class="remove">筛选</span></button></a>
        <div id="content_search_form">
            <form method="get" action="<?php echo backend_url('taobao/delivery/view'); ?>">
                <table class="form_table">
                    <colgroup><col width="150px"><col></colgroup><tbody>
                    <tr>
                        <td>订单编号</td>
                        <td><input type="text" name="orderid" class="normal" value="<?php echo isset($_REQUEST['orderid']) ? $_REQUEST['orderid'] : '';  ?>"  /></td>
                    </tr>
                    <tr>
                        <td>订单状态</td>
                        <td>
                            <select name="status">
                                <option value="">所有</option>
                                <?php foreach($status as $key=>$v): ?>
                                <option value="<?php echo $key ?>" 
                                    <?php echo isset($_REQUEST['status']) && $_REQUEST['status'] == $key  ? 'selected="selected"' : ''; ?>
                                ><?php echo $v; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button class="submit" type="submit"><span>搜索</span></button></td>
                    </tr>
                </tbody></table>
            </form>
        </div>
        <div class="search f_r">
            <form name="serachuser" action="<?php echo backend_url('taobao/delivery/view'); ?>" method="get">
                <select class="normal" style="width:auto" name="role" onchange="location='<?php echo backend_url('taobao/delivery/view'); ?>?status='+this.value;">
                    <option value="">状态统计</option>
                    <?php foreach($order_stats as $k=>$v): ?>
                    <option value="<?php echo $k; ?>"><?php echo $status[$k].'('.$v.')'; ?></option>
                    <?php endforeach; ?>
                </select>
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
                    <th>订单编号</th>
                    <th>购买者</th>
                    <th>状态</th>
                    <th>操作选项</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="content">
        <form id="content_list_form" method="post" action="<?php echo backend_url('taobao/delivery/del/'); ?>">
            <table id="list_table" class="list_table">
                <col width="40px" />
                <col />
                <tbody>
                <?php foreach($orders as $v) : ?>
                    <tr>
                        <td><input type="checkbox" name="id[]" value="<?php echo $v->id; ?>" /></td>
                        <td><?php echo $v->id; ?></td>
                        <td><?php echo $v->buyer->username; ?></td>
                        <td><?php  echo $status[$v->status]; ?></td>
                        <td>
                            <a href="<?php echo backend_url('taobao/delivery/detail/'.$v->id); ?>"><img class="operator" src="images/icon_edit.gif" alt="修改" title="修改"></a>
                            <a class="confirm_delete" href="<?php echo backend_url('taobao/delivery/del/'.$v->id); ?>"><img class="operator" src="images/icon_del.gif" alt="删除" title="删除"></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </form>
</div>
<div class="pages_bar pagination"><?php echo $pagination; ?></div>
<script language="javascript">
    var confirm_str = '是否要删除所选信息？\n此操作还会删除关联信息!';
    $('a.confirm_delete').click(function(){
        return confirm(confirm_str);    
    });
    function multi_delete()
    {
        if($(":checkbox[name='id[]']:checked").length  <= 0)
        {
                alert('请先选择要删除的信息!');
                return false;
        }
        else
        {
            if(confirm(confirm_str))
            {
                $('#content_list_form').submit();
            }
            else
            {
                return false;   
            }
        }
    }
</script>