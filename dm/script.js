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
			$("#editCharList").load("calls/charList.php");
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
		$("#addCharAction").click(function() {
			var dataD = {
				name: $("#name").val(),
				class: $("#class").val(),
				hp: $("#maxhp").val(),
				ac: $("#ac").val(),
				fort: $("#fort").val(),
				will: $("#will").val(),
				reflex: $("#reflex").val()
			};
			$("#addCharAction").attr("disabled", "disabled");
			$.post("calls/addChar.php", JSON.stringify(dataD), function(data, status) {
				alert(data);
				$("#addCharAction").removeAttr("disabled");
			});
		});
	}
};