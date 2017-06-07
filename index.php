<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
        "http://www.w3.org/TR/html4/frameset.dtd">

<?php
session_save_path("tmp");
session_start();

// http POST simul1, simul2.... to this page
$i=1;
$urls=array();
while (isset($_POST['simul'.$i])) {
        $urls[]=$_POST['simul'.$i];
        $i++;
        }

$_SESSION['urls'] = $urls;

//print_r($_SESSION['urls']);

?>

<HTML>
<HEAD>
   <TITLE>Inter-monitoring</TITLE>
   <META NAME="author" CONTENT="Patrick Brockmann">
   <META HTTP-EQUIV="Content-Type" CONTENT ="text/html;charset=ISO-8859-1">
   <link rel="shortcut icon" href="../images/Stocks-16x16.png">
   <link rel="stylesheet" href="css/tab-view.css" type="text/css" media="screen">
   <script type="text/javascript" src="js/tab-view.js"></script>
</HEAD>

<BODY>

<IFRAME SRC="banner.html" width="100%" height="120" frameborder="0">
</IFRAME>

<!======================================>
<div id="dhtmlgoodies_tabView1">

<!======================================>
  <div class="dhtmlgoodies_aTab">
<IFRAME SRC="step01.php" NAME="step01" width="100%" height="100%" frameborder="0">
</IFRAME>

  </div>

<!======================================>
  <div class="dhtmlgoodies_aTab">
<IFRAME SRC="step02.php" NAME="step02" width="100%" height="100%" frameborder="0">
</IFRAME>

  </div>

<!======================================>
  <div class="dhtmlgoodies_aTab">
<IFRAME SRC="step03.php" NAME="step03" width="100%" height="100%" frameborder="0">
</IFRAME>

  </div>

<!======================================>
</div>

<script type="text/javascript">
initTabs('dhtmlgoodies_tabView1',
          Array('<a style="background-color:#FF3300">&nbsp;&nbsp;Step 1&nbsp;&nbsp;</a>',
		'<a style="background-color:#FF6600">&nbsp;&nbsp;Step 2&nbsp;&nbsp;</a>',
		'<a style="background-color:#FF9900">&nbsp;&nbsp;Step 3&nbsp;&nbsp;</a>'),
          0,
          1200,300,
          Array(false,false,false));
</script>
<!======================================>

<br><br><br>
<IFRAME SRC="choices.php" NAME="choices" width="100%" height="400" frameborder=0>
</IFRAME>


</BODY>
</HTML>
