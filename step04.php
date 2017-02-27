<?php
session_save_path("tmp");
session_start();
?>

<HTML>
<HEAD>

<link rel="stylesheet" href="css/tab-view.css" type="text/css" media="screen">
<script type="text/javascript" src="js/tab-view.js"></script>

</HEAD>

<BODY>

<FONT style="font-family: Arial, Helvetica, sans-serif;">
<p><span style="border-bottom: 3px solid #FFCC00;">
Select one script
</span></p>

<form name="formstep04" method="post" action="choices.php" target="choices">

<select name="selectscript" size="4" 
style="width: 1000px; font-family: Arial, Helvetica, sans-serif;">
<option selected="selected" value="plot01">plot01: Time series</option>
<option value="plot02">plot02: Time series (time axis as indices)</option>
</select>       

<p>     
<input type="submit" value="Validate"
style="font-family: Arial, Helvetica, sans-serif;"
title="Validate Step 4">
</p>    

</form>

</FONT>
</BODY>
</HTML>
