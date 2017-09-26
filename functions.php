<?php

require_once('engine/main.php');
add_theme_support('post-thumbnails');

//add_image_size( 'homepage-standard', 200, 0, true );
add_image_size('home-event', 600, 400, true);
add_image_size('event', 538, 359, array('center', 'center'));
add_image_size('member', 250, 250, array('center', 'top'));
add_image_size('home-box', 300, 200, array('center', 'top'));


engine_register_post_type('Events', 'event', array('title'), true);
engine_register_post_type('Tools', 'project', array('title'), true);
engine_register_post_type('News', 'news', array('title'), true);
engine_register_post_type('Analysis', 'article', array('title'), true, 'analysis');
engine_register_post_type('People', 'person', array('title'), true);
engine_register_post_type('Community', 'organization', array('title'), true);
engine_register_post_type('Scaled tool', 'scaled-tool', array('title'), true);

engine_register_taxonomy('Filters', 'filter', array('event', 'project', 'tool', 'news', 'organization', 'person'));
engine_register_taxonomy('Sections', 'section', array('article'));

register_nav_menu('primary', 'Menu');


show_admin_bar(false);

function in_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

add_filter('upload_mimes', 'in_mime_types');

function tc_get_query_var($var) {
	if (get_query_var($var) == '')
		return 'all';
	else
		return get_query_var($var);
}

function url_change($new_value, $parameter) {
	$base = home_url();

	if ($parameter == 'content-type') {
		return $base . '/content-type/' . $new_value . '/country/' . tc_get_query_var('country') . '/org/' . tc_get_query_var('org') . '/technology/' . tc_get_query_var('technology') . '/topic/' . tc_get_query_var('topic') . '/';
	} elseif ($parameter == 'country') {
		return $base . '/content-type/' . tc_get_query_var('content-type') . '/country/' . $new_value . '/org/' . tc_get_query_var('org') . '/technology/' . tc_get_query_var('technology') . '/topic/' . tc_get_query_var('topic') . '/';
	} elseif ($parameter == 'org' || $parameter == 'organization') {
		return $base . '/content-type/' . tc_get_query_var('content-type') . '/country/' . tc_get_query_var('country') . '/org/' . $new_value . '/technology/' . tc_get_query_var('technology') . '/topic/' . tc_get_query_var('topic') . '/';
	} elseif ($parameter == 'technology') {
		return $base . '/content-type/' . tc_get_query_var('content-type') . '/country/' . tc_get_query_var('country') . '/org/' . tc_get_query_var('org') . '/technology/' . $new_value . '/topic/' . tc_get_query_var('topic') . '/';
	} elseif ($parameter == 'topic') {
		return $base . '/content-type/' . tc_get_query_var('content-type') . '/country/' . tc_get_query_var('country') . '/org/' . tc_get_query_var('org') . '/technology/' . tc_get_query_var('technology') . '/topic/' . $new_value . '/';
	}
}

function tc_rewrite() {
	add_rewrite_rule('^content-type/([^/]*)/country/([^/]*)/organization/([^/]*)/technology/([^/]*)/topic/([^/]*)/?', 'index.php?page_id=6&content-type=$matches[1]&country=$matches[2]&organization=$matches[3]&technology=$matches[4]&topic=$matches[5]', 'top');
	add_rewrite_rule('^content-type/([^/]*)/country/([^/]*)/org/([^/]*)/technology/([^/]*)/topic/([^/]*)/page/([^/]*)/?', 'index.php?page_id=6&content-type=$matches[1]&country=$matches[2]&org=$matches[3]&technology=$matches[4]&topic=$matches[5]&page=$matches[6]', 'top');
	add_rewrite_rule('^content-type/([^/]*)/country/([^/]*)/org/([^/]*)/technology/([^/]*)/topic/([^/]*)/?', 'index.php?page_id=6&content-type=$matches[1]&country=$matches[2]&org=$matches[3]&technology=$matches[4]&topic=$matches[5]', 'top');
	add_rewrite_rule('^community/country/([^/]*)/topic/([^/]*)/type/([^/]*)/?', 'index.php?page_id=10&country=$matches[1]&topic=$matches[2]&type=$matches[3]', 'top');
}

add_action('init', 'tc_rewrite');

function tc_rewrite_tag() {
	add_rewrite_tag('%content-type%', '([^&]+)');
	add_rewrite_tag('%country%', '([^&]+)');
	add_rewrite_tag('%org%', '([^&]+)');
	add_rewrite_tag('%technology%', '([^&]+)');
	add_rewrite_tag('%topic%', '([^&]+)');
	add_rewrite_tag('%type%', '([^&]+)');
	add_rewrite_tag('%page%', '([^&]+)');
}

add_action('init', 'tc_rewrite_tag', 10, 0);

function tc_get_post_type() {
	$ret = get_post_type();
	if ($ret == 'organization') {
		return 'community';
	}
	if ($ret == 'article') {
		return 'analysis';
	} else {
		return $ret;
	}
}

function acf_excerpt($text) {
	$t = explode('<!--more-->', $text);
	return force_balance_tags($t[0]);
}

function trans_nav_wrap($src) {
	$wrap = '<ul id="%1$s" class="%2$s">';
	$wrap .= '%3$s';
	$wrap .= '<li class="search">
								<div class="search-input">
								<form method="GET" action="' . get_permalink(1539) . '">
									<input type="text" name="search">
								</form>
								</div>
								<a href=""><img src="' . $src . '/img/search-icon.svg" alt=""></a>
							</li>';
	$wrap .= '</ul>';
	return $wrap;
}

function trans_first_paragraph($content) {
	global $post;
	if ('article' == get_post_type() || 'scaled-tool' == get_post_type()) {
		return preg_replace('/<p([^>]+)?>/', '<p$1 class="lead">', $content, 1);
	} else {
		return $content;
	}
}

add_filter('the_content', 'trans_first_paragraph');
