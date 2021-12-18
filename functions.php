<?php
// Add post thumbnails if possible
if (function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');
}
// Clean up the <head>
function removeHeadLinks()
{
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');

function get_current_user_role()
{
	global $wp_roles;
	$current_user = wp_get_current_user();
	$roles = $current_user->roles;
	$role = array_shift($roles);
	return isset($wp_roles->role_names[$role]) ? strtolower(translate_user_role($wp_roles->role_names[$role])) : false;
}

function is_user_subscriber()
{
	return (strcmp("subscriber", get_current_user_role()) == 0);
}

register_nav_menus(array(
	'primary_navigation' => __('Primary Navigation'),
));

add_action('init', 'my_add_excerpts_to_pages');
function my_add_excerpts_to_pages()
{
	add_post_type_support('page', 'excerpt');
}

add_filter('upload_mimes', 'add_custom_mime_types');
function add_custom_mime_types($mimes)
{
	return array_merge($mimes, array(
		'json' => 'application/json'
	));
}

class Bootstrap_Walker_Menu_Nav extends Walker_Nav_Menu
{

	function start_lvl(&$output, $depth = 0, $args = array())
	{
		$output .= "\n<ul class=\"dropdown-menu\">\n";
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
	{
		$item_html = '';
		parent::start_el($item_html, $item, $depth, $args);

		if ($item->is_dropdown && $depth === 0) {
			$item_html = str_replace('<a', '<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"', $item_html);
		}

		$output .= $item_html;
	}

	function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
	{
		if ($element->current)
			$element->classes[] = 'active';

		$element->is_dropdown = !empty($children_elements[$element->ID]);

		if ($element->is_dropdown) {
			if ($depth === 0) {
				$element->classes[] = 'dropdown';
			} elseif ($depth === 1) {
				// Extra level of dropdown menu,
				// as seen in http://twitter.github.com/bootstrap/components.html#dropdowns
				$element->classes[] = 'dropdown-submenu';
			}
		}

		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}

function add_classes_on_li($classes, $item, $args)
{
	$classes[] = 'nav-item';
	return $classes;
}
add_filter('nav_menu_css_class', 'add_classes_on_li', 1, 3);

function add_link_atts($atts)
{
	$atts['class'] = "nav-link";
	return $atts;
}
add_filter('nav_menu_link_attributes', 'add_link_atts');

add_filter(
	'get_archives_link',
	function ($link_html, $url, $text, $format, $before, $after) {
		if ('bootstrap' == $format) {
			$link_html = "<a class='dropdown-item' href='$url'><span>$text</span></a>";
		}
		return $link_html;
	},
	10,
	6
);

function has_parent()
{
	global $post;
	if ($post->post_parent) {
		return true;
	} else {
		return false;
	}
}

function has_children()
{
	global $post;

	$pages = get_pages('child_of=' . $post->ID);

	return count($pages);
}

function create_events_post_type()
{
	// Custom post: Events
	register_post_type('events', array(
		'label' => __('Events'),
		'singular_name' => __('Event'),
		'public' => true, // allows it to be publicly queryable
		'show_ui' => true, // displays the post time in the Admin Interface
		'menu_position' => 25,
		'capability_type' => 'post',
		'hierarchical' => false,
		'taxonomies' => array('post_tag', 'category'),
		'rewrite' => array("slug" => "events", "with_front" => false), // the slug for permalinks
		'supports' => array('title', 'revisions', 'excerpt', 'thumbnail', 'editor') // What can this post type do
	));
}
add_action('init', 'create_events_post_type', 0);

function create_team_post_type()
{
	// Custom post: Team
	register_post_type('team', array(
		'label' => __('Team'),
		'singular_name' => __('Team'),
		'public' => false, // allows it to be publicly queryable
		'exclude_from_search' => true,
		'show_ui' => true, // displays the post time in the Admin Interface
		'menu_position' => 25,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array("slug" => "team", "with_front" => false), // the slug for permalinks
		'supports' => array('title', 'revisions', 'thumbnail', 'editor') // What can this post type do
	));
}
add_action('init', 'create_team_post_type', 0);

function create_taskforces_post_type()
{
	// Custom post: Team
	register_post_type('taskforces', array(
		'label' => __('Task Forces'),
		'singular_name' => __('Task Force'),
		'public' => false, // allows it to be publicly queryable
		'exclude_from_search' => true,
		'show_ui' => true, // displays the post time in the Admin Interface
		'menu_position' => 25,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array("slug" => "task-forces", "with_front" => false), // the slug for permalinks
		'supports' => array('title', 'revisions', 'thumbnail', 'editor') // What can this post type do
	));
}
add_action('init', 'create_taskforces_post_type', 0);

function create_collections_post_type()
{
	// Custom post: Collections
	register_post_type('collections', array(
		'label' => __('Collections'),
		'singular_name' => __('Collection'),
		'public' => false, // allows it to be publicly queryable
		'exclude_from_search' => true,
		'show_ui' => true, // displays the post time in the Admin Interface
		'menu_position' => 25,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array("slug" => "collections", "with_front" => false), // the slug for permalinks
		'supports' => array('title', 'revisions', 'thumbnail', 'editor') // What can this post type do
	));
}
add_action('init', 'create_collections_post_type', 0);

function create_publications_post_type()
{
	// Custom post: Publications
	register_post_type('publications', array(
		'label' => __('Publications'),
		'singular_name' => __('Publication'),
		'public' => false, // allows it to be publicly queryable
		'exclude_from_search' => true,
		'show_ui' => true, // displays the post time in the Admin Interface
		'menu_position' => 25,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array("slug" => "publications", "with_front" => false), // the slug for permalinks
		'supports' => array('title', 'revisions', 'thumbnail', 'editor') // What can this post type do
	));
}
add_action('init', 'create_publications_post_type', 0);

function create_toolkits_post_type()
{
	// Custom post: Toolkits
	register_post_type('toolkits', array(
		'label' => __('Toolkits'),
		'singular_name' => __('Toolkit'),
		'public' => false, // allows it to be publicly queryable
		'exclude_from_search' => true,
		'show_ui' => true, // displays the post time in the Admin Interface
		'menu_position' => 25,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array("slug" => "toolkits", "with_front" => false), // the slug for permalinks
		'supports' => array('title', 'revisions', 'thumbnail', 'editor') // What can this post type do
	));
}
add_action('init', 'create_toolkits_post_type', 0);

function create_podcast_post_type()
{
	// Custom post: Podcast
	register_post_type('podcast', array(
		'label' => __('Podcast'),
		'singular_name' => __('Podcast'),
		'public' => true, // allows it to be publicly queryable
		'exclude_from_search' => true,
		'show_ui' => true, // displays the post time in the Admin Interface
		'menu_position' => 25,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array("slug" => "podcast/episodes", "with_front" => false), // the slug for permalinks
		'supports' => array('title', 'revisions', 'thumbnail', 'editor', 'excerpt') // What can this post type do
	));
	flush_rewrite_rules();
}
add_action('init', 'create_podcast_post_type', 0);

function my_post_count_queries($query)
{
	if (!is_admin() && $query->is_main_query()) {
		if (is_home()) {
			$query->set('posts_per_page', 1);
		}
	}
}
add_action('pre_get_posts', 'my_post_count_queries');

function fix_blog_menu_css_class($classes, $item)
{
	if (is_singular('events') || is_archive()) {
		if ($item->object_id == get_option('page_for_posts')) {
			$key = array_search('current_page_parent', $classes);
			if (false !== $key)
				unset($classes[$key]);
		}
	}

	return $classes;
}
add_filter('nav_menu_css_class', 'fix_blog_menu_css_class', 10, 2);

function namespace_add_custom_types($query)
{
	if ((is_category() || is_tag()) && $query->is_archive() && empty($query->query_vars['suppress_filters'])) {
		$query->set('post_type', array(
			'post', 'events'
		));
	}
	return $query;
}
add_filter('pre_get_posts', 'namespace_add_custom_types');

//Remove JQuery migrate
function remove_jquery_migrate($scripts)
{
	if (!is_admin() && isset($scripts->registered['jquery'])) {
		$script = $scripts->registered['jquery'];
		if ($script->deps) {
			// Check whether the script has any dependencies
			$script->deps = array_diff($script->deps, array('jquery-migrate'));
		}
	}
}
add_action('wp_default_scripts', 'remove_jquery_migrate');

function events_all($data)
{
	if (isset($_GET['offset'])) $offset = $_GET['offset'];
	else $offset = 0;
	$args = array('post_type' => 'events', 'posts_per_page' => 1000, 'offset' => $offset);

	$post_query = new WP_Query($args);

	if ($post_query->have_posts()) {

		$data = array();

		while ($post_query->have_posts()) {
			$post_query->the_post();
			global $post;
			$title = $post->post_title;
			$date_start = str_replace("/", "-", get_field('event_start'));
			$date_end = str_replace("/", "-", get_field('event_end'));
			$city = get_field('city');
			$institution = get_field('institution');
			$venue = get_field('venue');
			$categories = get_the_category();
			$tags = get_the_tags();
			$tag_names = array();
			$category_names = array();
			$categories_string = "";
			$categories_string = "";

			if ($categories) {
				foreach ($categories as $category) {
					$category_names[] = $category->name;
				}
				if (isset($category_names)) $categories_string = implode(", ", $category_names);
			}

			if ($tags) {
				foreach ($tags as $tag) {
					$tag_names[] = $tag->name;
				}
				if (isset($tag_names)) $tags_string = implode(", ", $tag_names);
			}

			$data['title'] = $title;
			$data['date_start'] = $date_start;
			$data['date_end'] = $date_end;
			$data['city'] = $city;
			$data['institution'] = $institution;
			$data['venue'] = $venue;
			$data['categories'] = $categories_string;
			$data['tags'] = $tags_string;

			$data_array['events'][] = $data;
		}

		return $data_array;
	}
}

add_action('rest_api_init', function () {
	register_rest_route('events', '/all', array(
		'methods' => 'GET',
		'callback' => 'events_all',
	));
});

/**
 * Removes or edits the 'Protected:' part from posts titles
 */
add_filter('protected_title_format', 'remove_protected_text');
function remove_protected_text()
{
	return '%s';
}

function get_the_symposia_password_form($output)
{
	// If is in the symposia category, replace the text.
	if (in_category('symposia')) {
		return str_replace(
			'This content is password protected. To view it please enter your password below:',
			'Symposium registrants and participants please sign in here for access to private Zoom links and videos:',
			$output
		);
	}

	return $output;
}
add_filter('the_password_form', 'get_the_symposia_password_form');

function generate_excerpt($content, $length = 40, $more = '...')
{
	$excerpt = strip_tags(trim($content));
	$words = str_word_count($excerpt, 2);
	if (count($words) > $length) {
		$words = array_slice($words, 0, $length, true);
		end($words);
		$position = key($words) + strlen(current($words));
		$excerpt = substr($excerpt, 0, $position) . $more;
	}
	return $excerpt;
}

function alt_gallery($output, $attr)
{
	global $post;

	static $instance = 0;
	$instance++;

	if (isset($attr['orderby'])) {
		$attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
		if (!$attr['orderby'])
			unset($attr['orderby']);
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'div',
		'icontag'    => 'div',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ('RAND' == $order)
		$orderby = 'none';

	if (!empty($include)) {
		$include = preg_replace('/[^0-9,]+/', '', $include);
		$_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

		$attachments = array();
		foreach ($_attachments as $key => $val) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif (!empty($exclude)) {
		$exclude = preg_replace('/[^0-9,]+/', '', $exclude);
		$attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
	} else {
		$attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
	}

	if (empty($attachments))
		return '';

	if (is_feed()) {
		$output = "\n";
		foreach ($attachments as $att_id => $attachment)
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100 / $columns) : 100;
	$float = is_rtl() ? 'right' : 'left';
	$width = "100%";
	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	if (apply_filters('use_default_gallery_style', true))
		$size_class = sanitize_html_class($size);
	$gallery_div = "<div id='$selector' class='my-5 row'>";
	$output = apply_filters('gallery_style', $gallery_style . "\n\t\t" . $gallery_div);
	$i = 0;
	foreach ($attachments as $id => $attachment) {
		$thumb = wp_get_attachment_image_src($id, $size);
		$img_full = wp_get_attachment_image_src($id, 'full');
		$caption = wp_get_attachment_caption($id);
		$output .= "<{$itemtag} class='col-lg-4 col-6 gallery-item mb-4'>";
		$output .= "
<a href='{$img_full[0]}' data-caption='{$caption}'><{$icontag} class=''>
<img src='{$thumb[0]}' width='{$width}' />
</{$icontag}></a>";
		$output .= "</{$itemtag}>";
		if ($columns > 0 && ++$i % $columns == 0)
			$output .= '<br style="clear: both" />';
	}
	$output .= "</div>\n";
	return $output;
}
add_filter("post_gallery", "alt_gallery", 10, 2);

add_filter('allowed_http_origins', 'add_allowed_origins');
function add_allowed_origins($origins)
{
	$origins[] = 'https://staging.spokenweb.ca';
	return $origins;
}
