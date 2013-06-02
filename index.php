<?php
error_reporting(E_ALL);
include("include/vars.php");
include("include/funcs.php");

mysql_connect("$host", "$user", "$pass") or die(mysql_error());
mysql_select_db("$db") or die(mysql_error());

$charRes = mysql_query("SELECT * FROM characters") or die(mysql_error());
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
        <title>DnD Manager System</title>
    </head>
    <body>
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
							<span class="charHP" style="color: <?php echo $hpcolour; ?>;"><?php echo $hp . "/" . $maxhp; ?></span>
						</div>
						<br style="clear: both;" />
						<div style="float: left;" />
							<br />
							<span class="statHeading">Defenses:</span><br />
							<table style="font-family: Verdana,Arial,sans-serif;border:0px;max-width:250px;">
								<tr>
									<th>AC</th>
									<th>Fortitude</th>
									<th>Reflex</th>
									<th>Will</th>
								</tr>
								<tr>
									<td><?php echo $row['ac'] ?></td>
									<td><?php echo $row['fortitude'] ?></td>
									<td><?php echo $row['reflex'] ?></td>
									<td><?php echo $row['will'] ?></td>
								</tr>
							</table>
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
