<?php get_header() ?>
<?php $src = get_template_directory_uri(); ?>

<?php if (have_posts()): ?>
	<?php while (have_posts()): the_post(); ?>
		<?php
		$logo = get_field('logo');
		$website = get_field('website');
		$facebook = get_field('facebook');
		$twitter = get_field('twitter');
		$youtube = get_field('youtube');
		?>
		<div class="article-header section blue about-header">
			<div class="content">
				<div class="wrap">
					<div class="article-title-container">
						<div class="article-title-center">
							<a class="category-link" href="#">
								COMMUNITY
							</a>
							<h1><?php the_title(); ?></h1>
							<p class="subtitle"><?php the_field('oneliner'); ?></p>



						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="section article-content">
			<div class="content">  

				<div class="organisation-part no-border">
					<div class="wrap">
						<div class="logo-col">
							<a href="<?php echo $website; ?>"><img src="<?php echo $logo['sizes']['medium']; ?>" alt="<?php the_title(); ?>"></a>

							<ul class="organization-links">
								<?php if ($website): ?><li><a href="<?php echo $website; ?>" target="_blank">Website</a></li><?php endif; ?>
								<?php if ($facebook): ?><li><a href="<?php echo $facebook; ?>" target="_blank">Facebook</a></li><?php endif; ?>
								<?php if ($twitter): ?><li><a href="<?php echo $twitter; ?>" target="_blank">Twitter</a></li><?php endif; ?>
								<?php if ($youtube): ?><li><a href="<?php echo $youtube; ?>" target="_blank">Youtube</a></li><?php endif; ?>
							</ul>


						</div>
						<div class="description-col">
							<div class="lead">
								<?php the_field('about'); ?>
							</div>
							<br>
							<?php
							$members = get_field('members');
							if ($members):
								?>
								<div class="wrap">
									<?php
									foreach ($members as $member):
										$photo = get_field('photo', $member['member'][0]);
										$flname = get_the_title($member['member'][0]);
										?>
										<div class="team-member">
											<img class="member-face" src="<?php echo $photo['sizes']['member']; ?>" alt="<?php echo $flname; ?>">
											<div class="member-name"><?php echo $flname; ?></div>
											<div class="member-function"><?php echo $member['function']; ?></div>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>

						</div>
					</div>




				</div>
				<br>

				<?php
				$args = array(
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
				$the_query = new WP_Query($args);
				?>
				<?php if ($the_query->have_posts()): ?>

					<h3 class="division-header">Projects</h3>

					<div class="organisation-wrap no-border">
						<div class="wrap">


							<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

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


							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>

						</div>
					</div>
				<?php endif; ?>
				<br>

				<?php
				$args = array(
						'post_type' => 'event',
						'posts_per_page' => 4,
						'meta_query' => array(
								array(
										'key' => 'organizers',
										'value' => '"' . get_the_ID() . '"',
										'compare' => 'LIKE'
								)
						),
						'meta_key' => 'date_for_sorting',
						'orderby' => 'meta_value_num',
						'order' => 'DESC'
				);

				// get results
				$the_query = new WP_Query($args);
				?>
				<?php if ($the_query->have_posts()) : ?>
					<h3 class="division-header">Events</h3>
					<div class="wrap">
						<?php
						while ($the_query->have_posts()) : $the_query->the_post();
							$website = get_field('website');
							$photo = get_field('photo');
							$logo = get_field('logo');
							?>
							<div class="event-small-link">
								<?php if ($photo): ?>
								<a href="<?php echo $website; ?>" class="event-link" target="_blank">
									<img src="<?php echo $photo['sizes']['large']; ?>" alt="<?php the_title(); ?>">
								</a>
								<?php elseif ($logo): ?>
									<a href="<?php echo $website; ?>" class="event-link" target="_blank">
										<img src="<?php echo $logo['sizes']['large']; ?>" alt="<?php the_title(); ?>">
									</a>
								<?php endif; ?>
								<a class="event-title" href="<?php echo $website; ?>" target="_blank">
									<h2><?php the_title(); ?></h2>
									<div class="event-place">March 2016 | Gdańsk, Poland</div>
								</a>
							</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>  
				<?php endif; ?>
			</div>          
		</div>


	<?php endwhile; ?>
<?php endif; ?>


<?php get_footer() ?>
