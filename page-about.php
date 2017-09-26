<?php
/*
 * Template name: About
 */
?>
<?php get_header() ?>
<?php $src = get_template_directory_uri(); ?>

<?php if (have_posts()): ?>
	<?php while (have_posts()): the_post(); ?>


		<div class="article-header section green about-header">
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

		<div class="section article-content">
			<div class="content">  
				<div class="wrap">
					<div class="text-column">
						<div class="lead">
							<?php the_field('s2_lead'); ?>
						</div>
						<?php the_field('s2_text'); ?>
					</div>
				</div>
				<br>
				<?php
				$organizations = get_field('organizations');
				if ($organizations):
					foreach ($organizations as $org):
						$org_id = $org['organization'][0]->ID;
						$logo = get_field('logo', $org_id);
						$website = get_field('website', $org_id);
						$facebook = get_field('facebook', $org_id);
						$twitter = get_field('twitter', $org_id);
						$youtube = get_field('youtube', $org_id);
						?>
						<div class="organisation-part">
							<div class="wrap">
								<div class="logo-col">
									<a href="<?php echo get_permalink($org_id); ?>"><img src="<?php echo $logo['sizes']['medium']; ?>" alt="<?php echo get_the_title($org_id); ?>"></a>

									<ul class="organization-links">
										<?php if ($website): ?><li><a href="<?php echo $website; ?>" target="_blank">Website</a></li><?php endif; ?>
										<?php if ($facebook): ?><li><a href="<?php echo $facebook; ?>" target="_blank">Facebook</a></li><?php endif; ?>
										<?php if ($twitter): ?><li><a href="<?php echo $twitter; ?>" target="_blank">Twitter</a></li><?php endif; ?>
										<?php if ($youtube): ?><li><a href="<?php echo $youtube; ?>" target="_blank">Youtube</a></li><?php endif; ?>
									</ul>

								</div>
								<div class="description-col">
									<div class="lead">
										<?php echo $org['description']; ?>
									</div>
									<br>
									<?php
									$members = get_field('members', $org['organization'][0]->ID);
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

						<?php
					endforeach;
					wp_reset_postdata();
				endif;
				?>


			</div>          
		</div>

	<?php endwhile; ?>
<?php endif; ?>


<?php get_footer() ?>
