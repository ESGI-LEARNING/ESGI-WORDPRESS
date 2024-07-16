<?php
/*
Template Name: About Us
*/
get_header();
?>

<main class="container">
	<section class="about-section">
		<h1 class="title">About us.</h1>

		<div class="image-container">
			<img src="<?php echo img_uri() ?>png/4.png" class="full-width" alt="">
		</div>
	</section>

	<section class="details-section">
		<div class="content">
			<div class="text-container">
				<h2 class="subtitle">Sky’s the limit</h2>
				<p class="description">
					Specializing in the creation of exceptional events for private and corporate clients, we design,
					plan and manage every project from conception to execution.
				</p>
			</div>
		</div>
        <?php include 'includes/about-us.php'; ?>
	</section>

	<section class="team-section">
		<h2 class="subtitle">Our Team</h2>

		<div class="team-grid">
            <?php
            $team = esgi_get_team_members();
            foreach ($team as $member) {
                echo '
                    <div class="team-member">
                        <img src="' . $member['image'] . '" class="member-image" alt="">
                        <h4 class="member-title">' . $member['work'] . '</h4>
                        <span class="member-contact">' . $member['phone'] . '</span>
                        <span class="member-contact">' . $member['email'] . '</span>
                    </div>
                ';
            }
            ?>
		</div>
	</section>
</main>

<?php get_footer(); ?>
