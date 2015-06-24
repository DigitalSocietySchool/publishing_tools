$(document).ready(function(){
	$("[name='my-checkbox']").bootstrapSwitch();
	$(".moduleBox p").addClass("hid");
	$(".moduleBox").hover(function(){
		$(this).find("p").toggleClass("hid");
	});
});

