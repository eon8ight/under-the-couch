var pagination_controls_name = '#pagination_controls';
var pagination_class_name    = 'paginationjs';

function pagination_init( pagination_class, limit, callback )
{
    var pagination_controls = $( pagination_controls_name );
    var data_source         = '/common/php/ajax/paginator/classes/' + pagination_class + '.php'
    var total_number        = __pagination_get_total( data_source );

    pagination_controls.pagination( {
        'dataSource'  : data_source,
        'locator'     : 'data',
        'totalNumber' : total_number,
        'pageSize'    : limit,
        'callback'    : callback,
        'className'   : pagination_class_name
    });
}

function __pagination_get_total( data_source )
{
    var total_count = 0;
    var data        = { '_total' : true };

    $.ajax( {
        'type'     : 'GET',
        'url'      : data_source,
        'data'     : data,
        'dataType' : 'json',
        'async'    : false,
    })
    .done( function( response, textStatus, jqXHR ) {
        if( response['success'] )
            total_count = response['total'];
        else
            js_error( 'Failed to load pagination.', PAGINATION_FAILURE );
    })
    .fail( js_generic_error );

    return total_count;
}
