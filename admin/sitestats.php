<?php
include "control.php";
include "../header.php";

$verifiedr = mysql_query("select * from members where verified='yes'");
$verifiedrows = @ mysql_num_rows($verifiedr);
$unverifiedr = mysql_query("select * from members where verified='no'");
$unverifiedrows = @ mysql_num_rows($unverifiedr);
$totalmembers = $verifiedrows+$unverifiedrows;

$advertiserr = mysql_query("select * from members where accounttype='FREE' and verified='yes'");
$advertiserrows = @ mysql_num_rows($advertiserr);

$partnerr = mysql_query("select * from members where accounttype='PAID' and verified='yes'");
$partnerrows = @ mysql_num_rows($partnerr);

$vacationr= mysql_query("select * from members where vacation='yes'");
$vacationrows = @ mysql_num_rows($vacationr);

$totalewalletq = "select sum(ewallet) as total_ewallet from members"; 
$ewalletrow = mysql_fetch_array(mysql_query($totalewalletq)); 
$totalewalletowed = $ewalletrow['total_ewallet'];
$totalewalletowed = sprintf("%.2f", $totalewalletowed);

$totaltotalcreditsq = "select sum(credits) as total_credits from members"; 
$creditsrow = mysql_fetch_array(mysql_query($totaltotalcreditsq)); 
$totalcredits = $creditsrow['total_credits'];

$totalsalesq = "select sum(amountreceived) as total_sales from transactions";
$salesrow = mysql_fetch_array(mysql_query($totalewalletq)); 
$totalsales = $salesrow['total_sales'];
$totalsales = sprintf("%.2f", $totalsales);

$totalpayoutsq = "select sum(paid) as total_paid from payouts";
$payoutsrow = mysql_fetch_array(mysql_query($totalpayoutsq)); 
$totalpayouts = $payoutsrow['total_paid'];
$totalpayouts = sprintf("%.2f", $totalpayouts);

$solosr= mysql_query("select * from solos");
$solosrows = @ mysql_num_rows($solosr);
$totalsoloclicksq = "select sum(clicks) as total_solo_clicks from solos";
$soloclicksrow = mysql_fetch_array(mysql_query($totalsoloclicksq)); 
$totalsoloclicks = $soloclicksrow['total_solo_clicks'];
if ($totalsoloclicks == "")
{
$totalsoloclicks = 0;
}

$bannersr= mysql_query("select * from banners");
$bannersrows = @ mysql_num_rows($bannersr);
$totalbannersclicksq = "select sum(clicks) as total_banner_clicks from banners";
$bannerclicksrow = mysql_fetch_array(mysql_query($totalbannersclicksq)); 
$totalbannerclicks = $bannerclicksrow['total_banner_clicks'];
if ($totalbannerclicks == "")
{
$totalbannerclicks = 0;
}
$totalbannershitsq = "select sum(hits) as total_banner_hits from banners";
$bannerhitsrow = mysql_fetch_array(mysql_query($totalbannershitsq)); 
$totalbannerhits = $bannerhitsrow['total_banner_hits'];
if ($totalbannerhits == "")
{
$totalbannerhits = 0;
}

$buttonsr= mysql_query("select * from buttons");
$buttonsrows = @ mysql_num_rows($buttonsr);
$totalbuttonsclicksq = "select sum(clicks) as total_button_clicks from buttons";
$buttonclicksrow = mysql_fetch_array(mysql_query($totalbuttonsclicksq)); 
$totalbuttonclicks = $buttonclicksrow['total_button_clicks'];
if ($totalbuttonclicks == "")
{
$totalbuttonclicks = 0;
}
$totalbuttonshitsq = "select sum(hits) as total_button_hits from buttons";
$buttonhitsrow = mysql_fetch_array(mysql_query($totalbuttonshitsq)); 
$totalbuttonhits = $buttonhitsrow['total_button_hits'];
if ($totalbuttonhits == "")
{
$totalbuttonhits = 0;
}

$textadsr= mysql_query("select * from textads");
$textadsrows = @ mysql_num_rows($textadsr);
$totaltextadsclicksq = "select sum(clicks) as total_textad_clicks from textads";
$textadclicksrow = mysql_fetch_array(mysql_query($totaltextadsclicksq)); 
$totaltextadclicks = $textadclicksrow['total_textad_clicks'];
if ($totaltextadclicks == "")
{
$totaltextadclicks = 0;
}
$totaltextadshitsq = "select sum(hits) as total_textad_hits from textads";
$textadhitsrow = mysql_fetch_array(mysql_query($totaltextadshitsq)); 
$totaltextadhits = $textadhitsrow['total_textad_hits'];
if ($totaltextadhits == "")
{
$totaltextadhits = 0;
}

$fullloginadsr= mysql_query("select * from fullloginads");
$fullloginadsrows = @ mysql_num_rows($fullloginadsr);
$totalfullloginadshitsq = "select sum(hits) as total_fullloginad_hits from fullloginads";
$fullloginadhitsrow = mysql_fetch_array(mysql_query($totalfullloginadshitsq)); 
$totalfullloginadhits = $fullloginadhitsrow['total_fullloginad_hits'];
if ($totalfullloginadhits == "")
{
$totalfullloginadhits = 0;
}
?>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="90%">
<tr><td align="center" colspan="2"><div class="heading">Site Stats</div></td></tr>

<tr><td align="center" colspan="2"><br>
<table border="0" cellpadding="2" cellspacing="2" class="sabrinatable" align="center" width="300">
<tr class="sabrinatrlight"><td>Total Members:</td><td><?php echo $totalmembers ?></td></tr>
<tr class="sabrinatrlight"><td>Verified Members:</td><td><?php echo $verifiedrows ?></td></tr>
<tr class="sabrinatrlight"><td>Un-Verified Members:</td><td><?php echo $unverifiedrows ?></td></tr>
<tr class="sabrinatrlight"><td>Total <?php echo $level1name ?> Members:</td><td><?php echo $advertiserrows ?></td></tr>
<tr class="sabrinatrlight"><td>Total <?php echo $level2name ?> Members:</td><td><?php echo $partnerrows ?></td></tr>
<tr class="sabrinatrlight"><td>Total Sales:</td><td><?php echo $totalsales ?></td></tr>
<tr class="sabrinatrlight"><td>Total Payouts:</td><td><?php echo $totalpayouts ?></td></tr>
<tr class="sabrinatrlight"><td>Total <?php echo $ewalletname ?> Balance:</td><td><?php echo $totalewalletowed ?></td></tr>
<?php
if ($enablecreditssystem == "yes")
{
?>
<tr class="sabrinatrlight"><td>Total Credits Balance:</td><td><?php echo $totalcredits ?></td></tr>
<?php
}
?>
<tr class="sabrinatrdark"><td colspan="2"></td></tr>
<tr class="sabrinatrlight"><td>Total Solos:</td><td><?php echo $solosrows ?></td></tr>
<tr class="sabrinatrlight"><td>Total Solo Clicks:</td><td><?php echo $totalsoloclicks ?></td></tr>
<tr class="sabrinatrlight"><td>Total Banner Ads:</td><td><?php echo $bannersrows ?></td></tr>
<tr class="sabrinatrlight"><td>Total Banner Ad Clicks:</td><td><?php echo $totalbannerclicks ?></td></tr>
<tr class="sabrinatrlight"><td>Total Banner Ad Hits:</td><td><?php echo $totalbannerhits ?></td></tr>
<tr class="sabrinatrlight"><td>Total Button Ads:</td><td><?php echo $buttonsrows ?></td></tr>
<tr class="sabrinatrlight"><td>Total Button Ad Clicks:</td><td><?php echo $totalbuttonclicks ?></td></tr>
<tr class="sabrinatrlight"><td>Total Button Ad Hits:</td><td><?php echo $totalbuttonhits ?></td></tr>
<tr class="sabrinatrlight"><td>Total Text Ads:</td><td><?php echo $textadsrows ?></td></tr>
<tr class="sabrinatrlight"><td>Total Text Ad Clicks:</td><td><?php echo $totaltextadclicks ?></td></tr>
<tr class="sabrinatrlight"><td>Total Text Ad Hits:</td><td><?php echo $totaltextadhits ?></td></tr>
<tr class="sabrinatrlight"><td>Total Full Page Login Ads:</td><td><?php echo $fullloginadsrows ?></td></tr>
<tr class="sabrinatrlight"><td>Total Full Page Login Ad Hits:</td><td><?php echo $totalfullloginadhits ?></td></tr>
</table>
</td></tr>

</table>
<br><br>
<?php
include "../footer.php";
?>