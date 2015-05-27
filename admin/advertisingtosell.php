<?php
include "control.php";
include "../header.php";
$action = $_POST["action"];
###############################################
if ($action == "delete")
{
$deleteid = $_POST["deleteid"];
$q = "delete from advertisingforsale where id=\"$deleteid\"";
$r = mysql_query($q);
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td colspan="2" align="center"><br>The advertising package was deleted</td></tr>
<tr><td colspan="2" align="center"><br><a href="advertisingtosell.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
} # if ($action == "delete")
###############################################
if ($action == "add")
{
$addadvertisingdescription = $_POST["addadvertisingdescription"];
$addadvertisingtype = $_POST["addadvertisingtype"];
$addadvertisinghowmany = $_POST["addadvertisinghowmany"];
$addadvertisingmax = $_POST["addadvertisingmax"];
$addadvertisingprice = $_POST["addadvertisingprice"];
$addadvertisingprice = sprintf("%.2f", $addadvertisingprice);
$addadvertisingcreditsprice = $_POST["addadvertisingcreditsprice"];
$addadvertisingcommissionfree = $_POST["addadvertisingcommissionfree"];
$addadvertisingcommissionpaid = $_POST["addadvertisingcommissionpaid"];

	if (!$addadvertisingdescription)
	{
	$error .= "<div>Please return and enter a description.</div>";
	}
	if((!$addadvertisingprice) or ($addadvertisingprice == "") or ($addadvertisingprice < 0.01))
	{
	$error .= "<div>Please return and enter a price greater than 0.00.</div>";
	}
	if(!$error == "")
	{
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
	<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
	<tr><td colspan="2" align="center"><br><?php echo $error ?></td></tr>
	<tr><td colspan="2" align="center"><br><a href="advertisingtosell.php">RETURN</a></td></tr>
	</table>
	<br><br>
	<?php
	include "../footer.php";
	exit;
	}
	
	if ($addadvertisingtype == "Credits")
	{
	$addadvertisingmax = 0;
	$addadvertisingcreditsprice = 0;
	}

$q = "insert into advertisingforsale (description,type,howmany,max,price,creditsprice,commissionfree,commissionpaid) values (\"$addadvertisingdescription\",\"$addadvertisingtype\",\"$addadvertisinghowmany\",\"$addadvertisingmax\",\"$addadvertisingprice\",\"$addadvertisingcreditsprice\",\"$addadvertisingcommissionfree\",\"$addadvertisingcommissionpaid\")";
$r = mysql_query($q);
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td colspan="2" align="center"><br>The new advertising package was created!</td></tr>
<tr><td colspan="2" align="center"><br><a href="advertisingtosell.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
} # if ($action == "add")
###############################################
?>
<form method="POST" action="advertisingtosell.php">
<table width="600" cellpadding="4" cellspacing="2" border="0" align="center" class="sabrinatable">
<tr class="sabrinatrdark"><td align="center" colspan="2"><font style="font-size:16px;">CREATE ADVERTISING</font></td></tr>
<tr class="sabrinatrlight"><td>Advertising Description:</td><td><input type="text" name="addadvertisingdescription" maxlength="255" size="25"></td></tr>
<tr class="sabrinatrlight"><td>Type:</td><td>
<?php
$typeq = "select * from advertisingtypes order by adtype";
$typer = mysql_query($typeq);
$typerows = mysql_num_rows($typer);
if ($typerows < 1)
	{
	?>
	No ad types are available to sell.
	<?php
	}
if ($typerows > 0)
	{
	?>
	<select name="addadvertisingtype">
	<?php
	while ($typerowz = mysql_fetch_array($typer))
		{
		$adtype = $typerowz["adtype"];
		?>
		<option value="<?php echo $adtype ?>"><?php echo $adtype ?></option>
		<?php
		}
	?>
	</select>
	<?php
	}
?>
</td></tr>
<tr class="sabrinatrlight"><td>How Many Do Buyers Receive?: </td><td><input type="text" name="addadvertisinghowmany" maxlength="8" size="6"></td></tr>
<tr class="sabrinatrlight"><td>How Many Clicks or Hits Does Each Ad Receive? (0 if selling credits): </td><td><input type="text" name="addadvertisingmax" maxlength="8" size="6" value="0"></td></tr>
<tr class="sabrinatrlight"><td>Price: </td><td><input type="text" name="addadvertisingprice" maxlength="8" size="6" value="0.00"></td></tr>
<?php
if ($enablecreditssystem == "yes")
{
?>
<tr class="sabrinatrlight"><td>Credits Trade (0 to disable credits trading or if selling credits): </td><td><input type="text" name="addadvertisingcreditsprice" maxlength="8" size="6" value="0"></td></tr>
<?php
}
?>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level1name ?> Member Sponsors when a referral buys these Ads (credit trade purchases do NOT pay commissions):</td><td><input type="text" class="typein" name="addadvertisingcommissionfree" value="0.00" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level2name ?> Member Sponsors when a referral buys these Ads (credit trade purchases do NOT pay commissions):</td><td><input type="text" class="typein" name="addadvertisingcommissionpaid" value="0.00" class="typein" size="6" maxlength="12"></td></tr>
<tr class="sabrinatrdark"><td align="center" colspan="2"><input type="hidden" name="action" value="add"><input type="submit" value="ADD NEW ADVERTISING"></form></td></tr>
</table>

<?php
if ($enablecreditssystem == "yes")
{
$cols = "9";
}
if ($enablecreditssystem != "yes")
{
$cols = "8";
}
?>
<br><br>
<center>
<table width="90%" cellpadding="4" cellspacing="2" border="0" align="center" class="sabrinatable">
<tr class="sabrinatrdark"><td align="center" colspan="<?php echo $cols ?>"><font style="font-size:16px;">ADVERTISING CURRENTLY FOR SALE</font></td></tr>
<?php
$adq = "select * from advertisingforsale order by id";
$adr = mysql_query ($adq) or die(mysql_error());
$adrows = mysql_num_rows($adr);
if ($adrows < 1)
	{
	?>
	<tr class="sabrinatrlight"><td align="center" colspan="<?php echo $cols ?>">No advertising is currently being sold on the website.</td></tr>
	<?php
	}
if ($adrows > 0)
	{
	?>
	<tr class="sabrinatrlight">
	<td align="center">Description</td>
	<td align="center">Type</td>
	<td align="center">How Many</td>
	<td align="center">Maximum Clicks or Hits</td>
	<td align="center">Price</td>
	<?php
	if ($enablecreditssystem == "yes")
	{
	?>
	<td align="center">Credits Trade</td>
	<?php
	}
	?>
	<td align="center"><?php echo $level1name ?> Sponsor Commission</td>
	<td align="center"><?php echo $level2name ?> Sponsor Commission</td>
	<td align="center">Delete</td>
	</tr>
	<?php
	while ($adrowz = mysql_fetch_array($adr))
		{
		$id = $adrowz["id"];
		$type = $adrowz["type"];
		$howmany = $adrowz["howmany"];
		$max = $adrowz["max"];
		$price = $adrowz["price"];
		$creditsprice = $adrowz["creditsprice"];
		$commissionfree = $adrowz["commissionfree"];
		$commissionpaid = $adrowz["commissionpaid"];
		$description = $adrowz["description"];
		$description = stripslashes($description);
		if ($type == "Credits")
			{
			$showcreditsprice = "N/A";
			$showmax = "N/A";
			}
		if ($type != "Credits")
			{
			$showcreditsprice = $creditsprice;
			if ($type == "Solos")
				{
				$showmax = "N/A";
				}
			else
				{
				$showmax = $max;
				}
			}
			?>
			<tr class="sabrinatrdark">
			<td align="center"><?php echo $description ?></td>
			<td align="center"><?php echo $type ?></td>
			<td align="center"><?php echo $howmany ?></td>
			<td align="center"><?php echo $showmax ?></td>
			<td align="center"><?php echo $price ?></td>
			<?php
			if ($enablecreditssystem == "yes")
			{
			?>
			<td align="center"><?php echo $showcreditsprice ?></td>
			<?php
			}
			?>
			<td align="center"><?php echo $commissionfree ?></td>
			<td align="center"><?php echo $commissionpaid ?></td>
			<form method="POST" action="advertisingtosell.php">
			<td align="center">
			<input type="hidden" name="action" value="delete">
			<input type="hidden" name="deleteid" value="<?php echo $id ?>">
			<input type="submit" value="DELETE">
			</td>
			</form>
			</tr>
			<?php
		} # while ($adrowz = mysql_fetch_array($adr))
	} # if ($adrows > 0)
?>
</table>
<?php
include "../footer.php";
exit;
?>