<?
    db_include( 'access_allowed' );
	lib_include( 'ical_lib' );

    $now = new DateTime();
    $end = new DateTime();
    $now = $now->sub( new DateInterval( 'P1D' ) );
    $end = $end->add( new DateInterval( 'P3W' ) );

    $icsDates = ics_to_array( URL_ICAL_BOOKING );
    $events   = ics_array_to_ical_events( $icsDates, $now, $end );

    usort( $events, 'compare_ical_entries' );
?>
<aside class="main-sidebar">
	<center id="main-sidebar-title"><b>Upcoming Events</b></center>
    <div id="main-sidebar-items">
        <? if( count( $events ) == 0 ): ?>
            <br />
            <center>No events found.</center>
        <? else: ?>
        	<? foreach( $events as $event ): ?>
        		<br />
        		<?= $event->getDate() . ' ' . $event->getTime() ?>
        		<br />
        		<?= $event->getDescription() ?>
        		<br />
        	<? endforeach; ?>
        <? endif; ?>
    </div>
</aside>
