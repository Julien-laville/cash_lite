jQuery(document).ready(function() {
	initFileUpload()
})

function initFileUpload() {
	jQuery('#img_upload').fileupload({
        url: "send_picture.php",
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files');
            });
        }
    })
}