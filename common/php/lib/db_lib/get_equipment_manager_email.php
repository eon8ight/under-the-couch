<?
    /*
     * Gets the equipment manager's email address from the database.
     *
     * Params:
     *   None.
     * Returns:
     *   The equipment manager's email address.
     */
    function get_equipment_manager_email()
    {
        $email_query = <<<SQL
            select m.display_email_address
              from tb_member m
              join tb_member_role mr
                on m.member = mr.member
              join tb_role r
                on mr.role = r.role
             where r.role = ?role?
SQL;

        $params = [ 'role' => ROLE_EQUIPMENT_MANAGER ];
        $result = query_prepare_select( $email_query, $params );

        if( is_resource( $result ) )
        {
            $row = query_fetch_one( $result );
            return $row['display_email_address'];
        }
        else
            return false;
    }
?>