var clignotement = function () {
    if (document.getElementById('flash').style.visibility == 'visible') {
       document.getElementById('flash').style.visibility = 'hidden';
    } else {
       document.getElementById('flash').style.visibility = 'visible';
    }
 };
 periode = setInterval(clignotement, 800);
 
 function preview_image(event) {
    var reader = new FileReader();
    reader.onload = function () {
       var output = document.getElementById('output_image');
       output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
 }