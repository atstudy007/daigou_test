<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');?>
<div class="headbar">
	<div class="position"><span>商城管理</span><span>></span><span>商城设置</span><span>></span><span>栏目设置</span><span>></span><span>重新同步栏目</span></div>
</div>
<div class="content_box">
	<div class="content form_content">
		<div class="red_box" id="lower_ie" ><img src="images/error.gif" />
			谨慎操作此处,若仅需要同步缺少的分类,请不要将下面的选项选为[是]!
		</div>
		<form action=""  method="post" id="sync_form">
			<table class="form_table">
				<col width="150px" />
				<col />
				<tr>
					<th> 是否清除现有数据：</th>
					<td>
						<input type="radio" name="clear_first" value="1">是
                        <input type="radio" name="clear_first" value="0" checked="checked">否
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<button class="submit" type='button' id="start_sync"><span>开始同步</span></button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<script type="text/javascript">
	$('#start_sync').click(function()
	{
		if (! confirm("确定要执行此操作?"))
		{
			return false;
		}
		$.ajax({
		   type: "POST",
		   url: "<?php echo backend_url('taobao/setting/sync_category'); ?>",
		   data: $('#sync_form').serialize(),
		   beforeSend : function(){
		   		$('#start_sync').children('span').html('正在同步中,请稍后......');
		   		$('#start_sync').attr('disabled', true);
		   },
		   success: function(msg){
		   		if (msg == 'ok')
		   		{
		   			alert('同步成功!');
		   		}
		   		else
		   		{
		   			alert('同步出错了!');
		   		}
		   },
		   error  : function(){alert('同步出错了!');},
		   complete : function(){
		   		$('#start_sync').children('span').html('开始同步');
		   		$('#start_sync').attr('disabled', false);
		   }
		});
	});
</script>