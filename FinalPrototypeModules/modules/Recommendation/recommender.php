<?php 
	include("opinion_mining.php");
?>
<?php
//algorithm: you write a title:
/*You know whether is considered positive,negative or neutral (along with the statistics)
 *As well as tagging the content: is it action, war, football ...?
 *Then you have the options of make it prominent or change its mood (pos,neg,neut)
 * 
 * Example: A good travel around the big British Empire --> a fascinating travel around the great British Empire
 * 
 */
 class Recommender{
	public $synonyms=array();//asociative array that imitate a Map in Java
	private $numberOfTokens;//number of words in text
	public $relevance;
	
	public function initialize(){ //initialize the synonyms
		$this->synonyms=array("peter" => array("pedro","pepe"));
	}
	
	public function tokenise($document) {
		//1º: strips the tokens in an article
		//2º: state the total number of tokens in the variable "numberOfTokens"
                $document = strtolower($document);
                preg_match_all('/\w+/', $document, $matches);
				$this->numberOfTokens=sizeof($matches[0]);
                return $matches[0];
    }
	
	public function process($document){
		//1º: take every word and get its synonyms
		//2º: at the same time count which ones are already prominent, so that at the end we know $relevance of the sentence
		$numberOfPromWords=0; //number of prominent words in an title
		$tokens=$this->tokenise($document);
		foreach ($tokens as $word) {
			if(isset($this->synonyms[$word])){
				print_r($this->synonyms[$word]);
			}else{
				foreach ($this->synonyms as $arr) {
					
						if(in_array($word, $arr)){
					    	$numberOfPromWords++;
						}
					
				}
			}
		}
		//lastly, calculate relevance
		$this->relevance=($numberOfPromWords*100)/$this->numberOfTokens;
	}
	
 }
 
 //Examples 
 
 /*
 //1º: Sentiment Analysis
 $op = new Opinion();
 $op->addToIndex('opinion/rt-polaritydata/rt-polarity.neg', 'neg');
 $op->addToIndex('opinion/rt-polaritydata/rt-polarity.pos', 'pos');
 $string = "Avatar had a surprisingly decent plot, and genuinely incredible special effects";
 echo "Classifying '$string' - " . $op->classify($string) . "\n";
 
 
 //2º: Recommender
 $rec=new Recommender();
 $rec->initialize();
 $tokens=$rec->tokenise("Peter world");
 print_r($rec->synonyms["peter"]);
 $count=0;
 foreach ($tokens as $token){
 	echo "<span id=word$count> $token </span>";
	$count++;
 }
 
*/





?>



<!--
	MYSQL statements
	
create table keywords(
	name varchar(50) not null primary key
);
CREATE TABLE synonyms(
	synname VARCHAR(50) NOT NULL PRIMARY KEY
);
create table word_synonyms(
	name_id varchar(50) not null,
	syn_id varchar(50) not null,
	primary key(name_id,syn_id)
	);
	
select *
from synonyms s
inner join word_synonyms ws
on ws.name_id='javier' ;
-->
 