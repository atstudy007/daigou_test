<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');?>
<div class="headbar">
    <div class="position"><span>商城管理</span><span>></span><span>订单管理</span><span>></span><span>转运订单详情</span></div>
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
                  <th>服务费：</th>
                  <td>￥<?php echo $order->service_fee; ?></td>
              </tr>
              <tr>
                  <th>税费：</th>
                  <td>￥<?php echo $order->tax_fee; ?></td>
              </tr>
              <tr>
                  <th>运费：</th>
                  <td>￥<?php echo $order->ship_fee; ?></td>
              </tr>
              <tr>
                  <th>当前状态：</th>
                  <td>
                      <span style="font-weight:bold;color:red"><?php  echo $status[$order->status]; ?></span>
                      <?php if ($order->status == DELIVERY_UNPAYED || $order->status == DELIVERY_CANCEL_PROGRESSING): ?>
                        <form method="post" action="<?php echo site_url('taobao/delivery/cancel/'.$order->id);  ?>" onsubmit="return confirm('确定要取消该订单吗？');">
                          <button class="submit" type="submit"><span>取消该订单</span></button>
                        </form>
                      <?php endif; ?>
                  </td>
              </tr>
              <tr>
                  <td colspan="2" style="padding:0"><div class="red_box" style="margin:0"><b>相关订单及物品</b></div></td>
              </tr>
              <tr>
                  <th>商品列表</th>
                  <td>
                    <table width="100%">
                      <tr><td>订单编号</td><td>商品名称</td><td>购买数量</td><td>购买价格</td><td>参数</td></tr>
                        <?php foreach($order->lists as $v): ?>
                        <tr>
                            <td>No.<?php echo $v->id; ?></td>
                            <td colspan="10"></td>
                        </tr>
							<?php foreach($v->lists as $vv): ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td><?php echo $vv->name; ?></td>
                                <td><?php echo $vv->qty; ?></td>
                                <td><?php echo $vv->price; ?></td>
                                <td><?php echo $vv->options; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </table>
                  </td>
              </tr>
              <tr>
                  <td colspan="2" style="padding:0"><div class="red_box" style="margin:0"><b>付费支付信息</b></div></td>
              </tr>
              <tr>
                  <th>总费用：</th>
                  <td>￥<?php echo $order->service_fee + $order->ship_fee + $order->tax_fee; ?></td>
              </tr>
              <tr>
                  <th>支付信息：</th>
                  <td>
                    <?php if ($order->status < DELIVERY_PAYED): ?>
                      无采购费用支付信息!
                    <?php else: ?>
                      付款渠道：<?php echo $order->pay_from; ?><br />
                      渠道订单：<?php echo $order->pay_from_bill; ?><br />
                      付款时间：<?php echo $order->pay_time ? date('Y-m-d H:i:s',$order->pay_time) : ''; ?><br />
                    <?php endif; ?>
                  </td>
              </tr>
              <tr>
                  <td colspan="2" style="padding:0"><div class="red_box" style="margin:0"><b>快递信息</b></div></td>
              </tr>
              <tr>
                  <th>快递公司：</th>
                  <td><?php echo $order->logistics; ?></td>
              </tr>
              <tr>
                  <th>收货地址：</th>
                  <td><?php echo $order->logistics_info; ?></td>
              </tr>
              <tr>
                  <th>对应的收费方式：</th>
                  <td>
                  		首重(<b><?php echo $order->weight_kg; ?></b>KG)
                        首重邮费(￥<b><?php echo $order->weight_fee; ?></b>)
                        续重邮费(￥<b><?php echo $order->weight_extra; ?></b>)
                        最大重量(KG<b><?php echo $order->max_weight; ?></b>)
                  </td>
              </tr>
              <form method="post" action="<?php echo site_url('taobao/delivery/ship/'.$order->id);  ?>">
              <tr>
                  <th>转运订单：</th>
                  <td>
                    	<table>
                        	<tr>
                            	<td>&nbsp;</td>
                                <td>重量</td>
                                <td>费用</td>
                                <td>快递单号</td>
                            </tr>
                            <?php $track_no = @unserialize($order->logistics_no); ?>
                            <?php foreach($order->packages as $k => $package): ?>
                            <tr>
                            	<td>运单<?php echo $k+1; ?></td>
                                <td><?php echo $package['weight']; ?>Kg</td>
                                <td>￥<?php echo $package['money']; ?></td>
                                <td><input name="track_no[<?php echo $k; ?>]" class="normal" <?php echo $order->status < DELIVERY_PAYED ? 'disabled="disabled"' : ''; ?> value="<?php echo isset($track_no[$k]) ? $track_no[$k] : '' ; ?>" /></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if ($order->status >= DELIVERY_PAYED): ?>
                            <tr>
                            	<td>
                                	<button class="submit" type="submit">
                                    <span>
                                    	<?php if ($order->status == DELIVERY_PAYED): ?>
                                        标记发货
                                        <?php else: ?>
                                        修改快递单号
                                        <?php endif; ?>
                                    </span>
                                    </button>
                                 </td>
                            </tr>
                            <?php endif; ?>
                        </table>
                  </td>
              </tr>
              </form>
              <tr>
                  <td colspan="2" style="padding:0"><div class="red_box" style="margin:0"><b>评价信息</b></div></td>
              </tr>
              <tr>
                  <th>评价信息：</th>
                  <td>
                    <?php if ($order->status < DELIVERY_EVALUATED): ?>
                      暂无评价信息!
                    <?php else: ?>
                      评价等级：<?php echo $order->rate_score; ?><br />
                      评价描述：<div><?php echo $order->rate_description; ?><div>
                    <?php endif; ?>
                  </td>
              </tr>
              <form method="post" action="<?php echo site_url('taobao/delivery/memo/'.$order->id);  ?>">
              <tr>
                  <td colspan="2" style="padding:0"><div class="red_box" style="margin:0"><b>管理员专用</b></div></td>
              </tr>
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