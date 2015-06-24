
<html>
	<head>
		
	<link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
		  padding-top: 40px;
		  padding-bottom: 40px;
		  background-color: #eee;
		}
	</style>
	</head>
	<body>
		
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
</body>
</html>