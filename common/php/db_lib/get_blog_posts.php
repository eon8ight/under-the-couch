<?
    /*
     * Gets an array of blog posts from the database.
     * A blog post is represented as a hash with the following fields:
     *   blog_post       : integer - the PK of the blog post.
     *   title           : string  - the title of the blog post.
     *   body            : string  - the body of the blog post.
     *   created         : string  - the blog post's creation time.
     *   author          : string  - the first and last name of the blog post's author.
     *   position        : string  - the officer position of the blog post's author.
     *   editor          : string  - the first and last name of the last person to edit
     *                               the blog post, or NULL if it was never edited.
     *   edited          : string  - the blog post's edit time, or NULL if it was never edited.
     *   editor_position : string  - the officer position of the blog post's last editor,
     *                               or NULL if it was never edited.
     *
     * Params:
     *   $max_num_posts : integer - the maximum number of blog posts to return.
     *   $offset        : integer - the number of blog posts to skip before the first
     *                              blog post in the array (default 0).
     * Returns:
     *   <<an array of blog posts hashes>> if retrieval was successful;
     *   <<false>> otherwise.
     */
    function get_blog_posts( $max_num_posts, $offset=0 )
    {
        $body_posts_query = <<<SQL
                 select bp.blog_post,
                        bp.title,
                        bp.body,
                        to_char( bp.created, 'Day, Month DD, YYYY HH:MI:SS AM' ) as created,
                        m.first_name || ' ' || m.last_name as author,
                        p.name as position,
                        case when bp.editor is not null
                             then e.first_name || ' ' || e.last_name
                             else null
                        end as editor,
                        case when bp.editor is not null
                            then to_char( bp.edited, 'Day, Month DD, YYYY HH:MI:SS AM' )
                            else null
                        end as edited,
                        case when bp.editor is not null
                            then pe.name
                            else null
                        end as editor_position
                  from tb_blog_post bp
                  join tb_member m
                    on bp.author = m.member
                  join tb_officer o
                    on o.member = m.member
                  join tb_position p
                    on o.position = p.position
             left join tb_member e
                    on bp.editor = e.member
             left join tb_officer oe
                    on oe.member = e.member
             left join tb_position pe
                    on oe.position = pe.position
              order by bp.blog_post desc
                 limit ?limit?
                offset ?offset?
SQL;

        $params = [
            'limit'  => $max_num_posts,
            'offset' => $offset
        ];

        $result = query_prepare_select( $body_posts_query, $params );
        return is_resource( $result ) ? query_fetch_all( $result ) : false;
    }
?>
