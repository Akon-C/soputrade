$(function(){
	$('.attrlist li a').click(function(){

		var position =$(this).position();
		var input=$(this).parent().children('input:radio').attr('checked',true);
		var msg=input.attr('msg');
		input.triggerHandler('click');
		$(this).attr('id','attrlist_a_hover').parent().siblings().children('a').removeAttr('id');
		$('#attr_selected').html(function(){
			var checked_value=$('form[name=cart_quantity] input:radio:checked').map(function(){
				return this.className;
			}).get().join(",");
			return "Selected attribute <h2 style='color:red'>"+checked_value+"</h2>";
		});
		if(msg.length>0){
			if($id=input.attr('attrname')){
				$('.attrlist div[id='+$id+']').css({
				'position':'relative',
				'clear': 'both',
				'left':function(){
					return position.left-$(this).parent().position().left+'px';
				}
				}).html(msg).show();
			}
		}

		var attr_id=$('form[name=cart_quantity] input:radio:checked').map(function(){
			return $(this).attr('id');
		}).get().join(",");
		if(attr_id && products_id){
			$.post(window.location.href,{  'id':products_id,'attr_id':attr_id },function(data,status){
				if(status=='success'){
					$("#product_price").html(data.product_price);
					$("#attr_price").html(data.attr_price);
				}
			},'json');
		}
	});
});