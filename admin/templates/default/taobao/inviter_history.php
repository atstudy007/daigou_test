<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');?>
<div class="headbar">
    <div class="position"><span>商城管理</span><span>></span><span>查看<?php echo $this->uri->rsegment(4) != 'cash' ? '积分' : '现金'; ?>历史信息</span></div>
    <div class="field">
        <table class="list_table">
            <col width="40px" />
            <col />
            <thead>
                <tr>
                    <th></th>
                    <th>用户名</th>
                    <th>时间</th>
                    <th>名目</th>
                    <th>数量</th>
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
                    <td></td>
                    <td><?php echo $v->username; ?></td>
                    <td><?php echo date('Y-m-d H:i', $v->timeline); ?></td>
                    <td><?php 
							if ($v->description)
							{
								echo $v->description;		
							}
							else
							{
								if ($v->iuid)
								{
									echo '下线会员'.$v->iusername.'消费$'.$v->money;	
								}
								else
								{
									echo '消费$'.$v->money;	
								}
							}
					?></td>
                    <td>+ <?php 
							if ($this->uri->rsegment(3) != 'cash') 
							{
								echo $v->credit;	
							}
							else
							{
								echo $v->cash;	
							}?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
</div>
<div class="pages_bar pagination"><?php echo $pagination; ?></div>