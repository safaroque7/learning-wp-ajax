<!-- per theme -->
<div class="col-md-4 mb-4">
	<div class="detailsHover bg-white p-3">
		<div class="imgBox position-relative mb-3">

			<?php
			$lead_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumb_692_406');
			if (!empty($lead_image)) { ?>
				<img class="fluid-img" src="<?php echo $lead_image[0] ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
			<?php } else { ?>
				<img class="fluid-img" src="<?php echo get_template_directory_uri() . '/images/692x406px.jpg' ?>"
					alt="<?php echo esc_attr(get_the_title()); ?>">
			<?php } ?>

			<div class="themeDetails w-100 h-100 position-absolute d-flex justify-content-center">
				<a href="<?php the_permalink(); ?>" class="d-inline-block bg-white text-dark p-2 rounded"> Details </a>
			</div>

		</div>

		<h4 class="border-bottom pb-1 mb-3"> <a href="<?php the_permalink(); ?>" class="text-dark">
				<?php the_title(); ?> </a> </h4>

		<div class="theme_price border-bottom pb-1 mb-3">
			<h6> Single License <span class="float-right"> ৳ <?php the_field('SingleLiecence'); ?> </span> </h6>
			<!-- <h6> আনলিমিটেড লাইসেন্স <span class="float-right"> <?php //the_field('UnlimitedLiecence'); 
																	?> টাকা </span> </h6> -->
		</div>


		<div class="demoLInk text-center d-flex justify-content-between">
			<h6 class="mb-0">
				<a href="<?php echo the_field('themeLiveDemo'); ?>" target="_blank"
					class="border border-dark rounded bg-light text-dark text-center d-inline-block p-2 float-left rounded-lg">
					Demo </a>
			</h6>

			<h6 class="mb-0">
				<a href="<?php the_permalink(); ?>" target="_blank"
					class="border border-dark rounded bg-light text-dark text-center d-inline-block p-2 float-left">
					Buy Now </a>
			</h6>

		</div>
	</div>
</div>