$(function(){
	
	(function($){
		$('.tabNav li').click(function(){
			$(this).addClass('current').siblings().removeClass('current');
			var index = $(this).index();
			$('.tabContent>div').eq(index).show().siblings().hide();
		});
	})(jQuery);
	
	$("#kinMaxShow").kinMaxShow({
	    height: 350,
	    hoverPause:true
	});
	if ($('.index_propaganda .wrap').css('width') == '1188px') {
	    
	    $('.PPD_header_nav').find('.w1000center').css('width', 1188);
	}


	/*底部微信和微博弹出窗口*/
	(function($){
		$('.footershare .weibo,.footershare .weixin').hover(function(){
			$(this).children().show();
		},function(){
			$(this).children().hide();
		});
	})(jQuery);
		

});
