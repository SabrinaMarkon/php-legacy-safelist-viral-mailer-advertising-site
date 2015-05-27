<?php
include "db.php";
$userid = $_GET["userid"];
$id = $_GET["id"];
$type = $_GET["type"];
$error = "";
if (empty($id)) {
	$top = "click2.php?message=".urlencode("Invalid click link");
}
if (empty($type)) {
	$top = "click2.php?message=".urlencode("Invalid click link");
}
if ($error != "yes")
{
	if (($type == "banners") or ($type == "buttons"))
	{
	$url = mysql_result(mysql_query("select targeturl from $type where id='".$id."' LIMIT 1"), 0, 'targeturl');
	}
	else
	{
	$url = mysql_result(mysql_query("select url from $type where id='".$id."' LIMIT 1"), 0, 'url');
	}
	#### - no points, cash so no need to check if already received earnings
	$top = "click2.php?id=".$id."&userid=".$userid."&type=".$type."&url=".urlencode($url);
}
if(empty($url))
{
$url = $domain;
}
#######
$bq = "select * from banners where hits<max and approved=1 order by rand() limit 1";
$br = mysql_query($bq);
$brows = mysql_num_rows($br);
if ($brows < 1)
{
$frameheight = "25";
}
if ($brows > 0)
{
$frameheight = "85";
}
?>
<frameset ROWS="<?php echo $frameheight ?>,*" BORDER=0 FRAMEBORDER=1 FRAMESPACING=0>
<frame name="header" scrolling="no" noresize marginheight="1" marginwidth="1" target="main" src="<?php echo $top ?>">
<frame name="main" src="<?php echo $url ?>">
</frameset>