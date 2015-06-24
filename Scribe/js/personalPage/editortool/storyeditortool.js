$(document).ready(function(){
    		//--------------MOST LEFT NAVIGATION:
    		//first of all we only display as selected the Impact Prediction module
    		$(".modulesNav img").addClass("hid");
    		$("#geoImg").removeClass("hid");
    		
    		//clicks for displaying the second left column 
    		$("#module").click(function(event){
    			event.preventDefault();
    			//1º Make sure the other one is closed
    			$(".shareNav").addClass("hidden");
    			$("#share").find("img").attr("src","img/storyeditor/editorTool/arrownavigation.png");
    			//2º Now we move to the current one
    			$(".modulesNav").toggleClass("hidden");
    			if($(".modulesNav").hasClass("hidden")){
    				$(this).find("img").attr("src","img/storyeditor/editorTool/arrownavigation.png");
    			}else{
    				$(this).find("img").attr("src","img/storyeditor/editorTool/arrowdown.png");
    			}
    		});
    		$("#share").click(function(event){
    			event.preventDefault();
    			//1º Make sure the other one is closed
    			$(".modulesNav").addClass("hidden");
    			$("#module").find("img").attr("src","img/storyeditor/editorTool/arrownavigation.png");
    			//2º Now we move to the current one
    			$(".shareNav").toggleClass("hidden");
    			if($(".shareNav").hasClass("hidden")){
    				$(this).find("img").attr("src","img/storyeditor/editorTool/arrownavigation.png");
    			}else{
    				$(this).find("img").attr("src","img/storyeditor/editorTool/arrowdown.png");
    			}
    		});
    		
    		
    		$("#impactModule").click(function(event){
    			event.preventDefault();
    			//1º: we change the most left nav
    			$(".modulesNav img").addClass("hid");
    			$("#impactImg").removeClass("hid");
    			//2º: change the content of the second left nav 
    			$(".geoContent").addClass("hidden");
    			$(".shareContent").addClass("hidden");
    			$(".predictionContent").removeClass("hidden");
    		});
    		$("#geoModule").click(function(event){
    			event.preventDefault();
    			//1º: we change the most left nav
    			$(".modulesNav img").addClass("hid");
    			$("#geoImg").removeClass("hid");
    			//2º: change the content of the second left nav 
    			$(".predictionContent").addClass("hidden");
    			$(".shareContent").addClass("hidden");
    			$(".geoContent").removeClass("hidden");
    		});
    		
    		$("#personalNetModule").click(function(event){
    			event.preventDefault();
    			
    			//1º: we don't need to change the most left nav, since Personal Network is the only available option
    			//2º:change the content of the second left nav
    			$(".predictionContent").addClass("hidden");
    			$(".geoContent").addClass("hidden");
    			$(".shareContent").removeClass("hidden");
    		});
            
            //---------------IMPACT MODULE------------
            $(".recommendedWords a").click(function(){
            	//if( (this).attr("wordNumber")!==null)
            	var number=$(this).attr("wordNumber");
            	$("#word"+number).html($(this).html());
            	var score=Number($("#score span").html());
            	if(score < 80)
            		$("#score span").html((score+20));
            
            });
            
            $("#addNewTitle").click(function(){
            	$(".articleTitle h2").html($(".newTitle").html());
            	$(".lastPublish span").html($(".newTitle").html());
            });
            
            
            //---------------SHARE MODULE-----------
            $(".shareContent img").addClass("networkNoBorder");
            $(".shareContent img").click(function(event){
            	event.preventDefault();
            	$(this).toggleClass("networkNoBorder").toggleClass("networkBorder");
            	
            	//in case I forgot to share it with someone else 
            	$("#shareButton").html("Share").removeClass("newShareButton");
            	
            });
            
            $("#shareButton").click(function(){
            	$(".shareContent img").removeClass("networkBorder").addClass("networkNoBorder");
            	$(this).html("Done!").addClass("newShareButton");
            });
    		//---------------ANNOTATION-----------------
    		//pop it up
    		$(".articleImage img").click(function(){
    			$(".annotation").toggleClass("hidden");
    		});
    		//destroy note
    		$(".annotation button").click(function(){
    			$(".annotation, .articleImage img").addClass("hidden");
    			
    		});
			
			
			//---------------PINBOARD:initial image menu--------------------
			$(".articleImage").hover(function(){
			    $(".pinMenu").removeClass("hidden");
		    },function(){
		    	$(".pinMenu").addClass("hidden");
		    });
			  
			//---------------PINBOARD:modal--------------------
			
			$("#pinboardImg").click(function(event){
				event.preventDefault();
				$("#modal1").addClass("hidden");
				$("#modal2").removeClass("hidden");
			});
			
			$("#pinboardNewImage").click(function(){
				event.preventDefault();
				$(".articleImage").removeClass("articleImageBack1").addClass("articleImageBack2");
				$("#modalPinboard").modal("toggle");
			});
			
			$(".recommendedTags").on("click","span",function(){ //WE MUST USE 'ON' FOR THE DINAMICALLY CREATED OBJECTS
				$(this).parent().remove();
			});
			
			//---------------PUBLISHING--------
			$(".checkers button").click(function(){
				if($(this).html()==""){
					$(this).html("X");
				}else{
					$(this).html("");
				}
			});
			$(".cancelPublish").click(function(){
				$("#modalPublish").modal("toggle");
			});
			$("#publishOk").click(function(){
				$("#modalPublishContent1").addClass("hidden");
				$("#modalPublishContent2").removeClass("hidden");
			});
			$("#backEditor").click(function(){
				$("#modalPublish").modal("toggle");
			});
    	});
    	