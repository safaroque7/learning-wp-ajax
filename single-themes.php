<?php get_header(); ?>

<div class="container mb-5">

	<div class="row mb-5">
		<div class="col-md-8">
			<?php while (have_posts()): the_post(); ?>

				<div class="theme_name bg-white p-2 mb-3 pl-3">
					<?php setPostViews(get_the_ID()); ?>
					<h3 class="mb-0"> Theme's Name : <?php the_title(); ?> </h3>
					<?php if (is_user_logged_in()) { ?>
						<span class="float-right h6 mb-0"> <?php echo getPostViews(get_the_ID()); ?> </a> </span>
					<?php } ?>
				</div>

				<div class="theme_screenshot_wnd">
					<?php
					$lead_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
					if (!empty($lead_image)) { ?>
						<img class="fluid-img mb-4" src="<?php echo esc_url($lead_image[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
					<?php } else { ?>
						<img class="fluid-img mb-4" src="<?php echo esc_url(get_template_directory_uri() . '/images/692x406px.jpg'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
					<?php } ?>

					<div class="row justify-content-center">
						<div class="col-md-4 pr-0">

							<h4 class="butn btn-success text-center"> <a href="<?php echo the_field('themeLiveDemo'); ?>" target="_blank" class="text-white liveDemo p-2 d-block rounded"> Live Demo Link </a> </h4>
						</div>

					</div>

					<?php
					$content = get_the_content();
					if (!empty($content)) { ?>

						<div class="bg-success mb-3">
							<h5 class="bg-dark text-white p-2 mb-0 d-inline-block p-2"> Details </h5>
						</div>

					<?php } ?>

					<div class="detailsDiscriptionTheme">
						<?php the_content(); ?>
						<?php
						$youtubeVideoLink = get_field('youtubeVideoLink');
						if (!empty($youtubeVideoLink)) { ?>
							<div class="themeTutorial videoWrapper">
								<iframe src="<?php echo esc_url($youtubeVideoLink); ?>?rel=0&autohide=1&showinfo=0" frameborder="0"></iframe>
							</div>
						<?php } ?>
					</div>
				</div>
		</div>

		<div class="col-md-4">

			<?php
				$planNameSilver = get_field('planNameSilver');
				$priceSilver = get_field('priceSilver');
				$priceLinkSilver = get_field('priceLinkSilver');

			?>
			<div class="card bg-transparent border-0 mb-md-2 mb-2 rounded-2">
				<div class="card-heading">
					<h4 class="text-center p-1 bg-secondary text-white mb-0"> <?php echo $planNameSilver; ?> </h4>
				</div>
				<div class="card-body bg-white">
					<p class="mb-0"> ✔ Theme </p>
				</div>
				<div class="card-heading mb-md-4">
					<h5>
						<a class="text-center p-md-2 p-1 mb-md-2 mb-1 bg-light text-dark d-block border-top"
							href="<?php echo esc_url($priceLinkSilver); ?>"
							target="_blank"
							rel="noopener noreferrer">
							<?php echo '৳ ' . esc_html($priceSilver); ?> | Buy Now
						</a>
					</h5>

				</div>

			</div>
			<?php ?>



			<?php
				$planNameGold = get_field('planNameGold');
				$priceGold = get_field('priceGold');
				$priceLinkGold = get_field('priceLinkGold');

			?>
			<div class="card bg-transparent border-0 mb-md-2 mb-2">
				<div class="card-heading">
					<h4 class="text-center p-1 bg-secondary text-white mb-0"> <?php echo $planNameGold; ?> </h4>
				</div>
				<div class="card-body bg-white">
					<p class="mb-0"> ✔ Theme </p>
					<p class="mb-0"> ✔ Customize </p>
				</div>
				<div class="card-heading mb-md-4">
					<h5>
						<a class="text-center p-md-2 p-1 mb-md-2 mb-1 bg-light text-dark d-block border-top"
							href="<?php echo esc_url($priceLinkGold); ?>"
							target="_blank"
							rel="noopener noreferrer">
							<?php echo '৳ ' . esc_html($priceGold); ?> | Buy Now
						</a>
					</h5>

				</div>

			</div>
			<?php ?>



			<?php
				$planNamePlatinum = get_field('planNamePlatinum');
				$pricePlatinum = get_field('pricePlatinum');
				$priceLinkPlatinum = get_field('priceLinkPlatinum');

			?>
			<div class="card bg-transparent border-0 mb-md-2 mb-2">
				<div class="card-heading">
					<h4 class="text-center p-1 bg-secondary text-white mb-0"> <?php echo $planNamePlatinum; ?> </h4>
				</div>
				<div class="card-body bg-white">
					<p class="mb-0"> ✔ Theme </p>
					<p class="mb-0"> ✔ Customize </p>
					<p class="mb-0"> ✔ Domain </p>
					<p class="mb-0"> ✔ Hosting [1GB] </p>
				</div>
				<div class="card-heading mb-md-4">
					<h5>
						<a class="text-center p-md-2 p-1 mb-md-2 mb-1 bg-light text-dark d-block border-top"
							href="<?php echo esc_url($priceLinkPlatinum); ?>"
							target="_blank"
							rel="noopener noreferrer">
							<?php echo '৳ ' . esc_html($pricePlatinum); ?> | Buy Now
						</a>
					</h5>

				</div>

			</div>
			<?php ?>


			<?php
				$planNameDiamond = get_field('planNameDiamond');
				$priceDiamond = get_field('priceDiamond');
				$priceLinkDiamond = get_field('priceLinkDiamond');

			?>
			<div class="card bg-transparent border-0 mb-md-2 mb-2">
				<div class="card-heading">
					<h4 class="text-center p-1 bg-secondary text-white mb-0"> <?php echo $planNameDiamond; ?> </h4>
				</div>
				<div class="card-body bg-white">
					<p class="mb-0"> ✔ Theme </p>
					<p class="mb-0"> ✔ Customize </p>
					<p class="mb-0"> ✔ Domain </p>
					<p class="mb-0"> ✔ Hosting [1GB] </p>
					<p class="mb-0"> ✔ Prioritizing Support </p>
				</div>
				<div class="card-heading mb-md-4">
					<h5>
						<a class="text-center p-md-2 p-1 mb-md-2 mb-1 bg-light text-dark d-block border-top"
							href="<?php echo esc_url($priceLinkDiamond); ?>"
							target="_blank"
							rel="noopener noreferrer">
							<?php echo '৳ ' . esc_html($priceDiamond); ?> | Buy Now
						</a>
					</h5>


				</div>

			</div>
			<?php ?>


			<div class="aboutTheme bg-white px-2 pt-2 pb-0 mb-3">
				<div class="uTitlt">
					<h5 class="border-bottom font-weight-bold"> Last Update </h5>
					<h5> <?php $u_modified_time = get_the_modified_time('d F Y');
							echo $u_modified_time;  ?> </h5>
				</div>
			</div>

			<div class="aboutTheme bg-white px-2 pt-2 pb-0 mb-3">
				<div class="uTitlt">
					<h5 class="border-bottom font-weight-bold"> Posted Time </h5>
					<h5> <?php the_time('d F Y'); ?> </h5>
				</div>
			</div>

			<div class="aboutTheme bg-white px-2 pt-2 pb-0 mb-3">
				<div class="uTitlt">
					<h5 class="border-bottom font-weight-bold"> Structures </h5>
					<h5> <?php echo the_field('structure'); ?> </h5>
				</div>
			</div>

			<div class="aboutTheme bg-white px-2 pt-2 pb-0 mb-3">
				<div class="uTitlt">
					<h5 class="border-bottom font-weight-bold"> Version </h5>
					<?php echo the_field('SoftwareVersion'); ?>
				</div>
			</div>

			<div class="aboutTheme bg-white px-2 pt-2 pb-0 mb-3">
				<div class="uTitlt">
					<h5 class="border-bottom font-weight-bold"> Attched Files </h5>
					<?php echo the_field('addFiles'); ?>
				</div>
			</div>

		</div>
	<?php endwhile; ?>
	</div>
	<div class="relatate_theme bg-success mb-3">
		<h5 class="bg-dark text-white p-2 mb-0 d-inline-block p-2"> Related Themes </h5>
	</div>
	<div class="row">

		<?php
		//Get array of terms
		$terms = get_the_terms($post->ID, 'theme', 'string');
		//Pluck out the IDs to get an array of IDS
		$term_ids = wp_list_pluck($terms, 'term_id');

		//Query posts with tax_query. Choose in 'IN' if want to query posts with any of the terms
		//Chose 'AND' if you want to query for posts with all terms
		$second_query = new WP_Query(array(
			'post_type' => 'themes',
			'tax_query' => array(
				array(
					'taxonomy' => 'theme',
					'field' => 'id',
					'terms' => $term_ids,
					'operator' => 'IN' //Or 'AND' or 'NOT IN'
				)
			),
			'posts_per_page' => 12,
			'ignore_sticky_posts' => 1,
			'orderby' => 'rand',
			'post__not_in' => array($post->ID)
		));
		?>



		<?php

		//Loop through posts and display...
		if ($second_query->have_posts()) {
			while ($second_query->have_posts()) : $second_query->the_post(); ?>

				<!-- per theme -->
				<div class="col-md-3 mb-4">

					<div class="detailsHover bg-white p-2">
						<div class="imgBox position-relative mb-3">
							<?php
							$lead_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumb_692_406');
							if (!empty($lead_image)) { ?>
								<img class="fluid-img" src="<?php echo $lead_image[0] ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
							<?php } else { ?>
								<img class="fluid-img" src="<?php echo get_template_directory_uri() . '/images/692x406px.jpg' ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
							<?php } ?>

							<div class="themeDetails w-100 h-100 position-absolute d-flex justify-content-center">
								<a href="<?php the_permalink(); ?>" class="d-inline-block bg-white text-dark p-2 rounded"> Details </a>
							</div>

						</div>

						<h5 class="border-bottom pb-1 mb-2"> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h5>

						<div class="theme_price">
							<h6 class="license"> Single License <span class="float-right"> <?php the_field('SingleLiecence'); ?> </span> </h6>
						</div>

						<div class="demoLInk text-center">
							<h6 class="mb-0"> <a href="<?php echo the_field('themeLiveDemo'); ?>" class="rounded bg-success text-white text-center d-inline-block p-2"> Demo </a> </h6>
						</div>
					</div>
				</div>
		<?php endwhile;
			wp_reset_query();
		} ?>
	</div>
</div>
<?php get_footer(); ?>