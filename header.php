<?php
$src = get_template_directory_uri();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<title><?php
			global $page, $paged;

			wp_title('|', true, 'right');

			bloginfo('name');

			$site_description = get_bloginfo('description', 'display');
			if ($site_description && ( is_home() || is_front_page() ))
				echo " | $site_description";
			?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900" rel="stylesheet">  
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo $src ?>/css/bootstrap-theme.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo $src ?>/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo $src ?>/css/style.css?v=1.07" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<link rel="icon" href="<?php echo $src ?>/images/favicon.png" type="image/png"/>
		<!--[if lt IE 9]>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
		<![endif]-->
		<?php
		if (is_singular() && get_option('thread_comments'))
			wp_enqueue_script('comment-reply');


		wp_head();
		?>
		<?php
		global $post;
		$posttype = get_post_type($post);
		$fbimg = get_field('facebook_image', $post->ID);
		if ($fbimg):
			?>
			<meta property="og:image" content="<?php echo $fbimg['url']; ?>" />
			<?php
		else:
			if ($posttype == 'event' || $posttype == 'project' || $posttype == 'organization'):

				$logo = get_field('logo');
				if ($logo):
					?>
					<meta property="og:image" content="<?php echo $logo['url']; ?>" />
					<?php
				endif;
			elseif ($posttype == 'person'):
				$photo = get_field('photo');
				if ($photo):
					?>
					<meta property="og:image" content="<?php echo $photo['url']; ?>" />
					<?php
				endif;
			endif;
			?>
		<?php endif; ?>

		<script>
			var src = '<?php echo $src; ?>',
							home_url = '<?php echo home_url(); ?>',
							country = '<?php echo sanitize_title(urldecode(get_query_var('country', 'all'))); ?>',
							topic = '<?php echo get_query_var('topic', 'all'); ?>',
							type = '<?php echo get_query_var('type', 'all'); ?>';

		</script>
		<script src="<?php echo $src ?>/js/jquery-3.1.0.min.js"></script>
		<script src="<?php echo $src ?>/js/bootstrap.min.js"></script>
		<script src="<?php echo $src ?>/js/script.js?v=1.01"></script>
	</head>


	<body <?php body_class(); ?> >

		<div id="menu-header">
			<div class="content">
				<div class="wrap">

					<div class="logo">
						<a href="<?php echo home_url(); ?>">
							<img src="<?php echo $src; ?>/img/transparencee-logo.svg" alt="">
						</a>  
					</div>

					<div class="menu-navigation">

						<?php echo wp_nav_menu(array('theme_location' => 'primary', 'items_wrap' => trans_nav_wrap($src))); ?>

						<?php /*
						  <ul>
						  <li>
						  <a href="scaling.php">SCALING</a>
						  </li>
						  <li>
						  <a href="events.php">EVENTS</a>
						  </li>
						  <li>
						  <a href="community.php">COMMUNITY</a>
						  </li>
						  <li>
						  <a href="resources.php">Resources</a>
						  </li>
						  <li>
						  <a href="about.php">ABOUT</a>
						  </li>
						  <li>
						  <a href="">REPORT'16</a>
						  </li>
						  <li>
						  <a href="contact.php">JOIN US</a>
						  </li>
						  <li class="search">
						  <div class="search-input">
						  <input type="text">
						  </div>
						  <a href=""><img src="<?php echo $src; ?>/img/search-icon.svg" alt=""></a>
						  </li>
						  </ul>
						 * 
						 * 
						 */ ?>



					</div>

					<div class="menu-open" onClick="">
						<div class="line-1"></div>
						<div class="line-2"></div>
						<div class="line-3"></div>
					</div>

				</div>
			</div>
		</div>


		<div class="global-container"> 

