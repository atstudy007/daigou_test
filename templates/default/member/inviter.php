<link href="images/member.css" rel="stylesheet" type="text/css" />
    <div class="indexleft">
        <!--二级分类-->
        <?php $this->load->view('member/left'); ?>
    </div><!--end indexleft-->
    <div class="indexright">
      <div class="shoppinglist" style="border:1px #ccc solid">
        <?php if ( ! $inviter): ?>
        <table class="info_table form">
            <tr>
            	<td colspan="10">
                	<p>You are not a promoter yet, please submit your application.</p>
                    <p>You can choose point back or cash back as your rewards.</p>
                </td>
            </tr>
        </table>
         <form method="post" action="<?php echo site_url('my/inviter');  ?>" class="form">
            <table class="info_table">
                <Tr><td colspan="3">
                <div class="addnew"><div class="op">Promoter Application</div></div>
                </td></Tr>
                <tr>
                    <td>Choose a reward type:</td>
                    <td>
                    	<input type="radio" name="type" value="1" checked="checked" />Point Back
                        <input type="radio" name="type" value="2" />Cash Back
                    </td>
                    <td width="30%">*Required</td>
                </tr>
                <tr style="display:none" id="paypal_tr">
                    <td>Paypal account:</td>
                    <td><input name="paypal" type="text" value="" /></td>
                    <td width="30%">*Required</td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><button type="submit" class="red white pointer strong">Submit</button></td>
                    <td></td>
                </tr>
            </table>
        </form>
        <script language="javascript">
			$('input[name="type"]').change(function(){
				if ($(this).val() == '1')
				{
					$('#paypal_tr').hide();	
				}
				else
				{
					$('#paypal_tr').show();	
				}
			});
		</script>
        <?php else: ?>
        <table class="info_table form">
            <tr>
            	<td colspan="10">
                <table class="listtable" cellpadding="0" cellspacing="0">
                    <?php if ($inviter->type == 1): ?>
                    <tr>
                    	<td>Promotion Points</td>
                        <td colspan="10"><?php echo $GLOBALS['member']->invite_credit; ?></td>
                    </tr>
                    <?php endif; ?>
                     <?php if ($inviter->type == 2): ?>
                    <tr>
                    	<td>Rewarded cash</td>
                        <td>$<?php echo $inviter->cash; ?>&nbsp;<a href="<?php echo site_url('my/history/cash'); ?>">detail</a></td>
                        <td>Paypal account</td>
                        <td><?php echo $inviter->paypal; ?></td>
                    </tr>
                    <?php endif; ?>
            	</table>
                 <?php if ($inviter->type == 2): ?>
                <table class="listtable" cellpadding="0" cellspacing="0">
                    <tr>
                        <th>Withdraw time</th>
                        <th>Comments</th>
                        <th>Amount</th>
                    </tr>
                    <?php foreach($detail['list'] as $key => $v): ?>
                   <tr style="background:<?php echo $key%2 == 0 ? '#ffffff' : '#f7f7f7'; ?>">
                        <td><?php echo date('Y-m-d H:i', $v->timeline); ?></td>
                        <td><?php echo $v->description; ?></td>
                        <td>$<?php  echo $v->cash; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if($detail['pagination']): ?>
                    <tr><td colspan="10"><?php echo $detail['pagination']; ?></td></tr>
                    <?php endif;?>
                </table>
                <?php endif; ?>
                </td>
            </tr>
        </table>
        <?php endif; ?>
      </div>
</div>
        
<!--end of main -->