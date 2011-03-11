(function($){
	$.fn.extend({
		cs_resize:function(obj, nw, nh){
			if (nw==0 || nh==0) return;
			var img = new Image();
			img.src = obj.src;
			var iw = img.width;
			var ih = img.height;
			if (iw==0 || ih==0) return;
			if (nw*ih/iw>=nh){
				obj.height = nh;
				obj.width = iw*nh/ih;
			}
			else{
				obj.width = nw;
				obj.height = ih*nw/iw;
			}
		},
		showtip:function() {
			var winheight=$(window).height();
			var winwidth=$(window).width();
			var tag=$(this)[0];
			var url=$(this).attr('altimg');
			var alt=$(this).attr('alt');
			$("#tooltip img,#tooltip span").empty().bind('load',function(){
				$(this).cs_resize(this,480,480);
				var rc = tag.getBoundingClientRect();
				$("#tooltip").css({"background-color":"#333333","color":"#ffffff","text-align":"center","padding":"2px"}).show().children('span').text(alt);
				var rc2 = $("#tooltip")[0].getBoundingClientRect();
				var l = rc.left;
				var t = rc.top;
				var r = winwidth-rc.right;
				var b = winheight-rc.bottom;
				var ratio = (rc2.bottom-rc2.top) / (rc2.right-rc2.left);
				var pos = typeof(pos)!='undefined'?pos:-1;
				if(pos >= 0) {
					var w = pos==1||pos==3?winwidth : pos==0?r:l;
					var h = pos==0||pos==2?winheight : pos==1?t:b;
					if(h < w*ratio) w = h/ratio;
					else if(w < h/ratio) h = w*ratio;
				} else {
					var pos0_2 = l < r ? 0 : 2;
					var pos1_3 = t < b ? 3 : 1;
					var w = l < r ? r : l;
					var h = t < b ? b : t;
					var h1 = w*ratio; if(h1 > winheight) h1 = winheight;
					var h2 = winwidth*ratio; if(h2 > h) h2 = h;
					if(h1 > h2) {
						var pos = pos0_2;
						h = h1;
						w = h1 / ratio;
					} else {
						var pos = pos1_3;
						h = h2;
						w = h2 / ratio;
					}
				}
				if(rc2.bottom-rc2.top > h || rc2.right-rc2.left > w) {
					//$("#tooltip").css({'width':w,'height':h});
				}
				var rc2 = $("#tooltip")[0].getBoundingClientRect();
				l = (pos==1||pos==3?rc.left:pos==0?rc.right:rc.left-(rc2.right-rc2.left));
				t = (pos==0||pos==2?rc.top:pos==3?rc.bottom:rc.top-(rc2.bottom-rc2.top));
				var k = winwidth-(l+rc2.right-rc2.left);
				if(k < 0) l += k;
				var k = winheight-(t+rc2.bottom-rc2.top);
				if(k < 0) t += k;
				$("#tooltip").css({'left':-2+$(window).scrollLeft()+l,'top':-2+$(window).scrollTop()+t});
			}).attr('src',url);
		}
	});
	$(function(){
		$("body").append('<div id="tooltip" style="z-index:999; display:none; position:absolute; border:1 solid black"><img /><br /><span></span></div>');
		$(".tooltip img").mouseover(function(){
			$(this).showtip();
		}).mouseout(function(){
			$("#tooltip").hide().unbind('mouseout').unbind('load');
		});
	});
})(jQuery);