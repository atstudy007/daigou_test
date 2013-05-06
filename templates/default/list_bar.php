<div class="bg listbar">
       		<div class="showmethod left" style="width:20px">
            	<!--<div class="bg list"></div>显示为红色，则加个liston-->
                <div class="bg pic picon"></div><!--显示为白色底，则去掉picon-->
                <div class="clear"></div>
             </div>
             
             <?php if (FALSE): ?><div class="showsort left clearfix">
             	
                <ul>
                	<?php if ($search['Sort'] == 'credit_desc'): ?>
                    <li class="on">Seller Credit</li>
					<?php else: ?>
                    <li><a href="<?php echo $this->pagination->base_url.'&Sort=credit_desc' ?>">Seller Credit</a></li>
					<?php endif; ?>
                    
                    <?php if ($search['Sort'] == 'commissionNum_desc'): ?>
                    <li class="on">Best Selling</li>
					<?php else: ?>
                    <li><a href="<?php echo $this->pagination->base_url.'&Sort=commissionNum_desc' ?>">Best Selling</a></li>
					<?php endif; ?>
                    
                    <?php if ($search['Sort'] == 'price_asc'): ?>
                    <li class="on">Lower Price</li>
					<?php else: ?>
                    <li><a href="<?php echo $this->pagination->base_url.'&Sort=price_asc' ?>">Lower Price</a></li>
					<?php endif; ?>
                    
                    <?php if ($search['Sort'] == 'price_desc'): ?>
                    <li class="on">Higher Price</li>
					<?php else: ?>
                    <li><a href="<?php echo $this->pagination->base_url.'&Sort=price_desc' ?>">Higher Price</a></li>
					<?php endif; ?>
                </ul>
                
             </div>
         	<?php endif; ?>
             <div class="pricesearch left clearfix">
                
             </div>
            
             <div class="nextpage right">
             	<span class="left">Total results:<?php echo isset($provider->total_results) ? $provider->total_results : 0; ?></span> 
             </div>
             
             <div class="clear"></div>
             
       </div>