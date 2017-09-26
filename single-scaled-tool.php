<?php get_header() ?>
<?php $src = get_template_directory_uri(); ?>

<?php if (have_posts()): ?>
	<?php
	while (have_posts()): the_post();
		?>
		<div class="article-header section blue">
			<div class="content">
				<div class="wrap">
					<div class="article-title-container">
						<div class="article-title-center">
							<a class="category-link" href="<?php echo get_permalink(1511); ?>">
								<?php echo get_the_title(1511); ?>
							</a>
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
						echo apply_filters('the_content', get_field('text'));

						$timeline = get_field('timeline');
						if ($timeline):
							?>
							<div class="scale-timeline">
								<?php
								foreach ($timeline as $event):
									?>
									<div class="timeline-section">
										<div class="timeline-date"><?php echo $event['date']; ?></div>
										<h3 class="timeline-header"><?php echo $event['title']; ?></h3>
										<?php
										if ($event['schema'] == 'large_photo'):
											?>
											<div class="image-container">
												<?php
												if ($event['photo']) {
													echo wp_get_attachment_image($event['photo']['ID'], 'large');
												}
												?>
												<div class="img-caption">
													<?php echo $event['image_caption']; ?>
												</div>
											</div>
											<?php echo $event['text']; ?>
										<?php elseif ($event['schema'] == 'small_photo'): ?>
											<div class="wrap image-and-text">
												<div class="smaller-image">
													<?php
													if ($event['photo']) {
														echo wp_get_attachment_image($event['photo']['ID'], 'large');
													}
													?>
												</div>
												<div class="text-col">
													<?php echo $event['text']; ?>
												</div>
											</div>
										<?php else: ?>
											<?php echo $event['text']; ?>
										<?php endif; ?>
									</div>

								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<?php
						$website = get_field('website');
						if ($website):
							?>
							<div class="button-center">
								<a href="<?php echo $website; ?>" class="button" target="_blank">
									Show website
								</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>  

		<?php
		$next_post = get_next_post();
		if (is_a($next_post, 'WP_Post')) :
			?>
			<div class="section blue next-section next-scale-section">
				<div class="content">
					<div class="wrap">
						<div class="next-case-column">
							<div class="undertilte">Read next case study</div>
							<a href="<?php echo get_permalink($next_post->ID); ?>" class="next-title-link">
								<h2>F<?php echo get_the_title($next_post->ID); ?></h2>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
<?php endif; ?>


<?php get_footer() ?>
