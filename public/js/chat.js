$(document).ready(function () {
	function refreshChat() {
		$.ajax({
			url: "?p=updatechat",
			success: function (data) {
                let msg = JSON.parse(data);
				$('#chatWindow').append(msg.pseudo);
				$('#chatWindow').append(msg.message);
			}
		});
	}
	setInterval(refreshChat, 5000)
});
