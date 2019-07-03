<?php
if (file_exists("../../../wp-load.php"))
	require_once ("../../../wp-load.php");


$topic = $_POST['topic'];
$country = $_POST['country'];
$type = $_POST['type'];

if ($type == 'all' || $type == ''):
	if ($topic && $topic != 'all') {
		$deployed_by_ids = [];
		$args = array(
				'post_type' => array('project'),
				'posts_per_page' => 150,
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'tax_query' => array(
						'relation' => 'AND',
						array(
								'taxonomy' => 'filter',
								'field' => 'slug',
								'terms' => $topic
						)
				)
		);

		$query = new WP_Query($args);
		if ($query->have_posts()):
			while ($query->have_posts()): $query->the_post();
				$deployed_by = get_field('deployed_by');
				if ($deployed_by) {
					foreach ($deployed_by as $db) {
						$deployed_by_ids[] = $db->ID;
					}
				}
			endwhile;
		endif;


		$args = array(
				'post_type' => array('organization'),
				'posts_per_page' => 150,
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'tax_query' => array(
						'relation' => 'AND',
						array(
								'taxonomy' => 'filter',
								'field' => 'slug',
								'terms' => $topic
						)
				)
		);

		$query = new WP_Query($args);
		if ($query->have_posts()):
			while ($query->have_posts()): $query->the_post();
				$deployed_by_ids[] = get_the_ID();
			endwhile;
		endif;

		$ids = array_unique($deployed_by_ids);

		$args = array(
				'post_type' => array('organization'),
				'posts_per_page' => 150,
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'post__in' => $ids
		);
	} else {
		$args = array(
				'post_type' => array('organization'),
				'posts_per_page' => 150,
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'tax_query' => array(
						'relation' => 'AND',
				),
		);
	}

	if ($country && $country != 'all') {
		$args['tax_query'][] = array(
				'taxonomy' => 'filter',
				'field' => 'slug',
				'terms' => $country
		);
	}

	$query = new WP_Query($args);
	if ($query->have_posts()):
		while ($query->have_posts()): $query->the_post();
			$logo = get_field('logo');
			?>
			<div class="organisation-wrap">
				<div class="wrap">
					<div class="tool-box-wrap oranization">
						<div class="toolbox">
							<div class="organization-logo">
								<?php
								if ($logo) {
									echo wp_get_attachment_image($logo['ID'], 'medium');
								}
								?>
							</div>

							<div class="category-title">organization</div>
							<a href="<?php the_permalink(); ?>">
								<h2 class="tool-title">
									<?php the_title(); ?>
								</h2>
							</a>
							<div class="tool-description"><?php the_field('oneliner'); ?></div>
							<a href="<?php the_permalink(); ?>" class="button">more</a>
						</div>
					</div>


					<?php
					$args2 = array(
							'post_type' => 'project',
							'meta_query' => array(
									array(
											'key' => 'deployed_by',
											'value' => '"' . get_the_ID() . '"',
											'compare' => 'LIKE'
									)
							)
					);
					if ($topic && $topic != 'all') {
						$args2['tax_query'][] = array(
								'taxonomy' => 'filter',
								'field' => 'slug',
								'terms' => $topic
						);
					}

					// get results
					$query2 = new WP_Query($args2);
					?>
					<?php if ($query2->have_posts()): ?>

						<?php while ($query2->have_posts()) : $query2->the_post(); ?>
							<div class="tool-box-wrap tool">
								<div class="toolbox">
									<div class="category-title">tool</div>
									<a href="<?php the_permalink(); ?>"><h2 class="tool-title">
											<?php the_title(); ?>
										</h2></a>
									<div class="tool-description"><?php the_field('oneliner'); ?></div>
									<a href="<?php the_permalink(); ?>" class="button">more</a>
								</div>

							</div>
							<?php
						endwhile;
						wp_reset_query();
						?>
					<?php endif; ?>

				</div>

			</div>
			<?php
		endwhile;
		wp_reset_postdata();
		?>
	<?php else: ?>

		No organisations found
	<?php endif; ?>

<?php elseif ($type == 'tools'): ?>


	<?php
	$args = array(
		'post_type' => 'project',
		'posts_per_page' => 150,
	);

	if ($country && $country != 'all') {
		$args['tax_query'][] = array(
				'taxonomy' => 'filter',
				'field' => 'slug',
				'terms' => $country
		);
	}
	if ($topic && $topic != 'all') {
		$args['tax_query'][] = array(
				'taxonomy' => 'filter',
				'field' => 'slug',
				'terms' => $topic
		);
	}
	// get results
	$query = new WP_Query($args);
	?>
	<?php if ($query->have_posts()): ?>

		<div class="organisation-wrap no-border">
			<div class="wrap">
				<?php while ($query->have_posts()) : $query->the_post(); ?>
					<div class="tool-box-wrap tool">
						<div class="toolbox">
							<div class="category-title">tool</div>
							<a href="<?php the_permalink(); ?>"><h2 class="tool-title">
									<?php the_title(); ?>
								</h2></a>
							<div class="tool-description"><?php the_field('oneliner'); ?></div>
							<a href="<?php the_permalink(); ?>" class="button">more</a>
						</div>

					</div>
					<?php
				endwhile;
				wp_reset_query();
				?>
			</div>
		</div>
	<?php else: ?>
		No tools found
	<?php endif; ?>


<?php elseif ($type == 'organisations'): ?>
	<?php
	$args = array(
			'post_type' => array('organization'),
			'posts_per_page' => 150,
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'tax_query' => array(
					'relation' => 'AND',
			),
	);

	if ($country && $country != 'all') {
		$args['tax_query'][] = array(
				'taxonomy' => 'filter',
				'field' => 'slug',
				'terms' => $country
		);
	}
	if ($topic && $topic != 'all') {
		$args['tax_query'][] = array(
				'taxonomy' => 'filter',
				'field' => 'slug',
				'terms' => $topic
		);
	}
	$query = new WP_Query($args);
	?>
	<div class="organisation-wrap no-border">
		<div class="wrap">
			<?php
			if ($query->have_posts()):
				while ($query->have_posts()): $query->the_post();
					$logo = get_field('logo');
					?>
					<div class="tool-box-wrap oranization">
						<div class="toolbox">
							<div class="organization-logo">
								<?php
								if ($logo) {
									echo wp_get_attachment_image($logo['ID'], 'medium');
								}
								?>
							</div>

							<div class="category-title">organization</div>
							<a href="<?php the_permalink(); ?>">
								<h2 class="tool-title">
									<?php the_title(); ?>
								</h2>
							</a>
							<div class="tool-description"><?php the_field('oneliner'); ?></div>
							<a href="<?php the_permalink(); ?>" class="button">more</a>
						</div>
					</div>


					<?php
				endwhile;
				wp_reset_postdata();
				?>

			</div>

		</div>
	<?php else: ?>

		No organisations found
	<?php endif; ?>

<?php else: ?>
<?php endif; ?>
