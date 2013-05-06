<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');?>
<?php $current_tab =  $this->input->get('tab') ? $this->input->get('tab') : 'view_index_hot' ; ?>
<div class="headbar">
	<div class="position"><span>商城管理</span><span>></span><span>商城设置</span><span>></span><span>其他设置</span></div>
    <ul class='tab' name='conf_menu'>
		<li <?php echo $current_tab == 'view_index_hot' ? 'class="selected"' : ''; ?>><a href="javascript:void(0);" onclick="select_tab('view_index_hot',this);">首页热门商品</a></li>
		<li <?php echo $current_tab == 'view_guide' ? 'class="selected"' : ''; ?>><a href="javascript:void(0);" onclick="select_tab('view_guide',this);">购买流程说明</a></li>
		<li <?php echo $current_tab == 'view_user_guide' ? 'class="selected"' : ''; ?>><a href="javascript:void(0);" onclick="select_tab('view_user_guide',this);">底部列表设置</a></li>
	</ul>
</div>
<div class="content_box">
	<div class="content form_content">
		<form action="<?php echo backend_url('taobao/setting/view').'?tab=view_index_hot'; ?>"  method="post">
			<table class="form_table dili_tabs" id="view_index_hot" style="<?php echo $current_tab == 'view_index_hot' ? '' : 'display:none'; ?>">
				<col width="150px" />
				<col />
				<?php $index_hot = @unserialize($setting->index_hot); ?>
				<?php for ($i = 1 ; $i <=16 ; $i++): ?>
					<tr>
						<th>热门商品ID-<?php echo $i; ?>：</th>
						<td>
							<input type='text' class='normal' name="index_hot[<?php echo $i; ?>]" value="<?php echo isset($index_hot[$i]) ? $index_hot[$i] : '' ; ?>" />
							格式：<b>商品ID|商品英文名称</b>
						</td>
					</tr>
				<?php endfor; ?>
				<tr>
					<th></th>
					<td>
						<button class="submit" type='submit'><span>保存热门商品设置</span></button>
					</td>
				</tr>
			</table>
		</form>

		<form action="<?php echo backend_url('taobao/setting/view').'?tab=view_guide'; ?>"  method="post">
			<table class="form_table dili_tabs" id="view_guide" style="<?php echo $current_tab == 'view_guide' ? '' : 'display:none'; ?>">
				<col width="150px" />
				<col />
				<?php $guide = @unserialize($setting->guide); ?>
				<?php for ($i = 1 ; $i <=5 ; $i++): ?>
					<tr>
						<th>Step <?php echo $i; ?>：</th>
						<td>
                        	标题：
							<div><input type='text' class='normal' name="guide[<?php echo $i; ?>][title]" value="<?php echo isset($guide[$i]['title']) ? $guide[$i]['title'] : '' ; ?>" /></div>
                            链接地址：
							<div><input type='text' class='normal' name="guide[<?php echo $i; ?>][link]" value="<?php echo isset($guide[$i]['link']) ? $guide[$i]['link'] : '' ; ?>" /></div>
                            简要说明:
                            <div>
                            	<textarea name="guide[<?php echo $i; ?>][txt]" style="width:400px;height:100px;"><?php echo isset($guide[$i]['txt']) ? $guide[$i]['txt'] : '' ; ?></textarea>
                            </div>
						</td>
					</tr>
				<?php endfor; ?>
                <tr>
					<th></th>
					<td>
						<button class="submit" type='submit'><span>保存购买流程说明</span></button>
					</td>
				</tr>
			</table>
		</form>

		<form action="<?php echo backend_url('taobao/setting/view').'?tab=view_user_guide'; ?>"  method="post">
			<table class="form_table dili_tabs" id="view_user_guide" style="<?php echo $current_tab == 'view_user_guide' ? '' : 'display:none'; ?>">
				<col width="150px" />
				<col />
				<?php $user_guide = @unserialize($setting->user_guide); ?>
				<?php $targets = array(
									1 => 'New User',
									2 => 'Transportation',
									3 => 'Payment & Charge',
									4 => 'Shopping Guide',
									5 => 'Order Instruction',
									6 => 'Customer Service',
									7 => 'Tools'
					  ); 
				?>
                <?php foreach ($targets as $k => $v): ?>
                <tr>
                    <th><?php echo $v; ?>：</th>
                    <td>
                    	<?php for ($i = 1; $i <= 3 ; $i ++): ?>
                        <div>
                        	标题<?php echo $i; ?>:<input type='text' class='normal' name="user_guide[<?php echo $k.'-'.$i.'-'.'title'; ?>]" value="<?php echo isset($user_guide[$k.'-'.$i.'-'.'title']) ? $user_guide[$k.'-'.$i.'-'.'title'] : '' ; ?>" />--
                        	URI<?php echo $i; ?>:<input type='text' class='normal' name="user_guide[<?php echo $k.'-'.$i.'-'.'uri'; ?>]" value="<?php echo isset($user_guide[$k.'-'.$i.'-'.'uri']) ? $user_guide[$k.'-'.$i.'-'.'uri'] : '' ; ?>" />
                        </div>
                        <?php endfor; ?>
                    </td>
				</tr>
                <?php endforeach; ?>
                <tr>
					<th></th>
					<td>
						<button class="submit" type='submit'><span>保存底部列表设置</span></button>
					</td>
				</tr>
			</table>
		</form>
       
	</div>
</div>