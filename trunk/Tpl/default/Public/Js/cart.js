$(function(){
	$('form[name=cart]').submit(function(){
		if($('.o_address').is(':hidden')){
			$('.o_address').empty();//防止验证
		}
		return Validator.Validate(this,2);
	});
	$("[name=delivery]").click(function(){
		if($(this).attr("value")==1){
			$(".o_address").show();
			$("#shippingtype").hide();
			$("#shippingmsg").show();
		}else{
			$(".o_address").hide();
			$("#shippingtype").show();

		}
	});
	$('#selCountries,#selProvinces,#selCities').change(function(){
		if($(this).val()>0){
			$.post($("#Shipping_area_url").val(),{
			'country':$("#selCountries").val(),
			'state':$("#selProvinces").val(),
			'city':$("#selCities").val()
			},function(data){

				$("#shippingmsg").hide();
				if(data.length>0){
					$('#shippingtype').html(data).show();
				}else{
					$("#shippingbox").html("There is no way in the area of distribution").show();
				}
			});
			$('input:radio[name=shipping_id]:checked').trigger('click');
			$('input:radio[name=payment_module_code]:checked').trigger('click');
		}
	});
	$('input:radio[name=shipping_id],input:radio[name=payment_module_code]').live('click',function(){
		var shipping_id=$('input:radio[name=shipping_id]:checked').val();
		var delivery=$('input:radio[name=delivery]:checked').val();
		var payment=$('input:radio[name=payment_module_code]:checked').attr('id');

		var post={};
		if(shipping_id>0){
			post.shipping_id=shipping_id;
		}
		post.delivery=delivery;
		if(delivery>0){
			post.country=$("#selCountries").val();
			post.state=$("#selProvinces").val();
			post.city=$("#selCities").val();
		}
		if(payment>0){
			post.payment=payment;
		}
		$.post($('#get_total_amount_url').val(),post,function(data){
			if(data.length>0){
				$('#get_total_amount').html(data).show();
			}
		});
	});

});