<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');?>
<div class="headbar">
	<div class="position"><span>商城管理</span><span>></span><span>商城设置</span><span>></span><span>栏目设置</span>
		<?php if ($parent): ?>
		<span>></span><span><?php echo $parent['name']; ?></span>
		<?php endif; ?>
	</div>
	<?php if ($parent): ?>
	<div class="operating">
		<a class="hack_ie" href="<?php echo backend_url('taobao/setting/category', 'pid='.$parent['parent_cid']); ?>"><button class="operating_btn" type="button"><span class="recover">返回上一层</span></button></a>
	</div>
	<?php endif; ?>
	<div class="field">
		<table class="list_table">
			<col width="40px" />
			<col />
			<thead>
				<tr>
                	<th></th>
					<th>栏目名称</th>
                    <th>栏目英文名称</th>
                    <th>是否显示</th>
                    <th>显示顺序</th>
                    <th>操作</th>
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
            		<form action="<?php echo backend_url('taobao/setting/category'); ?>" method="post">
	                	<td></td>
	                	<td><?php echo $v['name']; ?></td>
	                    <td><input style="width:98%" type="text" name="name_en" value="<?php echo $v['name_en']; ?>"></td>
	                    <td>
	                    	<select name="is_show">
	                    		<option value="1" <?php echo $v['is_show'] == 1 ? 'selected="selected"' : ''; ?>>是</option>
	                    		<option value="0" <?php echo $v['is_show'] == 0 ? 'selected="selected"' : ''; ?>>否</option>
	                    	</select>
	                    </td>
	                    <td><input style="width:50%" type="text" name="order" value="<?php echo $v['order']; ?>"></td>
	                    <td>
	                    	<?php if ($v['level'] != 4): ?>
	                    		<a href="<?php echo backend_url('taobao/setting/category/', 'pid='.$v['cid']); ?>">查看子分类</a>
	                    	<?php endif; ?>
	                    	<a href="javascript:void(0);" onclick="if(confirm('是否要保存修改？')){$('#btn_<?php echo $v['cid']; ?>').click();}">保存修改</a>
	                    	<input style="display:none" type="submit" id="btn_<?php echo $v['cid']; ?>" /> 
	                    	<input type="hidden" name="cid" value="<?php echo $v['cid']; ?>" />
	                    </td>
                	</form>
                </tr>
            <?php endforeach; ?>
			</tbody>
		</table>
</div>