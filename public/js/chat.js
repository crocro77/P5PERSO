$(document).ready(function () {


	function refreshChat() {
		$.ajax({
			url: "views/front/chat.php",
			success: function (data) {
				$('#chatWindow').html(data);
			}
		});

	}

	setInterval(refreshChat(), 1000)
});

// var auto_refresh = setInterval(
// 	function ()
// 	{
// 	$('#chatWindow').load('views/front/chat.php').fadeIn("slow");
// 	}, 1000);
	 
// 	 return auto_refresh
