<?php
include "control.php";
include "../header.php";
$action = $_POST['submit'];
$show = "";
$error = "";
$adtype = $_REQUEST["adtype"];
################################################################################################
if ($adtype == "solos")
{
$showadtype = "Solo";
}
elseif ($adtype == "banners")
{
$showadtype = "Banner";
}
elseif ($adtype == "buttons")
{
$showadtype = "Button";
}
elseif ($adtype == "textads")
{
$showadtype = "Text";
}
elseif ($adtype == "fullloginads")
{
$showadtype = "Full Page Login";
}
else
{
$showadtype = "";
}
################################################################################################
if ($action == "APPROVE")
{
$id = $_POST["id"];
if (is_array($id))
{
$how_many = count($id);

if ($how_many < 1)
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td colspan="2" align="center"><br>You must check at least one box next to an ad.</td></tr>
<tr><td colspan="2" align="center"><br><a href="approveads.php?adtype=<?php echo $adtype ?>">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
if ($how_many > 0)
{
	for ($i=0; $i<$how_many; $i++)
	{
	$each = $id[$i];
	mysql_query("update $adtype set approved=1 where id='$each'");
	} # for ($i=0; $i<$how_many; $i++)
$show = "The " . $showadtype . " Ads were approved!";
} # if ($how_many > 0)
} # if (is_array($id))
else
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td colspan="2" align="center"><br>You must check at least one box next to an ad.</td></tr>
<tr><td colspan="2" align="center"><br><a href="approveads.php?adtype=<?php echo $adtype ?>">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
} # if ($action == "APPROVE")
################################################################################################
if ($action == "DELETE")
{
$id = $_POST["id"];
if (is_array($id))
{
$how_many = count($id);

if ($how_many < 1)
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td colspan="2" align="center"><br>You must check at least one box next to an ad.</td></tr>
<tr><td colspan="2" align="center"><br><a href="approveads.php?adtype=<?php echo $adtype ?>">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
if ($how_many > 0)
{
	for ($i=0; $i<$how_many; $i++)
	{
	$each = $id[$i];

	if ($adtype == "solos")
	{
		mysql_query("update solos set added=0,subject='',adbody='',url='' where id='$each'");
		$resetq1 = "select * from solos where id=\"$each\"";
		$resetr1 = mysql_query($resetq1);
		while ($resetrowz1 = mysql_fetch_array($resetr1))
		{
		$userid = $resetrowz1["userid"];
		$resetq2 = "update members set lastsolopost=\"\" where userid=\"$userid\"";
		$resetr2 = mysql_query($resetq2);
		}
	}
	if ($adtype == "banners")
	{
		mysql_query("update banners set added=0,name='',bannerurl='',targeturl='' where id='$each'");
	}
	if ($adtype == "buttons")
	{
		mysql_query("update buttons set added=0,name='',bannerurl='',targeturl='' where id='$each'");
	}
	if ($adtype == "textads")
	{
		mysql_query("update textads set added=0,heading='',url='',description='' where id='$each'");
	}
	if ($adtype == "fullloginads")
	{
		mysql_query("update fullloginads set added=0,subject='',url='' where id='$each'");
	}
	} # for ($i=0; $i<$how_many; $i++)
$show = "The " . $showadtype . " Ads have been sent back to the members.";
} # if ($how_many > 0)
} # if (is_array($id))
else
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td colspan="2" align="center"><br>You must check at least one box next to an ad.</td></tr>
<tr><td colspan="2" align="center"><br><a href="approveads.php?adtype=<?php echo $adtype ?>">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
} # if ($action == "DELETE")
################################################################################################
if ($adtype == "solos")
{
$showadtype = "Solo";
$adq = "select * from $adtype where sent=0 and added=1 and approved=0 order by purchase desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "banners")
{
$showadtype = "Banner";
$adq = "select * from $adtype where added=1 and approved=0 order by purchase desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "buttons")
{
$showadtype = "Button";
$adq = "select * from $adtype where added=1 and approved=0 order by purchase desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "textads")
{
$showadtype = "Text";
$adq = "select * from $adtype where added=1 and approved=0 order by purchase desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "fullloginads")
{
$showadtype = "Full Page Login";
$adq = "select * from $adtype where added=1 and approved=0 order by purchase desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
else
{
$showadtype = "";
$adrows = 0;
}
################################################################################################
$soloq = "select * from solos where sent=0 and added=1 and approved=0 order by purchase desc";
$solor = mysql_query($soloq);
$solorows = mysql_num_rows($solor);

$bannerq = "select * from banners where approved=0 and added=1 order by purchase desc";
$bannerr = mysql_query($bannerq);
$bannerrows = mysql_num_rows($bannerr);

$buttonq = "select * from buttons where approved=0 and added=1 order by purchase desc";
$buttonr = mysql_query($buttonq);
$buttonrows = mysql_num_rows($buttonr);

$textadq = "select * from textads where approved=0 and added=1 order by purchase desc";
$textadr = mysql_query($textadq);
$textadrows = mysql_num_rows($textadr);

$fullloginadq = "select * from fullloginads where approved=0 and added=1 order by purchase desc";
$fullloginadr = mysql_query($fullloginadq);
$fullloginadrows = mysql_num_rows($fullloginadr);
################################################################################################
?>
<script language="JavaScript">
 function Inverse(form)
   {
    len = form.elements.length;
    var i=0;
    for( i=0; i<len; i++)
    {
     if (form.elements[i].type=='checkbox' )
     {
      form.elements[i].checked = !form.elements[i].checked;
     }
    }
	return false;
   }		
</script>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Approve&nbsp;Pending&nbsp;Ads</div></td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
?>
<tr><td align="center" colspan="2"><br>
<form action="approveads.php" method="post">
<table width="600" border="0" cellpadding="2" cellspacing="2" class="sabrinatable" align="center">
<tr class="sabrinatrlight"><td align="center" colspan="2">
<table width="600" border="0" cellpadding="2" cellspacing="2" class="sabrinatable" align="center">
<tr class="sabrinatrlight"><td>Pending Solo Ads:</td><td align="center"><?php echo $solorows ?></td></tr>
<tr class="sabrinatrlight"><td>Pending Banner Ads:</td><td align="center"><?php echo $bannerrows ?></td></tr>
<tr class="sabrinatrlight"><td>Pending Button Ads:</td><td align="center"><?php echo $buttonrows ?></td></tr>
<tr class="sabrinatrlight"><td>Pending Text Ads:</td><td align="center"><?php echo $textadrows ?></td></tr>
<tr class="sabrinatrlight"><td>Pending Full Page Login Ads:</td><td align="center"><?php echo $fullloginadrows ?></td></tr>
</table>
</td></tr>
<tr class="sabrinatrdark"><td align="center" colspan="2">
<select name="adtype" id="adtype" onchange="this.form.submit();">
<option value="" <?php if ($adtype == "") { echo "selected"; } ?>> - Select Ad Type - </option>
<option value="solos" <?php if ($adtype == "solos") { echo "selected"; } ?>>Solo Ads</option>
<option value="banners" <?php if ($adtype == "banners") { echo "selected"; } ?>>Banner Ads</option>
<option value="buttons" <?php if ($adtype == "buttons") { echo "selected"; } ?>>Button Ads</option>
<option value="textads" <?php if ($adtype == "textads") { echo "selected"; } ?>>Text Ads</option>
<option value="fullloginads" <?php if ($adtype == "fullloginads") { echo "selected"; } ?>>Full Page Login Ads</option>
</select></form></td></tr>
<?php
if ($adtype != "")
{
if ($adrows < 1)
{
?>
<tr class="sabrinatrlight"><td align="center" colspan="2">No Pending <?php echo $showadtype ?> Ads</td></tr>
<?php
}
if ($adrows > 0)
{
?>
<form action="approveads.php" method="post" name="approveform" id="approveform">
<tr class="sabrinatrlight"><td align="center" colspan="2">Approve <?php echo $showadtype ?> Ads</td></tr>
<tr class="sabrinatrdark"><td align="center" colspan="2">
<table width="600" border="0" cellpadding="2" cellspacing="2" class="sabrinatable" align="center">
<?php
if ($adtype == "solos")
{
?>
<tr class="sabrinatrdark">
<td align="center">&nbsp;</td>
<td align="center">UserID</td>
<td align="center">Subject</td>
<td align="center">URL</td>
<td align="center">Ad Body</td>
<td align="center">Date Ordered</td>
<td align="center">Contact Member</td>
</tr>
<?php
}
if ($adtype == "banners")
{
?>
<tr class="sabrinatrdark">
<td align="center">&nbsp;</td>
<td align="center">UserID</td>
<td align="center">Banner</td>
<td align="center">Name</td>
<td align="center">Banner URL</td>
<td align="center">Target URL</td>
<td align="center">Maximum Hits</td>
<td align="center">Date Ordered</td>
<td align="center">Contact Member</td>
<td align="center">Preview Banner</td>
</tr>
<?php
}
if ($adtype == "buttons")
{
?>
<tr class="sabrinatrdark">
<td align="center">&nbsp;</td>
<td align="center">UserID</td>
<td align="center">Button</td>
<td align="center">Name</td>
<td align="center">Button URL</td>
<td align="center">Target URL</td>
<td align="center">Maximum Hits</td>
<td align="center">Date Ordered</td>
<td align="center">Contact Member</td>
<td align="center">Preview Button</td>
</tr>
<?php
}
if ($adtype == "textads")
{
?>
<tr class="sabrinatrdark">
<td align="center">&nbsp;</td>
<td align="center">UserID</td>
<td align="center">Heading</td>
<td align="center">URL</td>
<td align="center">Description</td>
<td align="center">Date Ordered</td>
<td align="center">Contact Member</td>
</tr>
<?php
}
if ($adtype == "fullloginads")
{
?>
<tr class="sabrinatrdark">
<td align="center">&nbsp;</td>
<td align="center">UserID</td>
<td align="center">Subject</td>
<td align="center">URL</td>
<td align="center">Maximum Hits</td>
<td align="center">Date Ordered</td>
<td align="center">Contact Member</td>
</tr>
<?php
}
while ($adrowz = mysql_fetch_array($adr))
	{
		if ($adtype == "solos")
		{
		$id = $adrowz["id"];
		$userid = $adrowz["userid"];
		$subject = $adrowz["subject"];
		$subject = stripslashes($subject);
		$subject = str_replace('\\', '', $subject);
		$adbody = $adrowz["adbody"];
		$adbody = stripslashes($adbody);
		$adbody = str_replace('\\', '', $adbody);
		$url = $adrowz["url"];
		$purchase = $adrowz["purchase"];
		$purchase = date("M d Y", $purchase);
		$emailq = "select * from members where userid=\"$userid\"";
		$emailr = mysql_query($emailq);
		$emailrows = mysql_num_rows($emailr);
		if ($emailrows > 0)
			{
			$memberemail = mysql_result($emailr,0,"email");
			}
?>
<tr class="sabrinatrlight">
<td align="center"><input type="checkbox" name="id[]" value="<?php echo $id ?>"></td>
<td align="center"><?php echo $userid ?></td>
<td align="center"><?php echo $subject ?></td>
<td align="center"><a href="sitecheck.php?url=<?php echo $url ?>" target="_blank"><?php echo $url ?></a></td>
<td align="center"><div style="width: 400px; height: 200px; padding: 4px; overflow:auto; border-style: solid; border-size: 1px; border-color: #000000; background: #ffffff; color: #000000;"><?php echo $adbody ?></div></td>
<td align="center"><?php echo $purchase ?></td>
<td align="center"><a href="contactmembers.php?userid=<?php echo $userid ?>">Email</a></td>
</tr> 
<?php
		} # if ($adtype == "solos")
		if (($adtype == "banners") or ($adtype == "buttons"))
		{
		$id = $adrowz["id"];
		$userid = $adrowz["userid"];
		$name = $adrowz["name"];
		$name = stripslashes($name);
		$bannerurl = $adrowz["bannerurl"];
		$targeturl = $adrowz["targeturl"];
		$max = $adrowz["max"];
		$purchase = $adrowz["purchase"];
		$purchase = date("M d Y", $purchase);
		$emailq = "select * from members where userid=\"$userid\"";
		$emailr = mysql_query($emailq);
		$emailrows = mysql_num_rows($emailr);
		if ($emailrows > 0)
			{
			$memberemail = mysql_result($emailr,0,"email");
			}
		if ($adtype == "banners")
			{
			$width = "200";
			$windowwidth = "500";
			$windowheight = "75";
			}
		if ($adtype != "banners")
			{
			$width = "75";
			$windowwidth = "150";
			$windowheight = "150";
			}
?>
<tr class="sabrinatrlight">
<td align="center"><input type="checkbox" name="id[]" value="<?php echo $id ?>"></td>
<td align="center"><?php echo $userid ?></td>
<td align="center"><a href="sitecheck.php?url=<?php echo $targeturl ?>" target="_blank"><img src="<?php echo $bannerurl ?>" border="0" alt="<?php echo $name ?>" width="<?php echo $width ?>"></a></td>
<td align="center"><?php echo $name ?></td>
<td align="center"><?php echo $bannerurl ?></td>
<td align="center"><?php echo $targeturl ?></td>
<td align="center"><?php echo $max ?></td>
<td align="center"><?php echo $purchase ?></td>
<td align="center"><a href="contactmembers.php?userid=<?php echo $userid ?>">Email</a></td>
<td align="center">
<script language="JavaScript">
	function previewad(bannerurl,targeturl)
	{
	var win
	win = window.open("", "win", "height=<?php echo $windowheight ?>,width=<?php echo $windowwidth ?>,toolbar=no,directories=no,menubar=no,scrollbars=yes,resizable=yes,dependent=yes'");
	win.document.clear();
	win.document.write('<a href="'+targeturl+'"><img src="'+bannerurl+'" border="0"></a>');
	win.focus();
	win.document.close();
	}
</script>
<input type="button" value="PREVIEW" onclick="javscript:previewad('<?php echo $bannerurl ?>', '<?php echo $targeturl ?>');">		
</td>
</tr> 
<?php
		} # if (($adtype == "banners") or ($adtype == "buttons"))
		if ($adtype == "textads")
		{
		$id = $adrowz["id"];
		$userid = $adrowz["userid"];
		$heading = $adrowz["heading"];
		$heading = stripslashes($heading);
		$heading = str_replace('\\', '', $heading);
		$description = $adrowz["description"];
		$description = stripslashes($description);
		$description = str_replace('\\', '', $description);
		$url = $adrowz["url"];
		$purchase = $adrowz["purchase"];
		$purchase = date("M d Y", $purchase);
		$emailq = "select * from members where userid=\"$userid\"";
		$emailr = mysql_query($emailq);
		$emailrows = mysql_num_rows($emailr);
		if ($emailrows > 0)
			{
			$memberemail = mysql_result($emailr,0,"email");
			}
?>
<tr class="sabrinatrlight">
<td align="center"><input type="checkbox" name="id[]" value="<?php echo $id ?>"></td>
<td align="center"><?php echo $userid ?></td>
<td align="center"><?php echo $heading ?></td>
<td align="center"><a href="sitecheck.php?url=<?php echo $url ?>" target="_blank"><?php echo $url ?></a></td>
<td align="center"><div style="width: 150px; height: 150px; padding: 4px; overflow:auto; border-style: solid; border-size: 1px; border-color: #000000; background: #ffffff; color: #000000;"><?php echo $description ?></div></td>
<td align="center"><?php echo $purchase ?></td>
<td align="center"><a href="contactmembers.php?userid=<?php echo $userid ?>">Email</a></td>
</tr> 
<?php
		} # if ($adtype == "textads")
		if ($adtype == "fullloginads")
		{
		$id = $adrowz["id"];
		$userid = $adrowz["userid"];
		$subject = $adrowz["subject"];
		$subject = stripslashes($subject);
		$subject = str_replace('\\', '', $subject);
		$url = $adrowz["url"];
		$max = $adrowz["max"];
		$purchase = $adrowz["purchase"];
		$purchase = date("M d Y", $purchase);
		$emailq = "select * from members where userid=\"$userid\"";
		$emailr = mysql_query($emailq);
		$emailrows = mysql_num_rows($emailr);
		if ($emailrows > 0)
			{
			$memberemail = mysql_result($emailr,0,"email");
			}
?>
<tr class="sabrinatrlight">
<td align="center"><input type="checkbox" name="id[]" value="<?php echo $id ?>"></td>
<td align="center"><?php echo $userid ?></td>
<td align="center"><?php echo $subject ?></td>
<td align="center"><a href="sitecheck.php?url=<?php echo $url ?>" target="_blank"><?php echo $url ?></a></td>
<td align="center"><?php echo $max ?></td>
<td align="center"><?php echo $purchase ?></td>
<td align="center"><a href="contactmembers.php?userid=<?php echo $userid ?>">Email</a></td>
</tr> 
<?php
		} # ($adtype == "fullloginads")
	} # while ($adrowz = mysql_fetch_array($adr))
?>
</table>
</td></tr>
<?php
?>
<tr class="sabrinatrdark"><td align="center" colspan="2">
<input type="hidden" name="adtype" value="<?php echo $adtype ?>">
<input type="button" onclick="return Inverse(document.approveform);" value="INVERSE">&nbsp;&nbsp;
<input type="submit" name="submit" value="APPROVE">&nbsp;&nbsp;
<input type="submit" name="submit" value="DELETE">&nbsp;&nbsp;
</form>
</td></tr>
<?php
	} # if ($adrows > 0)
} # if ($adtype != "")
?>
</table>
</td></tr>

</table>
<br><br>
<?php
include "../footer.php";
exit;
?>