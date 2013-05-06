<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');?>
<script src="js/xheditor/xheditor-zh-cn.min.js" type="text/javascript"></script>
<?php $current_tab =  $this->input->get('tab') ? $this->input->get('tab') : 'active' ; ?>
<div class="headbar">
	<div class="position"><span>商城管理</span><span>></span><span>商城设置</span><span>></span><span>邮件模板设置</span></div>
    <ul class='tab' name='conf_menu'>
    	<?php foreach ($tpls as $tpl): ?>
		<li <?php echo $current_tab == $tpl['k'] ? 'class="selected"' : ''; ?>><a href="javascript:void(0);" onclick="select_tab('<?php echo $tpl['k']; ?>',this);"><?php echo $tpl['name'] ?></a></li>
        <?php endforeach; ?>
	</ul>
</div>
<div class="content_box">
	<div class="content form_content">
    <?php foreach ($tpls as $tpl): ?>
		<form action="<?php echo backend_url('taobao/setting/email').'?tab='.$tpl['k']; ?>"  method="post">
            <table class="form_table dili_tabs" id="<?php echo $tpl['k']; ?>" style="<?php echo $current_tab == $tpl['k'] ? '' : 'display:none'; ?>">
				<col width="150px" />
				<col />
                <tr>
                	<th></th>
                    <td><div class="red_box"><?php echo $tpl['description']; ?></div></td>
                </tr>
				<tr>
					<th>模版内容：</th>
					<td><textarea name='<?php echo $tpl['k']; ?>'  style="height:500px;width:100%" class="xheditor {skin:'nostyle'}"><?php echo $tpl['v']; ?></textarea></td>
				</tr>
				<tr>
					<th></th>
					<td>
						<button class="submit" type='submit'><span>保存</span></button>
					</td>
				</tr>
			</table>
		</form>
    <?php endforeach; ?>   
	</div>
</div>