$(document).ready(function () {
	function refreshChat() {
		$.ajax({
			url: "?p=updatechat",
			success: function (data) {
                let msg = JSON.parse(data);
                $('#chatWindow').append(msg.tomate);
				// console.log($('#chatLine'));
			}
		});
	}
	setInterval(refreshChat, 3000)
});
