$(document).ready(function () {	
	getShippingFee($("#city").val());
});
$(
		function(){
			$("[name=delivery]").click(
					function(){
						if($(this).attr("value")==0){
							$(".o_address").show();
							$("#shippingmsg").show();
							$("#shippingtype").hide();
							$("#shippingbox").html("");
						}
						else{
							getShippingFee($("#city").val());
							$(".o_address").hide();
							$("#shippingmsg").hide();
							$("#shippingtype").show();
						}
						
					}
			);
			$("#selCities").live("change",
					function(){
				      if($(this).val()>0){
				    	  getShippingFee($(this).val());
						  
				      }
			        }
			);
		}
);
function getShippingFee(city){
	$.ajax({
		  url:$("#Shipping_area_url").val(),
		  contentType: "application/x-www-form-urlencoded; charset=utf-8",
	      cache: false,
	      type: 'post',
	      dataType :'json',
	      data:{"city":city},
	      success: function(data) {
	    	  $("#shippingmsg").hide();
			  $("#shippingtype").show(); 
	    	  $("#shippingbox").html("");
	    	  if(data.length>0){
	    		  for(var i=0;i<data.length;i++){
		    		  var str="<tr><td class='huo_d'> <input type='radio' value='"+data[i].id+"' id='payment_bank' name='shipping_id' class='x-payMethod' > "+data[i].name+"</td><td class='huo_f'><span>+￥"+data[i].base_fee+"</span></td></tr>";
		    		  $("#shippingbox").html($("#shippingbox").html()+str);
		    	  }
	    	  }
	    	  else{
	    		  $("#shippingbox").html("没有该地区的配送方式");
	    	  }
	    	 
	    	  
	      }
	  });
}