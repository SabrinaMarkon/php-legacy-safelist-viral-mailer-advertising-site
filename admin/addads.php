<?php
include "control.php";
include "../header.php";
$action = $_POST["action"];
$show = "";
$error = "";
if ($action == "add")
{
$type = $_POST["type"];
$quantity = $_POST["quantity"];
$originalquantity = $quantity;
$max = $_POST["max"];
$userid = $_POST["userid"];
		if ($type == "Solo")
			{
				while($quantity > 0)
				{
				mysql_query("insert into solos (userid,purchase) VALUES ('".$userid."','".time()."')");
				$quantity--;
				}
			$show = $originalquantity . " " . $type . " Ad(s) were added to " . $userid . "'s member account";
			}
		if ($type == "Banner")
			{
				while($quantity > 0)
				{
				mysql_query("insert into banners (userid,max,purchase) VALUES ('".$userid."','".$bannermaxviews."','".time()."')");
				$quantity--;
				}
			$show = $originalquantity . " " . $type . " Ad(s) were added to " . $userid . "'s member account";
			}
		if ($type == "Button")
			{
				while($quantity > 0)
				{
				mysql_query("insert into buttons (userid,max,purchase) VALUES ('".$userid."','".$buttonmaxviews."','".time()."')");
				$quantity--;
				}
			$show = $originalquantity . " " . $type . " Ad(s) were added to " . $userid . "'s member account";
			}
		if ($type == "Text")
			{
				while($quantity > 0)
				{
				mysql_query("insert into textads (userid,max,purchase) VALUES ('".$userid."','".$textadmaxviews."','".time()."')");
				$quantity--;
				}
			$show = $originalquantity . " " . $type . " Ad(s) were added to " . $userid . "'s member account";
			}
		if ($type == "Full Page Login")
			{
				while($quantity > 0)
				{
				mysql_query("insert into fullloginads (userid,max,purchase) VALUES ('".$userid."','".$fullloginadmaxviews."','".time()."')");
				$quantity--;
				}
			$show = $originalquantity . " " . $type . " Ad(s) were added to " . $userid . "'s member account";
			}
} # if ($action == "add")
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Add&nbsp;Ads&nbsp;To&nbsp;Member&nbsp;Accounts</div></td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
?>
<tr><td align="center" colspan="2"><br>
<form action="addads.php" method="post">
<table width="80%" border="0" cellpadding="2" cellspacing="2" class="sabrinatable" align="center">
<tr class="sabrinatrdark"><td align="center">Type</td><td align="center">UserID</td><td align="center">Quantity</td><td align="center">Max&nbsp;Per&nbsp;Ad<br>(n/a if a solo)</td><td align="center">Add</td></tr>
<tr class="sabrinatrlight">
<td align="center">
<select name="type" class="pickone">
<option value="Solo">Solo</option>
<option value="Banner">Banner</option>
<option value="Button">Button</option>
<option value="Text">Text Ad</option>
<option value="Full Page Login">Full Page Login Ad</option>
</select>
</td>
<td align="center">
<?php
$uq = "select * from members order by userid";
$ur = mysql_query($uq);
$urows = mysql_num_rows($ur);
if ($urows < 1)
{
?>
There are no members yet
<?php
}
if ($urows > 0)
{
	?>
	<select name="userid">
	<?php
	while ($urowz = mysql_fetch_array($ur))
	{
		$userid = $urowz["userid"];
		?>
		<option value="<?php echo $userid ?>"><?php echo $userid ?></option>
		<?php
	} # while ($urowz = mysql_fetch_array($ur))
	?>
	</select>
	<?php
} # if ($urows > 0)
?>
</td>
<td align="center">
<select name="quantity" class="pickone">
<?php
for ($i=1;$i<=100;$i++)
{
?>
<option value="<?php echo $i ?>"><?php echo $i ?></option>
<?php
}
?>
</select>
</td>
<td align="center"><input type="text" name="max" class="typein" size="6" maxlength="12"></td>
<td align="center">
<?php
if ($urows > 0)
{
?>
<input type="hidden" name="action" value="add">
<input type="submit" value="ADD" class="sendit"></form>
<?php
}
if ($urows < 1)
{
?>
<input type="hidden" name="action" value="add">
<input type="submit" value="ADD" class="sendit" disabled></form>
<?php
}
?>
</td>
</tr>
</table>
</td></tr>

</table>
<br><br>
<?php
include "../footer.php";
exit;
?>