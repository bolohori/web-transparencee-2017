<?php
/*
 * Template name: Contact
 */
?>
<?php get_header() ?>
<?php $src = get_template_directory_uri(); ?>

<?php if (have_posts()): ?>
	<?php while (have_posts()): the_post(); ?>

		<div class="article-header section orange about-header">
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
						<br>
						<?php
						$repeater = get_field('s2_repeater');
						if ($repeater):
							foreach ($repeater as $item):
								?>
								<div class="anchor" id="<?php echo sanitize_title($item['title']) ?>"></div>
								<div class="join-us-section">
									<div class="wrap">
										<div class="icon-col">
											<img src="<?php echo $item['icon']['url']; ?>" alt="<?php echo $item['title']; ?>">
										</div>
										<div class="text-col">
											<h2><?php echo $item['title']; ?></h2>
											<p><?php echo $item['text']; ?></p>
											<?php
											if ($item['buttons']):
												foreach ($item['buttons'] as $btn):
												?>
											<a href="<?php echo $btn['url']; ?>" class="button" <?php if ($btn['new_window']): ?>target="_blank"<?php endif; ?>><?php echo $btn['text']; ?></a>
											<?php
												endforeach;
											endif;
											?>
										</div></div>
								</div>
								<?php
							endforeach;
						endif;
						?>
					</div>
				</div>

			</div>          
		</div>

	<?php endwhile; ?>
<?php endif; ?>


<?php get_footer() ?>
