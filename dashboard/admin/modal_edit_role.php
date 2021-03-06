<?
    db_include (
        'get_member',
        'get_roles_by_member',
        'get_roles'
    );

    $roles     = get_roles();
    $all_roles = [];

    foreach( $roles as $role )
        $all_roles[$role['role']] = $role;

    $member_pk            = $_REQUEST[ 'member' ];
    $member               = get_member( $member_pk );
    $member_current_roles = get_roles_by_member( $member_pk );

    $member_name       = $member[ 'name' ];
    $member_roles_list = [ ROLE_MEMBER ];

    js_common_include();
    js_include(
        'validate_lib.js',
        'featherlight'
    );
?>
<script src="/dashboard/admin/js/modal_edit_role.js"></script>
<div class="modal">
    <h3>Edit role for <?= $member_name ?></h3>
    <div>
        <strong>Current Role(s):</strong>
        <br />
        <? if( count( $member_current_roles ) == 1 ): ?>
            None
            <br />
        <? else: ?>
            <?
                foreach( $member_current_roles as $current_role )
                {
                    $current_role_pk = $current_role[ 'role' ];

                    if( $current_role_pk > 1 )
                    {
                        array_push( $member_roles_list, $current_role_pk );
                        $current = $all_roles[ $current_role_pk ];
            ?>
                        <?= $current['name'] ?>
                        <br />
            <?
                    }
                }
            ?>
        <? endif; ?>
    </div>
    <hr>
    <div>
        <strong>Add/Remove Roles</strong>
        <form class="admin" method="post" id="edit_role_form" action="/">
            <fieldset class="no-style">
                <p>
                    <label class="nowidth" for="add_role">Add Role:</label>
                    <select id="add_role" name="add_role">
                        <option value="--">--</option>
                        <?
                            for( $i = 0, $lim = count( $roles ); $i < $lim; $i++ )
                            {
                                $current = $roles[$i];

                                if( $current['role'] == ROLE_MEMBER )
                                    continue;

                                if( !in_array( $i, $member_roles_list ) )
                                {
                        ?>
                                    <option value="<?= $current[ 'abbreviation' ] ?>"><?= $current[ 'name' ] ?></option>
                        <?
                                }
                            }
                        ?>
                    </select>
                </p>
                <p>
                    <label class="nowidth" for="remove_role">Remove Role:</label>
                    <select id="remove_role" name="remove_role">
                        <option value="--">--</option>
                        <?
                            foreach( $member_roles_list as $current_role_pk )
                            {
                                if( $current_role_pk != ROLE_MEMBER )
                                {
                                    $current = $all_roles[ $current_role_pk ];
                        ?>
                                    <option value="<?= $current[ 'abbreviation' ] ?>"><?= $current[ 'name' ]?></option>
                        <?
                                }
                            }
                        ?>
                    </select>
                </p>
                <input id="member_pk" type="text" value="<?= $member_pk ?>" style="display:none;"></input>
                <input type="submit" class="submit-button" id="submit-edit-roles"></input>
            </fieldset>
        </form>
    </div>
</div>
