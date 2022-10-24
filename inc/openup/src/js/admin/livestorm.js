jQuery( document ).ready( function( $ ) {
    $( document ).on( 'click', '.livestorm-data__update', function( e ) {
        const data = {};
        const admin_ajax = location.protocol + '//' + location.hostname + '/wp-admin/admin-ajax.php';
        data.action = 'openup_livestorm_data_update';

        $('body').addClass('loading');
        $.ajax({
            'method': 'POST',
            'url': admin_ajax,
            'data': data,
            'success': function (answer) {
                var result = JSON.parse(answer);
                $('body').removeClass('loading');
                console.log(result);
                if ( result.got_google_sheet && result.values ) {
                    $( '.livestorm-data__ajax' ).text( 'updated, ' + result.values + ' items downloaded' ).addClass( 'active' );
                    setTimeout( function() {
                        $( '.livestorm-data__ajax' ).removeClass( 'active' );
                    }, 5000 );
                }
            },
            'error': function () {
                $('body').removeClass('loading');
            }
        });
    } );

    $( document ).on( 'click', '.ls-admin__event__session', function( e ) {
        if ( ! $( e.target ).hasClass( 'selected-session-already' ) || $( e.target ).hasClass( 'can-be-reselected' ) ) {
            $('.ls-admin__event__session').removeClass('active');
            $('.ls-admin__event__session.selected-session-already.can-be-reselected').removeClass('selected-session-already').removeClass('can-be-reselected');
            $(e.target).addClass('active');
            $('.ls-admin__event').removeClass('active');
            $(e.target).parents('.ls-admin__event').addClass('active');
            console.log($(e.target).attr('data-room_link'));
            $('.openup_space_session').val($(e.target).attr('data-session_id'));
            $('.openup_space_room_link').val($(e.target).attr('data-room_link'));
            $('.openup_space_event').val($(e.target).parents('.ls-admin__event').attr('data-event_id'));
        }
    } );

    /*$( '#post' ).submit( function( e ) {
        alert( 'Stopping Form From Submitting.' );
        return false;
    } );*/
} );