jQuery(document).ready(function($) {
                $('#banner_image_display').click(function(event) {
                    var thisImage = $(this);

                    var fileFrame = wp.media.frames.fileFrame = wp.media({
                        title: 'Select image',
                        library: {type: 'image'},
                        button: {text: 'Select'},   
                        multiple: false
                    });

                    var thisImageID = $('#banner_image_value').val();

                    if( thisImageID ) {
                        fileFrame.on('open', function() {
                            var selection = fileFrame.state().get('selection');
                            var attachment = wp.media.attachment( thisImageID );
                            attachment.fetch();
                            selection.add( attachment ? [ attachment ] : [] );
                        });
                    }

                    fileFrame.on( 'select', function() {
                        attachment = fileFrame.state().get('selection').first().toJSON();

                        $.ajax({
                            url: ajaxurl,
                            data: {
                                action: 'get_attachment_src',
                                attachment: attachment.id,
                                size: 'full'
                            },
                            success: function(response) {
                                if(response) {
                                    $(thisImage).attr('src', response);
                                    $('#banner_image_value').val( attachment.id );
                                }
                            }
                        });
                    });

                    fileFrame.open();
                });
            });