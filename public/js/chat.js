$(document).ready(function () {
	function refreshChat() {
		$.ajax({
			dataType: "Json",
			url: "../views/front/chat.twig",
			data: data,
			type: 'GET',
			success: function (data) {
				var array1 = ['pseudo', 'message'];
				array1.forEach(function(data) {
					let msg = JSON.parse(data);
				},
				$('#chatWindow').append(msg.pseudo),
				$('#chatWindow').append(msg.message),
			}
		});
	}
	setInterval(refreshChat, 5000)
});
