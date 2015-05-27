<?php
include "control.php";
include "../header.php";
$action = $_POST["action"];
$show = "";
if ($action == "savesettings")
{
$adminuserid = $_POST["adminuseridp"];
$adminpassword = $_POST["adminpasswordp"];
$adminmemberuserid = $_POST["adminmemberuseridp"];
$adminname = $_POST["adminnamep"];
$domain = $_POST["domainp"];
$sitename = $_POST["sitenamep"];
$adminemail = $_POST["adminemailp"];
$bounceemail = $_POST["bounceemailp"];
$bouncesmax = $_POST["bouncesmaxp"];
$egopay_store_id = $_POST["egopay_store_idp"];
$egopay_store_password = $_POST["egopay_store_passwordp"];
$adminpayza = $_POST["adminpayzap"];
$adminpayzaseccode = $_POST["adminpayzaseccodep"];
$adminperfectmoney = $_POST["adminperfectmoneyp"];
$adminokpay = $_POST["adminokpayp"];
$adminsolidtrustpay = $_POST["adminsolidtrustpayp"];
$adminpaypal = $_POST["adminpaypalp"];
$joinprice = $_POST["joinpricep"];
$joinpriceinterval = $_POST["joinpriceintervalp"];
$testimonialrotateorgroup = $_POST["testimonialrotateorgroupp"];
$testimonialgroupmax = $_POST["testimonialgroupmaxp"];
$testimonialphotopath = $_POST["testimonialphotopathp"];
$paymentprocessorfeetoadd = $_POST["paymentprocessorfeetoaddp"];
$ewalletname = $_POST["ewalletnamep"];
$ewalletfundingincrement = $_POST["ewalletfundingincrementp"];
$ewalletfundinghowmanyincrements = $_POST["ewalletfundinghowmanyincrementsp"];
$minimumpayout = $_POST["minimumpayoutp"];
$minimumewalletbalancetowithdraw = $_POST["minimumewalletbalancetowithdrawp"];
$maximumpercentageofewalletthatcanbewithdrawnascash = $_POST["maximumpercentageofewalletthatcanbewithdrawnascashp"];
$soloprice = $_POST["solopricep"];
$solotimer = $_POST["solotimerp"];
$memberhoursbetweensoloposts = $_POST["memberhoursbetweensolopostsp"];
$solosaveadsfree = $_POST["solosaveadsfreep"];
$solosaveadspaid = $_POST["solosaveadspaidp"];
$textadprice = $_POST["textadpricep"];
$textadmaxviews = $_POST["textadmaxviewsp"];
$textadtimer = $_POST["textadtimerp"];
$textadsaveadsfree = $_POST["textadsaveadsfreep"];
$textadsaveadpaids = $_POST["textadsaveadspaidp"];
$fullloginadprice = $_POST["fullloginadpricep"];
$fullloginadmaxviews = $_POST["fullloginadmaxviewsp"];
$fullloginadtimer = $_POST["fullloginadtimerp"];
$fullloginadsaveadsfree = $_POST["fullloginadsaveadsfreep"];
$fullloginadsaveadspaid = $_POST["fullloginadsaveadspaidp"];
$bannermaxviews = $_POST["bannermaxviewsp"];
$bannerprice = $_POST["bannerpricep"];
$bannertimer = $_POST["bannertimerp"];
$bannersaveadsfree = $_POST["bannersaveadsfreep"];
$bannersaveadspaid = $_POST["bannersaveadspaidp"];
$buttonmaxviews = $_POST["buttonmaxviewsp"];
$buttonprice = $_POST["buttonpricep"];
$buttontimer = $_POST["buttontimerp"];
$buttonsaveadsfree = $_POST["buttonsaveadsfreep"];
$buttonsaveadspaid = $_POST["buttonsaveadspaidp"];
$adpackprice = $_POST["adpackpricep"];
$adpackcommissionfree = $_POST["adpackcommissionfreep"];
$adpackcommissionpaid = $_POST["adpackcommissionpaidp"];
$payoutegopay = $_POST["payoutegopayp"];
$payoutpayza = $_POST["payoutpayzap"];
$payoutperfectmoney = $_POST["payoutperfectmoneyp"];
$payoutokpay = $_POST["payoutokpayp"];
$payoutsolidtrustpay = $_POST["payoutsolidtrustpayp"];
$payoutpaypal = $_POST["payoutpaypalp"];
$adminemailtimer = $_POST["adminemailtimerp"];
$enableautodowngrade = $_POST["enableautodowngradep"];
$autodowngradeafterhowmanydayslatepay = $_POST["autodowngradeafterhowmanydayslatepayp"];
$enablecreditssystem = $_POST["enablecreditssystemp"];
$creditspriceperlot = $_POST["creditspriceperlotp"];
$creditshowmanyperlot = $_POST["creditshowmanyperlotp"];
$creditshowmanylots = $_POST["creditshowmanylotsp"];
$creditcommissionfree = $_POST["creditcommissionfreep"];
$creditcommissionpaid = $_POST["creditcommissionpaidp"];
$adminemailscreditsfree = $_POST["adminemailscreditsfreep"];
$adminemailscreditspaid = $_POST["adminemailscreditspaidp"];
$soloscreditsfree = $_POST["soloscreditsfreep"];
$soloscreditspaid = $_POST["soloscreditspaidp"];
$bannerscreditsfree = $_POST["bannerscreditsfreep"];
$bannerscreditspaid = $_POST["bannerscreditspaidp"];
$buttonscreditsfree = $_POST["buttonscreditsfreep"];
$buttonscreditspaid = $_POST["buttonscreditspaidp"];
$textadscreditsfree = $_POST["textadscreditsfreep"];
$textadscreditspaid = $_POST["textadscreditspaidp"];
$fullloginadscreditsfree = $_POST["fullloginadscreditsfreep"];
$fullloginadscreditspaid = $_POST["fullloginadscreditspaidp"];
$soloscreditstradefree = $_POST["soloscreditstradefreep"];
$soloscreditstradepaid = $_POST["soloscreditstradepaidp"];
$bannerscreditstradefree = $_POST["bannerscreditstradefreep"];
$bannerscreditstradepaid = $_POST["bannerscreditstradepaidp"];
$buttonscreditstradefree = $_POST["buttonscreditstradefreep"];
$buttonscreditstradepaid = $_POST["buttonscreditstradepaidp"];
$textadscreditstradefree = $_POST["textadscreditstradefreep"];
$textadscreditstradepaid = $_POST["textadscreditstradepaidp"];
$fullloginadscreditstradefree = $_POST["fullloginadscreditstradefreep"];
$fullloginadscreditstradepaid = $_POST["fullloginadscreditstradepaidp"];
$solocommissionfree = $_POST["solocommissionfreep"];
$solocommissionpaid = $_POST["solocommissionpaidp"];
$bannercommissionfree = $_POST["bannercommissionfreep"];
$bannercommissionpaid = $_POST["bannercommissionpaidp"];
$buttoncommissionfree = $_POST["buttoncommissionfreep"];
$buttoncommissionpaid = $_POST["buttoncommissionpaidp"];
$textadcommissionfree = $_POST["textadcommissionfreep"];
$textadcommissionpaid = $_POST["textadcommissionpaidp"];
$fullloginadcommissionfree = $_POST["fullloginadcommissionfreep"];
$fullloginadcommissionpaid = $_POST["fullloginadcommissionpaidp"];
$level1name = $_POST["level1namep"];
$level2name = $_POST["level2namep"];
$creditsoloscreditsfree = $_POST["creditsoloscreditsfreep"];
$creditsoloscreditspaid = $_POST["creditsoloscreditspaidp"];
$creditsoloscreditstradefree = $_POST["creditsoloscreditstradefreep"];
$creditsoloscreditstradepaid = $_POST["creditsoloscreditstradepaidp"];
$creditsoloprice = $_POST["creditsolopricep"];
$creditsolotimer = $_POST["creditsolotimerp"];
$memberhoursbetweencreditsolopostsfree = $_POST["memberhoursbetweencreditsolopostsfreep"];
$memberhoursbetweencreditsolopostspaid = $_POST["memberhoursbetweencreditsolopostspaidp"];
$creditsolosaveadsfree = $_POST["creditsolosaveadsfreep"];
$creditsolosaveadspaid = $_POST["creditsolosaveadspaidp"];
$creditsolomaxrecipientsfree = $_POST["creditsolomaxrecipientsfreep"];
$creditsolomaxrecipientspaid = $_POST["creditsolomaxrecipientspaidp"];
$howoftensponsorscanmailreferrals = $_POST["howoftensponsorscanmailreferralsp"];
$enableautoapprove = $_POST["enableautoapprovep"];
$showmembercount = $_POST["showmembercountp"];
$turingkeyenable = $_POST["turingkeyenablep"];

$update = mysql_query("update adminsettings set setting='$adminuserid' where name='adminuserid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adminpassword' where name='adminpassword'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adminmemberuserid' where name='adminmemberuserid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adminname' where name='adminname'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$domain' where name='domain'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting=\"$sitename\" where name='sitename'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adminemail' where name='adminemail'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$bounceemail' where name='bounceemail'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$bouncesmax' where name='bouncesmax'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$egopay_store_id' where name='egopay_store_id'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$egopay_store_password' where name='egopay_store_password'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adminpayza' where name='adminpayza'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adminpayzaseccode' where name='adminpayzaseccode'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adminperfectmoney' where name='adminperfectmoney'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adminokpay' where name='adminokpay'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adminsolidtrustpay' where name='adminsolidtrustpay'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adminpaypal' where name='adminpaypal'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$joinprice' where name='joinprice'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$joinpriceinterval' where name='joinpriceinterval'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$testimonialrotateorgroup' where name='testimonialrotateorgroup'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$testimonialgroupmax' where name='testimonialgroupmax'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$testimonialphotopath' where name='testimonialphotopath'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$paymentprocessorfeetoadd' where name='paymentprocessorfeetoadd'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$ewalletname' where name='ewalletname'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$ewalletfundingincrement' where name='ewalletfundingincrement'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$ewalletfundinghowmanyincrements' where name='ewalletfundinghowmanyincrements'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$minimumpayout' where name='minimumpayout'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$minimumewalletbalancetowithdraw' where name='minimumewalletbalancetowithdraw'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$maximumpercentageofewalletthatcanbewithdrawnascash' where name='maximumpercentageofewalletthatcanbewithdrawnascash'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$soloprice' where name='soloprice'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$solotimer' where name='solotimer'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$memberhoursbetweensoloposts' where name='memberhoursbetweensoloposts'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$solosaveadsfree' where name='solosaveadsfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$solosaveadspaid' where name='solosaveadspaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$textadprice' where name='textadprice'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$textadmaxviews' where name='textadmaxviews'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$textadtimer' where name='textadtimer'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$textadsaveadsfree' where name='textadsaveadsfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$textadsaveadspaid' where name='textadsaveadspaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$fullloginadprice' where name='fullloginadprice'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$fullloginadmaxviews' where name='fullloginadmaxviews'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$fullloginadtimer' where name='fullloginadtimer'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$fullloginadsaveadsfree' where name='fullloginadsaveadsfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$fullloginadsaveadspaid' where name='fullloginadsaveadspaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$bannermaxviews' where name='bannermaxviews'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$bannerprice' where name='bannerprice'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$bannertimer' where name='bannertimer'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$bannersaveadsfree' where name='bannersaveadsfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$bannersaveadspaid' where name='bannersaveadspaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$buttonmaxviews' where name='buttonmaxviews'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$buttonprice' where name='buttonprice'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$buttontimer' where name='buttontimer'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$buttonsaveadsfree' where name='buttonsaveadsfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$buttonsaveadspaid' where name='buttonsaveadspaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adpackprice' where name='adpackprice'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adpackcommissionfree' where name='adpackcommissionfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adpackcommissionpaid' where name='adpackcommissionpaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$payoutegopay' where name='payoutegopay'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$payoutpayza' where name='payoutpayza'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$payoutperfectmoney' where name='payoutperfectmoney'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$payoutokpay' where name='payoutokpay'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$payoutsolidtrustpay' where name='payoutsolidtrustpay'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$payoutpaypal' where name='payoutpaypal'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adminemailtimer' where name='adminemailtimer'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$enableautodowngrade' where name='enableautodowngrade'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$autodowngradeafterhowmanydayslatepay' where name='autodowngradeafterhowmanydayslatepay'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$enablecreditssystem' where name='enablecreditssystem'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$creditspriceperlot' where name='creditspriceperlot'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$creditshowmanyperlot' where name='creditshowmanyperlot'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$creditshowmanylots' where name='creditshowmanylots'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$creditcommissionfree' where name='creditcommissionfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$creditcommissionpaid' where name='creditcommissionpaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adminemailscreditsfree' where name='adminemailscreditsfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$adminemailscreditspaid' where name='adminemailscreditspaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$soloscreditsfree' where name='soloscreditsfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$soloscreditspaid' where name='soloscreditspaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$bannerscreditsfree' where name='bannerscreditsfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$bannerscreditspaid' where name='bannerscreditspaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$buttonscreditsfree' where name='buttonscreditsfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$buttonscreditspaid' where name='buttonscreditspaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$textadscreditsfree' where name='textadscreditsfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$textadscreditspaid' where name='textadscreditspaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$fullloginadscreditsfree' where name='fullloginadscreditsfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$fullloginadscreditspaid' where name='fullloginadscreditspaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$soloscreditstradefree' where name='soloscreditstradefree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$soloscreditstradepaid' where name='soloscreditstradepaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$bannerscreditstradefree' where name='bannerscreditstradefree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$bannerscreditstradepaid' where name='bannerscreditstradepaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$buttonscreditstradefree' where name='buttonscreditstradefree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$buttonscreditstradepaid' where name='buttonscreditstradepaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$textadscreditstradefree' where name='textadscreditstradefree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$textadscreditstradepaid' where name='textadscreditstradepaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$fullloginadscreditstradefree' where name='fullloginadscreditstradefree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$fullloginadscreditstradepaid' where name='fullloginadscreditstradepaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$solocommissionfree' where name='solocommissionfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$solocommissionpaid' where name='solocommissionpaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$bannercommissionfree' where name='bannercommissionfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$bannercommissionpaid' where name='bannercommissionpaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$buttoncommissionfree' where name='buttoncommissionfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$buttoncommissionpaid' where name='buttoncommissionpaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$textadcommissionfree' where name='textadcommissionfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$textadcommissionpaid' where name='textadcommissionpaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$fullloginadcommissionfree' where name='fullloginadcommissionfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$fullloginadcommissionpaid' where name='fullloginadcommissionpaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$level1name' where name='level1name'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$level2name' where name='level2name'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$creditsoloscreditsfree' where name='creditsoloscreditsfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$creditsoloscreditspaid' where name='creditsoloscreditspaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$creditsoloscreditstradefree' where name='creditsoloscreditstradefree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$creditsoloscreditstradepaid' where name='creditsoloscreditstradepaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$creditsoloprice' where name='creditsoloprice'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$creditsolotimer' where name='creditsolotimer'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$memberhoursbetweencreditsolopostsfree' where name='memberhoursbetweencreditsolopostsfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$memberhoursbetweencreditsolopostspaid' where name='memberhoursbetweencreditsolopostspaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$creditsolosaveadsfree' where name='creditsolosaveadsfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$creditsolosaveadspaid' where name='creditsolosaveadspaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$creditsolomaxrecipientsfree' where name='creditsolomaxrecipientsfree'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$creditsolomaxrecipientspaid' where name='creditsolomaxrecipientspaid'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$howoftensponsorscanmailreferrals' where name='howoftensponsorscanmailreferrals'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$enableautoapprove' where name='enableautoapprove'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$showmembercount' where name='showmembercount'") or die(mysql_error());
$update = mysql_query("update adminsettings set setting='$turingkeyenable' where name='turingkeyenable'") or die(mysql_error());

$_SESSION["loginusernameadmin"] = $adminuserid;
$_SESSION["loginpasswordadmin"] = $adminpassword;

$adminuserid = $adminuseridp;
$adminpassword = $adminpasswordp;

$show = "Your settings were updated!";
} # if ($action == "savesettings")
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Website&nbsp;Settings</div></td></tr>

<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
?>
<tr><td align="center" colspan="2"><br>
<form action="sitecontrol.php" method="post">
<table width="600" border="0" cellpadding="2" cellspacing="2" class="sabrinatable" align="center">
<tr class="sabrinatrdark"><td colspan="2" align="center"><div class="heading">MAIN SETTINGS</div></td></tr>
<tr class="sabrinatrlight"><td>Admin Login ID:</td><td><input type="text" class="typein" name="adminuseridp" value="<?php echo $adminuserid ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Admin Login Password:</td><td><input type="text" class="typein" name="adminpasswordp" value="<?php echo $adminpassword ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Admin Site Member UserID:</td><td><input type="text" class="typein" name="adminmemberuseridp" value="<?php echo $adminmemberuserid ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Admin Name:</td><td><input type="text" class="typein" name="adminnamep" value="<?php echo $adminname ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Website Main Domain URL (with http:// and NO trailing slash):</td><td><input type="text" class="typein" name="domainp" value="<?php echo $domain ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Website Name:</td><td><input type="text" class="typein" name="sitenamep" value="<?php echo $sitename ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Show Membership Count on Main Page:</td><td>
<select name="showmembercountp">
<option value="no" <?php if ($showmembercount != "yes") { echo "selected"; } ?>>NO</option>
<option value="yes" <?php if ($showmembercount == "yes") { echo "selected"; } ?>>YES</option>
</select>
</td></tr>
<tr class="sabrinatrlight"><td>Enable Captcha/Turing Key for Login and Signup Forms:</td><td>
<select name="turingkeyenablep">
<option value="no" <?php if ($turingkeyenable != "yes") { echo "selected"; } ?>>NO</option>
<option value="yes" <?php if ($turingkeyenable == "yes") { echo "selected"; } ?>>YES</option>
</select>
</td></tr>
<tr class="sabrinatrlight"><td>First Membership Level (free membership) Name:</td><td><input type="text" class="typein" name="level1namep" value="<?php echo $level1name ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Second Membership Level Name:</td><td><input type="text" class="typein" name="level2namep" value="<?php echo $level2name ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Admin Support Email:</td><td><input type="text" class="typein" name="adminemailp" value="<?php echo $adminemail ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Admin Bounce Email (different than support email!):</td><td><input type="text" class="typein" name="bounceemailp" value="<?php echo $bounceemail ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Maximum Bounces for Member to be Automatically Put on Vacation:</td><td>
<select name="bouncesmaxp">
<?php
for ($m=1;$m<=20;$m++)
{
?>
<option value="<?php echo $m ?>" <?php if ($m == $bouncesmax) { echo "selected"; } ?>><?php echo $m ?></option>
<?php
}
?>
</select>
</td></tr>
<tr class="sabrinatrlight"><td>Admin EgoPay Store ID (leave blank if you don't want to sell using EgoPay):</td><td><input type="text" class="typein" name="egopay_store_idp" value="<?php echo $egopay_store_id ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Admin EgoPay Store Password (leave blank if you don't want to sell using EgoPay):</td><td><input type="text" class="typein" name="egopay_store_passwordp" value="<?php echo $egopay_store_password ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Admin Payza Account (leave blank if you don't want to sell using Payza):</td><td><input type="text" class="typein" name="adminpayzap" value="<?php echo $adminpayza ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Admin Payza IPN Security Code (leave blank if you don't want to sell using Payza):</td><td><input type="text" class="typein" name="adminpayzaseccodep" value="<?php echo $adminpayzaseccode ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Admin Perfect Money Account (leave blank if you don't want to sell using Perfect Money):</td><td><input type="text" class="typein" name="adminperfectmoneyp" value="<?php echo $adminperfectmoney ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Admin OKPay Account (leave blank if you don't want to sell using OKPay):</td><td><input type="text" class="typein" name="adminokpayp" value="<?php echo $adminokpay ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Admin Solid Trust Pay Account (leave blank if you don't want to sell using Solid Trust Pay):</td><td><input type="text" class="typein" name="adminsolidtrustpayp" value="<?php echo $adminsolidtrustpay ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Admin PayPal Account (leave blank if you don't want to sell using PayPal):</td><td><input type="text" class="typein" name="adminpaypalp" value="<?php echo $adminpaypal ?>" class="typein" size="25" maxlength="255"></td></tr>
<tr class="sabrinatrlight"><td>Price To Upgrade To <?php echo $level2name ?> Membership (comes with an AdPack):</td><td><input type="text" class="typein" name="joinpricep" value="<?php echo $joinprice ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Bill How Often? (attempts to withdraw automatically from <?php echo $ewalletname ?> when due):</td><td>
<select name="joinpriceintervalp">
<option value="One Time" <?php if ($joinpriceinterval == "One Time") { echo "selected"; } ?>>One Time</option>
<option value="Monthly" <?php if ($joinpriceinterval == "Monthly") { echo "selected"; } ?>>Monthly</option>
<option value="Annually" <?php if ($joinpriceinterval == "Annually") { echo "selected"; } ?>>Annually</option>
</select>
</td></tr>
<tr class="sabrinatrlight"><td>Price Per AdPack:</td><td><input type="text" class="typein" name="adpackpricep" value="<?php echo $adpackprice ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level1name ?> Member Sponsors when a referral buys an AdPack or Upgrades (credit trade purchases do NOT pay commissions):</td><td><input type="text" class="typein" name="adpackcommissionfreep" value="<?php echo $adpackcommissionfree ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level2name ?> Member Sponsors when a referral buys an AdPack (credit trade purchases do NOT pay commissions):</td><td><input type="text" class="typein" name="adpackcommissionpaidp" value="<?php echo $adpackcommissionpaid ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Automatically Downgrade Overdue <?php echo $level2name ?> Member Accounts:</td><td><select name="enableautodowngradep"><option value="yes" <?php if ($enableautodowngrade == "yes") { echo "selected"; } ?>>YES</option><option value="no" <?php if ($enableautodowngrade != "yes") { echo "selected"; } ?>>NO</option></select></td></tr>
<tr class="sabrinatrlight"><td>How many days late with payment should a <?php echo $level2name ?> member be before being Automatically Downgraded to <?php echo $level1name ?>?</td><td>
<select name="autodowngradeafterhowmanydayslatepayp">
<?php
for ($z=1;$z<=100;$z++)
{
?>
<option value="<?php echo $z ?>" <?php if ($z == $autodowngradeafterhowmanydayslatepay) { echo "selected"; } ?>><?php echo $z ?></option>
<?php
}
?>
</select></td></tr>

<tr class="sabrinatrlight"><td>E-Wallet Name:</td><td><input type="text" class="typein" name="ewalletnamep" value="<?php echo $ewalletname ?>" class="typein" size="25" maxlength="255"></td></tr>

<tr class="sabrinatrlight"><td>Dollar Increment for Amounts For Sale to Fund <?php echo $ewalletname ?>:</td><td><input type="text" class="typein" name="ewalletfundingincrementp" value="<?php echo $ewalletfundingincrement ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many <?php echo $ewalletname ?> Funding Amounts are For Sale? (funding purchase options will be sold in multiples of the dollar value above.):</td><td>
<select name="ewalletfundinghowmanyincrementsp">
<?php
for ($a=1;$a<=50;$a++)
{
?>
<option value="<?php echo $a ?>" <?php if ($a == $ewalletfundinghowmanyincrements) { echo "selected"; } ?>><?php echo $a ?></option>
<?php
}
?>
</select>
</td></tr>

<tr class="sabrinatrlight"><td>Member Minimum <?php echo $ewalletname ?> Balance to request withdrawals (enter 0.00 for no minimum):</td><td>$<input type="text" class="typein" name="minimumewalletbalancetowithdrawp" value="<?php echo $minimumewalletbalancetowithdraw ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Maximum Percentage of <?php echo $ewalletname ?> Balance that can be withdrawn as cash:</td><td>
<select name="maximumpercentageofewalletthatcanbewithdrawnascashp">
<?php
for ($i=0;$i<=100;$i++)
{
?>
<option value="<?php echo $i ?>" <?php if ($i == $maximumpercentageofewalletthatcanbewithdrawnascash) { echo "selected"; } ?>><?php echo $i ?></option>
<?php
}
?>
</select>%</td></tr>
<tr class="sabrinatrlight"><td>Member Minimum Payout:</td><td><input type="text" class="typein" name="minimumpayoutp" value="<?php echo $minimumpayout ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Additional Payment Processor fee Percentage for funding <?php echo $ewalletname ?> (enter 0 for none):</td><td><input type="text" class="typein" name="paymentprocessorfeetoaddp" value="<?php echo $paymentprocessorfeetoadd ?>" class="typein" size="6" maxlength="12">%</td></tr>
<tr class="sabrinatrlight"><td>Allow Members to Request Payout with EgoPay:</td><td><select name="payoutegopayp"><option value="yes" <?php if ($payoutegopay == "yes") { echo "selected"; } ?>>YES</option><option value="no" <?php if ($payoutegopay != "yes") { echo "selected"; } ?>>NO</option></select></td></tr>
<tr class="sabrinatrlight"><td>Allow Members to Request Payout with Payza:</td><td><select name="payoutpayzap"><option value="yes" <?php if ($payoutpayza == "yes") { echo "selected"; } ?>>YES</option><option value="no" <?php if ($payoutpayza != "yes") { echo "selected"; } ?>>NO</option></select></td></tr>
<tr class="sabrinatrlight"><td>Allow Members to Request Payout with Perfect Money:</td><td><select name="payoutperfectmoneyp"><option value="yes" <?php if ($payoutperfectmoney == "yes") { echo "selected"; } ?>>YES</option><option value="no" <?php if ($payoutperfectmoney != "yes") { echo "selected"; } ?>>NO</option></select></td></tr>
<tr class="sabrinatrlight"><td>Allow Members to Request Payout with OKPay:</td><td><select name="payoutokpayp"><option value="yes" <?php if ($payoutokpay == "yes") { echo "selected"; } ?>>YES</option><option value="no" <?php if ($payoutokpay != "yes") { echo "selected"; } ?>>NO</option></select></td></tr>
<tr class="sabrinatrlight"><td>Allow Members to Request Payout with Solid Trust Pay:</td><td><select name="payoutsolidtrustpayp"><option value="yes" <?php if ($payoutsolidtrustpay == "yes") { echo "selected"; } ?>>YES</option><option value="no" <?php if ($payoutsolidtrustpay != "yes") { echo "selected"; } ?>>NO</option></select></td></tr>
<tr class="sabrinatrlight"><td>Allow Members to Request Payout with PayPal:</td><td><select name="payoutpaypalp"><option value="yes" <?php if ($payoutpaypal == "yes") { echo "selected"; } ?>>YES</option><option value="no" <?php if ($payoutpaypal != "yes") { echo "selected"; } ?>>NO</option></select></td></tr>
<tr class="sabrinatrlight"><td>How many days between member emails to their downline referrals?:</td><td>
<select name="howoftensponsorscanmailreferralsp">
<?php
for ($k=0;$k<=30;$k++)
{
?>
<option value="<?php echo $k ?>" <?php if ($k == $howoftensponsorscanmailreferrals) { echo "selected"; } ?>><?php echo $k ?></option>
<?php
}
?>
</select></td></tr>
<tr class="sabrinatrlight"><td>Auto-Approve Ads Submitted by Members:</td><td><select name="enableautoapprovep"><option value="yes" <?php if ($enableautoapprove == "yes") { echo "selected"; } ?>>YES</option><option value="no" <?php if ($enableautoapprove != "yes") { echo "selected"; } ?>>NO</option></select></td></tr>


<tr class="sabrinatrdark"><td colspan="2" align="center"><div class="heading">CREDIT SYSTEM SETTINGS</div></td></tr>
<tr class="sabrinatrlight"><td>Enable Credits System (members click ads to accumulate credits toward posting their own ads):</td><td><select name="enablecreditssystemp"><option value="yes" <?php if ($enablecreditssystem == "yes") { echo "selected"; } ?>>YES</option><option value="no" <?php if ($enablecreditssystem != "yes") { echo "selected"; } ?>>NO</option></select></td></tr>
<tr class="sabrinatrlight"><td>Price Per Credit Lot For Sale (the price for the smallest credit pack a member may buy):</td><td><input type="text" class="typein" name="creditspriceperlotp" value="<?php echo $creditspriceperlot ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many Credits Per Lot? (the number of credits in the smallest credit pack that is for sale):</td><td><input type="text" class="typein" name="creditshowmanyperlotp" value="<?php echo $creditshowmanyperlot ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many Credit Lots For Sale? (credits will be sold in multiples of the Credits Per Lot value above. This setting is the highest level pack of credits a member may buy):</td><td>
<select name="creditshowmanylotsp">
<?php
for ($h=1;$h<=50;$h++)
{
?>
<option value="<?php echo $h ?>" <?php if ($h == $creditshowmanylots) { echo "selected"; } ?>><?php echo $h ?></option>
<?php
}
?>
</select>
</td></tr>
<tr class="sabrinatrlight"><td>Percent Commission for <?php echo $level1name ?> Member Sponsors when a referral buys Credits:</td><td>
<select name="creditcommissionfreep">
<?php
for ($m=1;$m<=100;$m++)
{
?>
<option value="<?php echo $m ?>" <?php if ($m == $creditcommissionfree) { echo "selected"; } ?>><?php echo $m ?>%</option>
<?php
}
?>
</select>
</td></tr>
<tr class="sabrinatrlight"><td>Percent Commission for <?php echo $level2name ?> Member Sponsors when a referral buys Credits:</td><td>
<select name="creditcommissionpaidp">
<?php
for ($n=1;$n<=100;$n++)
{
?>
<option value="<?php echo $n ?>" <?php if ($n == $creditcommissionpaid) { echo "selected"; } ?>><?php echo $n ?>%</option>
<?php
}
?>
</select>
</td></tr>


<tr class="sabrinatrdark"><td colspan="2" align="center"><div class="heading">CREDIT MAILER SETTINGS</div></td></tr>
<tr class="sabrinatrlight"><td colspan="2" align="center">The credit system MUST be enabled above for the Credit Mailer feature to be available to members.</td></tr>
<tr class="sabrinatrlight"><td>Maximum members a <?php echo $level1name ?> member may send to:</td><td><input type="text" class="typein" name="creditsolomaxrecipientsfreep" value="<?php echo $creditsolomaxrecipientsfree ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Maximum members a <?php echo $level2name ?> member may send to:</td><td><input type="text" class="typein" name="creditsolomaxrecipientspaidp" value="<?php echo $creditsolomaxrecipientspaid ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many Credit Emails may a <?php echo $level1name ?> member save?:</td><td><input type="text" class="typein" name="creditsolosaveadsfreep" value="<?php echo $creditsolosaveadsfree ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many Credit Emails may a <?php echo $level2name ?> member save?:</td><td><input type="text" class="typein" name="creditsolosaveadspaidp" value="<?php echo $creditsolosaveadspaid ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many hours between Credit Emails posted by the same <?php echo $level1name ?> member?:</td><td>
<select name="memberhoursbetweencreditsolopostsfreep">
<?php
for ($x=0;$x<=336;$x++)
{
?>
<option value="<?php echo $x ?>" <?php if ($x == $memberhoursbetweencreditsolopostsfree) { echo "selected"; } ?>><?php echo $x ?></option>
<?php
}
?>
</select></td></tr>
<tr class="sabrinatrlight"><td>How many hours between Credit Emails posted by the same <?php echo $level2name ?> member?:</td><td>
<select name="memberhoursbetweencreditsolopostspaidp">
<?php
for ($y=0;$y<=336;$y++)
{
?>
<option value="<?php echo $y ?>" <?php if ($y == $memberhoursbetweencreditsolopostspaid) { echo "selected"; } ?>><?php echo $y ?></option>
<?php
}
?>
</select></td></tr>
<tr class="sabrinatrlight"><td>How many seconds does a member view a Credit Email link?:</td><td><input type="text" class="typein" name="creditsolotimerp" value="<?php echo $creditsolotimer ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many credits do <?php echo $level1name ?> members get when they click a Credit Email link?:</td><td><input type="text" class="typein" name="creditsoloscreditsfreep" value="<?php echo $creditsoloscreditsfree ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many credits do <?php echo $level2name ?> members get when they click a Credit Email link?:</td><td><input type="text" class="typein" name="creditsoloscreditspaidp" value="<?php echo $creditsoloscreditspaid ?>" class="typein" size="4" maxlength="12"></td></tr>


<tr class="sabrinatrdark"><td colspan="2" align="center"><div class="heading">ADMIN EMAIL SETTINGS</div></td></tr>
<tr class="sabrinatrlight"><td>How many seconds does a member view an Admin Email link?:</td><td><input type="text" class="typein" name="adminemailtimerp" value="<?php echo $adminemailtimer ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits do <?php echo $level1name ?> members get when they click an Admin Email link?:</td><td><input type="text" class="typein" name="adminemailscreditsfreep" value="<?php echo $adminemailscreditsfree ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits do <?php echo $level2name ?> members get when they click an Admin Email link?:</td><td><input type="text" class="typein" name="adminemailscreditspaidp" value="<?php echo $adminemailscreditspaid ?>" class="typein" size="4" maxlength="12"></td></tr>


<tr class="sabrinatrdark"><td colspan="2" align="center"><div class="heading">SOLO AD SETTINGS</div></td></tr>
<tr class="sabrinatrlight"><td>Price to buy a Solo Ad:</td><td><input type="text" class="typein" name="solopricep" value="<?php echo $soloprice ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits does it cost <?php echo $level1name ?> members to trade for a Solo Ad? (set to 0 to disable credit trading for <?php echo $level1name ?> members):</td><td><input type="text" class="typein" name="soloscreditstradefreep" value="<?php echo $soloscreditstradefree ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits does it cost <?php echo $level2name ?> members to trade for a Solo Ad? (set to 0 to disable credit trading for <?php echo $level2name ?> members):</td><td><input type="text" class="typein" name="soloscreditstradepaidp" value="<?php echo $soloscreditstradepaid ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level1name ?> Member Sponsors when a referral buys a Solo Ad (credit trade purchases do NOT pay commissions):</td><td><input type="text" class="typein" name="solocommissionfreep" value="<?php echo $solocommissionfree ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level2name ?> Member Sponsors when a referral buys a Solo Ad (credit trade purchases do NOT pay commissions):</td><td><input type="text" class="typein" name="solocommissionpaidp" value="<?php echo $solocommissionpaid ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many Solo Ads may a <?php echo $level1name ?> member save?:</td><td><input type="text" class="typein" name="solosaveadsfreep" value="<?php echo $solosaveadsfree ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many Solo Ads may a <?php echo $level2name ?> member save?:</td><td><input type="text" class="typein" name="solosaveadspaidp" value="<?php echo $solosaveadspaid ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many hours between Solo Ads posted by the same member?:</td><td>
<select name="memberhoursbetweensolopostsp">
<?php
for ($j=0;$j<=24;$j++)
{
?>
<option value="<?php echo $j ?>" <?php if ($j == $memberhoursbetweensoloposts) { echo "selected"; } ?>><?php echo $j ?></option>
<?php
}
?>
</select></td></tr>
<tr class="sabrinatrlight"><td>How many seconds does a member view a Solo Ad link?:</td><td><input type="text" class="typein" name="solotimerp" value="<?php echo $solotimer ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits do <?php echo $level1name ?> members get when they click a Solo Ad link?:</td><td><input type="text" class="typein" name="soloscreditsfreep" value="<?php echo $soloscreditsfree ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits do <?php echo $level2name ?> members get when they click a Solo Ad link?:</td><td><input type="text" class="typein" name="soloscreditspaidp" value="<?php echo $soloscreditspaid ?>" class="typein" size="4" maxlength="12"></td></tr>


<tr class="sabrinatrdark"><td colspan="2" align="center"><div class="heading">BANNER SETTINGS</div></td></tr>
<tr class="sabrinatrlight"><td>Price to buy a Banner Ad:</td><td><input type="text" class="typein" name="bannerpricep" value="<?php echo $bannerprice ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many impressions (hits) does each Banner Ad receive?:</td><td><input type="text" class="typein" name="bannermaxviewsp" value="<?php echo $bannermaxviews ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits does it cost <?php echo $level1name ?> members to trade for a Banner Ad? (set to 0 to disable credit trading for <?php echo $level1name ?> members):</td><td><input type="text" class="typein" name="bannerscreditstradefreep" value="<?php echo $bannerscreditstradefree ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits does it cost <?php echo $level2name ?> members to trade for a Banner Ad? (set to 0 to disable credit trading for <?php echo $level2name ?> members):</td><td><input type="text" class="typein" name="bannerscreditstradepaidp" value="<?php echo $bannerscreditstradepaid ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level1name ?> Member Sponsors when a referral buys a Banner Ad (credit trade purchases do NOT pay commissions):</td><td><input type="text" class="typein" name="bannercommissionfreep" value="<?php echo $bannercommissionfree ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level2name ?> Member Sponsors when a referral buys a Banner Ad (credit trade purchases do NOT pay commissions):</td><td><input type="text" class="typein" name="bannercommissionpaidp" value="<?php echo $bannercommissionpaid ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many Banner Ads may a <?php echo $level1name ?> member save?:</td><td><input type="text" class="typein" name="bannersaveadsfreep" value="<?php echo $bannersaveadsfree ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many Banner Ads may a <?php echo $level2name ?> member save?:</td><td><input type="text" class="typein" name="bannersaveadspaidp" value="<?php echo $bannersaveadspaid ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many seconds does a member view a Banner Ad link?:</td><td><input type="text" class="typein" name="bannertimerp" value="<?php echo $bannertimer ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits do <?php echo $level1name ?> members get when they click a Banner Ad?:</td><td><input type="text" class="typein" name="bannerscreditsfreep" value="<?php echo $bannerscreditsfree ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits do <?php echo $level2name ?> members get when they click a Banner Ad?:</td><td><input type="text" class="typein" name="bannerscreditspaidp" value="<?php echo $bannerscreditspaid ?>" class="typein" size="4" maxlength="12"></td></tr>


<tr class="sabrinatrdark"><td colspan="2" align="center"><div class="heading">BUTTON SETTINGS</div></td></tr>
<tr class="sabrinatrlight"><td>Price to buy a Button Ad:</td><td><input type="text" class="typein" name="buttonpricep" value="<?php echo $buttonprice ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many impressions (hits) does each Button Ad receive?:</td><td><input type="text" class="typein" name="buttonmaxviewsp" value="<?php echo $buttonmaxviews ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits does it cost <?php echo $level1name ?> members to trade for a Button Ad? (set to 0 to disable credit trading for <?php echo $level1name ?> members):</td><td><input type="text" class="typein" name="buttonscreditstradefreep" value="<?php echo $buttonscreditstradefree ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits does it cost <?php echo $level2name ?> members to trade for a Button Ad? (set to 0 to disable credit trading for <?php echo $level2name ?> members):</td><td><input type="text" class="typein" name="buttonscreditstradepaidp" value="<?php echo $buttonscreditstradepaid ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level1name ?> Member Sponsors when a referral buys a Button Ad (credit trade purchases do NOT pay commissions):</td><td><input type="text" class="typein" name="buttoncommissionfreep" value="<?php echo $buttoncommissionfree ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level2name ?> Member Sponsors when a referral buys a Button Ad (credit trade purchases do NOT pay commissions):</td><td><input type="text" class="typein" name="buttoncommissionpaidp" value="<?php echo $buttoncommissionpaid ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many Button Ads may a <?php echo $level1name ?> member save?:</td><td><input type="text" class="typein" name="buttonsaveadsfreep" value="<?php echo $buttonsaveadsfree ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many Button Ads may a <?php echo $level2name ?> member save?:</td><td><input type="text" class="typein" name="buttonsaveadspaidp" value="<?php echo $buttonsaveadspaid ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many seconds does a member view a Button Ad link?:</td><td><input type="text" class="typein" name="buttontimerp" value="<?php echo $buttontimer ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits do <?php echo $level1name ?> members get when they click a Button Ad?:</td><td><input type="text" class="typein" name="buttonscreditsfreep" value="<?php echo $buttonscreditsfree ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits do <?php echo $level2name ?> members get when they click a Button Ad?:</td><td><input type="text" class="typein" name="buttonscreditspaidp" value="<?php echo $buttonscreditspaid ?>" class="typein" size="4" maxlength="12"></td></tr>


<tr class="sabrinatrdark"><td colspan="2" align="center"><div class="heading">TEXT AD SETTINGS</div></td></tr>
<tr class="sabrinatrlight"><td>Price to buy a Text Ad:</td><td><input type="text" class="typein" name="textadpricep" value="<?php echo $textadprice ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many impressions (hits) does each Text Ad receive?:</td><td><input type="text" class="typein" name="textadmaxviewsp" value="<?php echo $textadmaxviews ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits does it cost <?php echo $level1name ?> members to trade for a Text Ad? (set to 0 to disable credit trading for <?php echo $level1name ?> members):</td><td><input type="text" class="typein" name="textadscreditstradefreep" value="<?php echo $textadscreditstradefree ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits does it cost <?php echo $level2name ?> members to trade for a Text Ad? (set to 0 to disable credit trading for <?php echo $level2name ?> members):</td><td><input type="text" class="typein" name="textadscreditstradepaidp" value="<?php echo $textadscreditstradepaid ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level1name ?> Member Sponsors when a referral buys a Text Ad (credit trade purchases do NOT pay commissions):</td><td><input type="text" class="typein" name="textadcommissionfreep" value="<?php echo $textadcommissionfree ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level2name ?> Member Sponsors when a referral buys a Text Ad (credit trade purchases do NOT pay commissions):</td><td><input type="text" class="typein" name="textadcommissionpaidp" value="<?php echo $textadcommissionpaid ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many Text Ads may a <?php echo $level1name ?> member save?:</td><td><input type="text" class="typein" name="textadsaveadsfreep" value="<?php echo $textadsaveadsfree ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many Text Ads may a <?php echo $level2name ?> member save?:</td><td><input type="text" class="typein" name="textadsaveadspaidp" value="<?php echo $textadsaveadspaid ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many seconds does a member view a Text Ad link?:</td><td><input type="text" class="typein" name="textadtimerp" value="<?php echo $textadtimer ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits do <?php echo $level1name ?> members get when they click a Text Ad?:</td><td><input type="text" class="typein" name="textadscreditsfreep" value="<?php echo $textadscreditsfree ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits do <?php echo $level2name ?> members get when they click a Text Ad?:</td><td><input type="text" class="typein" name="textadscreditspaidp" value="<?php echo $textadscreditspaid ?>" class="typein" size="4" maxlength="12"></td></tr>

<tr class="sabrinatrdark"><td colspan="2" align="center"><div class="heading">FULL PAGE LOGIN AD SETTINGS</div></td></tr>
<tr class="sabrinatrlight"><td>Price to buy a Full Page Login Ad:</td><td><input type="text" class="typein" name="fullloginadpricep" value="<?php echo $fullloginadprice ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many impressions (hits) does each Full Page Login Ad receive?:</td><td><input type="text" class="typein" name="fullloginadmaxviewsp" value="<?php echo $fullloginadmaxviews ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits does it cost <?php echo $level1name ?> members to trade for a Full Page Login Ad? (set to 0 to disable credit trading for <?php echo $level1name ?> members):</td><td><input type="text" class="typein" name="fullloginadscreditstradefreep" value="<?php echo $fullloginadscreditstradefree ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits does it cost <?php echo $level2name ?> members to trade for a Full Page Login Ad? (set to 0 to disable credit trading for <?php echo $level2name ?> members):</td><td><input type="text" class="typein" name="fullloginadscreditstradepaidp" value="<?php echo $fullloginadscreditstradepaid ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level1name ?> Member Sponsors when a referral buys a Full Page Login Ad (credit trade purchases do NOT pay commissions):</td><td><input type="text" class="typein" name="fullloginadcommissionfreep" value="<?php echo $fullloginadcommissionfree ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level2name ?> Member Sponsors when a referral buys a Full Page Login Ad (credit trade purchases do NOT pay commissions):</td><td><input type="text" class="typein" name="fullloginadcommissionpaidp" value="<?php echo $fullloginadcommissionpaid ?>" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many Full Page Login Ads may a <?php echo $level1name ?> member save?:</td><td><input type="text" class="typein" name="fullloginadsaveadsfreep" value="<?php echo $fullloginadsaveadsfree ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many Full Page Login Ads may a <?php echo $level2name ?> member save?:</td><td><input type="text" class="typein" name="fullloginadsaveadspaidp" value="<?php echo $fullloginadsaveadspaid ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>How many seconds does a member view a Full Page Login Ad?:</td><td><input type="text" class="typein" name="fullloginadtimerp" value="<?php echo $fullloginadtimer ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits do <?php echo $level1name ?> members get when they view a Full Page Login Ad?:</td><td><input type="text" class="typein" name="fullloginadscreditsfreep" value="<?php echo $fullloginadscreditsfree ?>" class="typein" size="4" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>If the Credit System is enabled, how many credits do <?php echo $level2name ?> members get when they view a Full Page Login Ad?:</td><td><input type="text" class="typein" name="fullloginadscreditspaidp" value="<?php echo $fullloginadscreditspaid ?>" class="typein" size="4" maxlength="12"></td></tr>



<tr class="sabrinatrdark"><td colspan="2" align="center"><div class="heading">TESTIMONIAL SETTINGS</div></td></tr>
<tr class="sabrinatrlight"><td>Do you want only one testimonial at a time to rotate, or show multiple testimonials at once?</td><td><select name="testimonialrotateorgroupp"><option value="group" <?php if ($testimonialrotateorgroup == "group") { echo "selected"; } ?>>Show Multiple Testimonials</option><option value="random" <?php if ($testimonialrotateorgroup != "group") { echo "selected"; } ?>>Show One Testimonial at a Time (rotated)</option></select>
</td></td></tr>
<tr class="sabrinatrlight"><td>If Multiple Testimonials are shown at once (above), show how many on the page together?</td><td><select name="testimonialgroupmaxp">
<option value="1" <?php if ($testimonialgroupmax == "1") { echo "selected"; } ?>>1</option>
<option value="2" <?php if ($testimonialgroupmax == "2") { echo "selected"; } ?>>2</option>
<option value="3" <?php if ($testimonialgroupmax == "3") { echo "selected"; } ?>>3</option>
<option value="4" <?php if ($testimonialgroupmax == "4") { echo "selected"; } ?>>4</option>
<option value="5" <?php if ($testimonialgroupmax == "5") { echo "selected"; } ?>>5</option>
<option value="6" <?php if ($testimonialgroupmax == "6") { echo "selected"; } ?>>6</option>
<option value="7" <?php if ($testimonialgroupmax == "7") { echo "selected"; } ?>>7</option>
<option value="8" <?php if ($testimonialgroupmax == "8") { echo "selected"; } ?>>8</option>
<option value="9" <?php if ($testimonialgroupmax == "9") { echo "selected"; } ?>>9</option>
<option value="10" <?php if ($testimonialgroupmax == "10") { echo "selected"; } ?>>10</option>
</select>
</td></td></tr>
<tr class="sabrinatrlight"><td>File Path to Testimonial Photos:</td><td><input type="text" class="typein" name="testimonialphotopathp" value="<?php echo $testimonialphotopath ?>" class="typein" size="25" maxlength="255"></td></tr>

<tr class="sabrinatrdark"><td colspan="2" align="center">
<input type="hidden" name="action" value="savesettings">
<input type="submit" name="submit" value="SAVE" class="sendit"></form>
</td></tr>
</table>

</td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
?>