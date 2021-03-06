<?
    /*
     * Deletes a blog post from the database.
     *
     * Params:
     *   $blog_post : integer - the PK of the blog post to delete.
     * Returns:
     *   <<true>> if deletion was successful;
     *   <<false>> otherwise.
     */
    function delete_blog_post( $blog_post )
    {
        $delete_blog_post_query = <<<SQL
delete from tb_blog_post
      where blog_post = ?blog_post?
SQL;

        $params = [ 'blog_post' => $blog_post ];
        $delete = query_execute( $delete_blog_post_query, $params );

        return query_success( $delete );
    }
?>
