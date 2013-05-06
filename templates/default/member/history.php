<link href="images/member.css" rel="stylesheet" type="text/css" />
    <div class="indexleft">
        <!--二级分类-->
        <?php $this->load->view('member/left'); ?>
    </div><!--end indexleft-->
    <div class="indexright">
      <div class="shoppinglist" style="border:1px #ccc solid">
        <table class="info_table form">
            <tr><td colspan="3">
               <div class="addnew"><div class="op"><?php echo $this->uri->rsegment(3) != 'cash' ? 'Points' : 'Promotion Cash'; ?>&nbsp;Detail</div></div>
            </td></tr>
            <tr>
            	<td colspan="10">
                <table class="listtable" cellpadding="0" cellspacing="0">
                    <tr>
                        <th>Time</th>
                        <th>Actions</th>
                        <th>Points</th>
                    </tr>
                    <?php foreach($list as $key => $v): ?>
                   <tr style="background:<?php echo $key%2 == 0 ? '#ffffff' : '#f7f7f7'; ?>">
                        <td><?php echo date('Y-m-d H:i', $v->timeline); ?></td>
                        <td>
                        	<?php 
							if ($v->description)
							{
								echo $v->description;		
							}
							else
							{
								if ($v->iuid)
								{
									echo 'Direct referral:'.$v->iusername.' consumed$'.$v->money;	
								}
								else
								{
									echo 'Consumed $'.$v->money;	
								}
							}
							?>
                        </td>
                        <td>
                        	+ <?php 
							if ($this->uri->rsegment(3) != 'cash') 
							{
								echo $v->credit;	
							}
							else
							{
								echo $v->cash;	
							}
							?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if($pagination): ?>
                    <tr><td colspan="10"><?php echo $pagination; ?></td></tr>
                    <?php endif;?>
                </table>
                </td>
            </tr>
        </table>
      </div>
</div>
        
<!--end of main -->