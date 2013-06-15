<?php
include("../../include/funcs.php");
?>

<label for="name">Name: </label>
<input type="text" id="name" />
<br />
<label for="class">Race & Class: </label>
<input type="text" id="class" />
<br />
<label for="maxhp">Max Health Points: </label>
<input type="text" id="maxhp" />
<br />
<label for="ac">AC: </label>
<input type="text" id="ac" />
<br />
<label for="fort">Fortitude: </label>
<input type="text" id="fort" />
<br />
<label for="reflex">Reflex: </label>
<input type="text" id="reflex" />
<br />
<label for="will">Will: </label>
<input type="text" id="will" />
<br />
<?php if (clean($_GET['r']) >= 10) { ?>
	<label for="userid">User ID: </label>
	<input type="text" id="userid" />
	<br />
<?php } else { ?>
	<input type="hidden" id="userid" value="<?php echo clean($_GET['id']); ?>" />
<?php } ?>
<input type="button" id="addCharAction" value="Create Character" />