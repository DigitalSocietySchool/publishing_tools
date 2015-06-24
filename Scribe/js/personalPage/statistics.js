$(document).ready(function(){
	$("#addStatistics").click(function(){
		$("#modalStatistics").modal("toggle");
	});
	
     	$(".close").click(function(){
     		$(this).parents(".panel").addClass("hidden");
     	});
     $("#timeStayed").click(function(){
     	 $("#timeStayedBox").removeClass("hidden");
     	 $("#modalStatistics").modal("toggle");
     }); 
});
