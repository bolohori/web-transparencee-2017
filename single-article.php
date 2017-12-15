<?php
$external = get_field('external_site');
if ($external) {
	wp_redirect($external);
}
?>

<?php get_header() ?>
<?php $src = get_template_directory_uri(); ?>

<?php if (have_posts()): ?>
	<?php
	while (have_posts()): the_post();
		$terms = get_the_terms(get_the_ID(), 'section');
		?>
		<div class="article-header section orange">
			<div class="content">
				<div class="wrap">
					<div class="article-title-container">
						<div class="article-title-center">
							<div class="category-link">
								<?php echo $terms[0]->name; ?>
							</div>
							<h1>
								<?php the_title(); ?>
							</h1>
							<p class="subtitle"><?php the_field('subtitle'); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="section article-content">
			<div class="content">
				<div class="wrap">
					<div class="text-column">
						<?php
						echo apply_filters('the_content', get_field('about'));
						?>
					</div>
				</div>
			</div>
		</div>  

		<?php
		$next_post = get_previous_post(true, '', 'section');
		if (is_a($next_post, 'WP_Post')) :
			?>
			<div class="section orange next-section next-scale-section">
				<div class="content">
					<div class="wrap">
						<div class="next-case-column">
							<div class="undertilte">Read next</div>
							<a href="<?php echo get_permalink($next_post->ID); ?>" class="next-title-link">
								<h2><?php echo get_the_title($next_post->ID); ?></h2>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php else: ?>
			<?php
			$next_term = get_terms(array(
					'taxonomy' => 'section',
					'hide_empty' => false,
					'exclude' => $terms[0]->term_id,
					'fields' => 'ids'
							));
			shuffle($next_term);
			$args = array(
					'post_type' => array('article'),
					'posts_per_page' => 1,
					'tax_query' => array(
							array(
									'taxonomy' => 'section',
									'field' => 'term_id',
									'terms' => $next_term[0],
							),
					),
					'meta_query' => array(
							'relation' => 'OR',
							array(
									'key' => 'external_site',
									'value' => '',
							),
							array(
									'key' => 'external_site',
									'compare' => 'NOT EXISTS',
							),
					),
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'fields' => 'ids'
			);
			$query = new WP_Query($args);
			if ($query->have_posts()) {
				while ($query->have_posts()) {
					$query->the_post();
					$next_post = get_the_ID();
				}
			}
			?>
			<div class="section orange next-section next-scale-section">
				<div class="content">
					<div class="wrap">
						<div class="next-case-column">
							<div class="undertilte">Read next</div>
							<a href="<?php echo get_permalink($next_post); ?>" class="next-title-link">
								<h2><?php echo get_the_title($next_post); ?></h2>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
<?php endif; ?>


<?php get_footer() ?>
