( function ( wp ) {
    wp.data.dispatch( 'core/notices' ).createNotice(
        'error', // Can be one of: success, info, warning, error.
        'Click Save Draft to continue working on this page.', // Text string to display.
        {
            isDismissible: false, // Whether the user can dismiss the notice.
            // Any actions the user can perform.
            actions: [
                {
                    url: '#',
                    label: 'View post',
                },
            ],
        }
    );
} )( window.wp );