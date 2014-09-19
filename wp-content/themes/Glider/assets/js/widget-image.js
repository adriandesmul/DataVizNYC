
var image_field;
jQuery(function($){
    $(document).on('click', 'input.select-img', function(evt){
        image_field = $(this).siblings('.img');

        var frame = wp.media( {
            title       : 'Widget Uploader',
            multiple    : false,
            library     : { type : 'image' },
            button      : { text : 'Select Image' }
        } );

        frame.on( 'close', function() {

            var media_attachment = frame.state().get('selection').first().toJSON();
            image_field.val(media_attachment.url);


        } );

        frame.open();
        return false;

    });

});