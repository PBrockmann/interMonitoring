<?php
session_save_path("tmp");
session_start();
$_SESSION['simus'] = $_POST['selectsimus'];
?>

<HTML>
<HEAD>
</HEAD>

<BODY>

<FONT style="font-family: Arial, Helvetica, sans-serif;">
<p><span style="border-bottom: 3px solid #FF9900;">
Select one file from
</span></p>

<?php
$n=1;
foreach($_SESSION['simus'] as $simu){
	$xml=simplexml_load_file($simu."/MONITORING/files/catalog.xml");
	$tab = array();
	foreach($xml->dataset[0]->children() as $c) 
		if ($c->getName() == "dataset")
			foreach($c->attributes() as $a => $b) 
				if ($a == "name" && preg_match('/^.*\.(nc)$/i', $b)) 
					$tab[]=(string) $b;		

	sort($tab);
	if ($n == 1) $tabinter=$tab;
	else $tabinter=array_intersect($tabinter,$tab);
	$n=$n+1;
}

?>

<form name="formstep02" method="post" action="choices.php" target="choices">

<select name="selectfile" size="10" 
style="width: 800px; font-family: Arial, Helvetica, sans-serif;">

<?php
if (sizeof($tabinter) == 0) {
	print("<option value=\"none\">no files or no common files found</option>\n");
	if (isset($_SESSION['file'])) $_SESSION['file']="?";
	}	
else foreach($tabinter as $file1){
	if (!strcmp($_SESSION['file'],$file1))  
    		print("<option selected=\"selected\" value=\"$file1\">$file1</option>\n");
        else
    		print("<option value=\"$file1\">$file1</option>\n");
	}

$_SESSION['allfiles']=$tabinter;

?>
</select>

<p>     
<input type="submit" value="Validate"
onclick="parent.showTab('dhtmlgoodies_tabView1',2);"
style="font-family: Arial, Helvetica, sans-serif;"
title="Validate Step 1,2">
</p>    

</form>

</FONT>
</BODY>
</HTML>
