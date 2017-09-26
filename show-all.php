<?php
if (file_exists("../../../wp-load.php"))
	require_once ("../../../wp-load.php");


$oos = get_field('organisations_on_start', 10);

$args = array(
		'post_type' => array('organization'),
		'posts_per_page' => 150,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'offset' => $oos
);
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
<?php endif; ?>