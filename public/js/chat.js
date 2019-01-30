$(document).ready(function () {
	function refreshChat() {
		$.ajax({
			url: "../views/front/chat.twig",
			type: 'GET',
			success: function (data) {
				let msg = JSON.parse(data);
				
				$('#chatWindow').append(msg.pseudo);
				$('#chatWindow').append(msg.message);
			}
		});
	}
	setInterval(refreshChat, 5000)
});
