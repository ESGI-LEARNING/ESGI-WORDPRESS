<?php get_header(); ?>
	<main class="container">
		<!-- Hero section -->
		<section class="hero-section">
			<h1>A really professional structure<br class="hidden">for all your events!</h1>

			<div class="image-wrapper">
				<img src="<?php echo img_uri() ?>png/1.png" alt="">
			</div>
		</section>

		<!-- About section -->
		<section class="about-section">
			<div class="content-wrapper">
				<div class="text-content">
					<div class="text-block">
						<h2>About Us</h2>
						<p>
							Specializing in the creation of exceptional events for private and corporate clients, we
							design,
							plan and manage every project from conception to execution.
						</p>
					</div>
				</div>
			</div>

            <?php include 'template/includes/about-us.php' ?>
		</section>

		<!-- Services section -->
		<section class="services-section">
			<h2>Our Services</h2>

            <?php include 'template/includes/our-services.php' ?>
		</section>

        <?php $pass = false;
        foreach (esgi_get_partners() as $key => $value) {
            if ($value !== "") {
                $pass = true;
            }
        }
        if ($pass) { ?>
			<!-- Partners section -->
			<section class="partners-section">
				<h1>Our Partners</h1>

                <?php include 'template/includes/our-parteners.php' ?>
			</section>
        <?php } ?>
	</main>


<?php get_footer(); ?>