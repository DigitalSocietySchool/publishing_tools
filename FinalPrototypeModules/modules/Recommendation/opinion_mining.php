<?php
//remember php the associative arrays
class Opinion {
        private $index = array(); 
        private $classes = array('pos', 'neg');
        private $classTokCounts = array('pos' => 0, 'neg' => 0);
        private $tokCount = 0; //total number of words counted (for training)
        private $classDocCounts = array('pos' => 0, 'neg' => 0);
        private $docCount = 0;
        private $prior = array('pos' => 0.5, 'neg' => 0.5);

//MOSTLY FOR TRAINING
        public function addToIndex($file, $class, $limit = 0) {
                $fh = fopen($file, 'r');
                $i = 0;
                if(!in_array($class, $this->classes)) {//is $class in our array of sentiments
                        echo "Invalid class specified\n";
                        return;
                }
                while($line = fgets($fh)) {
                        if($limit > 0 && $i > $limit) {
                                break;
                        }
                        $i++;
                        
                        $this->docCount++;
                        $this->classDocCounts[$class]++;
                        $tokens = $this->tokenise($line);
                        foreach($tokens as $token) { //we take each word 
                                if(!isset($this->index[$token][$class])) {//1º check if it is stored (for this class/sentiment). In case it wasn't we create this element with value=0
                                        $this->index[$token][$class] = 0;
                                }
                                $this->index[$token][$class]++; //
                                $this->classTokCounts[$class]++;
                                $this->tokCount++;
                        }
                }
                fclose($fh);
        }
        
        public function classify($document) {
                $this->prior['pos'] = $this->classDocCounts['pos'] / $this->docCount;
                $this->prior['neg'] = $this->classDocCounts['neg'] / $this->docCount; 
                $tokens = $this->tokenise($document);
                $classScores = array();

                foreach($this->classes as $class) {
                        $classScores[$class] = 1;
                        foreach($tokens as $token) {
                                $count = isset($this->index[$token][$class]) ? 
                                        $this->index[$token][$class] : 0;

                                $classScores[$class] *= ($count + 1) / 
                                        ($this->classTokCounts[$class] + $this->tokCount);
                        }
                        $classScores[$class] = $this->prior[$class] * $classScores[$class];
                }
                
                arsort($classScores); //sort in reverse order, according to the values (not the keys)
                return key($classScores); //give the first key (first class ( the most important ))
        }

        private function tokenise($document) {
                $document = strtolower($document);
                preg_match_all('/\w+/', $document, $matches);
                return $matches[0];
        }
}
?>