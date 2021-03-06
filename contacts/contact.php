<?
	db_include(
        'get_role_by_abbreviation',
		'get_officer_info'
	);

    $name     = $_REQUEST['name'];
	$position = get_role_by_abbreviation( $name );

	if( $position ):
		$position_name        = $position['name'];
		$position_description = $position['description_html'];
	else:
?>
        <script type="text/javascript">
            window.location = '/404.php?file=contacts/contact.php?name=<?= $name ?>';
        </script>
<?
        exit;
	endif;

	$officers = get_officer_info( $position['role'] );
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Under the Couch - <?= $position_name ?></title>
		<link rel="stylesheet" type="text/css" href="/gtmn_standard.css" />
        <? js_common_include(); ?>
	</head>
	<body>
		<? ui_insert( 'header' ); ?>
		<div class="container">
			<? ui_insert( 'sidebar' ); ?>
			<div class="primary">
				<article>
					<br/>
                    <center>
						<? if( $officers ): ?>
							<? foreach( $officers as $officer ): ?>
								<img src="<?= $officer['profile_photo_path'] ?: '/media/profile/default.jpg' ?>" class="contact-photo" />
								<br />
								<b> <?= $officer['officer_name'] ?> </b>
								<br />
								<?= $officer['display_email_address'] ?>
								<br />
								<br />
							<? endforeach; ?>
						<? endif; ?>
						<?= $position_description ?>
                    </center>
					<br/>
				</article>
			</div>
			<? ui_insert( 'footer' ); ?>
		</div>
	</body>
</html>
