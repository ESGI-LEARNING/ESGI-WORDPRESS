<?php
$args = array(
    'posts_per_page' => 4,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_type' => 'post',
);

$recent_posts = new WP_Query($args);
?>

<aside class="sidebar">
	<div class="search-section">
		<h3 class="section-title">Search</h3>
        <?php get_search_form(); ?>
	</div>

	<div class="recent-posts">
		<h3 class="section-title">Recent posts</h3>
		<div class="recent-posts-list">
            <?php
            if ($recent_posts->have_posts()) {
                while ($recent_posts->have_posts()) {
                    $recent_posts->the_post();
                    $post_sidebar = get_post();
                    ?>

					<article class="recent-post">
						<a href="<?= get_permalink($post_sidebar->ID) ?>" class="flex gap-[25px]">
							<div class="post-thumbnail">
                                <?php
                                $src = "https://via.placeholder.com/88x88";

                                if (has_post_thumbnail($post_sidebar->ID)) {
                                    $src = get_the_post_thumbnail_url($post_sidebar->ID);
                                }
                                ?>

								<img src="<?= $src ?>" class="w-full aspect-square"/>
							</div>

							<div class="post-content">
								<h4 class="post-title"><?= $post_sidebar->post_title ?></h4>
								<time class="post-date"><?= wp_date('j F Y', strtotime($post_sidebar->post_date)) ?></time>
							</div>
						</a>
					</article>

                    <?php
                }
            }
            ?>
		</div>
	</div>
	<div class="archives-section">
		<div id="content" role="main">
			<h3 class="section-title">Archives</h3>
			<ul class="archive-list">
                <?php wp_get_archives('type=monthly'); ?>
			</ul>
		</div>
	</div>
	<div class="categories-section">
		<h3 class="section-title">Categories</h3>
		<ul class="categories-list">
            <?php
            $categories = get_categories();
            foreach ($categories as $category) {
                $category_url = add_query_arg('category', $category->slug, delete_argument_uri(get_current_uri()));
                ?>
				<li>
					<a href="<?= esc_url($category_url) ?>">
                        <?= esc_html($category->name) ?>
					</a>
				</li>
                <?php
            }
            ?>
		</ul>
	</div>

	<div class="tags-section">
		<h3 class="section-title">Tags</h3>
		<div class="tags-list">
            <?php
            $tags = get_tags();
            foreach ($tags as $tag) {
                $tag_url = add_query_arg('tags', $tag->slug, delete_argument_uri(get_current_uri()));
                ?>
				<a href="<?= esc_url($tag_url) ?>" class="tag-link">
                    <?= esc_html($tag->name) ?>
				</a>
                <?php
            }
            ?>
		</div>
	</div>
</aside>
