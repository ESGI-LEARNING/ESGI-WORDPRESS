<?php get_header(); ?>
/*
Template Name: Contacts
*/
<main class="main-container">
	<section class="section-container">
		<div>
			<h1 class="title">Contacts.</h1>
			<p class="intro-text">A desire for a big big party or a very select congress? Contact us.</p>
		</div>

		<div class="contact-info-container">
			<div class="contact-info">
				<div class="contact-item">
					<h5 class="contact-heading">Location</h5>
					<span class="contact-detail"><?php echo esgi_get_services()['location_desk']['street']; ?></span>
					<span class="contact-detail"><?php echo esgi_get_services()['location_desk']['region']; ?></span>
				</div>

				<div class="contact-item">
					<h5 class="contact-heading">Manager</h5>
					<span class="contact-detail"><?php echo esgi_get_services()['manager']['phone']; ?></span>
					<span class="contact-detail"><?php echo esgi_get_services()['manager']['email']; ?></span>
				</div>

				<div class="contact-item">
					<h5 class="contact-heading">CEO</h5>
					<span class="contact-detail"><?php echo esgi_get_services()['ceo']['phone']; ?></span>
					<span class="contact-detail"><?php echo esgi_get_services()['ceo']['email']; ?></span>
				</div>
			</div>

			<img src="<?php echo img_uri() ?>png/10.png" class="image-full-width">
		</div>
	</section>

	<section class="contact-form-section">
		<div class="form-header">
			<h2 class="form-title">Write us here</h2>
			<p class="form-subtitle">Go! Don’t be shy.</p>
		</div>

		<div class="contact-form">
			<form action="" method="POST" class="form-content">
				<input type="hidden" name="action" value="submit_contact_form">
				<input type="text" name="subject" placeholder="Subject" class="form-input">
				<div class="row-50">
					<input type="email" name="email" placeholder="Email" class="form-input">
					<input type="tel" name="phone" placeholder="Phone no." class="form-input">
				</div>
				<textarea name="message" placeholder="Your message" class="form-textarea"></textarea>
				<input type="submit" value="Submit" class="form-submit">
			</form>
		</div>
	</section>
</main>
<?php get_footer(); ?>
