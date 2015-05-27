<?php
include "db.php";
####### COPYRIGHT 2011 SABRINA MARKON pearlsofwealth@gmail.com #######
?>
<html><head>
<style type="text/css">
<!--
/* FONT COLORS */
TABLE		{ COLOR: #CC9933; FONT: 11px arial, sans-serif; font-weight: normal }
.title		{ COLOR: #0033FF; FONT: 12px arial, sans-serif; font-weight: bold; }
#NewsDiv2	{ position: absolute; left: 0; top: -18; width: 100%; height:270px; overflow:auto; }
/* PAGE LINK COLORS */
a:link		{ color: #0033FF; text-decoration: underline; }
a:visited	{ color: #6633FF; text-decoration: underline; }
a:active	{ color: #0033FF; text-decoration: underline; }
a:hover		{ color: #6699FF; text-decoration: none; }
-->
</style>
<!--<BODY TEXT="#CC9933" onMouseover="scrollspeed=0" onMouseout="scrollspeed=current" OnLoad="NewsScrollStart();" bgcolor="#323232">-->
<BODY TEXT="#CC9933" bgcolor="#323232">
<div id="NewsDiv2">
<?php
if ($testimonialrotateorgroup == "group")
{
$tq = "select * from testimonials where approved=\"1\" order by rand() limit $testimonialgroupmax";
$tr = mysql_query($tq);
$trows = mysql_num_rows($tr);
if ($trows > 0)
	{
	while ($trowz = mysql_fetch_array($tr))
		{
		$tid = $trowz["id"];
		$tuserid = $trowz["userid"];
		$tname = $trowz["name"];
		$tphoto = $trowz["photo"];
		$tcompany = $trowz["company"];
		$tcompany = stripslashes($tcompany);
		$turl = $trowz["url"];
		$theading = $trowz["heading"];
		$theading = stripslashes($theading);
		$tbody = $trowz["body"];
		$tbody = stripslashes($tbody);
		$trating = $trowz["rating"];
		$tq2 = "update testimonials set views=views+1 where id=\"$tid\"";
		$tr2 = mysql_query($tq2);
?>
<table width="190" cellpadding="1" cellspacing="0" align="center">
<tr><td align="center" colspan="2" valign="top"><font style="font-size: 12px; font-weight: bold;"><?php echo $theading ?></font></td></tr>
<tr><td colspan="2"><font style="font-size: 10px;"><i><?php echo $tbody ?></i></font></td></tr>
<?php
if ($tphoto == "")
{
?>
<tr>
<td align="center" colspan="2">
<div style="width: 190px;">
<br><br>
<font style="font-size: 12px; font-weight: bold;"><?php echo $tname ?></font><br>
<?php
if ($turl != "")
	{
if ($tcompany != "")
	{
?>
<a href="<?php echo $turl ?>" target="_blank"><font style="font-size: 10px;"><?php echo $tcompany ?></font></a><br>
<a href="<?php echo $turl ?>" target="_blank"><font style="font-size: 10px;"><?php echo $turl ?></font></a><br>
<?php
	}
if ($tcompany == "")
	{
?>
<a href="<?php echo $turl ?>" target="_blank"><font style="font-size: 10px;"><?php echo $turl ?></font></a><br>
<?php
	}
	} # if ($turl != "")
#######################
if ($turl == "")
	{
if ($tcompany != "")
	{
?>
<font style="font-size: 10px;"><?php echo $tcompany ?></font><br>
<?php
	}
	} # if ($turl == "")
?>
</div>
</td>
</tr>
<?php
}
if ($tphoto != "")
{
?>
<tr>
<td align="center" colspan="2">
<div style="width: 190px;">
<img src="<?php echo $domain ?>/photos/<?php echo $tphoto ?>" style="border: 4px solid #000000;" alt="<?php echo $tname ?>'s <?php echo $sitename ?> Testimonial" width="125" height="125">
<font style="font-size: 12px; font-weight: bold;"><?php echo $tname ?></font><br>
<?php
if ($turl != "")
	{
if ($tcompany != "")
	{
?>
<a href="<?php echo $turl ?>" target="_blank"><font style="font-size: 10px;"><?php echo $tcompany ?></font></a><br>
<a href="<?php echo $turl ?>" target="_blank"><font style="font-size: 10px;"><?php echo $turl ?></font></a><br>
<?php
	}
if ($tcompany == "")
	{
?>
<a href="<?php echo $turl ?>" target="_blank"><font style="font-size: 10px;"><?php echo $turl ?></font></a><br>
<?php
	}
	} # if ($turl != "")
#######################
if ($turl == "")
	{
if ($tcompany != "")
	{
?>
<font style="font-size: 10px;"><?php echo $tcompany ?></font><br>
<?php
	}
	} # if ($turl == "")
?>
</div>
</td>
</tr>
<?php
}
?>
</table>
<?php
		} # while ($trowz = mysql_fetch_array($tr))
	} # if ($trows > 0)
} # if ($testimonialrotateorgroup == "group")
######################################################################
if ($testimonialrotateorgroup != "group")
{
$tq = "select * from testimonials where approved=\"1\" order by rand() limit 1";
$tr = mysql_query($tq);
$trows = mysql_num_rows($tr);
if ($trows > 0)
	{
	$tid = mysql_result($tr,0,"id");
	$tuserid = mysql_result($tr,0,"userid");
	$tname = mysql_result($tr,0,"name");
	$tphoto = mysql_result($tr,0,"photo");
	$tcompany = mysql_result($tr,0,"company");
	$tcompany = stripslashes($tcompany);
	$turl = mysql_result($tr,0,"url");
	$theading = mysql_result($tr,0,"heading");
	$theading = stripslashes($theading);
	$tbody = mysql_result($tr,0,"body");
	$tbody = stripslashes($tbody);
	$trating = mysql_result($tr,0,"rating");
	$tq2 = "update testimonials set views=views+1 where id=\"$tid\"";
	$tr2 = mysql_query($tq2);
?>
<br>
<table width="190" cellpadding="1" cellspacing="0" align="center">
<tr><td align="center" colspan="2" valign="top"><font style="font-size: 12px; font-weight: bold;"><?php echo $theading ?></font></td></tr>
<tr><td colspan="2"><font style="font-size: 10px;"><i><?php echo $tbody ?></i></font></td></tr>
<?php
if ($tphoto == "")
{
?>
<tr>
<td align="center" colspan="2">
<div style="width: 140px;">
<font style="font-size: 12px; font-weight: bold;"><?php echo $tname ?></font><br>
<?php
if ($turl != "")
	{
if ($tcompany != "")
	{
?>
<a href="<?php echo $turl ?>" target="_blank"><font style="font-size: 10px;"><?php echo $tcompany ?></font></a><br>
<a href="<?php echo $turl ?>" target="_blank"><font style="font-size: 10px;"><?php echo $turl ?></font></a><br>
<?php
	}
if ($tcompany == "")
	{
?>
<a href="<?php echo $turl ?>" target="_blank"><font style="font-size: 10px;"><?php echo $turl ?></font></a><br>
<?php
	}
	} # if ($turl != "")
#######################
if ($turl == "")
	{
if ($tcompany != "")
	{
?>
<font style="font-size: 10px;"><?php echo $tcompany ?></font><br>
<?php
	}
	} # if ($turl == "")
?>
</div>
</td>
</tr>
<?php
}
if ($tphoto != "")
{
?>
<tr>
<td align="center" colspan="2">
<div style="width: 140px;">
<img src="<?php echo $domain ?>/photos/<?php echo $tphoto ?>" style="border: 4px solid #000000;" alt="<?php echo $tname ?>'s <?php echo $sitename ?> Testimonial" width="125" height="125">
<font style="font-size: 12px; font-weight: bold;"><?php echo $tname ?></font><br>
<?php
if ($turl != "")
	{
if ($tcompany != "")
	{
?>
<a href="<?php echo $turl ?>" target="_blank"><font style="font-size: 10px;"><?php echo $tcompany ?></font></a><br>
<a href="<?php echo $turl ?>" target="_blank"><font style="font-size: 10px;"><?php echo $turl ?></font></a><br>
<?php
	}
if ($tcompany == "")
	{
?>
<a href="<?php echo $turl ?>" target="_blank"><font style="font-size: 10px;"><?php echo $turl ?></font></a><br>
<?php
	}
	} # if ($turl != "")
#######################
if ($turl == "")
	{
if ($tcompany != "")
	{
?>
<font style="font-size: 10px;"><?php echo $tcompany ?></font><br>
<?php
	}
	} # if ($turl == "")
?>
</div>
</td>
</tr>
<?php
}
?>
</table>
<?php
	} # if ($trows > 0)
} # if ($testimonialrotateorgroup != "group")
?>
</div>
<!-- YOU DO NOT NEED TO EDIT BELOW THIS LINE -->

<script language="JavaScript" type="text/javascript">
<!-- HIDE CODE

var scrollspeed		= "1"		// SET SCROLLER SPEED 1 = SLOWEST
var speedjump		= "30"		// ADJUST SCROLL JUMPING = RANGE 20 TO 40
var startdelay 		= "2" 		// START SCROLLING DELAY IN SECONDS
var nextdelay		= "0" 		// SECOND SCROLL DELAY IN SECONDS 0 = QUICKEST
var topspace		= "52px"		// TOP SPACING FIRST TIME SCROLLING
var frameheight		= "200px"	// IF YOU RESIZE THE WINDOW EDIT THIS HEIGHT TO MATCH



current = (scrollspeed)


function HeightData(){
AreaHeight=dataobj.offsetHeight
if (AreaHeight==0){
setTimeout("HeightData()",( startdelay * 1000 ))
}
else {
ScrollNewsDiv()
}}

function NewsScrollStart(){
dataobj=document.all? document.all.NewsDiv2 : document.getElementById("NewsDiv2")
dataobj.style.top=topspace
setTimeout("HeightData()",( startdelay * 1000 ))
}

function ScrollNewsDiv(){
dataobj.style.top=parseInt(dataobj.style.top)-(scrollspeed)
if (parseInt(dataobj.style.top)<AreaHeight*(-1)) {
dataobj.style.top=frameheight
setTimeout("ScrollNewsDiv()",( nextdelay * 1000 ))
}
else {
setTimeout("ScrollNewsDiv()",speedjump)
}}



// END HIDE CODE -->
</script>
</body>
</html>