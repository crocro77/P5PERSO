$(document).ready(function () {
	function refreshChat() {
		$.ajax({
			dataType: "Json",
			url: "http://localhost/PROJET5PERSO/chat/update",
			type: 'GET',
			success: function (data) {
				data.forEach(function(element) {
					let msg = 
					`<div>
						<p id="chatLine">
							<span id="chatPseudo">${element.pseudo}</span> <span id="chatMessage">${element.message}</span>
						</p>
					</div>`;
					$('#chatWindow').append(msg)
				})
			},
		});
	}
	setInterval(refreshChat, 5000)
});
