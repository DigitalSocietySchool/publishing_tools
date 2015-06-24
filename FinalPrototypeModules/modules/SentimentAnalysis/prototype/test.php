<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Modules for the future journalists ">
    <meta name="author" content="Javier Trujillo">

    <title>Modules</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/bootstrap/dashboard.css" rel="stylesheet">
	<style>
		.quest{
    		font-style: italic;
    		font-size: 20px;
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
      	<a href="../../../../Scribe/modules.html">
          <img id="logoScribe"  src="../../../img/icons/logo.png" />
        </a> 
       
        
        </div>
    </nav>
    <div class="container-fluid">
    	<div class="row">
       <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="" style="text-align: center"> Sentiment Analysis</a></li>
          </ul>
          <p style=" word-wrap: break-word;">Analize the general mood of a given text.</p>
          <br>
          <p style=" word-wrap: break-word;"><span class="quest">How we can implement it in our tool:</span><br>
          	In the social feed section, the journalist can analyze the overall sentiment of the readers.
          	 <br>
          <p style=" word-wrap: break-word;"><span class="quest">What's the benefit for the journalist?</span><br>
They would be able to know what people think about their article, a very useful feedback they can make use of to adapt their stories according to make them more prominent.</p>
        
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div class="row">
		<table class="table table-striped">
			<tr><th>Title</th><th>Dominant</th><th>Positive</th><th>Neutral</th><th>Negative</th></tr>
		
			
		
	<?php
	/*if (PHP_SAPI != 'cli') {
		echo "<pre>";
	}*/
	
	$strings = array(
		1 => 'Weather today is rubbish',
		2 => 'This cake looks amazing',
		3 => 'His skills are mediocre',
		4 => 'He is very talented',
		5 => 'She is seemingly very agressive',
		6 => 'Marie was enthusiastic about the upcoming trip. Her brother was also passionate about her leaving - he would finally have the house for himself.',
		7 => 'To be or not to be?',
		8 => 'The joys and dangers of exploring'
	);
	
	require_once __DIR__ . '/../autoload.php';
	$sentiment = new \PHPInsight\Sentiment();
	foreach ($strings as $string) {
	
		// calculations:
		$scores = $sentiment->score($string);
		$class = $sentiment->categorise($string);
	
		// output:
		/*echo "<h1> $string\n";
		echo "Dominant: $class, scores: ";
		print_r($scores);
		echo "\n";*/
		echo "<tr>";
		echo "<td>$string</td><td>$class</td><td>$scores[pos]</td><td>$scores[neu]</td><td>$scores[neg]</td>";
		echo "</tr>";
	}
	
	?>
	</table>
	</div>
	</div>
	</div>
	</div>
</body>
</html>