<?php
include("../include/vars.php");
include("../include/funcs.php");

mysql_connect("$host", "$user", "$pass") or die(mysql_error());
mysql_select_db("$db") or die(mysql_error());

session_start();

if (isset($_SESSION['sid']) && isset($_SESSION['id'])) {
	$id = ($_SESSION['sid']);
	$query = "SELECT * FROM users WHERE id='$id'";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_array($result);

	if (isset($row['token']) && $row['token'] == $_SESSION['sid']) {
		header("Location: http://www.doubledeez.ca/dnd/dm/");
		exit();
	}
}
?>
<!DOCTYPE html">
<html>
	<head>
		<?php
		session_destroy();

		if (isset($_POST['submit'])) {
			$error = "";

			$user = clean($_POST['user']);
			$pass = clean($_POST['pass']);

			if (!isset($user) || !isset($pass) || ($user == "") || ($pass == "") || ($user == "Username")) {
				$error = "Please enter your username and password.";
			} else {

				$query = "SELECT * FROM users WHERE name='$user'";
				$result = mysql_query($query) or die(mysql_error());
				$row = mysql_fetch_array($result);

				if ($row['rank'] <= 9) {
					$error = "You do not have access to the DM Panel.";
				} else {
					$ipass = sha1($row['salt'] . $pass);
					$opass = $row['pass'];

					if ($ipass != $opass) {
						$error = "The password you entered is incorrect.";
					} else {
						session_start();

						$id = $row['id'];
						$_SESSION['id'] = $id;
						$_SESSION['sn'] = $row['name'];
						$sid = $_SESSION['sid'] = session_id();
						$_SESSION['rank'] = $row['rank'];

						mysql_query("UPDATE users SET token='$sid' WHERE id='$id'") or die(mysql_error());
						sleep(2);
						echo '<META HTTP-EQUIV="Refresh" Content="0; URL=http://www.doubledeez.ca/dnd/dm/">';
					}
				}
			}
		}
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>DnD Manager - Log In</title>
	</head>

	<body>
	<center>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<div id="loginbox">
						<span id="logintitle">Log In</span>
						<form action="login.php" method="post" name="login" target="_self">
							<input class="inputlog" name="user" type="text" value="Username" size="30" maxlength="15" onblur="if (this.value == '') {
										this.value = 'Username';
									}"  onfocus="if (this.value == 'Username') {
										this.value = '';
									}" />&nbsp;&nbsp;&nbsp;&nbsp;
							<input class="inputlog" name="pass" type="password" value="Password" size="30" maxlength="30" onblur="if (this.value == '') {
										this.value = 'Password';
									}"  onfocus="if (this.value == 'Password') {
										this.value = '';
									}" />&nbsp;&nbsp;&nbsp;&nbsp;
							<input class="submitlog" name="submit" type="submit" value="Log In" />
						</form>
						<br />
						<span id="error">&nbsp;<?php echo $error; ?></span>
					</div>
					<br />
					<div id="loginfooter">
						<span id="footcopy">Dylan Dumesnil 2013&copy;</span>
					</div>
				</td>
			</tr>
		</table>
	</center>
</body>
</html>