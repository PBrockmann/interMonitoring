<?php

$xml=simplexml_load_file("http://esgf.extra.cea.fr/thredds/catalog/work/p86caub/IPSLCM5A-MR/PROD/historicalGHGNOLU/v5.historicalGHGNOLUMR1/MONITORING/files/catalog.xml");

$list = array();
foreach($xml->dataset[0]->children() as $c) {
//echo $c->getName(),"<br>";
	if ($c->getName() == "dataset")
	foreach($c->attributes() as $a => $b) {
		if ($a == "name" && preg_match('/^.*\.(nc)$/i', $b)) {
			echo $a,'="',$b,'"<br>';
			$list[]=(string) $b;		
		}
  	}
//echo "<br>";
}


print_r($list);


?> 
