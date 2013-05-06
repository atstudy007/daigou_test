<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');?>
<div class="headbar">
    <div class="position"><span>商城管理</span><span>></span><span>订单管理</span><span>></span><span>订单详情</span></div>
</div>
<div class="content">
        <table id="list_table" class="form_table">
            <col width="140px" />
            <col />
            <tbody>
              <tr>
                  <td colspan="2" style="padding:0"><div class="red_box" style="margin:0"><b>订单概述</b></div></td>
              </tr>
              <tr>
                  <th>订单编号</th>
                  <td><?php echo $order->id; ?></td>
              </tr>
              <tr>
                  <th>购买的会员：</th>
                  <td><?php echo $order->buyer->username; ?></td>
              </tr>
              <tr>
                  <th>当前状态：</th>
                  <td>
                      <span style="font-weight:bold;color:red"><?php  echo $status[$order->status]; ?></span>
                      <?php if ($order->status == ORDER_UNPAYED || $order->status == ORDER_CANCEL_PROGRESSING): ?>
                        <form method="post" action="<?php echo site_url('taobao/order/cancel/'.$order->id);  ?>" onsubmit="return confirm('确定要取消该订单吗？');">
                          <button class="submit" type="submit"><span>取消该订单</span></button>
                        </form>
                      <?php endif; ?>
                  </td>
              </tr>
              <tr>
                  <td colspan="2" style="padding:0"><div class="red_box" style="margin:0"><b>购买的物品列表</b></div></td>
              </tr>
              <tr>
                  <th>商品列表</th>
                  <td>
                    <table width="100%">
                      <tr><td>商品名称</td><td>购买数量</td><td>购买价格</td><td>参数</td></tr>
                        <?php foreach($order->lists as $v): ?>
                        <tr>
                            <td><a href="<?php echo $v->click_url; ?>" target="_blank"><?php echo $v->name; ?></a></td>
                            <td><?php echo $v->qty; ?></td>
                            <td><?php echo $v->price; ?></td>
                            <td><?php echo $v->options; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                  </td>
              </tr>
              <tr>
                  <td colspan="2" style="padding:0"><div class="red_box" style="margin:0"><b>采购信息</b></div></td>
              </tr>
              <tr>
                  <th>采购费用：</th>
                  <td>￥<?php echo $order->money; ?></td>
              </tr>
              <tr>
                  <th>支付信息：</th>
                  <td>
                    <?php if ($order->status < ORDER_PAYED): ?>
                      无采购费用支付信息!
                    <?php else: ?>
                      付款渠道：<?php echo $order->pay_from; ?><br />
                      渠道订单：<?php echo $order->pay_from_bill; ?><br />
                      付款时间：<?php echo $order->pay_time ? date('Y-m-d H:i:s',$order->pay_time) : ''; ?><br />
                    <?php endif; ?>
                  </td>
              </tr>
              <tr>
                  <td colspan="2" style="padding:0"><div class="red_box" style="margin:0"><b>管理员专用</b></div></td>
              </tr>
              <form method="post" action="<?php echo site_url('taobao/order/memo/'.$order->id);  ?>">
              <tr>
                  <th>订单状态</th>
                  <td>
                      <select name="status">
                                <?php foreach($status as $key=>$v): ?>
                                <option value="<?php echo $key ?>" <?php echo $order->status == $key  ? 'selected="selected"' : ''; ?>><?php echo $v; ?></option>
                                <?php endforeach; ?>
                      </select>
                      <input type="checkbox" name="update_status_time" value="yes" />更新状态变化时间
                  </td>
              </tr>
              <tr>
                  <th>订单金额</th>
                  <td>
                        <input type="text" class="normal" value="<?php echo $order->money; ?>" name="money" />人民币单位
                  </td>
              </tr>
              <tr>
                  <th>订单重量</th>
                  <td>
                        <input type="text" class="small" value="<?php echo $order->weight; ?>" name="weight" />KG
                  </td>
              </tr>
              <tr>
                  <th>管理员备忘</th>
                  <td>
                            <textarea name="admin_memo" style="width:600px;height:200px"><?php echo $order->admin_memo; ?></textarea>
                            <br />
                            <button class="submit" type="submit"><span>修改</span></button>
                  </td>
              </tr>
              </form>
            </tbody>
        </table>
</div>