<footer class="footer">
	<div class="footer-top">
		<a href="/" class="logo">
			<img src="<?php echo esgi_get_site_logo()['logo_white']; ?>" alt="logo"/>
		</a>

		<div class="contact-info">
			<div class="contact-section">
				<h5>Manager</h5>
				<span><?php echo esgi_get_services()['manager']['phone']; ?></span>
				<span><?php echo esgi_get_services()['manager']['email']; ?></span>
			</div>
			<div class="contact-section">
				<h5>CEO</h5>
				<span><?php echo esgi_get_services()['ceo']['phone']; ?></span>
				<span><?php echo esgi_get_services()['ceo']['email']; ?></span>
			</div>
		</div>
	</div>

	<div class="footer-bottom">
		<div class="footer-text">&copy;<?= date("Y") ?> Figma Template by ESGI</div>

		<div class="social-links">
			<a href="<?php echo esgi_get_social_networks()['linkedin']['url'] ?>" target="_blank">
				<img src="<?php echo img_uri(); ?>svg/linkedin.svg" alt="linkedin"/>
			</a>
			<a href="<?php echo esgi_get_social_networks()['facebook']['url'] ?>" target="_blank">
				<img src="<?php echo img_uri(); ?>svg/facebook.svg" alt="facebook"/>
			</a>
		</div>
	</div>
</footer>

</body>

</html>