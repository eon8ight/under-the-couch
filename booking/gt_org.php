<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Under the Couch - Booking</title>
		<link rel="stylesheet" type="text/css" href="/gtmn_standard.css">
		<?
            js_common_include();
            js_include( 'validate_lib.js' );
		?>
        <script src="/booking/js/gt_org.js"></script>
	</head>
	<body>
		<? ui_insert( 'header' ); ?>
		<div class="container">
			<? ui_insert( 'sidebar' ); ?>
			<div class="primary">
				<article>
					<h1>GT Organization Booking</h1>
					This option is for Georgia Tech organizations wishing to use our space. It is required
					that at least two UTC sound engineers be present for the entirety of your event. Other
					event details will be handled on a case-by-case basis.
					<br />
					<br />
					Cash is the preferred payment option for sound engineers, but a check made out to the
					engineer is also acceptable. Payment must be made at the event.
					<br />
					<br />
					Sound Engineer Rates: $10/hour per engineer
					<br /><br />
					<form method="post" id="gt_org_booking_form" action="/">
						<fieldset>
							<p>
								<label class="nowidth" for="orgname">*Organization Name:</label>
								<input class="textbox" type="text" name="org_name"
									id="org_name" placeholder="Musician's Network">
							</p>
							<p>
								<label class="nowidth" for="contactname">*Contact Name:</label>
								<input class="textbox" type="text" name="contact_name"
									id="contact_name" placeholder="First Last">
							</p>
							<p>
								<label class="nowidth" for="email">*Email Address:</label>
								<input class="textbox" type="text" name="email"
									id="email" placeholder="you@example.com">
							</p>
							<p>
								<label class="nowidth" for="number">Contact Phone Number:</label>
								<input class="textbox" type="tel" name="phone"
									id="phone" placeholder="(xxx)-xxx-xxxx">
							</p>
							<p>
								<label class="nowidth" for="date">*Date Requested:</label>
								<input class="textbox" type="date" name="date" id="date">
							</p>
							<p>
								<label class="nowidth" for="start">*Start Time (including 30 minute setup time):</label>
								<input class="textbox" type="time" name="start" id="start">
							</p>
							<p>
								<label class="nowidth" for="website">*End Time (including 30 minute teardown time):</label>
								<input class="textbox" type="time" name="end" id="end">
							</p>
							<p>
								<label class="nowidth" for="description">*Description of Event:</label>
								<br>
								<textarea name="description" class="textbox" id="description"></textarea>
							</p>
							<p>
								<label class="nowidth" for="attendees">*Expected Number of Attendees:</label>
								<input class="textbox" type="number" name="attendees" id="attendees">
							</p>
							<p>
								<label class="nowidth" for="comments">Additional comments:</label>
								<br>
								<textarea name="comments" class="comments"
									placeholder="Anything else you'd like to add?" id="comments"></textarea>
							</p>
							Required fields are marked with "*".
							<br />
							<br />
							<u><a href="usageagreement.pdf">USAGE AGREEMENT</a></u> &ndash; What we expect from you:
							<ul>
								<li>
									You must clean up after the event; this includes taking trash out to the dumpster (do not
									put in student center trash cans)
								</li>
								<li>
									Please respect our equipment; you will be held responsible for any equipment that you damage
								</li>
								<li>
									If you wish for music to be played over the speakers during your event, you must bring your
									own device
								</li>
								<li>
									You are required to pay two Musician's Network workers $10/hour to help run your event
								</li>
							</ul>
							By clicking the submit button below, you agree to the terms of the usage agreement above.
							<br />
							<br />
							<input type="submit" class="submit-button"></input>
						</fieldset>
					</form>
					<br />
					The above form is the standard for booking events, but the booking agent may be emailed directly at
					<a href="mailto:<?= EMAIL_BOOKING ?>?subject=[GT Organization]"><?= EMAIL_BOOKING ?></a>. Please have your email subject begin
					with "[GT Organization]" and include as much of the above information as possible in the email. If you
					do not fill out the above form, please print and sign our <a href="usageagreement.pdf">Usage Agreement</a>
					and bring it to the event.
				</article>
			</div>
			<? ui_insert( 'footer' ); ?>
		</div>
	</body>
</html>
