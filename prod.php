<?php
session_save_path("tmp");
session_start();

?>

<HTML>
<HEAD>

<!-- ################### -->
<STYLE type="text/css">
div#message {
   width: 600px;
   height: 180px;
   background-color: #FFFF00;
   text-align: center;
}
div#netvibes {
   width: 600px;
}
</STYLE>
<!-- ################### -->

</HEAD>

<BODY>

<div id="message" style="font-family : Arial, Helvetica, sans-serif;"><B>
Your request is being processed by webservices2017.ipsl.fr<BR>
The result will be displayed in this window in a while.<BR>
Stay online ...
</B></div>

<BR>

<div>
<script language="javascript" charset="utf-8" src="http://dicocitations.lemonde.fr/citationblog.js"></script>
</div>

<?php

#=====================
include ("ProgressBar.php");
ProgressBar_Initialize(100,100,400,35,'#000000','#FFCC00','#006699');

#====================
$scriptname=$_GET['name'].".jnl";
$outputdir=$_GET['name']."_prod";
exec("rm -rf $outputdir");
exec("mkdir -p $outputdir/images");

$colors=array("ATM" => "AECDFF", "CHM" => "F0D5F4", "ICE" => "D4E3E6", "MBG" => "D0F8E0", "OCE" => "6D80FF", "SBG" => "EEE8AA", "SRF" => "E7FFAB");

$filesnb=count($_SESSION['allfiles']);
$filescount=1;
foreach($_SESSION['allfiles'] as $file) {
        $basefile=basename($file, ".nc");
        exec(". /home/webservices/.env_prod.sh ; pyferret -batch $outputdir/images/$basefile.png -script $scriptname $file ; convert $outputdir/images/$basefile.png $outputdir/images/$basefile.gif");
        $filepieces=split('_', $file);
        $color=$colors[$filepieces[0]];
        exec("convert -geometry 50%x50% -bordercolor \"#$color\" -border 15x15 $outputdir/images/$basefile.gif $outputdir/images/$basefile.jpg");
        $percent=intval(100./$filesnb*$filescount);
        $status=sprintf("Status: processing file %03d of %03d", $filescount, $filesnb);
        $title="Inter-monitoring $percent%";
        ProgressBar_Update($percent,$status,$title);
        ++$filescount;
}

foreach ($_SESSION['simus'] as $s)
        $listsimus[]=basename($s);
exec(". /home/webservices/.env_prod.sh ; monitoring01_createindex -t 'Inter-monitoring: ".implode(" vs ", $listsimus)."' $outputdir");

#====================
#exec("rm -rf tmp/*");
#exec("sleep 10",$return_code);
exec("chmod -R 777 tmp/*");

#====================
print("<HR>\n");
print_r(implode("<BR>\n",$return_code));
print("<HR>\n");

#=====================
print("\n<script>");
print("window.location.replace(\"$outputdir\")");
print("</script>\n");

?>

</BODY>
</HTML>
