<?php
$havePost = false;
if (!empty($_GET['s'])) {
    $posts = esgi_search_posts(get_search_query());
    $havePost = true;
}
?>
<?php get_header() ?>
<main class="main-container">
	<section class="section-container">
		<h1 class="search-title">
			Search results for:
			<div class="search-query">
				<span class="query-text"><?= get_search_query() ?></span>
				<div class="query-underline"></div>
			</div>
		</h1>
		<div class="search-form-container">
            <?php get_search_form(); ?>
		</div>

        <?php if (!$havePost) { ?>
			<p class="no-results-text">No results found.</p>
        <?php } ?>

        <?php if (!is_array($posts)) { ?>
			<p class="no-results-text"><?= $posts ?></p>
        <?php } ?>

		<div class="posts-grid">
            <?php if (is_array($posts)) {
                foreach ($posts as $post) {
                    ?>
					<a href="<?= $post['permalink'] ?>" class="post-link">
						<article class="post-article">
							<h4 class="post-title"><?= $post['title'] ?></h4>
							<span class="post-meta"><?= $post['category'][0] ?>, <?= $post['date'] ?></span>
							<p class="post-description">
                                <?php
                                $content = $post['content'];
                                $trimmed_content = mb_substr($content, 0, 100);
                                echo $trimmed_content;
                                ?>
							</p>
						</article>
					</a>
                <?php }
            } else {
                $posts = new WP_Query(
                    array(
                        'posts_per_page' => 6,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'post_type' => 'post',
                    )
                );

                if ($posts->have_posts()) {
                    while ($posts->have_posts()) {
                        $posts->the_post();
                        $post = get_post();
                        ?>
						<a href="<?= get_permalink($post->ID) ?>" class="post-link">
							<article class="post-article">
								<h4 class="post-title"><?= $post->post_title ?></h4>
								<span class="post-meta">
                        <?php
                        $categories = get_the_category(get_the_ID());
                        foreach ($categories as $category) {
                            echo $category->name . " ";
                        }
                        ?>
                        - <?= wp_date('j F Y', strtotime($post->post_date)) ?>
                    </span>
								<div class="post-description">
                                    <?php
                                    $content = get_the_content($post->ID);
                                    $trimmed_content = mb_substr($content, 0, 100); // Limite à 100 caractères
                                    echo $trimmed_content;
                                    ?>
								</div>
							</article>
						</a>
                        <?php
                    }
                }
            }
            ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>
