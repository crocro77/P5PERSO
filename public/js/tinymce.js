tinymce.init({
	selector: 'textarea',
	height: 500,
	menubar: false,
    plugins: [
        'advlist autolink lists charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media save table contextmenu paste code'
    ],
    toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
    content_css: '//www.tinymce.com/css/codepen.min.css'
    });