<?php
include("../../include/funcs.php");
include("../../include/vars.php");

	mysql_connect("$host", "$user", "$pass") or die(mysql_error());
	mysql_select_db("$db") or die(mysql_error());
?>

<div style="float:left;">
	<h4>Split EXP among all active characters:</h4>
	<label for="dmEXP">EXP Amount: </label>
	<input type="text" id="dmEXP" />
	<br />
	<input type="button" id="dmEXPAction" value="Add EXP" />
</div>
<div style="float:left;padding-left:50px;">
	<h4>Reset Encounter Initiatives:</h4>
	<input type="button" id="dmInitAction" value="Reset Initiatives" />
</div>
<div style="float:left;padding-left:50px;">
	<h4>Set the owner of a character:</h4>
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