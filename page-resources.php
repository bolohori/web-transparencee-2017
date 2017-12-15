<?php
/*
 * Template name: Resources
 */
?>
<?php get_header() ?>
<?php
$src = get_template_directory_uri();
?>

<?php if (have_posts()): ?>
	<?php while (have_posts()): the_post(); ?>


		<div class="article-header section orange">
			<div class="content">
				<div class="wrap">
					<div class="article-title-container">
						<div class="article-title-center">
							<h1><?php the_field('s1_big_header'); ?></h1>
							<div class="subtitle"><?php the_field('s1_text'); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="section resources-content">
			<div class="content">
				<?php
				$args = array(
						'post_type' => array('article'),
						'posts_per_page' => 3,
						'orderby' => 'date',
						'order' => 'DESC'
				);
				$query = new WP_Query($args);
				if ($query->have_posts()):
					?>
					<div class="featured-content">
						<h2 class="smaller-header">Last articles</h2>
						<div class="wrap">
							<?php
							while ($query->have_posts()): $query->the_post();
								$terms = get_the_terms(get_the_ID(), 'section');
								$external = get_field('external_site');
								if (empty($external)) {
									$link = 'href="' . get_permalink() . '"';
								} else {
									$link = 'href="' . $external . '" target="_blank"';
								}
								?>
								<div class="article">
									<div class="article-container">
										<div class="subtitle"><?php echo $terms[0]->name; ?></div>
										<a class="article-title-link" <?php echo $link; ?>>
											<h2><?php the_title(); ?></h2>
										</a>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<?php
			$terms = get_terms(array(
					'taxonomy' => 'section',
					'hide_empty' => false,
			));

			if ($terms):
				foreach ($terms as $term):
					?>

					<div class="content">
						<div class="resources-category">
							<div class="wrap">
								<div class="description-column">
									<h2 class="description-title"><?php echo $term->name; ?></h2>
									<div class="description-sentance"><?php echo term_description($term->term_id) ?></div>
								</div>
								<?php
								$args = array(
										'post_type' => array('article'),
										'posts_per_page' => 20,
										'tax_query' => array(
												array(
														'taxonomy' => 'section',
														'field' => 'term_id',
														'terms' => $term->term_id,
												),
										),
										'orderby' => 'menu_order',
										'order' => 'ASC'
								);
								$query = new WP_Query($args);
								if ($query->have_posts()):
									?>
									<div class="articles-column">
										<ul class="articles-list">
											<?php
											while ($query->have_posts()): $query->the_post();
												$external = get_field('external_site');
												if (empty($external)) {
													$link = 'href="' . get_permalink() . '"';
												} else {
													$link = 'href="' . $external . '" target="_blank"';
												}
												?>
												<li><div><a <?php echo $link; ?> class="article-link"><?php the_title(); ?></a></div></li>
														<?php endwhile; ?>
										</ul>                 
									</div>
									<?php
									wp_reset_query();
								endif;
								?>
							</div>
						</div>
					</div>
					<?php
				endforeach;
			endif;
			?>

		</div>

	<?php endwhile; ?>
<?php endif; ?>


<?php get_footer() ?>
