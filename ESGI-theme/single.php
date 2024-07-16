<?php
get_header();
?>

<main class="main-content">
	<section class="blog-section">
		<h1 class="page-title"><?= the_title() ?></h1>
		<div class="blog-content">
            <?php include 'template/blog/sidebar.php'; ?>
			<div id="content" class="content-area">
				<article class="article-content">
                    <?php the_post(); ?>
					<div class="post-thumbnail">
                        <?php the_post_thumbnail(); ?>
					</div>
					<span class="post-meta">
                        <?php
                        $categories = get_the_category(get_the_ID());
                        foreach ($categories as $category) {
                            echo $category->name . " ";
                        }
                        ?>
                        - <?= wp_date('j F Y', strtotime($post->post_date)) ?>
                    </span>

                    <?php the_content(); ?>

					<div class="post-tags">
                        <?php
                        $tags = get_the_tags();
                        if ($tags) {
                            foreach ($tags as $tag) {
                                ?>
								<a href="<?= get_tag_link($tag->term_id) ?>" class="tag-link">
                                    <?= $tag->name ?>
								</a>
                                <?php
                            }
                        }
                        ?>
					</div>
				</article>

				<div id="comments" class="comments-section">
                    <?php
                    $comments = get_comments(array(
                        'post_id' => get_the_ID(),
                        'status' => 'approve'
                    ));
                    ?>
					<h1 class="comments-title">Comments (<?php echo count($comments); ?>)</h1>
                    <?php foreach ($comments as $comment) { ?>
						<div class="comment">
							<h3 class="comment-author"><?php echo $comment->comment_author; ?></h3>
							<p class="comment-content"><?php echo $comment->comment_content; ?></p>
							<div class="comment-reply">
								<img class="reply-icon" src="<?php echo esgi_get_site_logo()['comment_reply']; ?>"
								     alt="Reply">
								<a href="#comment-form" class="reply-link">Reply</a>
							</div>
						</div>
                    <?php } ?>
				</div>

				<div id="comment-form" class="comment-form">
					<h1 class="form-title">Leave a reply</h1>
                    <?php
                    comment_form(array(
                        'title_reply' => '',
                        'comment_field' => '
                            <textarea id="comment" name="comment" class="form-textarea" placeholder="Message" required></textarea>
                        ',
                        'fields' => array(
                            'author' => '
                                <input id="author" name="author" type="text" class="form-input" placeholder="Full name" required>
                            ',
                            'email' => '
                                <input id="email" name="email" type="email" class="form-input" placeholder="Email" required>
                            '
                        ),
                        'class_form' => 'form-content',
                        'class_submit' => 'form-submit',
                        'label_submit' => 'Submit',
                        'comment_notes_before' => '',
                        'comment_notes_after' => ''
                    ));
                    ?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer();
?>
