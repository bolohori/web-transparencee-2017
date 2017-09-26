<?php
/*
 * Template name: Community
 */
?>
<?php get_header() ?>
<?php
$src = get_template_directory_uri();
?>

<?php if (have_posts()): ?>
	<?php
	while (have_posts()): the_post();

		$oos = get_field('organisations_on_start');

		$topic = get_query_var('topic');
		$country = sanitize_title(urldecode(get_query_var('country')));
		$type = get_query_var('type');
		?>

		<div class="community section grey">
			<div class="content">
				<div class="wrap">
					<div class="text-part">
						<h2 class="big-header"><?php the_field('s1_big_header'); ?></h2>
						<div class="section-summary"><?php the_field('s1_text'); ?></div>

					</div>
				</div> 
			</div>

			<div class="community-map">
				<?php get_template_part('moduls/interactive-map') ?>

			</div>
		</div>


		<div class="section community-results">
			<div class="content">
				<div class="community-filters">

					<div class="left-filters">
						<div class="wrap">
							<div class="column">
								<div class="filter-column">
									<div class="dropdown">
										<div class="filter-select cs-fs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Country
										</div>
										<ul class="dropdown-menu country-select" aria-labelledby="dLabel">
											<li><a href="#" data-country-slug="all">All countries</a></li>
											<?php
											$terms = get_terms(array(
													'taxonomy' => 'filter',
													'hide_empty' => false,
													'parent' => 2
											));

											if ($terms):
												foreach ($terms as $term):
													?>
													<li><a href="#" data-country-slug="<?php echo $term->slug; ?>" data-country="<?php echo $term->name; ?>"><?php echo $term->name; ?></a></li>
												<?php endforeach; ?>
											<?php endif; ?>
										</ul>
									</div>
								</div>
							</div>
							<div class="column">
								<div class="filter-column">
									<div class="dropdown">
										<div class="filter-select top-fs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Topic
										</div>
										<ul class="dropdown-menu topic-select" aria-labelledby="dLabel">
											<li><a href="#" data-topic-slug="all">All topics</a></li>
											<?php
											$terms = get_terms(array(
													'taxonomy' => 'filter',
													'hide_empty' => false,
													'parent' => 5
											));

											if ($terms):
												foreach ($terms as $term):
													?>
													<li><a href="#" data-topic-slug="<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
												<?php endforeach; ?>
											<?php endif; ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="right-menu type-select">
						<a <?php if ($type == 'all' || $type == ''): ?>class="active"<?php endif; ?> href="" data-type="all">All</a>
						<a <?php if ($type == 'tools'): ?>class="active"<?php endif; ?> href="" data-type="tools">Tools</a>
						<a <?php if ($type == 'organisations'): ?>class="active"<?php endif; ?> href="" data-type="organisations">Organisations</a>
					</div>
				</div>

				<div class="org-list">
					<?php if ($type == 'all' || $type == ''): ?>
						<?php
						if ($topic && $topic != 'all') {
							$deployed_by_ids = '';
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
									'posts_per_page' => $oos,
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


						/*
						  $args = array(
						  'post_type' => array('organization'),
						  'posts_per_page' => $oos,
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
						 */
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

						<?php
						if (!$topic || $topic == 'all'):
							?>

							<div class="button-center">
								<a href="#" class="button show-all">Show all</a>
							</div>
							<div class="all-container"></div>
						<?php endif; ?>
					<?php elseif ($type == 'tools'): ?>

						<?php
						$args = array(
								'post_type' => 'project',
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


					<?php endif; ?>
				</div>
			</div>


		</div>

	<?php endwhile; ?>
<?php endif; ?>


<?php get_footer() ?>
