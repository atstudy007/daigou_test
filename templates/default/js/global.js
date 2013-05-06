var cart_loaded = false;
$(function(){
	$('#quick_order_url').focus(function()
	{
		$(this).val('').css('color', 'black');	
	}).blur(function(){
		if ($(this).val() == '')
		{
			$(this).val('Please Enter Goods Url Here!').css('color', '#DDD');		
		}
	});
	$("#topitem").mouseover(function(){
		$(this).parent().addClass('carthover');
		$("#cartdetail").show();
		if ( ! cart_loaded)
		{
			$("#cartdetail").html('loading......');
			$.get(base_url + 'ajax/cart',{},function(response){
				$("#cartdetail").html(response);
				cart_loaded = true;
			});
		}
	}).mouseout(function(e){
		$(this).parent().removeClass('carthover');
		$("#cartdetail").hide();
	});	
	
	$("#cartdetail").hover(function(){},function(e){
		$("#topitem").removeClass('carthover');
		$("#cartdetail").hide();
	});
	
	$("#search_cate").hover(function(e){
		$("#catlist").css('z-index','99');
		$("#catlist").show();
	},function(){
		$("#catlist").hide();	
	});
	$("#catlist ul li").click(function(){
		var id = $(this).attr('rel');
		$('#catid').val(id);
		var str = $(this).html();
		$("#catname").html(str);
		$("#catlist").hide();
	});
	$("#catlist ul li").mouseover(function(){
		$("#catlist ul li").removeClass('hover');
		$(this).addClass('hover');	
	});
	$(".indexcat li").filter(':last').addClass('noborder');
	
	
	$("#indexcat > li.hoverable").hover(function(){
		$(this).addClass('hover');
		$(this).children('ul').show();	
	},function(){
		$(this).removeClass('hover');
		$(this).children('ul').hide();	
	});
	
	$('#uc').hover(function(){
		$(this).addClass('hover');
	},function(){
		$(this).removeClass('hover');
	});
	
});

function add_favorite(item_object){
	$.post( base_url + 'ajax/favorite/add', item_object, function(response){
			if(response == '0'){alert('Add Favorite Failed!\nPlease Login First!');}
			else if(response == '1'){alert('Add Favorite Success!');}
			else if(response == '2'){alert('You Already Have it !');}
		} )
}

function remove_favorite(iid,target){
	if (confirm('Confirm to remove?'))
	{
		$.post( base_url + 'ajax/favorite/delete', {'iid':iid}, function(response){location=base_url+'my/favorites';} )		
	}
}

function add_cart(pid, max_qty, quick){
	var qty = 0;
	var item_color = '';
	var item_size = '';
	
	qty = parseInt($('#qty').val());
	if(isNaN(qty) || qty <= 0){alert('Invalid Quantity!');return false;}
	if(qty > max_qty){alert('No enough Inventory');return false;}
	var property_colors = $('.property_color');
	if (property_colors.length > 0 && property_colors.filter('.property_selected').length != 1)
	{
		alert('please select property');
		return false;
	}
	else
	{
		item_color = 	property_colors.filter('.property_selected').text();
	}
	var property_sizes = $('.property_size');
	if (property_sizes.length > 0 && property_sizes.filter('.property_selected').length != 1)
	{
		alert('please select property');
		return false;
	}
	else
	{
		item_size = property_sizes.filter('.property_selected').text();
	}
		
	if(quick != 1){
		$.post(base_url + 'ajax/add_cart',{'pid':pid,'qty':qty,'color':item_color,'size':item_size},function(response){alert('Item Added!');});
	}else{
		$.post(base_url + 'ajax/add_cart',{'pid':pid,'qty':qty,'color':item_color,'size':item_size},function(response){location=base_url + 'my/cart';});	
	}
}

function del_cart(rowid, is_top)
{
		if(confirm('Confirm remove?')){
			if ( ! is_top)
			{
				$('#'+rowid).fadeOut('slow',function(){$(this).find('input[name="qty[]"]').val(0);$('#cart_form').submit();});
			}
			else
			{
				$.get(base_url + 'ajax/quick_del_cart',{'rowid':rowid},function(response){$('#cart_'+rowid).remove();});
			}
		}
}

function buy_now(){
	if(confirm('Confirm to generate order?')){
		$('#checkout').submit();
	}
	else{
		return false;
	}
}

function checkform(container)
{
	flag = true;
	$.each($('#'+container).find('.required'),function(k,v){
		if($.trim($(v).val()) == '')
		{
			flag = false;
			$(v).focus();
			return false;	
		}
	});		
	if(flag == false){alert('Please fill in the form!');}
	return flag;
}
