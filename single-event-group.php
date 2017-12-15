<?php
/*
 * Template name: Events
 */
?>
<?php get_header() ?>
<?php
$src = get_template_directory_uri();
$today = date('Ymd');
?>

<?php if (have_posts()): ?>
	<?php while (have_posts()): the_post(); ?>


		<div class="article-header section blue events-header">
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

		<div class="section events-list">
			<div class="content">  

				<?php
				$eg_id = get_the_ID();
				$args = array(
						'post_type' => array('event', 'news'),
						'posts_per_page' => 30,
						'meta_key' => 'date_for_sorting',
						'orderby' => 'meta_value_num',
						'order' => 'DESC',
						'meta_query' => array(
								array(
										'key' => 'event_group',
										'value' => '"' . $eg_id . '"',
										'compare' => 'LIKE',
								)
						),
				);
				$query = new WP_Query($args);


				if ($query->have_posts()):
					?>

					<div class="wrap past-events">

						<?php
						while ($query->have_posts()): $query->the_post();
							$photo = get_field('photo');
							$logo = get_field('logo');
							$bg = get_field('bg_photo');
							$post_type = get_post_type();
							if ($post_type == 'event') {
								$text = get_field('about_new');
								$website = get_field('website');
								$target = 'target="_blank"';
								$date = date('F Y', strtotime(get_field('date_for_sorting'))).' | ';
							} elseif ($post_type == 'news') {
								$text = wp_trim_words(get_field('about'));
								$website = get_permalink();
								$target = '';
								$date = date('d F Y', strtotime(get_field('date_for_sorting')));
							}
							?>
							<a class="event-anchor" name="<?php echo get_post_field('post_name') ?>"></a>
							<div class="event-link">
								<?php if ($photo): ?>
									<a href="<?php echo $website; ?>" class="image-link" <?php echo $target; ?>>
										<img src="<?php echo $photo['sizes']['event']; ?>" alt="<?php the_title(); ?>">
									</a>
								<?php elseif ($logo): ?>
									<a href="<?php echo $website; ?>" class="image-link" <?php echo $target; ?>>
										<img src="<?php echo $logo['sizes']['large']; ?>" alt="<?php the_title(); ?>">
									</a>
								<?php elseif ($bg): ?>
									<a href="<?php echo $website; ?>" class="image-link" <?php echo $target; ?>>
										<img src="<?php echo $bg['sizes']['large']; ?>" alt="<?php the_title(); ?>">
									</a>
								<?php endif; ?>
								<a class="event-title-link" href="<?php echo $website; ?>"<?php echo $target; ?>><h2><?php the_title(); ?></h2>
									<div class="event-date"><?php echo $date; ?><?php the_field('place'); ?></div></a>

								<div class="event-description"><?php echo $text; ?></div>
								<a href="<?php echo $website; ?>" class="button"<?php echo $target; ?>>more</a>
							</div>
							<?php
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				<?php endif; ?>


			</div>          
		</div>

	<?php endwhile; ?>
<?php endif; ?>


<?php get_footer() ?>
