function loadRegion(sel,type_id,selName,url){
	//alert($("#"+sel).val());
	$("#"+selName+" option").each(function(){
		$(this).remove();
	});
	$("<option value=0>请选择</option>").appendTo($("#"+selName));
	if($("#"+sel).val()==0){
		return;
	}
	$.getJSON(url,{pid:$("#"+sel).val(),type:type_id},
	function(data){
		if(data){
			$.each(data,function(idx,item){
				if(idx==0){
					return true;//同countinue，返回false同break
				}

				//$(new Option(item.name,item.id)).appendTo($("#"+selName));
				$("<option value="+item.id+">"+item.name+"</option>").appendTo($("#"+selName));

			});
		}else{
			$("<option value='0'>All Province</option>").appendTo($("#"+selName));
		}

	}

	);
}
function addconfig(){
	var city=$("#selCities").val();
	var Provinces=$("#selProvinces").val();
	var Countries=$("#selCountries").val();
	if(city>0){
		var chboxtext="<input type='checkbox' name='config[]' value='"+city+"' checked />"+$("#selCities").find('option:selected').text();
	}
	else{
		if(Provinces>0){
			var chboxtext="<input type='checkbox' name='config[]' value='"+Provinces+"' checked />"+$("#selProvinces").find('option:selected').text();
		}
		else{
			if(Countries>0){
				var chboxtext="<input type='checkbox' name='config[]' value='"+Countries+"' checked />"+$("#selCountries").find('option:selected').text();
			}
		}
	}

	$("#configtext").append(chboxtext);
}