$(document).ready(function () {
	var id = 0;
	function refreshChat() {
		$.ajax({
			dataType: "Json",
			url: "http://localhost/PROJET5PERSO/chat/update?id="+id,
			type: 'GET',
			success: function (data) {
				data.forEach(function(element) {
					id = element.id;
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
