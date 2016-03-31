<?
    // SQL constants
    define( 'PSQL_HOST', 'localhost' );
    define( 'PSQL_PORT', '5432' );
    define( 'PSQL_DB'  , 'gtmnorg_mnclub' );
    define( 'PSQL_USER', 'gtmnorg' );

    define( 'PSQL_CONNECT_STRING',
            ' host='   . PSQL_HOST
          . ' port='   . PSQL_PORT
          . ' dbname=' . PSQL_DB
          . ' user='   . PSQL_USER );

    // Primary keys
    define( 'EQUIPMENT_MANAGER', 9 );

    // URL constants
    define( 'URL_ICAL_BOOKING', 'http://www.google.com/calendar/ical/kcbafbo67qe33jpj8s10b1ltk0@group.calendar.google.com/public/basic.ics');
    define( 'URL_CALENDAR'    , 'https://www.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTz=0&amp;height=600&amp;'
                              . 'wkst=1&amp;bgcolor=%23FFFFFF&amp;src=c15nvehc365iejl19oedqf59ao%40group.calendar.google.com&amp;'
                              . 'color=%236B3304&amp;src=blq0j50tj034hu67u4gdltn8lc%40group.calendar.google.com&amp;color=%232952A3&amp;'
                              . 'src=2cn9iaf49hbdnbaddsect2rmks%40group.calendar.google.com&amp;color=%238C500B&amp;'
                              . 'src=iiailan4hmunsuiru1s3tr0bvs%40group.calendar.google.com&amp;color=%232952A3&amp;'
                              . 'src=kcbafbo67qe33jpj8s10b1ltk0%40group.calendar.google.com&amp;color=%23875509&amp;'
                              . 'src=d9mfbr5rbro76mgsg8829htjmo%40group.calendar.google.com&amp;color=%232F6309&amp;'
                              . 'src=utcbooking%40gmail.com&amp;color=%231B887A&amp;'
                              . 'src=soacojivunh8bo6rvnfi9nngk8%40group.calendar.google.com&amp;color=%232F6309&amp;'
                              . 'src=qcolb7go6s8oouldedrpa45d48%40group.calendar.google.com&amp;color=%235229A3&amp;'
                              . 'ctz=America%2FNew_York' );

    //Email constants
    define( 'EMAIL_WEBMASTER', 'webmaster@gtmn.org' );
    define( 'EMAIL_BOOKING'  , 'utcbooking@gmail.com' );
?>
