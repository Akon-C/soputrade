function set_shipping(sel,country,state,weight,total,url){
	var shipping_mod=$("input[type=radio][checked]").val();
	$.getJSON(url,{code:shipping_mod,country:country,state:state,weight:weight,total:total},
			function(data){			
			
			$("#shipping_money_text").html(data.Shipping_money_str);
			
			$("#pay_fee_str2").html(data.paymoney_str);
			$("#total_text").html(data.procuts_total_str);
			$("#shippingfee").val(data.Shipping_money);
			$("#paymentfee").val(data.paymoney);
			$("#insurance").val(data.insurance);
			$("#total").val(data.procuts_total);
			
		}
			
		);
	
}