<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');?>
<div class="headbar">
	<div class="position"><span>商城管理</span><span>></span><span>商城设置</span><span>></span><span>运费设置</span></div>
</div>
<div class="content_box">
	<div class="content form_content">
		<form action="<?php echo site_url('taobao/country/express'); ?>"  method="post">
			<table class="form_table">
				<col width="150px" />
				<col />
				<tr>
					<th> 选择国家:</th>
					<td>
						<select name="id" onchange="location='<?php echo site_url('taobao/country/express/'); ?>/'+this.value;">
                        	<option value="">--选择一个国家--</option>
                            <?php foreach($countries as $c): ?>
                            	<option value="<?php echo $c->id; ?>" <?php echo (isset($country->id) AND $country->id == $c->id) ? 'selected="selected"' : ''; ?>><?php echo $c->name; ?></option>
                            <?php endforeach; ?>
                        </select>
					</td>
				</tr>
                <?php if(!$country): ?>
                <tr>
                	<th></th>
                    <td>
                    	<div class="red_box" id="lower_ie" ><img src="images/error.gif" />
							请先选择一个国家！
						</div>
                    </td>
                </tr>
                <?php else: ?>
                <tr>
                	<th>邮费设置:</th>
                    <td>
                    	<div class="red_box" id="lower_ie" >
							周期可以填写字符串，其他项目必须填写数字！
						</div>
                    	<table>
                        	<tr>
                            	<td>快递名称</td>
                                <td>周期(天)</td>
                                <td>首重(KG)</td>
                                <td>首重邮费(￥)</td>
                                <td>续重邮费(￥)</td>
                                <td>最大重量(KG)</td>
                            </tr>
                            <?php $express = unserialize($country->express); ?>
                            <?php foreach(array("EMS","UPS","DHL","FedEx","TNT","Air-Small","Air-Express","SAL") as $type): ?>
                            <?php if ( ! isset($express[$type])): ?>
                            <?php $express[$type] = array('days'=>'','kg'=>0,'fee'=>0,'extra'=>0,'max'=>0); ?>
							<?php endif; ?>
                            <tr>
                            	<td><?php echo $type; ?></td>
                                <td><input type="text" class="small" name="express[<?php echo $type; ?>][days]" value="<?php echo $express[$type]['days'] ?>" /></td>
                                <td><input type="text" class="small" name="express[<?php echo $type; ?>][kg]" value="<?php echo $express[$type]['kg'] ?>"/></td>
                                <td><input type="text" class="small" name="express[<?php echo $type; ?>][fee]" value="<?php echo $express[$type]['fee'] ?>"/></td>
                                <td><input type="text" class="small" name="express[<?php echo $type; ?>][extra]" value="<?php echo $express[$type]['extra'] ?>"/></td>
                                <td><input type="text" class="small" name="express[<?php echo $type; ?>][max]" value="<?php echo $express[$type]['max'] ?>"/></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </td>
                </tr>
				<tr>
					<th></th>
					<td>
						<button class="submit" type='submit'><span>保存修改</span></button>
					</td>
				</tr>
                <?php endif; ?>
			</table>
		</form>
	</div>
</div>