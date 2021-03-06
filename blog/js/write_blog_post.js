$( document ).ready( initialize );

function initialize()
{
    $( '#create_blog_post_form' ).submit( validate_blog_post );

    $( '#title' ).change( reset_validation );
    $( '#body' ).change( reset_validation );
}

function validate_blog_post( event )
{
    event.preventDefault();

    var title = $( '#title' );
    var body  = $( '#body' );

    if( !title.val() )
    {
        validate_error( title, 'Title is required.' );
        return;
    }

    if( !body.val() )
    {
        validate_error( body, 'Body is required.' );
        return;
    }

    var send_to_mailing_list = $( '#send_email:checked' ).val() === 'on';

    var form_data = {
        'title'                : title.val(),
        'body'                 : body.val(),
        'send_to_mailing_list' : send_to_mailing_list
    };

    create_blog_post( form_data );
}

function create_blog_post( data )
{
    var url = '/common/php/ajax/create_blog_post.php';

    $.post( url, data, function( response, textStatus, jqXHR ) {
        if( response['blog_post_success'] )
        {
            var created_blog_post = response['blog_post'];

            if( data['send_to_mailing_list'] && !response['sent_email_success'] )
            {
                js_error(
                    'Blog post successful, but email was not sent - please contact support.',
                    BLOG_POST_EMAIL_SEND_FAILURE
                );
            }

            window.location = '/blog/blog_post.php?id=' + created_blog_post;
        }
        else
            js_error( 'Blog post unsuccessful.', BLOG_POST_SUBMIT_FAILURE );
    }, 'json' )
    .fail( js_generic_error );
}
