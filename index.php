<?php
error_reporting(E_ALL);
include("include/vars.php");
include("include/funcs.php");

mysql_connect("$host", "$user", "$pass") or die(mysql_error());
mysql_select_db("$db") or die(mysql_error());


?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
        <title>D&D Live Stats</title>
    </head>
    <body onload='setTimeout("location.reload(true);", 60000);'>
		<div id='menu'>
			<div style="display: inline-block;width:10%;">
				<a id="collAll" class="linkBtn">Collapse All</a>
			</div>
			<div style="display: inline-block;width:70%;">
			<?php 
				$menuRes = mysql_query("SELECT * FROM characters WHERE disable='0'") or die(mysql_error());
				$menuCount = 0;
				while ($mrow = mysql_fetch_array($menuRes)) {
					$mhp = $mrow['hp'];
					$mmaxhp = $mrow['maxhp'];
					$mhpcolour = "#006400";
					if ($mhp <= 0) {
						$mhpcolour = "#FF0000";
					} else if ($mhp <= ($mmaxhp / 2)) {
						$mhpcolour = "#FFA500";
					}
			?>
				<a href="#<?php echo $menuCount; ?>" class="linkBtn" style="font-size:14px;"><?php echo $mrow['name']; ?></a>
				<span style="color:<?php echo $mhpcolour; ?>;font-weight:bold;font-size:14px;"> (<?php echo $mhp . "/" . $mmaxhp; echo ($mrow['temphp'] == 0) ? "" : " + ".$mrow['temphp']; ?>)</span>
			<?php $menuCount++;} ?>
			</div>
			<div style="display: inline-block;width:10%;">
				<a href="#top" class="linkBtn">Top of Page</a>
			</div>
			<br style="clear:both;" />
		</div>
		<a name="top" />
		<div id='main'>
			<div id='content'>
				<div class="charInfo">
					<span class="statHeading">Encounter Order:</span><br /><br />
				<?php
					$initRes = mysql_query("SELECT * FROM (SELECT initroll, name, type FROM enemies WHERE disable='0' AND hide='0' AND initroll!='0' UNION ALL SELECT initroll, name, type FROM characters WHERE disable='0' AND initroll!='0') AS `result` ORDER BY `result`.`initroll` DESC") or die(mysql_error());
					
					while ($initrow = mysql_fetch_array($initRes)) {
						if($initrow['type'] != "") {
							echo "&bull; <span style='color:#660000;font-weight:bold;'>".$initrow['name']." ".$initrow['type']."</span>";
						} else {
							echo "&bull; <span style='color:#024435;font-weight:bold;'>".$initrow['name']."</span>";
						}
				?>
				<?php
				}
				?>
				
				</div>
				<?php
					$enRes = mysql_query("SELECT * FROM enemies WHERE disable='0' AND hide='0'") or die(mysql_error());
					$enNum = 0;
					while ($enrow = mysql_fetch_array($enRes)) {
						$enFloat = (($enNum % 2) == 0 ? "left" : "right");
						$hpcolour = "#006400";
						$enhp = $enrow['hp'];
						$enmaxhp = $enrow['maxhp'];
						
						if($enrow['mask'] == 1) {
							$enHPmsg = "Health Masked";
						} else {
							$enHPmsg = ($enmaxhp - $enhp) . " damage taken";
						}
						
						if ($enhp <= 0) {
							$hpcolour = "#FF0000";
							$enHPmsg = "Slain";
						} else if ($enhp <= ($enmaxhp / 2)) {
							$hpcolour = "#FFA500";
						}
				?>
				<div class="charInfo" style='width:45%;float:<?php echo $enFloat;?>'>
					<div style='float: left;'>
						<span class='enName'><?php echo $enrow['name'] . ": " . $enrow['type']; ?></span>
					</div>
					<div style='float: right;'>
						<span class='charHP' style="color: <?php echo $hpcolour; ?>;"><?php echo $enHPmsg; ?></span>
					</div>
					<br style='clear: both;' />
				</div>
				<?php
					if((($enNum % 2) == 1) || (($enNum + 1) == mysql_num_rows($enRes))) {
						echo "<br style='clear: both;' />";
					}
					
					$enNum++;
				}
				?>
				<a name="0" />
				<?php
				$charRes = mysql_query("SELECT * FROM characters WHERE disable='0'") or die(mysql_error());
				$charCount = 1;
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
							<span class="charName"><?php echo $row['name']; ?></span>&nbsp;<a class="linkBtn toggleChar" id="toggleChar<?php echo $row['id']; ?>">(collapse)</a>
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
						<div class="charBox" id="char<?php echo $row['id']; ?>">
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
						<span class="statHeading">Healing Surges:</span><br />
						<table style="font-family: Verdana,Arial,sans-serif;border:0px;width:300px;padding-top:5px;">
							<tr>
								<th style="font-size:14px;width:25%;">Value</th>
								<th style="font-size:14px;width:25%;">Daily</th>
								<th style="font-size:14px;width:25%;">Left</th>
								<th style="font-size:14px;width:25%;">2nd Wind</th>
							</tr>
							<tr>
								<td><?php echo $row['hsval']; ?></td>
								<td><?php echo $row['hsdaily']; ?></td>
								<td><?php echo $row['hsleft']; ?></td>
								<td><?php echo ($row['hswind'] == 1) ? "Available" : "Used"; ?></td>
							</tr>
						</table>
						<br />
						<br />
						<span class="statHeading">Ability Scores:</span><br />
						<table style="font-family: Verdana,Arial,sans-serif;border:0px;width:300px;padding-top:5px;">
							<tr>
								<th style="font-size:14px;width:20%;">Str:</th>
								<td style="font-size:13px;width:15%;"><?php echo $row['str']; ?></td>
								<td style="font-size:13px;width:15%;"><?php echo ($row['strMod'] >= 0) ? "+" : ""; echo $row['strMod']; ?></td>
								<th style="font-size:14px;width:20%;">Con:</th>
								<td style="font-size:13px;width:15%;"><?php echo $row['con']; ?></td>
								<td style="font-size:13px;width:15%;"><?php echo ($row['conMod'] >= 0) ? "+" : ""; echo $row['conMod']; ?></td>
							</tr>
							<tr>
								<th style="font-size:14px;width:20%;">Dex:</th>
								<td style="font-size:13px;width:15%;"><?php echo $row['dex']; ?></td>
								<td style="font-size:13px;width:15%;"><?php echo ($row['dexMod'] >= 0) ? "+" : ""; echo $row['dexMod']; ?></td>
								<th style="font-size:14px;width:20%;">Int:</th>
								<td style="font-size:13px;width:15%;"><?php echo $row['int']; ?></td>
								<td style="font-size:13px;width:15%;"><?php echo ($row['intMod'] >= 0) ? "+" : ""; echo $row['intMod']; ?></td>
							</tr>
							<tr>
								<th style="font-size:14px;width:20%;">Wis:</th>
								<td style="font-size:13px;width:15%;"><?php echo $row['wis']; ?></td>
								<td style="font-size:13px;width:15%;"><?php echo ($row['wisMod'] >= 0) ? "+" : ""; echo $row['wisMod']; ?></td>
								<th style="font-size:14px;width:20%;">Cha:</th>
								<td style="font-size:13px;width:15%;"><?php echo $row['cha']; ?></td>
								<td style="font-size:13px;width:15%;"><?php echo ($row['chaMod'] >= 0) ? "+" : ""; echo $row['chaMod']; ?></td>
							</tr>
						</table>
					</div>
					<div style="float: left;padding-left:25px;">
					<br />
					<span class="statHeading">Inventory: </span><a class="linkBtn" id="toggleInv<?php echo $row['id']; ?>">(hide)</a><br />
					<div id="inv<?php echo $row['id']; ?>">
					<table style="font-family: Verdana,Arial,sans-serif;border-width:0px;width:auto;width:350px;padding-top:5px;" cellspacing="0">
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
					<div style="float: left;padding-left:30px;">
					<br />
					<span class="statHeading">Skills: </span><a class="linkBtn" id="toggleSkill<?php echo $row['id']; ?>">(hide)</a><br />
					<div id="skl<?php echo $row['id']; ?>">
					<table style="font-family: Verdana,Arial,sans-serif;border-width:0px;width:auto;width:300px;padding-top:5px;" cellspacing="0">
						<tr style="background-color:#D1D1D1;">
							<th style="font-size:14px;width:75%;">Acrobatics (Dex)</th>
							<td style="font-size:13px;width:25%;"><?php echo ($row['acr'] >= 0) ? "+" : ""; echo $row['acr']; ?></td>
						</tr>
						<tr style="background-color:#E3E3E3;">
							<th style="font-size:14px;width:75%;">Arcana (Int)</th>
							<td style="font-size:13px;width:25%;"><?php echo ($row['arc'] >= 0) ? "+" : ""; echo $row['arc']; ?></td>
						</tr>
						<tr style="background-color:#D1D1D1;">
							<th style="font-size:14px;width:75%;">Athletics (Str)</th>
							<td style="font-size:13px;width:25%;"><?php echo ($row['ath'] >= 0) ? "+" : ""; echo $row['ath']; ?></td>
						</tr>
						<tr style="background-color:#E3E3E3;">
							<th style="font-size:14px;width:75%;">Bluff (Cha)</th>
							<td style="font-size:13px;width:25%;"><?php echo ($row['blu'] >= 0) ? "+" : ""; echo $row['blu']; ?></td>
						</tr>
						<tr style="background-color:#D1D1D1;">
							<th style="font-size:14px;width:75%;">Diplomacy (Cha)</th>
							<td style="font-size:13px;width:25%;"><?php echo ($row['dip'] >= 0) ? "+" : ""; echo $row['dip']; ?></td>
						</tr>
						<tr style="background-color:#E3E3E3;">
							<th style="font-size:14px;width:75%;">Dungeoneering (Wis)</th>
							<td style="font-size:13px;width:25%;"><?php echo ($row['dun'] >= 0) ? "+" : ""; echo $row['dun']; ?></td>
						</tr>
						<tr style="background-color:#D1D1D1;">
							<th style="font-size:14px;width:75%;">Endurance (Con)</th>
							<td style="font-size:13px;width:25%;"><?php echo ($row['end'] >= 0) ? "+" : ""; echo $row['end']; ?></td>
						</tr>
						<tr style="background-color:#E3E3E3;">
							<th style="font-size:14px;width:75%;">Heal (Wis)</th>
							<td style="font-size:13px;width:25%;"><?php echo ($row['hea'] >= 0) ? "+" : ""; echo $row['hea']; ?></td>
						</tr>
						<tr style="background-color:#D1D1D1;">
							<th style="font-size:14px;width:75%;">History (Int)</th>
							<td style="font-size:13px;width:25%;"><?php echo ($row['his'] >= 0) ? "+" : ""; echo $row['his']; ?></td>
						</tr>
						<tr style="background-color:#E3E3E3;">
							<th style="font-size:14px;width:75%;">Insight (Wis)</th>
							<td style="font-size:13px;width:25%;"><?php echo ($row['ins'] >= 0) ? "+" : ""; echo $row['ins']; ?></td>
						</tr>
						<tr style="background-color:#D1D1D1;">
							<th style="font-size:14px;width:75%;">Intimidate (Cha)</th>
							<td style="font-size:13px;width:25%;"><?php echo ($row['itd'] >= 0) ? "+" : ""; echo $row['itd']; ?></td>
						</tr>
						<tr style="background-color:#E3E3E3;">
							<th style="font-size:14px;width:75%;">Nature (Wis)</th>
							<td style="font-size:13px;width:25%;"><?php echo ($row['nat'] >= 0) ? "+" : ""; echo $row['nat']; ?></td>
						</tr>
						<tr style="background-color:#D1D1D1;">
							<th style="font-size:14px;width:75%;">Perception (Wis)</th>
							<td style="font-size:13px;width:25%;"><?php echo ($row['per'] >= 0) ? "+" : ""; echo $row['per']; ?></td>
						</tr>
						<tr style="background-color:#E3E3E3;">
							<th style="font-size:14px;width:75%;">Religion (Int)</th>
							<td style="font-size:13px;width:25%;"><?php echo ($row['rel'] >= 0) ? "+" : ""; echo $row['rel']; ?></td>
						</tr>
						<tr style="background-color:#D1D1D1;">
							<th style="font-size:14px;width:75%;">Stealth (Dex)</th>
							<td style="font-size:13px;width:25%;"><?php echo ($row['ste'] >= 0) ? "+" : ""; echo $row['ste']; ?></td>
						</tr>
						<tr style="background-color:#E3E3E3;">
							<th style="font-size:14px;width:75%;">Streetwise (Cha)</th>
							<td style="font-size:13px;width:25%;"><?php echo ($row['stw'] >= 0) ? "+" : ""; echo $row['stw']; ?></td>
						</tr>
						<tr style="background-color:#D1D1D1;">
							<th style="font-size:14px;width:75%;">Thievery (Dex)</th>
							<td style="font-size:13px;width:25%;"><?php echo ($row['thi'] >= 0) ? "+" : ""; echo $row['thi']; ?></td>
						</tr>
					</table>
					</div>
					<script>
						$("#toggleSkill<?php echo $row['id']; ?>").click(function() {
							if($(this).html() === "(hide)") {
								$(this).html("(show)");
								$("#skl<?php echo $row['id']; ?>").slideUp();
							} else {
								$(this).html("(hide)");
								$("#skl<?php echo $row['id']; ?>").slideDown();
							}
						});
					</script>
				</div>
				<br style="clear: both;" />	
			<a name="<?php echo $charCount; ?>" />
			</div>
					<script>
						$("#toggleChar<?php echo $row['id']; ?>").click(function() {
							if($(this).html() === "(collapse)") {
								$(this).html("(open)");
								$("#char<?php echo $row['id']; ?>").slideUp();
							} else {
								$(this).html("(collapse)");
								$("#char<?php echo $row['id']; ?>").slideDown();
							}
						});
					</script>
				</div><?php
			$charCount++;
}
?>

	</div>
	<div id='sidebar'></div>
</div>
<div id='footer'></div>
<script>
	$("#collAll").click(function() {
		if($(this).html() === "Collapse All") {
			$(this).html("Open All");
			$(".toggleChar").html("(open)");
			$(".charBox").slideUp();
		} else {
			$(this).html("Collapse All");
			$(".toggleChar").html("(collapse)");
			$(".charBox").slideDown();
		}
	});
</script>
</body>
</html>
