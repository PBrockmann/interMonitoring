<?php
session_save_path("tmp");
session_start();
?>

<HTML>
<HEAD>
</HEAD>

<BODY>

<FONT style="font-family: Arial, Helvetica, sans-serif;">
<p><span style="border-bottom: 3px solid #FF6600;">
Select one or more <i>JobName</i> directory
</span></p>

<form name="formstep01" method="post" action="step02.php" target="step02">

<select name="selectsimus[]" size="10" multiple="true" 
style="width: 800px; font-family: Arial, Helvetica, sans-serif;">
<?php

foreach($_SESSION['urls'] as $url) {
	print("<option selected=\"selected\" value='".$url."'>".$url."</option>\n");
} 

?>
</select>

<p>     
<input type="submit" value="Search files"
onclick="parent.showTab('dhtmlgoodies_tabView1',1);"
style="font-family: Arial, Helvetica, sans-serif;"
title="Search all common netCDF files found in subdirectories MONITORING/files">
</p>     

</form>

</FONT>
</BODY>
</HTML>
