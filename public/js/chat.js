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
						<p class="chatLine">
							<span class="chatPseudo">${element.pseudo}</span> <span class="chatMessage">${element.message}</span>
						</p>
					</div>`;
					$('#chatWindow').append(msg)
				})
			},
		});
	}
	setInterval(refreshChat, 5000)
});


// success: function (data) {
//     id = data.last;
//     data.messages.forEach(function(element) {      
//         let msg =
//         `<div>
//             <p class="chatLine">
//                 <span class="chatPseudo">${element.pseudo}</span> <span class="chatMessage">${element.message}</span>
//             </p>
//         </div>`;
//         $('#chatWindow').append(msg)
//     })
// },