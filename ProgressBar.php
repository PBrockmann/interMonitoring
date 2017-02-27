<?php

// http://www.phpcs.com/code.aspx?ID=32601

function ProgressBar_Initialize($left,$top,$width,$height,$bord_col,$txt_col,$bg_col)
{
$txt_height=$height-10;
echo '<div id="progressbartext" style="position:absolute;top:'.($top);
echo ';left:'.$left;
echo ';width:'.$width.'px';
echo ';height:'.$height.'px;border:1px solid '.$bord_col.';font-family:Arial, Helvetica, sans-serif;font-weight:bold';
echo ';font-size:'.$txt_height.'px;color:'.$txt_col.';z-index:1;text-align:center;"></div>';

echo '<div id="progressbar" style="position:absolute;top:'.($top+1); //+1
echo ';left:'.($left+1); //+1
echo ';height:'.$height.'px';
echo ';background-color:'.$bg_col.';z-index:0;"></div>';

echo '<div id="progressbarstatus" style="position:absolute;top:'.($top+$height+10); //+1
echo ';left:'.$left;
echo ';font-family:Arial, Helvetica, sans-serif;font-weight:bold';
echo ';color:'.$txt_col.';text-align:right;"></div>';
}

function ProgressBar_Update($percent,$status,$title)
{
echo "\n<script>";
echo "document.getElementById('progressbartext').innerHTML='$percent%';";
echo "document.getElementById('progressbar').style.width=".($percent*4).";\n";
echo "document.getElementById('progressbarstatus').innerHTML='$status';";
echo "document.title='$title';";
echo "</script>";

// http://www.manuelphp.com/php/function.flush.php
flush();
ob_flush();
}

?>
