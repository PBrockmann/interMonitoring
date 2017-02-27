<?php
session_save_path("tmp");
session_start();
$_SESSION['url'] = rtrim($_POST['url'],'/');
?>

<HTML>
<HEAD>
</HEAD>

<BODY>

<FONT style="font-family: Arial, Helvetica, sans-serif;">
<p><span style="border-bottom: 3px solid #FF6600;">
Select one or more <i>JobName</i> directory
</span></p>

<form name="formstep02" method="post" action="step03.php" target="step03">

<select name="selectsimus[]" size="10" multiple="true" 
style="width: 1000px; font-family: Arial, Helvetica, sans-serif;">
<?php

$urls=array();
if(isset($_POST['append'])) {	# will not pass there if $_POST['list'] is set 
if(isset($_SESSION['urls'])) {
	foreach($_SESSION['urls'] as $url) {
		print("<option value='".$url."'>".$url."</option>\n");
		$urls[]=$url;	
	}
}
} 

// Parse the Thredds server catalog.xml
$xml=simplexml_load_file($_SESSION['url']."/catalog.xml");

// select only directories
$listdir = array();
foreach($xml->dataset[0]->children() as $c) {
        if ($c->getName() == "catalogRef")
        foreach($c->attributes('xlink', TRUE) as $a => $b) {
        	if ($a == "title") $listdir[]=(string) $b;
	}
}

arsort($listdir);
foreach($listdir as $dir1){
	$url=$_SESSION['url']."/".$dir1;
	print("<option value='".$url."'>".$url."</option>\n");
	$urls[]=$url;	
}

$_SESSION['urls']=$urls;

?>
</select>

<p>     
<input type="submit" value="Search files"
onclick="parent.showTab('dhtmlgoodies_tabView1',2);"
style="font-family: Arial, Helvetica, sans-serif;"
title="Search all common netCDF files found in subdirectories MONITORING/files">
</p>     

</form>

</FONT>
</BODY>
</HTML>
