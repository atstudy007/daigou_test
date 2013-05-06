<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');?>
<?php $current_tab =  $this->input->get('tab') ? $this->input->get('tab') : 'view_credit' ; ?>
<div class="headbar">
	<div class="position"><span>商城管理</span><span>></span><span>商城设置</span><span>></span><span>其他设置</span></div>
    <ul class='tab' name='conf_menu'>
		<li <?php echo $current_tab == 'view_credit' ? 'class="selected"' : ''; ?>><a href="javascript:void(0);" onclick="select_tab('view_credit',this);">积分设置</a></li>
		<li <?php echo $current_tab == 'view_system' ? 'class="selected"' : ''; ?>><a href="javascript:void(0);" onclick="select_tab('view_system',this);">系统设置</a></li>
		<li <?php echo $current_tab == 'view_taobao' ? 'class="selected"' : ''; ?>><a href="javascript:void(0);" onclick="select_tab('view_taobao',this);">淘宝设置</a></li>
        <li <?php echo $current_tab == 'view_contact' ? 'class="selected"' : ''; ?>><a href="javascript:void(0);" onclick="select_tab('view_contact',this);">联系信息设置</a></li>
	</ul>
</div>
<div class="content_box">
	<div class="content form_content">
		<form action="<?php echo backend_url('taobao/setting/basic').'?tab=view_credit'; ?>"  method="post">
			<table class="form_table dili_tabs" id="view_credit" style="<?php echo $current_tab == 'view_credit' ? '' : 'display:none'; ?>">
				<col width="150px" />
				<col />
				<?php $credit = @unserialize($setting->credit); ?>
				<tr>
					<th>注册奖励积分：</th>
					<td>
						<input type='text' class='normal' name="credit[register]" value="<?php echo isset($credit['register']) ? $credit['register'] : 0 ; ?>" />
					</td>
				</tr>
				<tr>
					<th>推广积分比率：</th>
					<td>
						<input type='text' class='normal' name="credit[invite]" value="<?php echo isset($credit['invite']) ? $credit['invite'] : 0 ; ?>" />
					</td>
				</tr>
				<tr>
					<th>消费积分比率：</th>
					<td>
						<input type='text' class='normal' name="credit[trade]" value="<?php echo isset($credit['trade']) ? $credit['trade'] : 0 ; ?>" />
					</td>
				</tr>
                <tr>
					<th>推广现金比率：</th>
					<td>
						<input type='text' class='normal' name="credit[cash]" value="<?php echo isset($credit['cash']) ? $credit['cash'] : 0 ; ?>" />
					</td>
				</tr>
                <tr>
					<th>积分折扣等级：</th>
					<td>
						<table>
                        	<tr>
                            	<td>名称</td>
                            	<td>积分下限</td>
                                <td>积分上限</td>
                                <td>享受的折扣</td>
                            </tr>
                            <?php for($i = 1; $i <= 3 ;  $i ++): ?>
                            <tr>
                            	<td><input type="text" class="small" name="credit[level][<?php echo  $i; ?>][name]" value="<?php echo isset($credit['level'][$i]['name']) ? $credit['level'][$i]['name'] : '0'; ?>" /></td>
                            	<td><input type="text" class="small" name="credit[level][<?php echo  $i; ?>][min]" value="<?php echo isset($credit['level'][$i]['min']) ? $credit['level'][$i]['min'] : '0'; ?>" /></td>
                                <td><input type="text" class="small" name="credit[level][<?php echo  $i; ?>][max]" value="<?php echo isset($credit['level'][$i]['max']) ? $credit['level'][$i]['max'] : '0'; ?>" /></td>
                                <td><input type="text" class="small" name="credit[level][<?php echo  $i; ?>][discount]" value="<?php echo isset($credit['level'][$i]['discount']) ? $credit['level'][$i]['discount'] : '0'; ?>"/></td>
                            </tr>
                            <?php endfor; ?>
                        </table>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<button class="submit" type='submit'><span>保存积分设置</span></button>
					</td>
				</tr>
			</table>
		</form>

		<form action="<?php echo backend_url('taobao/setting/basic').'?tab=view_system'; ?>"  method="post">
			<table class="form_table dili_tabs" id="view_system" style="<?php echo $current_tab == 'view_system' ? '' : 'display:none'; ?>">
				<col width="150px" />
				<col />
				<?php $system = @unserialize($setting->system); ?>
				<tr>
					<th>美元对人民币汇率：</th>
					<td>
						<input type='text' class='small' name="system[rate]" value="<?php echo isset($system['rate']) ? $system['rate'] : 0 ; ?>" />
					</td>
				</tr>
                <tr>
					<th>受推荐首次服务费折扣：</th>
					<td>
						<input type='text' class='normal' name="system[invite]" value="<?php echo isset($system['invite']) ? $system['invite'] : 0 ; ?>" />
					</td>
				</tr>
                <tr>
					<th>关税税率：</th>
					<td>
						<input type='text' class='normal' name="system[tax]" value="<?php echo isset($system['tax']) ? $system['tax'] : 0 ; ?>" />
					</td>
				</tr>
                <tr>
					<th>服务费起收额：</th>
					<td>
						<input type='text' class='normal' name="system[service_min]" value="<?php echo isset($system['service_min']) ? $system['service_min'] : 0 ; ?>" />人民币
					</td>
				</tr>
                <tr>
					<th>服务费比率：</th>
					<td>
						<input type='text' class='normal' name="system[service]" value="<?php echo isset($system['service']) ? $system['service'] : 0 ; ?>" />
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<button class="submit" type='submit'><span>保存系统设置</span></button>
					</td>
				</tr>
			</table>
		</form>

		<form action="<?php echo backend_url('taobao/setting/basic').'?tab=view_taobao'; ?>"  method="post">
			<table class="form_table dili_tabs" id="view_taobao" style="<?php echo $current_tab == 'view_taobao' ? '' : 'display:none'; ?>">
				<col width="150px" />
				<col />
				<?php $taobao = @unserialize($setting->taobao); ?>
				<?php $scores_range = array(
							'5goldencrown' => '5金冠',
							'4goldencrown' => '4金冠',
							'3goldencrown' => '3金冠',
							'2goldencrown' => '2金冠',
							'1goldencrown' => '1金冠',
							'5crown' => '5冠',
							'4crown' => '4冠',
							'3crown' => '3冠',
							'2crown' => '2冠',
							'1crown' => '1冠',
							'5diamond' => '5钻',
							'4diamond' => '4钻',
							'3diamond' => '3钻',
							'2diamond' => '2钻',
							'1diamond' => '1钻',
							'5heart' => '5星',
							'4heart' => '4星',
							'3heart' => '3星',
							'2heart' => '2星',
							'1heart' => '1星'
				); ?>
				<tr>
					<th>卖家信誉过滤：</th>
					<td>
						<select name="taobao[startscore]">
							<?php foreach ($scores_range as $key => $v): ?>
							<option value="<?php echo $key; ?>" <?php echo ((isset($taobao['startscore']) AND $taobao['startscore'] == $key) ? 'selected="selected"' : '') ; ?>><?php echo $v; ?></option>
							<?php endforeach; ?>
						</select>
						---
						<select name="taobao[endscore]">
							<?php foreach ($scores_range as $key => $v): ?>
							<option value="<?php echo $key; ?>" <?php echo ((isset($taobao['endscore']) AND $taobao['endscore'] == $key) ? 'selected="selected"' : '') ; ?>><?php echo $v; ?></option>
							<?php endforeach; ?>
						</select>
						设置全站商品卖家信用过滤,不在设定范围内的卖家以及商品将会被过滤。建议（1钻 - 5金冠）
					</td>
				</tr>
                <tr>
					<th>商品佣金比率：</th>
					<td>
						<input class="small" name="taobao[startcommission]" type="text" value="<?php echo isset($taobao['startcommission']) ? $taobao['startcommission'] : ''; ?>" />
						---
						<input class="small" name="taobao[endcommission]" type="text" value="<?php echo isset($taobao['endcommission']) ? $taobao['endcommission'] : ''; ?>" />
						推荐200-5000
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<button class="submit" type='submit'><span>保存淘宝设置</span></button>
					</td>
				</tr>
			</table>
		</form>
        
        
        <form action="<?php echo backend_url('taobao/setting/basic').'?tab=view_contact'; ?>"  method="post">
			<table class="form_table dili_tabs" id="view_contact" style="<?php echo $current_tab == 'view_contact' ? '' : 'display:none'; ?>">
				<col width="150px" />
				<col />
				<?php $contact = @unserialize($setting->contact); ?>
				<tr>
					<th>联系邮箱：</th>
					<td>
						<input type='text' class="normal" name="contact[email]" value="<?php echo isset($contact['email']) ? $contact['email'] : '' ; ?>" />
					</td>
				</tr>
                <tr>
					<th>联系电话：</th>
					<td>
						<input type='text' class='normal' name="contact[phone]" value="<?php echo isset($contact['phone']) ? $contact['phone'] : '' ; ?>" />
					</td>
				</tr>
                <tr>
					<th>MSN：</th>
					<td>
						<input type='text' class='normal' name="contact[msn]" value="<?php echo isset($contact['msn']) ? $contact['msn'] : '' ; ?>" />
					</td>
				</tr>
                <tr>
					<th>客服时间：</th>
					<td>
						<input type='text' class='normal' name="contact[address]" value="<?php echo isset($contact['address']) ? $contact['address'] : ''; ?>" />
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<button class="submit" type='submit'><span>保存系统设置</span></button>
					</td>
				</tr>
			</table>
		</form>
       
	</div>
</div>