/**
 * Created by ALVARO on 6/10/2018.
 */

/**
 * Image Preview
 * @param input
 */
function imagePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#image_preview').attr('src', e.target.result).show();
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$( function() {
    $( ".datepicker" ).datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true
    });
} );


