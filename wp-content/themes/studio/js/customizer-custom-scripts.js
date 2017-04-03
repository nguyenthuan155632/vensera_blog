
( function( api ) {
    wp.customize( 'reset_all_settings', function( setting ) {
        setting.bind( function( value ) {
            console.log('asdff');
            var code = 'needs_refresh';
            if ( value ) {
                setting.notifications.add( code, new wp.customize.Notification(
                    code,
                    {
                        type: 'info',
                        message: studio_data.reset_message
                    }
                ) );
            } else {
                setting.notifications.remove( code );
            }
        } );
    } );
} )( wp.customize );