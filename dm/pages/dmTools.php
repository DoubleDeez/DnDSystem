<?php
include("../../include/funcs.php");
include("../../include/vars.php");

mysql_connect("$host", "$user", "$pass") or die(mysql_error());
mysql_select_db("$db") or die(mysql_error());
?>

<div style="float:left;">
	<h3>Split EXP among all active characters:</h3>
	<label for="dmEXP">EXP Amount: </label>
	<input type="text" id="dmEXP" />
	<input type="button" id="dmEXPAction" value="Add EXP" />
</div>
<div style="float:left;padding-left:50px;">
	<h3>Reset Encounter Initiatives:</h3>
	<input type="button" id="dmInitAction" value="Reset Initiatives" />
</div>
<div style="float:left;padding-left:50px;">
	<h3>Set the owner of a character:</h3>
	<label for="dmOwner">Owner:</label>
	<select id="dmOwner">
		<?php
		$result = mysql_query("SELECT * FROM users") or die(mysql_error());

		while ($row = mysql_fetch_array($result)) {
			echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
		}
		?>
	</select>
	&nbsp;&HorizontalLine;&nbsp;
	<label for="dmChar">Character:</label>
	<select id="dmChar">
		<?php
		$charresult = mysql_query("SELECT * FROM characters") or die(mysql_error());

		while ($charrow = mysql_fetch_array($charresult)) {
			echo "<option value='" . $charrow['id'] . "'>" . $charrow['name'] . "</option>";
		}
		?>
	</select>
	<br/>
	<input type="button" id="dmOwnerAction" value="Set Owner" />
</div>
<br style="clear:both;"/>
<br/>
<div style="float:left;">
	<?php
	$setresult = mysql_query("SELECT * FROM settings") or die(mysql_error());
	$setRow = mysql_fetch_assoc($setresult);

	$timeSec = $setRow['time'];

	$hours = floor($timeSec / 3600);
	$timeSec -= 3600 * $hours;

	$mins = floor($timeSec / 60);
	$timeSec -= 60 * $mins;

	if ($mins < 10) {
		$mins = "0" . $mins;
	}

	$secs = $timeSec;

	if ($secs < 10) {
		$secs = "0" . $secs;
	}
	?>
	<label>Set time:</label>
	<input type="text" id="dmSetHour" size="1" value="<?php echo $hours; ?>"/>:
	<input type="text" id="dmSetMin"  size="1" value="<?php echo $mins; ?>"/>:
	<input type="text" id="dmSetSec"  size="1" value="<?php echo $secs; ?>"/>&nbsp;
	<input type="button" id="dmSetTime" value="Set" />
</div>
<div style="float:left;padding-left:50px;">
	<label>Add time:</label>
	<input type="text" id="dmAddHour" size="1" value="0"/>:
	<input type="text" id="dmAddMin"  size="1" value="0"/>:
	<input type="text" id="dmAddSec"  size="1" value="0"/>&nbsp;
	<input type="button" id="dmAddTime" value="Add" />
</div>
<br style="clear:both;"/>
<br/>
<div style="float:left;">
	<h3>Settings:</h3>
	<label for="dmInit">Show Initiative Bar: </label>
	<input type="checkbox" id="dmInit" <?php echo ($setRow['initiative'] == "1") ? "checked='checked'": "";?>/>
	<br/><br/>
	<input type="button" id="dmSettings" value="Apply" />
</div>
<br style="clear:both;"/>