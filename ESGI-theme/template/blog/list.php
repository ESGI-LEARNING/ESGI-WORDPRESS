<?php get_header(); ?>

<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$args = array(
    'posts_per_page' => 6,
    'paged' => $paged,
);

if (isset($_GET['category']) && !empty($_GET['category'])) {
    $args['category_name'] = $_GET['category'];
} elseif (isset($_GET['tags']) && !empty($_GET['tags'])) {
    $args['tag'] = $_GET['tags'];
}

$posts_query = new WP_Query($args);
?>

<main class="blog-main">
	<section class="blog-section">
		<h1 class="blog-title">Blog.</h1>

		<div class="blog-content">
            <?php include 'sidebar.php'; ?>

			<div class="articles">
				<div class="article-list">
                    <?php
                    if ($posts_query->have_posts()) {
                        while ($posts_query->have_posts()) {
                            $posts_query->the_post();
                            $post = get_post();
                            $content = get_the_content($post->ID);
                            $regex = '/<figure class="wp-block-image[^>]*><img[^>]*src="([^"]+)"[^>]*\/><\/figure>/';
                            $content = preg_replace($regex, '', $content);
                            if (strlen($content) > 200) {
                                $content = substr($content, 0, 200) . '...';
                            }
                            ?>

							<article class="article">
								<a href="<?= get_permalink($post->ID) ?>" class="article-link">
									<div class="article-image">
                                        <?php
                                        $categories = get_the_category($post->ID);

                                        $src = "https://via.placeholder.com/500x330";

                                        if (has_post_thumbnail($post->ID)) {
                                            $src = get_the_post_thumbnail_url($post->ID);
                                        }
                                        ?>

										<div class="article-categories">
                                            <?php foreach ($categories as $category) { ?>
												<span>
                                        <?php
                                        if (count($categories) > 1 && $category !== end($categories)) {
                                            echo $category->name . ',';
                                        } else {
                                            echo $category->name;
                                        }
                                        ?>
                                    </span>
                                            <?php } ?>
										</div>

										<img src="<?= $src ?>" alt="">
									</div>

									<div class="article-content">
										<h3 class="article-title"><?= $post->post_title ?></h3>

										<div class="article-description description">
                                            <?= $content ?>
										</div>
									</div>
								</a>
							</article>

                            <?php
                        }
                    }
                    ?>
				</div>

				<div class="pagination">
                    <?php
                    $pagination_args = array(
                        'mid_size' => 4,
                        'prev_text' => '<',
                        'next_text' => '>',
                        'total' => $posts_query->max_num_pages,
                        'type' => 'array'
                    );

                    $pagination_links = paginate_links($pagination_args);

                    if ($pagination_links) {
                        echo '<div class="pagination-links">';

                        foreach ($pagination_links as $link) {
                            $link = str_replace('page-numbers', 'page-numbers ajax-link', $link);
                            echo $link;
                        }
                        echo '</div>';
                    }
                    ?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
