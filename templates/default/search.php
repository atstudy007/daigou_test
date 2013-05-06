    <div class="indexleft">
        <!--二级分类-->
        <div class="ralatedcat">
        	<div class="bg catname">Filter</div>
            <div style="padding:10px 5px">
            	Price: 
                <input type="text" name="StartPrice" style="width:50px" id="StartPrice" value="<?php echo isset($_GET['StartPrice']) ? $_GET['StartPrice'] : ''; ?>" /> 
                - 
                <input type="text" name="EndPrice" style="width:50px" id="EndPrice" value="<?php echo isset($_GET['EndPrice']) ? $_GET['EndPrice'] : ''; ?>" />
                <br /><br />
                <?php $scores_range = array(
							'5goldencrown' => '20',
							'4goldencrown' => '19',
							'3goldencrown' => '18',
							'2goldencrown' => '17',
							'1goldencrown' => '16',
							'5crown' => '15',
							'4crown' => '14',
							'3crown' => '13',
							'2crown' => '12',
							'1crown' => '11',
							'5diamond' => '10',
							'4diamond' => '9',
							'3diamond' => '8',
							'2diamond' => '7',
							'1diamond' => '6',
							'5heart' => '5',
							'4heart' => '4',
							'3heart' => '3',
							'2heart' => '2',
							'1heart' => '1'
				); ?>
                Seller Credit:
                <select id="filter_seller_credit">
                	<option value="">--select--</option>
                    <?php foreach ($scores_range as $key => $v): ?>
							<option value="<?php echo $key; ?>" <?php echo ($this->input->get('StartCredit') == $key ? 'selected="selected"' : '') ; ?>><?php echo $v; ?></option>
					<?php endforeach; ?>
                </select>
                <br /><br />
                <input type="button" style="padding:4px;cursor:pointer"  value="Filter" onclick="location='<?php echo $this->pagination->base_url; ?>'+'&StartPrice='+ $('#StartPrice').val() +'&EndPrice='+$('#EndPrice').val()+'&StartCredit='+$('#filter_seller_credit').val()+'&EndCredit='+$('#filter_seller_credit').val();"/>
            </div>
        </div>
    </div><!--end indexleft-->
    <div class="indexright">
    	
       <?php $this->load->view('list_bar'); ?>   
       <div  class="blank10"></div>     
            <div class="shoppinglist">
            	<ul>
                	<?php if (isset($provider->taobaoke_items->taobaoke_item)): ?>
                    <?php foreach ($provider->taobaoke_items->taobaoke_item as $item): ?>
                    <li>
                    	<a href="<?php echo site_url('item/'.$item->num_iid); ?>">
                        	<img  src="<?php echo isset($item->pic_url)  ? $item->pic_url : '' ; ?>"  width="170" height="161"/>
                        </a>
                        <p class="title"><a href="<?php echo site_url('item/'.$item->num_iid); ?>"><?php echo $item->title; ?></a></p>
                        <p class="price">$<?php echo dollar($item->price); ?></p>
                        <p class="bought">(<?php echo $item->volume; ?> customers bought)</p>
                    </li>
                    <?php endforeach; ?>
                    <?php endif;?>
                </ul>
            </div>
            <div class="clear"></div>
 			<?php echo $pagination; ?>
       </div>
</div>
