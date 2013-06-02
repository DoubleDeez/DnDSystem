<?php
error_reporting(E_ALL);
include("include/vars.php");
include("include/funcs.php");

mysql_connect("$host", "$user", "$pass") or die(mysql_error());
mysql_select_db("$db") or die(mysql_error());

$charRes = mysql_query("SELECT * FROM characters WHERE disable='0'") or die(mysql_error());
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
        <title>DnD Manager System</title>
    </head>
    <body onload='setTimeout("location.reload(true);", 120000);'>
		<div id='menu'></div>
		<div id='main'>
			<div id='content'>
				<?php
				while ($row = mysql_fetch_array($charRes)) {
					$hp = $row['hp'];
					$maxhp = $row['maxhp'];
					$hpcolour = "#006400";
					$exp = $row['exp'];

					if ($hp <= 0) {
						$hpcolour = "#FF0000";
					} else if ($hp <= ($maxhp / 2)) {
						$hpcolour = "#FFA500";
					}
					?>
					<div class="charInfo">
						<div style="float: left;">
							<span class="charName"><?php echo $row['name']; ?></span>
							<br/>
							<span class="charType"><?php echo $row['class'] ?></span>
							<br/>
							<span class="charLevel">Level: <?php echo getLevel($exp); ?></span>
							<br/>
							<span class="charExpToLevel">EXP to Level: <?php echo getExpToLevel($exp); ?></span>
						</div>
						<div style="float: right;">
							<span class="charHP" style="color: <?php echo $hpcolour; ?>;"><?php echo $hp . "/" . $maxhp; echo ($row['temphp'] == 0) ? "" : " + ".$row['temphp']; ?></span>
						</div>
						<br style="clear: both;" />
						<div style="float: left;" />
						<br />
						<table style="font-family: Verdana,Arial,sans-serif;border:0px;width:300px;padding-top:5px;">
							<tr>
								<th style="font-size:14px;width:25%;">Speed</th>
								<th style="font-size:14px;width:25%;">Initiative</th>
								<th style="font-size:14px;width:25%;">Action</th>
								<th style="font-size:14px;width:25%;">Vision</th>
							</tr>
							<tr>
								<td><?php echo $row['speed']; ?></td>
								<td><?php echo $row['initiative']; ?></td>
								<td><?php echo $row['ap']; ?></td>
								<td><?php echo $row['vision']; ?></td>
							</tr>
						</table>
						<br />
						<br />
						<span class="statHeading">Defenses:</span><br />
						<table style="font-family: Verdana,Arial,sans-serif;border:0px;width:300px;padding-top:5px;">
							<tr>
								<th style="font-size:14px;width:25%;">AC</th>
								<th style="font-size:14px;width:25%;">Fortitude</th>
								<th style="font-size:14px;width:25%;">Reflex</th>
								<th style="font-size:14px;width:25%;">Will</th>
							</tr>
							<tr>
								<td><?php echo $row['ac']; ?></td>
								<td><?php echo $row['fortitude']; ?></td>
								<td><?php echo $row['reflex']; ?></td>
								<td><?php echo $row['will']; ?></td>
							</tr>
						</table>
						<br />
						<br />
						<span class="statHeading">Ability Scores:</span><br />
						<table style="font-family: Verdana,Arial,sans-serif;border:0px;width:300px;padding-top:5px;">
							<tr>
								<th style="font-size:14px;width:25%;">Str:</th>
								<td style="font-size:13px;width:25%;"><?php echo $row['str']; ?></td>
								<td style="font-size:13px;width:25%;"><?php echo ($row['strMod'] >= 0) ? "+" : ""; echo $row['strMod']; ?></td>
							</tr>
							<tr>
								<th style="font-size:14px;width:25%;">Con:</th>
								<td style="font-size:13px;width:25%;"><?php echo $row['con']; ?></td>
								<td style="font-size:13px;width:25%;"><?php echo ($row['conMod'] >= 0) ? "+" : ""; echo $row['conMod']; ?></td>
							</tr>
							<tr>
								<th style="font-size:14px;width:25%;">Dex:</th>
								<td style="font-size:13px;width:25%;"><?php echo $row['dex']; ?></td>
								<td style="font-size:13px;width:25%;"><?php echo ($row['dexMod'] >= 0) ? "+" : ""; echo $row['dexMod']; ?></td>
							</tr>
							<tr>
								<th style="font-size:14px;width:25%;">Int:</th>
								<td style="font-size:13px;width:25%;"><?php echo $row['int']; ?></td>
								<td style="font-size:13px;width:25%;"><?php echo ($row['intMod'] >= 0) ? "+" : ""; echo $row['intMod']; ?></td>
							</tr>
							<tr>
								<th style="font-size:14px;width:25%;">Wis:</th>
								<td style="font-size:13px;width:25%;"><?php echo $row['wis']; ?></td>
								<td style="font-size:13px;width:25%;"><?php echo ($row['wisMod'] >= 0) ? "+" : ""; echo $row['wisMod']; ?></td>
							</tr>
							<tr>
								<th style="font-size:14px;width:25%;">Cha:</th>
								<td style="font-size:13px;width:25%;"><?php echo $row['cha']; ?></td>
								<td style="font-size:13px;width:25%;"><?php echo ($row['chaMod'] >= 0) ? "+" : ""; echo $row['chaMod']; ?></td>
							</tr>
						</table>
					</div>
					<div style="float: left;padding-left:25px;" />
					<br />
					<span class="statHeading">Inventory: </span><a class="linkBtn" id="toggleInv<?php echo $row['id']; ?>">(hide)</a><br />
					<div id="inv<?php echo $row['id']; ?>">
					<table style="font-family: Verdana,Arial,sans-serif;border-width:0px;width:auto;max-width:350px;padding-top:5px;" cellspacing="0">
						<?php
						$invRes = mysql_query("SELECT * FROM inventory WHERE charid='" . $row['id'] . "'") or die(mysql_error());

						$invRowBG = 0;
						while ($invRow = mysql_fetch_array($invRes)) {
							$invRowBG++;
							if (($invRowBG % 2) == 1) {
								$invRowColour = "#D1D1D1";
							} else {
								$invRowColour = "#E3E3E3";
							}
							?>
							<tr style="background-color:<?php echo $invRowColour; ?>;">
								<td style="padding-right:5px;"><span class="itemQty" style="vertical-align: top;"><?php echo $invRow['qty']; ?>x</span></td>
								<td style="padding-left:5px;">
									<span class="itemName"><?php echo $invRow['name']; ?></span>
								</td>
							</tr>
							<tr style="background-color:<?php echo $invRowColour; ?>;">
								<td style="padding-right:5px;"></td>
								<td style="padding-left:5px;">
									<span class="itemDesc"><?php echo $invRow['desc']; ?></span>
								</td>
							</tr>
		<?php
	}
	?>
					</table>
					</div>
					<script>
						$("#toggleInv<?php echo $row['id']; ?>").click(function() {
							if($(this).html() === "(hide)") {
								$(this).html("(show)");
								$("#inv<?php echo $row['id']; ?>").slideUp();
							} else {
								$(this).html("(hide)");
								$("#inv<?php echo $row['id']; ?>").slideDown();
							}
						});
					</script>
				</div>
				<br style="clear: both;" />
			</div>
	<?php
}
?>
	</div>
	<div id='sidebar'></div>
</div>
<div id='footer'></div>
</body>
</html>
