<?php
session_save_path("tmp");
session_start();
if (isset($_POST['selectfile']))
	$_SESSION['file'] = $_POST['selectfile'];
if (isset($_POST['selectscript']))
	$_SESSION['script']=$_POST['selectscript'];
?>

<HTML>
<HEAD>

<script type="text/javascript" src="js/external/mootools.js"></script>
<link type="text/css" href="jquery-ui/themes/base/ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="jquery-ui/jquery-1.3.2.js"></script>
<script type="text/javascript" src="jquery-ui/ui/ui.core.js"></script>
<script type="text/javascript" src="jquery-ui/ui/ui.slider.js"></script>
<script type="text/javascript" src="jquery-ui/ui/ui.spinner.js"></script>
<script type="text/javascript" src="jquery-ui/external/mousewheel/jquery.mousewheel.min.js"></script>

<style type='text/css'>
.ui-spinner {
    display: inline-block;
    height: 24px;
}
.ui-slider .ui-slider-handle { width: 4px; margin-left: -2px; }
#slider-range {
    top: -20px;
    left: 230px;
    position: relative;
    width: 600px;
}
#smoothBoxDiv {
    float: left;
    margin-top: 8px;
    margin-right: 12px;
}
.ui-spinner {
    margin-top: 6px;
}
#dateOffsetValues {
    width: 308px;
    margin-top: 6px;
}
#dateOffsetDiv {
    float: left;
    margin-top: 8px;
    margin-right: 12px;
}
.ui-slider-horizontal {
    height: 1em;
}
.ui-slider-horizontal .ui-slider-handle {
    top: -0.15em;
}
</style>

<script type="text/javascript">
$(function() {
	$("#sbx").spinner({min: 1, max: 500, step: 12});
	$("#slider-range").slider({
		range: true,
		min: 1700,
		max: 10000,
		step: 10,
		values: [1800, 2100],
		slide: function(event, ui) {
			$("#hlimuser").val(ui.values[0] + ' - ' + ui.values[1]);
			$("#radio2").attr("checked","checked");
		}
	});
	$("#hlimuser").val($("#slider-range").slider("values", 0) + ' - ' + $("#slider-range").slider("values", 1));
});
</script>

</HEAD>

<BODY>

<FONT style="font-family: Arial, Helvetica, sans-serif;">

<p><span style="background-color:#99FF33;">
&nbsp;&nbsp;Recall of your choices&nbsp;&nbsp;
</span></p>

<?php
$ready=True;

print('<input type="radio" value="1" checked="checked"/>');
if (isset($_SESSION['simus']) && ($_SESSION['simus'] != "?"))
        print(" ".implode(", ", $_SESSION['simus']));
else if (isset($_COOKIE['simus'])) {
        print(" ".$_COOKIE['simus']);
	$_SESSION['simus']=explode(",",$_COOKIE['simus']);
}
else {
        print(" ?");
	$ready=False;
}
print('<BR>');

print('<input type="radio" value="1" checked="checked"/>');
if (isset($_SESSION['file']) && ($_SESSION['file'] != "?") && ($_SESSION['file'] != "none"))
        print(" ".$_SESSION['file']);
else if (isset($_COOKIE['file'])) {
        print(" ".$_COOKIE['file']);
	$_SESSION['file']=$_COOKIE['file'];
}
else {
        print(" ?");
	$ready=False;
}
print('<BR>');

if (!isset($_SESSION['url']))
	$_SESSION['url']=$_COOKIE['url'];

if (!isset($_SESSION['allfiles']))
	$_SESSION['allfiles']=explode(", ",$_COOKIE['allfiles']);

print('<input type="radio" value="1" checked="checked"/>');
if (isset($_SESSION['script']) && ($_SESSION['script'] != "?"))
        print(" ".$_SESSION['script']);
else if (isset($_COOKIE['script'])) {
        print(" ".$_COOKIE['script']);
	$_SESSION['script']=$_COOKIE['script'];
}
else {
        print(" ?");
	$ready=False;
}
print('<BR>');
?>

<form name="formchoice" method="post" action="script.php" target="_blank">
<input style="float: left;" type="radio" value="1" checked="checked"/>
<div id="smoothBoxDiv">Smoothing box value:</div>
<input name="sbx" id="sbx" name="value" type="text" align="middle" style="font-family: Arial, Helvetica, sans-serif;font-size:90%;"
<?php
if (isset($_SESSION['sbx']))
	print("value=\"".$_SESSION['sbx']."\"");
else if (isset($_COOKIE['sbx'])) {
	print("value=\"".$_COOKIE['sbx']."\"");
	$_SESSION['sbx']=$_COOKIE['sbx'];
}
else
	print("value=\"12\"");
?>
title="Apply a boxcar window (running mean) to smooth the variable">
<BR>

<input type="radio" name="hlim" value="default" id="radio1" checked="checked"/>
<label for="radio1">Dates default</label><BR>

<input type="radio" name="hlim" value="user" id="radio2" />
<label for="radio2">Dates range:</label>
<input type="text" name="hlimuser" id="hlimuser" style="border:0;font-family: Arial, Helvetica, sans-serif;font-size:100%;" />
<div id="slider-range" title="Valid only with time series (See Step 4)"></div>

<input style="float: left;" type="radio" name="dateOffset" value="default" id="radio3" checked="checked"/>
<div id="dateOffsetDiv" title="Use this input to translate simulations on their dates">Date offset:</div>
<input type="text" name="dateOffsetValues" value="0" id="dateOffsetValues"
title="Indicate year offsets separated by comma (0 or empty for no change). Example: ,100,,150 to translate simu2 of 100 years and simu4 of 150 years" />

<BR>
<p>     
<input type="submit" value="Prepare and Run the ferret script"
style="font-family: Arial, Helvetica, sans-serif;"
<?php
if (!($ready)) print("disabled\n");
?>
title="">
</p>     

</form>

</FONT>
</BODY>
</HTML>
