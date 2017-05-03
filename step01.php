<HTML>
<HEAD>

<script type="text/javascript" src="js/form_widget_editable_select.js"></script>
<script type="text/javascript" src="js/tab-view.js"></script>

<style type='text/css'>
.selectBoxArrow {
  position: relative;
  left: -4px;
  top: 2px;
}

</style>

</HEAD>

<BODY>

<FONT style="font-family: Arial, Helvetica, sans-serif;">

<p><span style="border-bottom: 3px solid #FF3300;">
Enter <i>ExperimentName</i> directory
</span>
<ul><small>
<li>http://vesg.ipsl.upmc.fr/thredds/catalog/work_thredds/YourLogin/TagName/SpaceName/ExperimentName
<li>http://prodn.idris.fr/thredds/catalog/ipsl_public/YourLogin/TagName/SpaceName/ExperimentName
<li>http://prodn.idris.fr/thredds/catalog/ipsl_public/YourLogin/TagName/SpaceName/ExperimentName
</ul>
</small>
</p>

<form name="formstep01" method="post" action="step02.php" target="step02">

<input type="text" name="url" style="width: 1000px; font-family: Arial, Helvetica, sans-serif;"
<?php
if (isset($_COOKIE['url'])) {
        print("value=\"".$_COOKIE['url']."\"");
        print("selectBoxOptions=\"".$_COOKIE['url'].";http://vesg.ipsl.upmc.fr/thredds/catalog/work_thredds/p86caub/IPSLCM6/DEVT/piControl;http://esgf.extra.cea.fr/thredds/catalog/work/p86caub/IPSLCM6/TEST/piControl;http://esgf.extra.cea.fr/thredds/catalog/work/p86caub/IPSLCM5A/PROD/piControl;http://prodn.idris.fr/thredds/catalog/ipsl_public/rpsl003/IPSLCM5A/DEVT/pdControl\"");
} else {
        print("value=\"http://esgf.extra.cea.fr/thredds/catalog/work/p86caub/IPSLCM6/TEST/piControl\"");
        print("selectBoxOptions=\"http://vesg.ipsl.upmc.fr/thredds/catalog/work_thredds/p86caub/IPSLCM6/DEVT/piControl;http://esgf.extra.cea.fr/thredds/catalog/work/p86caub/IPSLCM6/TEST/piControl;http://esgf.extra.cea.fr/thredds/catalog/work/p86caub/IPSLCM5A-MR/PROD/piControl;http://prodn.idris.fr/thredds/catalog/ipsl_public/rpsl003/IPSLCM5A/DEVT/pdControl\"");
}
?>
>

<p>
<input type="submit" value="List directories" name="list"
onclick="parent.showTab('dhtmlgoodies_tabView1',1);"
style="font-family: Arial, Helvetica, sans-serif;"
title="List all directories from the given URL">
<input type="submit" value="Append directories" name="append"
onclick="parent.showTab('dhtmlgoodies_tabView1',1);"
style="font-family: Arial, Helvetica, sans-serif;"
title="Append to the list all directories from the given URL">
</p>

</form>

<script type="text/javascript">
createEditableSelect(document.forms['formstep01'].url);
</script>

</FONT>

</BODY>
</HTML>
