jQuery(document).ready(function($) {
  $(document).on("click", ".pm_upload_image_button", function (e) {
     e.preventDefault();
     var button = $(this);
     var img = button.parent().prev().find('img');
     var input = button.parent().prev().prev().find('input');
     var input_alt = button.parent().prev().prev().prev().find('input');

     // Create the media frame.
     var file_frame = wp.media.frames.file_frame = wp.media({
        title: 'Select or upload image',
        library: { // remove these to show all
           type: 'image' // specific mime
        },
        button: {
           text: 'Select'
        },
        multiple: false  // Set to true to allow multiple files to be selected
     });

     // When an image is selected, run a callback.
     file_frame.on('select', function () {
        // We set multiple to false so only get one image from the uploader

        var attachment = file_frame.state().get('selection').first().toJSON();
        input.val(attachment.url);
        input_alt.val(attachment.alt);
        img.attr('src',attachment.url).css('display','block');

     });
     // Finally, open the modal
     file_frame.open();
  });

  $(document).on("click", ".pm_remove_image_button", function (e) {
    e.preventDefault();
    $path = object_name.templateUrl + '/dist/images/placeholder.jpg';
    var button = $(this);
    var img = button.parent().prev().find('img');
    var input = button.parent().prev().prev().find('input');
    var input_alt = button.parent().prev().prev().prev().find('input');
    input.val('');
    input_alt.val('');
    img.attr('src', $path);
  });

  $(document).on("click", ".pm_remove_signature_button", function (e) {
    e.preventDefault();
    $path = object_name.templateUrl + '/dist/images/signature-placeholder.png';
    var button = $(this);
    var img = button.parent().prev().find('img');
    var input = button.parent().prev().prev().find('input');
    var input_alt = button.parent().prev().prev().prev().find('input');
    input.val('');
    input_alt.val('');
    img.attr('src', $path);
  });
});
