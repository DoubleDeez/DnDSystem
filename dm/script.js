var dnd = {
	init: function() {
		$("#addChar").hide();
		$("#editChar").hide();
		$("#manageEnemies").hide();
		$("#infoBtn").click(function() {
			$("#info").show();
			$("#addChar").hide();
			$("#editChar").hide();
			$("#manageEnemies").hide();
		});
		$("#addCharBtn").click(function() {
			$("#info").hide();
			$("#addChar").show();
			$("#editChar").hide();
			$("#manageEnemies").hide();
		});
		$("#editCharBtn").click(function() {
			$("#info").hide();
			$("#addChar").hide();
			$("#editChar").show();
			$("#manageEnemies").hide();
		});
		$("#manageEnemiesBtn").click(function() {
			$("#info").hide();
			$("#addChar").hide();
			$("#editChar").hide();
			$("#manageEnemies").show();
		});
		$("#logoutBtn").click(function() {
			window.location.replace("logout.php");
		});
	}
};