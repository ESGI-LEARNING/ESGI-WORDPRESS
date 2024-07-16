<?php
/*
Template Name: Services
*/
get_header();
?>

<main class="container">
	<section class="services-intro">
		<h1 class="title">Our Services.</h1>
        <?php include 'includes/our-services.php'; ?>
	</section>

	<section class="services-detail">
		<h2 class="subtitle">Corp. Parties</h2>
		<p class="description">
			Specializing in the creation of exceptional events for private and corporate clients, we design, plan and
			manage every project from conception to execution.
		</p>
	</section>

	<section class="services-image">
		<img src="<?php echo img_uri(); ?>png/9.png" class="full-image">
	</section>
</main>

<?php get_footer(); ?>
