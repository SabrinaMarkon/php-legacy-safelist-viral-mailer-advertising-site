<?php
include "db.php";
$buq = "select * from buttons where hits<max and approved=1 and bannerurl!='' order by rand() limit 6";
$bur = mysql_query($buq) or die(mysql_error());
$burows = mysql_num_rows($bur);
if ($burows > 0)
{
	while ($burowz = mysql_fetch_array($bur))
	{
	$buid = $burowz["id"];
	$bubannerurl = $burowz["bannerurl"];
		$buq2 = "update buttons set hits=hits+1 where id=".$buid;
		$bur2 = mysql_query($buq2) or die(mysql_error());
		$clickurl = $domain . "/click1.php?userid=".$userid."&id=".$buid."&type=buttons";
		?>
		<a href="<?php echo $clickurl ?>" target="_blank"><img src="<? echo $bubannerurl; ?>" border="0" width="125" height="125"></a><br><br>
		<?
	} # while ($burowz = mysql_fetch_array($bur))
} # if ($burows > 0)
?>
