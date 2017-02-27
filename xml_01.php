<?php

$xml=simplexml_load_file("http://esgf.extra.cea.fr/thredds/catalog/work/p86caub/IPSLCM5A-MR/PROD/catalog.xml");
//$xml=simplexml_load_file("http://esgf.extra.cea.fr/thredds/catalog/work/p86caub/IPSLCM5A-MR/PROD/historicalGHGNOLU/catalog.xml");
//$xml=simplexml_load_file("http://esgf.extra.cea.fr/thredds/catalog/work/p86caub/IPSLCM5A-MR/PROD/historicalGHGNOLU/v5.historicalGHGNOLUMR1/MONITORING/catalog.xml");

$list = array();
foreach($xml->dataset[0]->children() as $c) {
//echo $c->getName(),"<br>";
	if ($c->getName() == "catalogRef")
	foreach($c->attributes('xlink', TRUE) as $a => $b) {
		if ($a == "title") {
			echo $a,'="',$b,'"<br>';
			$list[]=(string) $b;		
		}
  	}
//echo "<br>";
}


print_r($list);


?> 
