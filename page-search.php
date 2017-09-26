<?php
/*
 * Template name: Search results
 */
?>
<?php get_header() ?>
<?php
$src = get_template_directory_uri();
$today = date('Ymd');
$search = $_GET['search'];
?>



<div class="article-header section orange">
	<div class="content">
		<div class="wrap">
			<div class="article-title-container">
				<div class="article-title-center">
					<h1>Search results for:<br /><?php echo $search; ?></h1>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="section events-list">
	<div class="content">  

		<?php
		$args2 = array(
				'post_type' => array('event', 'article', 'project', 'organization', 'scaled-tool'),
				'posts_per_page' => 999,
				's' => $search,
				'fields' => 'ids'
		);
		$query2 = new WP_Query($args2);
		
		$args3 = array(
				'post_type' => array('event', 'article', 'project', 'organization', 'scaled-tool'),
				'posts_per_page' => 999,
				'meta_query' => array(
						'relation' => 'OR',
						array(
								'key' => 'oneliner',
								'value' => $search,
								'compare' => 'LIKE'
						),
						array(
								'key' => 'about',
								'value' => $search,
								'compare' => 'LIKE'
						),
						array(
								'key' => 'text',
								'value' => $search,
								'compare' => 'LIKE'
						),
						array(
								'key' => 'subtitle',
								'value' => $search,
								'compare' => 'LIKE'
						)
				),
				'fields' => 'ids'
		);
		$query3 = new WP_Query($args3);
		$ids = array_merge($query2->posts, $query3->posts);

		$args = array(
				'post_type' => array('event', 'article', 'project', 'organization', 'scaled-tool'),
				'posts_per_page' => 10,
				'post__in' => $ids,
				'paged' => get_query_var('paged', 1)
		);
		$query = new WP_Query($args);
		if ($query->have_posts()):
			?>
			<div class="upcoming-events">  
				<?php
				while ($query->have_posts()): $query->the_post();
					$post_type = get_post_type();
					$more = get_the_permalink();
					$img = '';
					if ($post_type == 'event') {
						$img = get_field('photo');
						if (empty($img)) {
							$img = get_field('logo');
						}
						$more = get_field('website');
						$type = 'Event:';
						$text = get_field('about_new');
					} elseif ($post_type == 'project') {
						$img = get_field('project_logo');
						$type = 'Tool:';
						$text = get_field('oneliner');
					} elseif ($post_type == 'scaled-tool') {
						$img = get_field('listing_photo');
						$type = 'Scaling:';
					} elseif ($post_type == 'organization') {
						$img = get_field('logo');
						$type = 'Organisation:';
						$text = get_field('oneliner');
					} elseif ($post_type == 'article') {
						//$img = get_field('logo');
						$type = 'Resources: ';
						$text = get_field('subtitle');
					}
					?> 
					<div class="upcoming-event">    
						<div class="wrap">
							<div class="image-col">
								<?php if ($img): ?>
									<a href="<?php echo $more; ?>" class="image-link">
										<img src="<?php echo $img['sizes']['large']; ?>" alt="<?php the_title(); ?>">
									</a>
								<?php endif; ?>
							</div>
							<div class="title-col">
								<a class="title-link" href="<?php echo $more; ?>"><h2><span class="post-type"><?php echo $type; ?></span> <?php the_title(); ?></h2></a>
								<div class="event-desciption"><?php echo $text; ?></div>
								<a href="<?php echo $more; ?>" class="button">more</a>
							</div>
						</div>
					</div>
					<?php
				endwhile;
				?>
			</div>
			<div class="pager">
				<?php
				$big = 999999999;
				echo paginate_links(array(
						'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
						'format' => '?paged=%#%',
						'current' => max(1, get_query_var('paged')),
						'total' => $query->max_num_pages,
						'prev_text' => ' ',
						'next_text' => ' '
				));
				?> 
			</div>

			<?php
			wp_reset_postdata();
		else:
			?>
			No results found
		<?php
		endif;
		?>

	</div>          
</div>


<?php get_footer() ?>
