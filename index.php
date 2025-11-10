<?php get_header(); ?>

<div class="container">
	<div class="row">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<div class="col-12">
					<h1 class="post-title"><?php the_title(); ?></h1>
					<div class="post-content">
						<?php the_content(); ?>
					</div>
				</div>
			<?php endwhile; ?>
		<?php else : ?>
			<div class="col-12">
				<p><?php esc_html_e('Sorry, no posts found.', 'portfolio'); ?></p>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>