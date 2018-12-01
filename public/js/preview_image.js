function preview_cover_image(event) {
    var reader = new FileReader();
    reader.onload = function () {
       var output = document.getElementById('output_cover_image');
       output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
 }

 function preview_screenshot_image(event) {
   var reader = new FileReader();
   reader.onload = function () {
      var output = document.getElementById('output_screenshot_image');
      output.src = reader.result;
   }
   reader.readAsDataURL(event.target.files[0]);
}