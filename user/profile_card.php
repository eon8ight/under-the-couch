<?
    db_include(
        'get_instruments_by_member',
        'get_music_genres_by_member'
    );

    $paid_dues_date     = $member_info['paid_dues_date'] ?: 'N/A';
    $paid_practice_date = $member_info['paid_practice_date'] ?: 'N/A';

    $paid_locker_date = $member_info['paid_locker_date'];
    $locker_end_date  = $member_info['locker_end_date'];
    $locker_number    = $member_info['locker_number'];

    $personal_website               = $member_info['personal_website'];
    $is_available_for_collaboration = $member_info['is_available_for_collaboration'];
    $biography                      = $member_info['biography'];

    $instruments = get_instruments_by_member( $member_pk );
    $genres      = get_music_genres_by_member( $member_pk );
?>
<? if( $is_owner || SessionLib::get( 'user_member.is_admin' ) ): ?>
    <div id="payment_dates">
        <p>
            <span>Paid Dues:</span> <span><?= $paid_dues_date ?></span>
            <br />
            <span>Paid Practice Fees:</span> <span><?= $paid_practice_date ?></span>
            <br />
            <? if( $paid_locker_date ): ?>
                <br />
                Paid Locker Fee: <?= $paid_locker_date ?>
                <br />
                Paid Through: <?= $locker_end_date ?>
                <br />
                Locker Number: <?= $locker_number ?>
            <? else: ?>
                Paid Locker Fee: N/A
            <? endif; ?>
        </p>
    </div>
<? endif; ?>
<h2>About Me</h2>
<p>
    <? if( $personal_website ): ?>
        Personal Website: <a href="<?= $personal_website ?>"><?= $personal_website ?></a>
    <? endif; ?>
</p>
<p>
    <? if( count( $instruments ) > 0 ): ?>
        Instruments:
        <ul>
            <? foreach( $instruments as $instrument ): ?>
                <li>
                    <?= $instrument['name'] ?>
                    <? if( $instrument['can_teach'] ): ?>
                        (Can Teach)
                    <? endif; ?>
                </li>
            <? endforeach; ?>
        </ul>
    <? endif; ?>
</p>
<p>
    <? if( count( $genres ) > 0 ): ?>
        Favorite Genres:
        <ul>
            <? foreach( $genres as $genre ): ?>
                <li><?= $genre['name'] ?></li>
            <? endforeach; ?>
        </ul>
    <? endif; ?>
</p>
<? if( $is_available_for_collaboration ): ?>
    <p>Available for collaboration</p>
<? else: ?>
    <p>Not available for collaboration</p>
<? endif; ?>
<? if( $biography ): ?>
<p>
    <h3>Personal Biography</h3>
    <div id='additional-personal-info'>
        <?= $biography ?>
    </div>
</p>
<? endif; ?>
