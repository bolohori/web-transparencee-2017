<?php
/*
 * Template name: Scaling
 */
?>
<?php get_header() ?>
<?php
$src = get_template_directory_uri();
?>

<?php if (have_posts()): ?>
	<?php while (have_posts()): the_post(); ?>


		<div class="article-header section blue">
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

		<div class="section scaling-content article-content">
			<div class="content">
				<div class="wrap">
					<div class="text-column bottom-space">
						<?php
						echo apply_filters('the_content', get_field('s2_text'));
						?>
					</div>
				</div>

				<?php
				$args = array(
						'post_type' => array('scaled-tool'),
						'posts_per_page' => 20,
						'orderby' => 'menu_order',
						'order' => 'ASC'
				);
				$query = new WP_Query($args);
				if ($query->have_posts()):
					?>
					<h3 class="division-header">Our projects</h3>
					<?php
					while ($query->have_posts()): $query->the_post();
						$photo = get_field('listing_photo');
						$listing_text = get_field('listing_text');
						?>
						<div class="wrap scaling-project-link">
							<div class="project-title-col">
								<a href="<?php the_permalink(); ?>"><h2 class="project-title"><?php the_title(); ?></h2>
									<div class="project-country"><?php the_field('subtitle'); ?></div>
								</a>
							</div>
							<div class="short-description">
								<?php
								if ($photo):
									?>
									<a class="scaling-link-image" href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image($photo['ID'], 'large'); ?></a>
								<?php endif; ?>
								<?php if ($listing_text): ?>
									<?php echo $listing_text; ?>
								<?php else: ?>
									<?php the_field('text'); ?>
								<?php endif; ?>
								<a href="<?php the_permalink(); ?>" class="button">more</a>
							</div>
						</div>
					<?php endwhile; ?>
					<?php
					wp_reset_query();
				endif;
				?>
			</div>
		</div>  

	<?php endwhile; ?>
<?php endif; ?>


<?php get_footer() ?>
