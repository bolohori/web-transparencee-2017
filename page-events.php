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
				$args = array(
						'post_type' => array('event'),
						'posts_per_page' => 20,
						'meta_query' => array(
								array(
										'key' => 'date_for_sorting',
										'value' => $today,
										'compare' => '>',
								)
						),
						'meta_key' => 'date_for_sorting',
						'orderby' => 'meta_value_num',
						'order' => 'DESC'
				);
				$query = new WP_Query($args);
				if ($query->have_posts()):
					?>
					<h3 class="division-header">Upcoming events</h3>
					<?php
					while ($query->have_posts()): $query->the_post();
						$website = get_field('website');
						$photo = get_field('photo');
						$logo = get_field('logo');
						?>
						<div class="upcoming-events">
							<a class="event-anchor" name="<?php echo get_post_field( 'post_name' ) ?>"></a>
							<div class="upcoming-event">    
								<div class="wrap">           
									<div class="date-col">
										<div class="day">
											<?php the_field('date_1'); ?></div>
										<div class="year"><?php the_field('date_2'); ?></div>
										<div class="place"><?php the_field('place'); ?></div>
									</div>
									<div class="image-col">
										<?php if ($photo): ?>
											<a href="<?php echo $website; ?>" class="image-link" target="_blank">
												<img src="<?php echo $photo['sizes']['event']; ?>" alt="<?php the_title(); ?>">
											</a>
										<?php elseif ($logo): ?>
											<a href="<?php echo $website; ?>" class="image-link" target="_blank">
												<img src="<?php echo $logo['sizes']['large']; ?>" alt="<?php the_title(); ?>">
											</a>
										<?php endif; ?>
									</div>
									<div class="title-col">
										<a class="title-link" href="<?php echo $website; ?>" target="_blank"><h2><?php the_title(); ?></h2></a>
										<div class="event-description"><?php the_field('about_new'); ?></div>
										<a href="<?php echo $website; ?>" target="_blank" class="button">more</a>
									</div>
								</div>
							</div>
							<?php
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				<?php endif; ?>

				<?php
				$args = array(
						'post_type' => array('event'),
						'posts_per_page' => 30,
						'meta_query' => array(
								array(
										'key' => 'date_for_sorting',
										'value' => $today,
										'compare' => '<=',
								)
						),
						'meta_key' => 'date_for_sorting',
						'orderby' => 'meta_value_num',
						'order' => 'DESC'
				);
				$query = new WP_Query($args);
				if ($query->have_posts()):
					?>
					<h3 class="division-header">Past events</h3>

					<div class="wrap past-events">

						<?php
						while ($query->have_posts()): $query->the_post();
							$website = get_field('website');
							$photo = get_field('photo');
							$logo = get_field('logo');
							?>
							<a class="event-anchor" name="<?php echo get_post_field( 'post_name' ) ?>"></a>
							<div class="event-link">
								<?php if ($photo): ?>
									<a href="<?php echo $website; ?>" class="image-link" target="_blank">
										<img src="<?php echo $photo['sizes']['event']; ?>" alt="<?php the_title(); ?>">
									</a>
								<?php elseif ($logo): ?>
									<a href="<?php echo $website; ?>" class="image-link" target="_blank">
										<img src="<?php echo $logo['sizes']['large']; ?>" alt="<?php the_title(); ?>">
									</a>
								<?php endif; ?>
								<a class="event-title-link" href="<?php echo $website; ?>"><h2><?php the_title(); ?></h2>
									<div class="event-date"><?php echo date('F Y', strtotime(get_field('date_for_sorting'))); ?> | <?php the_field('place'); ?></div></a>

								<div class="event-description"><?php the_field('about_new'); ?></div>
								<a href="<?php echo $website; ?>" class="button">more</a>
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
