
<br>
<?php
########### DO NOT REMOVE BELOW LINES UNLESS YOU DON'T WANT THE MINI ADS
if ($parentfolder != "admin")
{
?>
<center>
<?php
include "banners.php";
?>
<br><br>
<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="width:600px;"><tr>

<td align="center" valign="top" style="width:200px;">
<?php
include "recentadswidget_solos.php";
?>
</td>

<td align="center" valign="top" style="width:200px;">
<?php
include "recentadswidget_banners.php";
?>
</td>

<td align="center" valign="top" style="width:200px;">
<?php
include "recentadswidget_fullloginads.php";
?>
</td>

<td align="center" valign="top" style="width:200px;">
<?php
include "recentadswidget_buttons.php";
?>
</td>
</tr>
</table>
<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="width:600px;margin-top:60px;"><tr>
<tr><td align="center">
<iframe width="600" height="68" src="<?php echo $domain ?>/bannersscrollwidget.php" frameborder="0" allowtransparency="true" style="overflow: hidden;" scrolling="no"></iframe>
<div style="height:10px;"></div>
<iframe width="600" height="133" src="<?php echo $domain ?>/buttonscrollwidget.php" frameborder="0" allowtransparency="true" style="overflow: hidden;" scrolling="no"></iframe>
</td></tr>
</table>
<?php
}
########### DO NOT REMOVE ABOVE LINES UNLESS YOU DON'T WANT THE MINI ADS

########### REMOVE BELOW LINE TO REMOVE TESTIMONIALS
include "testimonials.php";
########### REMOVE ABOVE LINE TO REMOVE TESTIMONIALS

########### REMOVE BELOW TWO LINES TO REMOVE MAILER SITE DIRECTORY LIST
include "script_sitesforsale.php";
include "db.php";
########### REMOVE ABOVE TWO LINES TO REMOVE MAILER SITE DIRECTORY LIST
?>

|&nbsp;<a href="<?php echo $domain ?>/login.php?referid=<?php echo $referid ?>"><font color="#000000">Member Login</a>&nbsp;|&nbsp;
<a href="<?php echo $domain ?>/register.php?referid=<?php echo $referid ?>"><font color="#000000">Register</a>&nbsp;|&nbsp;
<a href="http://e-webs.us/helpdesk" target="_blank"><font color="#000000">Helpdesk</a>&nbsp;|&nbsp;
<a href="<?php echo $domain ?>/details.php?referid=<?php echo $referid ?>"><font color="#000000">Program Details</a>&nbsp;|&nbsp;
<a href="<?php echo $domain ?>/terms.php?referid=<?php echo $referid ?>"><font color="#000000">Terms and Conditions</a>&nbsp;|&nbsp;
<a href="<?php echo $domain ?>/spam.php?referid=<?php echo $referid ?>"><font color="#000000">Spam/Privacy Policy</a>&nbsp;|&nbsp;
<a href="<?php echo $domain ?>/about.php?referid=<?php echo $referid ?>"><font color="#000000">About Us</a>&nbsp;|&nbsp;
<a href="<?php echo $domain ?>/faq.php?referid=<?php echo $referid ?>"><font color="#000000">FAQ</a>&nbsp;|&nbsp;
<a href="<?php echo $domain ?>/testimonialpage.php?referid=<?php echo $referid ?>"><font color="#000000">Testimonials</a>&nbsp;|
<br><br>
<a href="http://e-webs.us" target="_blank">&copy; 2014 Marc Tori, E-Webs.us</a>. &copy; 2014 Custom PHP Script Development By <a href="http://phpsitescripts.com" target="_blank">Sabrina Markon, PHPSiteScripts.com</a>, Proudly Hosted by <a href="http://sunshinehosting.net" target="_blank">SunshineHosting.net</a>
</center>
<br>

</td></tr>
<tr><td align="center"><img src="<?php echo $domain ?>/images/footer.jpg" width="960"></td></tr>
</table>
</body>
</html>
