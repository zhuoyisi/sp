// JavaScript Document
$(function(){

	$("#page span").hover(function(){
		$(this).addClass("se3").siblings().removeClass("se3");
		$("#imgbox a:eq("+ $(this).index()+")").show().siblings().hide();
		clearInterval(move);
		i=$(this).index();

	},function(){
			move =setInterval(m,4000)
			});
	//×Ô¶¯ÇÐ»»
		var i =0 ;
		var a = $("#imgbox div").size();

		var move;

		function m(){
			i++;
			if(i>a-1)
			{i=0;}
		$("#imgbox a:eq("+ i+")").show().siblings().hide();
		$("#page span:eq("+i+")").addClass("se3").siblings().removeClass("se3");
		};

		move =setInterval(m,4000);

})

$(document).ready(function(){
    var ali=$('#lunbonum li');
    var aPage=$('#lunhuanback p');
    var aslide_img=$('.lunhuancenter b');
    var iNow=0;

    ali.each(function(index){
        $(this).mouseover(function(){
            slide(index);
        })
    });

    function slide(index){
        iNow=index;
        ali.eq(index).addClass('lunboone').siblings().removeClass();
		$(".lunhuan_main a").eq(index).show().siblings().hide();
		aPage.eq(index).siblings().stop().animate({opacity:0},600);
		aPage.eq(index).stop().animate({opacity:1},600);
        aslide_img.eq(index).stop().animate({opacity:1,top:-10},600).siblings('b').stop().animate({opacity:0,top:-40},600);
    }

	function autoRun(){
        iNow++;
		if(iNow==ali.length){
			iNow=0;
		}
		slide(iNow);
	}

	var timer=setInterval(autoRun,4000);

    ali.hover(function(){
		clearInterval(timer);
	},function(){
		timer=setInterval(autoRun,4000);
    });
})


/*banner----end*/