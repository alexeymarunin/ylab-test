function onChangeTaskStatus( task_id ) {
    var el = $( '#task-' + task_id + '-status' );
    var status_id = el.val();

    el.attr( 'disabled', 'disabled' );
    $.ajax( {
        url: '/task/change-status?id=' + task_id,
        type: 'post',
        data: {
            'status_id': status_id
        }
    } )
        .done( function ( response ) {
            el.val( response.status_id );
        } )
        .fail( function ( response ) {
        } )
        .always( function() {
            el.removeAttr( 'disabled' );
        })
}