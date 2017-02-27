<?php

$xml=simplexml_load_file("http://esgf.extra.cea.fr/thredds/catalog/work/p86caub/IPSLCM5A-MR/PROD/historicalGHGNOLU/v5.historicalGHGNOLUMR1/MONITORING/files/catalog.xml");

$tab = array();
foreach($xml->dataset[0]->children() as $c)
	if ($c->getName() == "dataset")
		foreach($c->attributes() as $a => $b)
			if ($a == "name" && preg_match('/^.*\.(nc)$/i', $b))
				$tab[]=(string) $b;		

sort($tab);
print_r($tab);


?> 
