<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');?>
<?php $current_tab =  $this->input->get('tab') ? $this->input->get('tab') : 'api_taobao' ; ?>
<div class="headbar">
	<div class="position"><span>商城管理</span><span>></span><span>商城设置</span><span>></span><span>API设置</span></div>
    <ul class='tab' name='conf_menu'>
		<li <?php echo $current_tab == 'api_taobao' ? 'class="selected"' : ''; ?>><a href="javascript:void(0);" onclick="select_tab('api_taobao',this);">淘宝API</a></li>
		<li <?php echo $current_tab == 'api_paypal' ? 'class="selected"' : ''; ?>><a href="javascript:void(0);" onclick="select_tab('api_paypal',this);">支付接口</a></li>
		<li <?php echo $current_tab == 'api_email' ? 'class="selected"' : ''; ?>><a href="javascript:void(0);" onclick="select_tab('api_email',this);">邮件设置</a></li>
	</ul>
</div>
<div class="content_box">
	<div class="content form_content">
		<form action="<?php echo backend_url('taobao/setting/api').'?tab=api_taobao'; ?>"  method="post">
			<!--淘宝API!-->
			<table class="form_table dili_tabs" id="api_taobao" style="<?php echo $current_tab == 'api_taobao' ? '' : 'display:none'; ?>">
				<col width="150px" />
				<col />
				<tr>
					<th>运行模式：</th>
					<td>
						<input type="radio" name="taobao_dev_mode" value="1" <?php echo $api->taobao_dev_mode == 1 ? 'checked="checked"' : ''; ?>>开发模式
                        <input type="radio" name="taobao_dev_mode" value="0" <?php echo $api->taobao_dev_mode == 0 ? 'checked="checked"' : ''; ?>>运营模式
					</td>
				</tr>
				<tr>
					<th>APP KEY：</th>
					<td><input type='text' class='normal' name='taobao_key'  id="taobao_key" value="<?php echo $api->taobao_key; ?>" /></td>
				</tr>
				<tr>
					<th>APP SECRET KEY：</th>
					<td>
						<input type='text' class='normal' name='taobao_secret_key'  id="taobao_secret_key" value="<?php echo $api->taobao_secret_key; ?>" /></td>
				</tr>
                <tr>
					<th>淘宝客昵称：</th>
					<td>
						<input type='text' class='normal' name='taobao_nick'  id="taobao_nick" value="<?php echo $api->taobao_nick; ?>" /></td>
				</tr>
                <tr>
					<th>淘宝客PID：</th>
					<td>
						<input type='text' class='normal' name='taobao_pid'  id="taobao_pid" value="<?php echo $api->taobao_pid; ?>" /></td>
				</tr>
				<tr>
					<th>沙箱模式：</th>
					<td>
						<input type="radio" name="taobao_sandbox_mode" value="1" <?php echo $api->taobao_sandbox_mode == 1 ? 'checked="checked"' : ''; ?>>开启
                        <input type="radio" name="taobao_sandbox_mode" value="0" <?php echo $api->taobao_sandbox_mode == 0 ? 'checked="checked"' : ''; ?>>关闭
					</td>
				</tr>
				<tr>
					<th>SANDBOX SECRET KEY：</th>
					<td><input type='text' class='normal' name='taobao_sandbox_key'  id="taobao_sandbox_key" value="<?php echo $api->taobao_sandbox_key; ?>" /></td>
				</tr>
				<tr>
					<th></th>
					<td>
						<button class="submit" type='submit'><span>保存淘宝API设置</span></button>
					</td>
				</tr>
			</table>
		</form>
        
        <form action="<?php echo backend_url('taobao/setting/api').'?tab=api_paypal'; ?>"  method="post">
			<!--支付接口设置!-->
			<table class="form_table dili_tabs" id="api_paypal" style="<?php echo $current_tab == 'api_paypal' ? '' : 'display:none'; ?>">
				<col width="150px" />
				<col />
				<tr>
					<th>Paypal 商户账号：</th>
					<td><input type='text' class='normal' name='paypal_business'  id="paypal_business" value="<?php echo $api->paypal_business; ?>" /></td>
				</tr>
				<!--<tr>
					<th>Moneybookers 商户设置：</th>
					<td><textarea  name='site_close_reason' style="height:200px;width:100%" class="xheditor {skin:'nostyle'}" ><?php echo $site->site_close_reason; ?></textarea></td>
				</tr>-->
				<tr>
					<th></th>
					<td>
						<button class="submit" type='submit'><span>保存支付接口设置</span></button>
					</td>
				</tr>
			</table>
		</form>

		<form action="<?php echo backend_url('taobao/setting/api').'?tab=api_email'; ?>"  method="post">
			<!--email设置!-->
			<table class="form_table dili_tabs" id="api_email" style="<?php echo $current_tab == 'api_email' ? '' : 'display:none'; ?>">
				<col width="150px" />
				<col />
				<tr>
					<th>邮件发送服务器：</th>
					<td><input type='text' class='normal' name='email_smtp'  id="email_smtp" value="<?php echo $api->email_smtp; ?>" /></td>
				</tr>
				<tr>
					<th>帐号：</th>
					<td><input type='text' class='normal' name='email_account'  id="email_account" value="<?php echo $api->email_account; ?>" /></td>
				</tr>
				<tr>
					<th>密码：</th>
					<td>
						<input type='text' class='normal' name='email_password'  id="email_password" value="<?php echo $api->email_password; ?>" /></td>
				</tr>
				<tr>
					<th></th>
					<td>
						<button class="submit" type='submit'><span>保存EMAIL设置</span></button>
					</td>
				</tr>
			</table>
		</form>
       
	</div>
</div>