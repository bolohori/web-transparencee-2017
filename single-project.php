<?php get_header() ?>
<?php $src = get_template_directory_uri(); ?>

<?php if (have_posts()): ?>
	<?php
	while (have_posts()): the_post();
		$website = get_field('website');
		$logo = get_field('project_logo');
		?>


		<div class="article-header section blue">
			<div class="content">
				<div class="wrap">
					<div class="article-title-container">
						<div class="article-title-center">
							<a class="category-link" href="#">
								tool
							</a>
							<h1><?php the_title(); ?></h1>
							<?php if ($website): ?>
								<a href="<?php echo $website; ?>" class="button" target="_blank">project website</a>
							<?php endif; ?>
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
						if ($logo) {
							echo wp_get_attachment_image($logo['ID'], 'large');
						}
						?>
						<?php
						echo apply_filters('the_content', get_field('about'));
						?>
					</div>
				</div><div class="wrap">
					<div class="text-column">
						<?php
						echo apply_filters('the_content', get_field('useful_info'));
						?>
					</div>
				</div>
			</div>
		</div>  
		<?php
		$orgs = get_field('deployed_by');
		if ($orgs):
			?>
			<div class="section">
				<div class="content">
					<h3 class="division-header">Made by</h3>
					<div class="organisation-wrap no-border">
						<div class="wrap">
							<?php
							foreach ($orgs as $post): setup_postdata($post);
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
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>



		<?php /*

		  <?php get_template_part('map'); ?>
		  <section class="content-wrapper">
		  <div class="row">
		  <div class="small-12 large-2 columns sidebar text-center">
		  <h2>About</h2>
		  <div class="white-margin mt15">
		  <a href="javascript: history.go(-1)" class="btn grey-border smaller">&larr;&nbsp; back</a>
		  </div>
		  </div>
		  <div class="small-12 large-9 columns large-offset-1 large-pt10 content">
		  <?php $img = get_field('project_logo'); ?>
		  <?php if ($img['url'] != ''): ?>
		  <img src="<?php echo $img['sizes']['medium']; ?>" alt="Logo - <?php the_title(); ?>" class="mb30" /><br />
		  <?php endif; ?>
		  <?php the_field('about'); ?>
		  <a href="<?php the_field('website'); ?>" class="btn red-border mt20">Project website</a>
		  </div>
		  </div>

		  <div class="row mt70">
		  <div class="small-12 large-2 columns sidebar">
		  <h2>Useful<br />info</h2>
		  </div>
		  <div class="small-12 large-9 columns large-offset-1 large-pt10">
		  <div class="row">
		  <div class="small-6 columns useful-info">
		  <?php the_field('useful_info'); ?>
		  </div>
		  <div class="small-6 columns useful-info">
		  <?php
		  $techs = wp_get_post_terms(get_the_ID(), 'filter');
		  $ret = '';
		  foreach ($techs as $tech):
		  if ($tech->parent == 4):

		  $ret .= '<a href="http://transparencee.org/content-type/all/country/all/org/all/technology/' . $tech->slug . '/topic/all/#list" class="btn blue-border smaller mt10">' . $tech->name . '</a>';
		  endif;
		  ?>
		  <?php endforeach; ?>
		  <?php if (!empty($ret)): ?>
		  <h3>Technology</h3>
		  <?php echo $ret; ?><br class="clear" />
		  <?php endif; ?> &nbsp;
		  <?php
		  $topics = wp_get_post_terms(get_the_ID(), 'filter');
		  $ret = '';
		  foreach ($topics as $topic):
		  if ($topic->parent == 5):

		  $ret .= '<a href="http://transparencee.org/content-type/all/country/all/org/all/technology/all/topic/' . $topic->slug . '/#list" class="btn blue-border smaller mt10">' . $topic->name . '</a>';
		  endif;
		  ?>
		  <?php endforeach; ?>
		  <?php if (!empty($ret)): ?>
		  <h3>Topics</h3>
		  <?php echo $ret; ?>
		  <?php endif; ?> &nbsp;
		  <?php /*
		  <h3 class="mt30">Content</h3>
		  <p><?php the_field('content'); ?></p>
		  </div>
		  </div>
		  </div>
		  </div>

		  <?php
		  $org = get_field('deployed_by');

		  if (is_array($org)):
		  ?>
		  <div class="row mt70">
		  <div class="small-12 large-2 columns sidebar">
		  <h2>Deployed<br />by</h2>
		  </div>
		  <div class="small-12 large-9 columns large-offset-1 large-pt10">
		  <ul class="small-block-grid-1 medium-block-grid-3">
		  <?php foreach ($org as $post): ?>
		  <?php setup_postdata($post); ?>
		  <?php
		  global $more;
		  $more = 0;
		  the_content();
		  ?>
		  <li>
		  <div class="post-block">
		  <div class="pb-wrapper">
		  <h3><?php the_title(); ?></h3>
		  <div class="excerpt"><?php echo acf_excerpt(get_field('about')); ?></div>
		  </div>
		  <a href="<?php the_permalink(); ?>" class="btn red-border smaller mt10">learn more</a>
		  </div>
		  </li>
		  <?php endforeach; ?>
		  <?php wp_reset_postdata(); ?>
		  </ul>
		  </div>
		  </div>
		  <?php endif; ?>
		  </section>
		  <?php
		  $org = get_field('others');

		  if (is_array($org)):
		  ?>
		  <section class="others-wrapper">
		  <div class="content-wrapper">
		  <div class="row">
		  <div class="small-12 large-2 columns sidebar">
		  <h2>Other<br />projects</h2>
		  </div>
		  <div class="small-12 large-9 columns large-offset-1 large-pt10">
		  <ul class="small-block-grid-1 medium-block-grid-3">
		  <?php foreach ($org as $post): ?>
		  <?php setup_postdata($post); ?>
		  <li>
		  <div class="post-block">
		  <div class="pb-wrapper">
		  <h3><?php the_title(); ?></h3>
		  <div class="excerpt"><?php echo acf_excerpt(get_field('about')); ?></div>
		  </div>
		  <a href="<?php the_permalink(); ?>" class="btn red-border smaller mt10">learn more</a>
		  </div>
		  </li>
		  <?php endforeach; ?>
		  <?php wp_reset_postdata(); ?>
		  </ul>
		  </div>
		  </div>
		  </div>
		  </section>
		  <?php else: ?>
		  <?php
		  $args = array(
		  'post_type' => 'project',
		  'posts_per_page' => 3,
		  'orderby' => 'rand',
		  'post__not_in' => array(get_the_ID())
		  );
		  $query = new WP_Query($args);
		  if ($query->found_posts > 0):
		  ?>
		  <section class="others-wrapper">
		  <div class="content-wrapper">
		  <div class="row">
		  <div class="small-12 large-2 columns sidebar">
		  <h2>Other<br />projects</h2>
		  </div>
		  <div class="small-12 large-9 columns large-offset-1 large-pt10">
		  <ul class="small-block-grid-1 medium-block-grid-3">

		  <?php
		  while ($query->have_posts()) : $query->the_post();
		  ?>
		  <li>
		  <div class="post-block">
		  <div class="pb-wrapper">
		  <h3><?php the_title(); ?></h3>
		  <div class="excerpt"><?php echo acf_excerpt(get_field('about')); ?></div>
		  </div>
		  <a href="<?php the_permalink(); ?>" class="btn red-border smaller mt10">learn more</a>
		  </div>
		  </li>
		  <?php endwhile; ?>
		  <?php wp_reset_postdata(); ?>
		  </ul>
		  </div>
		  </div>
		  </div>
		  </section>
		  <?php endif; ?>
		  <?php endif; ?> */ ?>
	<?php endwhile; ?>
<?php endif; ?>


<?php get_footer() ?>
