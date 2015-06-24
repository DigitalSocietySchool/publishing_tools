/**
 * @author bottle
 */
$(document).ready(function(){
	/*display of both right and left navigations */
	
	$("#arrowLeftNav").click(function(){
		$(".navleft").toggle("slide");
		$("#hamburgerRightNav").removeClass("hid");
	});
	
	$("#hamburgerRightNav").click(function(){
		$(".navleft").toggle("slide");
		$(this).addClass("hid");
	});
	
	$("#arrowRightNav").click(function(){
		$(".navright").toggle("slide");
		if($(this).attr("down")){
			$(this).removeAttr("down");
			$(this).attr("src","img/icons/arrows up.png");
		}else{
			$(this).attr("down","yes");
			$(this).attr("src","img/icons/arrows down.png");
		}
	});
	
	/* chat over functionality */
	$(".chatOver").addClass("hid");
	$(".media").hover(function(){
		$(this).find(".chatOver").removeClass("hid");
		$(this).parent().addClass("chatSelected");
		
	},function(){
		$(this).find(".chatOver").addClass("hid");
		$(this).parent().removeClass("chatSelected");
		
	});
	
	
});

