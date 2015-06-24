<!-- poner las tablas hidden(de verdad) -->

<?php
 include("recommender.php");
?>

<html>
	<link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap/dashboard.css" rel="stylesheet">
	<style>
			
		.hid{
			visibility:hidden;
		}
		
		.selected{
			background:red;
		}
		table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}

.improved{
	bottom:40%;
}
h1{
	color:blue;
}
.quest{
    		font-style: italic;
    		font-size: 20px;
    	}
   h2:hover{
   	cursor:pointer;
   }
   .fila:hover{
   	cursor:pointer;
   }
	#logoScribe{
	height:56px;
	position:relative;
	left:3%;
}
</style>
<body>
 
   <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
      	<a href="../../../Scribe/modules.html">
          <img id="logoScribe"  src="../../img/icons/logo.png" />
        </a> 
       
        
        </div>
    </nav>

    <div class="container-fluid">
    	<div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="" style="text-align: center"> Article Impact Prediction</a></li>
          </ul>
          <p style=" word-wrap: break-word;">Predict and improve the future impact of your stories by creating more prominent titles.</p>
          <br>
          <p style=" word-wrap: break-word;"><span class="quest">How we can implement it in our tool:</span><br>
          	When writing a story, the module will analyse the current impact of their titles and recommend synonyms to improve it.
          	 <br>
          <p style=" word-wrap: break-word;"><span class="quest">What's the benefit for the journalist?</span><br>
          They will know in advance how prominent their titles will be on the Web.</p>
        
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		 
	
		<div class="row">
			<div class="col-md-8">
			<?php
			 $rec=new Recommender();
			 $rec->initialize();
			 $tokens=$rec->tokenise("the joys and dangers of exploring africa");
			 $count=0;
			 $rec->process("the joys and dangers of exploring africa");
			 echo "<h2>";
			 foreach ($tokens as $token){
			 	echo "<span class='wordProposal' id='word$count'> $token </span>";
				$count++;
			 }
			 echo "</h2>";
			 ?>
			</div>
			<div class="col-md-4">
				<div class="puntuacion">
					<h1> 30 %</h1>
				</div>
			</div>
	    </div>
	    <br>
	    <div class="row">
	    	<div class="col-md-8">
				<div class="tablerec">
					<table>
						<tr><th>Hints</th><th>Score %</th></tr>
						<tr class="fila" id="0"><td id="f11"></td><td id="f12"></td></tr>
						<tr class="fila" id="1"><td id="f21"></td><td id="f22"></td></tr>
					</table>
			</div>
			</div>
		</div>
		<br>
		<br><br>
		<div class="improved">
		<div class="row">
			
				
					<div class="col-md-8"> 
					<?php  
					 $count=0;
					 echo "<h2>";
					 foreach ($tokens as $token){
					 	echo "<span class='word' id='word$count'> $token </span>";
						$count++;
					 }
					 echo "</h2>";
					?>
			    </div>
					<div class="puntuacion col-md-4">
						<h1><span>30</span>&nbsp;%</h1>
					</div>
			  </div>
	   </div>
	  </div>
	 </div>
	</div><!-- end container -->
	</body>
	
	
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
	
		$(document).ready(function(){
			$(".fila").addClass("hid");
			
			$(".wordProposal").hover(function(){ 
				$(".wordProposal").removeClass("selected");
				$(this).addClass("selected");
				$(".fila").addClass("hid");
				
				var word=$(this).html();
				word=word.substring(1,word.length-1);
				word=word.toString();
				if(word=="joys"){
					$(".fila").removeClass("hid");
					$("#f11").html("pleasures");$("#f12").html("12");
					$("#f21").html("amusement");$("#f22").html("9");
				}else if(word=="dangers"){
					$(".fila").removeClass("hid");
					$("#f11").html("risks");$("#f12").html("22");
					$("#f21").html("insecurity");$("#f22").html("8");
				}else if(word=="exploring"){
					$(".fila").removeClass("hid");
					$("#f11").html("delving into");$("#f12").html("19");
					$("#f21").html("examining");$("#f22").html("10");
				}
			});
			
			
		   $('.fila').click(function(){ //when we click on a row, the improved title changes: the corresponding word and the score
		   		//first we change the word
		   		var idSelected=$(".selected").attr("id");
		   		if($("#"+idSelected).attr("done")){
		   			return;
		   		}else{
		   			var substitute=$(this).children().first().html(); //get the word to replace
		   		$(".improved #"+idSelected).html(" "+substitute);
		   		//now we change the score
		   	    var oldScore=parseInt($(".improved .puntuacion span").html());
			   	var newPoints=$(this).children().last().html();
			   	newPoints=parseInt(newPoints);
			   	var newScore=oldScore+newPoints;
			   	 if(newScore < 90){
			   	    $(".improved .puntuacion span").html(newScore);
			   		var idFila=$(this).attr('id'); //take the id of the raw to know which word to change
			   		$(".puntuacion.col-md-4 h1").css('color','green'); //lastly we put the value in green
			   		$("#"+idSelected).attr("done","yes");
		   		 }
		   		}
		   		
		   });
		});
		
	</script>
</html>