<?php
preg_match("/.*_.*_(.*_.*)_.*.nc/",$_SESSION['file'], $matches);
$varname=$matches[1];

$fh = fopen($tmpfname.".jnl", "w");
$cmd="!============================";
fwrite($fh, $cmd."\n");
$cmd="! Script generated by the inter-monitoring application by LSCE\n";
fwrite($fh, $cmd."\n");
# mode linecolors is an undocumented mode (beta) 
# /thick does not work
$cmd="set mode linecolors 30"; 
fwrite($fh, $cmd."\n");
$cmd="set window/size=0.4 1 ; cancel mode logo";
fwrite($fh, $cmd."\n");
$cmd="set view full ; go margins_set 15 30 10 08";
fwrite($fh, $cmd."\n");
$cmd="\n!============================";
fwrite($fh, $cmd."\n");
$cmd="!Please change the colors or/and legends if needed";
fwrite($fh, $cmd."\n");
$cmd='let colors={"3B63E6", "FF4500", "FFE000", "34D314", "FF1392", "FFA400", "775BB4", "9ACD32", "789BF1", "AFDFE6", "0000C7", "1FB1AA", "B12121", "DEB886", "FFB6C1", "CCCCCC"}';
fwrite($fh, $cmd."\n");
$cmd='! Keep black in #1, gray will be at #17';
fwrite($fh, $cmd."\n");
$cmd='repeat/name=dv/range=1:16 ( define symbol ds=`dv` ; go set_color_from_hexa `dv+1` `colors[i=($ds)]` )';
fwrite($fh, $cmd."\n");
$cmd="\n!============================";
fwrite($fh, $cmd."\n");
$cmd="def symbol FILE=($01%".$_SESSION['file']."%)";
fwrite($fh, $cmd."\n\n");
$nd=0;
foreach ($_SESSION['simus'] as $s){
        $s=str_replace('thredds/catalog', 'thredds/dodsC', $s);
	$cmd="use \"".$s."/MONITORING/files/(\$FILE)\"";
	fwrite($fh, $cmd."\n");
        $nd=$nd+1;
}
$cmd="\ndef symbol NVAR1=`..nvars`";
fwrite($fh, $cmd."\n");
$cmd="def symbol VAR1=`..varnames[i=(\$NVAR1)]`";
fwrite($fh, $cmd."\n");
$cmd="def symbol SMOOTH=(\$02%".$_POST['sbx']."%)";
fwrite($fh, $cmd."\n");
$cmd="if `strindex(\"(\$FILE)\", \"_JAN_\") OR strindex(\"(\$FILE)\", \"_FEB_\") OR \\";
fwrite($fh, $cmd."\n");
$cmd="    strindex(\"(\$FILE)\", \"_MAR_\") OR strindex(\"(\$FILE)\", \"_APR_\") OR \\";
fwrite($fh, $cmd."\n");
$cmd="    strindex(\"(\$FILE)\", \"_MAY_\") OR strindex(\"(\$FILE)\", \"_JUN_\") OR \\";
fwrite($fh, $cmd."\n");
$cmd="    strindex(\"(\$FILE)\", \"_JUL_\") OR strindex(\"(\$FILE)\", \"_AUG_\") OR \\";
fwrite($fh, $cmd."\n");
$cmd="    strindex(\"(\$FILE)\", \"_SEP_\") OR strindex(\"(\$FILE)\", \"_OCT_\") OR \\";
fwrite($fh, $cmd."\n");
$cmd="    strindex(\"(\$FILE)\", \"_NOV_\") OR strindex(\"(\$FILE)\", \"_DEC_\")` then";
fwrite($fh, $cmd."\n");
$cmd="        let var=tsequence((\$VAR1)[L=@FNR])";
fwrite($fh, $cmd."\n");
$cmd="        def sym TRANSF=@FNR";
fwrite($fh, $cmd."\n");
$cmd="else";
fwrite($fh, $cmd."\n");
$cmd="        let var=tsequence((\$VAR1)[L=@SBX:(\$SMOOTH)])";
fwrite($fh, $cmd."\n");
$cmd="        def sym TRANSF=@SBX:(\$SMOOTH)";
fwrite($fh, $cmd."\n");
$cmd="endif";
fwrite($fh, $cmd."\n");
$cmd="\n!============================";
fwrite($fh, $cmd."\n");

$cmd="plot/nolab/grat=(dash,color=17)/color var[d=1]";
for($i=2;$i<=$nd;$i+=1) {
        $cmd="$cmd, var[d=$i]";
}
fwrite($fh, $cmd."\n");

$cmd="\n!============================";
fwrite($fh, $cmd."\n");
$cmd="define view/x=0:1/y=0:1 full2 ; set view full2";
fwrite($fh, $cmd."\n");
$cmd="go margins_set 15 30 10 08";
fwrite($fh, $cmd."\n");
$cmd="plot/nolab/noaxis i[i=1:5]*0-1E34 ! plot nothing, needed to define symbols used by text_legend_put";
fwrite($fh, $cmd."\n\n");
$xpos1=10; $yposstart=20; $ypos=$yposstart;
$nd=1;
foreach ($_SESSION['simus'] as $s){
	$ncolor=$nd+1;     # Users colors will begin at 2
	if ($ypos < 4 ) {
		$ypos=$yposstart;
		$xpos1=55;
	} 
	$xpos2=$xpos1+10; 
	$parts=explode("/",$s);
	$TagName=$parts[count($parts)-4];
	$SpaceName=$parts[count($parts)-3];
	$ExperimentName=$parts[count($parts)-2];
	$FreeName=$parts[count($parts)-1];
	# $cmd="go text_legend_put ".$xpos1." ".$xpos2." ".$ypos." \"@AS ".$SpaceName.'/'.$ExperimentName.'/'.$FreeName."\" $ncolor 0.35";
	$cmd="go text_legend_put2 ".$xpos1." ".$xpos2." ".$ypos." \"@AS ".$SpaceName.'/'.$ExperimentName.'/'.$FreeName."\" /line/thick=3/color=$ncolor 0.25";
	$ypos=$ypos-3;
	fwrite($fh, $cmd."\n");
        $nd=$nd+1;
}
$cmd="\n!============================";
fwrite($fh, $cmd."\n");
$cmd="go text_put 05 95 \"@AS`(\$VAR1),return=dset`.nc\" -1 0.3";
fwrite($fh, $cmd."\n");
$cmd="go text_put 10 90 \"@AS`(\$VAR1),return=title` (`(\$VAR1),return=units`) ((\$TRANSF))\" -1 0.35";
fwrite($fh, $cmd."\n");
$cmd="\n!============================";
fwrite($fh, $cmd."\n");
fclose($fh);
?>

