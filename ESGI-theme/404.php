<?php get_header(); ?>

<main class="error-page">
	<section class="error-section">
		<h1 class="error-title">404 Error</h1>

		<p class="error-message">The page you were looking for couldn't be found.<br>Maybe try a search?</p>

		<div>
            <?php get_search_form(); ?>
		</div>
	</section>
</main>

<script>
	const header = document.getElementById("header");
	const burgerLines = document.querySelectorAll(".burger-line");
	const logo = document.getElementById("logo");

	header.classList.add("dark-mode");
	burgerLines.forEach(burgerLine => {
		burgerLine.classList.add("bg-white");
	});
	logo.src = "<?php echo img_uri(); ?>svg/logo-white.svg";
</script>

<?php get_footer(); ?>
