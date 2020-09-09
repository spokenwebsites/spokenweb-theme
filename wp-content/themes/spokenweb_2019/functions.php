<?php

  //include_once( TEMPLATEPATH . '/functions/post-types.php');


	// Add post thumbnails if possible
	if ( function_exists( 'add_theme_support' ) ) { add_theme_support( 'post-thumbnails' );  }

	// add_image_size( 'bio-square', 500, 500, array( 'center', 'center' ) );

	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');

	function get_current_user_role() {
		global $wp_roles;
		$current_user = wp_get_current_user();
		$roles = $current_user->roles;
		$role = array_shift($roles);
		return isset($wp_roles->role_names[$role]) ? strtolower( translate_user_role($wp_roles->role_names[$role] ) ) : false;
	}

	function is_user_subscriber() {
		return ( strcmp("subscriber", get_current_user_role() ) == 0);
	}

  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation'),
  ));

	add_action( 'init', 'my_add_excerpts_to_pages' );
	function my_add_excerpts_to_pages() {
	     add_post_type_support( 'page', 'excerpt' );
	}

	add_filter('upload_mimes','add_custom_mime_types');
		function add_custom_mime_types($mimes){
			return array_merge($mimes,array (
				'json' => 'application/json'
			));
		}

		class Bootstrap_Walker_Menu_Nav extends Walker_Nav_Menu {

		   function start_lvl(&$output, $depth = 0, $args = array()) {
		      $output .= "\n<ul class=\"dropdown-menu\">\n";
		   }

		   function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		       $item_html = '';
		       parent::start_el($item_html, $item, $depth, $args);

		       if ( $item->is_dropdown && $depth === 0 ) {
		           $item_html = str_replace( '<a', '<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"', $item_html );
		           //$item_html = str_replace( '</a>', ' <b class="caret"></b></a>', $item_html );
		       }

		       $output .= $item_html;
		    }

		    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
		        if ( $element->current )
		        $element->classes[] = 'active';

		        $element->is_dropdown = !empty( $children_elements[$element->ID] );

		        if ( $element->is_dropdown ) {
		            if ( $depth === 0 ) {
		                $element->classes[] = 'dropdown';
		            } elseif ( $depth === 1 ) {
		                // Extra level of dropdown menu,
		                // as seen in http://twitter.github.com/bootstrap/components.html#dropdowns
		                $element->classes[] = 'dropdown-submenu';
		            }
		        }

		    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
		    }
		}

		function add_classes_on_li($classes, $item, $args) {
		  $classes[] = 'nav-item';
		  return $classes;
		}
		add_filter('nav_menu_css_class','add_classes_on_li',1,3);

		function add_link_atts($atts) {
		  $atts['class'] = "nav-link";
		  return $atts;
		}
		add_filter( 'nav_menu_link_attributes', 'add_link_atts');

		add_filter ('get_archives_link',
		function ($link_html, $url, $text, $format, $before, $after) {
		    if ('bootstrap' == $format) {
		        $link_html = "<a class='dropdown-item' href='$url'><span>$text</span></a>";
		    }
		    return $link_html;
		}, 10, 6);

    function has_parent() {
    	global $post;
    	if ( $post->post_parent ) {
    		return true;
    	} else {
    		return false;
    	}
    }

    function has_children() {
      global $post;

      $pages = get_pages('child_of=' . $post->ID);

      return count($pages);
    }

    function create_events_post_type() {
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
    add_action( 'init', 'create_events_post_type', 0 );

    function create_team_post_type() {
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
    add_action( 'init', 'create_team_post_type', 0 );

    function create_taskforces_post_type() {
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
    add_action( 'init', 'create_taskforces_post_type', 0 );

    function create_collections_post_type() {
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
    add_action( 'init', 'create_collections_post_type', 0 );

		function create_publications_post_type() {
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
		add_action( 'init', 'create_publications_post_type', 0 );

    function create_toolkits_post_type() {
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
    add_action( 'init', 'create_toolkits_post_type', 0 );

		function create_podcast_post_type() {
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
    add_action( 'init', 'create_podcast_post_type', 0 );

    function my_post_count_queries( $query ) {
      if (!is_admin() && $query->is_main_query()){
        if(is_home()){
           $query->set('posts_per_page', 1);
        }
      }
    }
    add_action( 'pre_get_posts', 'my_post_count_queries' );


    function fix_blog_menu_css_class( $classes, $item ) {
        if ( is_singular( 'events' ) || is_archive()) {
            if ( $item->object_id == get_option('page_for_posts') ) {
                $key = array_search( 'current_page_parent', $classes );
                if ( false !== $key )
                    unset( $classes[ $key ] );
            }
        }

        return $classes;
    }
    add_filter( 'nav_menu_css_class', 'fix_blog_menu_css_class', 10, 2 );



    function namespace_add_custom_types( $query ) {
      if( (is_category() || is_tag()) && $query->is_archive() && empty( $query->query_vars['suppress_filters'] ) ) {
        $query->set( 'post_type', array(
         'post', 'events'
            ));
        }
        return $query;
    }
    add_filter( 'pre_get_posts', 'namespace_add_custom_types' );

    //Remove JQuery migrate

    function remove_jquery_migrate($scripts) { if (!is_admin() && isset($scripts->registered['jquery'])) { $script = $scripts->registered['jquery']; if ($script->deps) {
      // Check whether the script has any dependencies
      $script->deps = array_diff($script->deps, array( 'jquery-migrate' )); } } } add_action('wp_default_scripts', 'remove_jquery_migrate');


			function events_all( $data ) {

				if (isset($_GET['offset'])) $offset = $_GET['offset'];
				else $offset = 0;
				$args = array ('post_type'=>'events', 'posts_per_page'=>1000, 'offset'=>$offset);

				$post_query = new WP_Query($args);

				if ($post_query->have_posts()) {

					$data = array();

					while ($post_query->have_posts()) {
						$post_query->the_post();
						global $post;
						$post_custom_fields = get_post_custom( $post->ID );

						// $ curl http://localhost/spokenweb/wp-json/events/all | jq ' | [.title, .date_start, .date_end, .city, .institution, .venue, .categories, .tags]'
						//
						// $ cat sampleOrder.json | jq '.order | [.id, .email, .phone, .billing_address, .shipping_address, .line_items]'

						$title = $post->post_title;
						$date_start = str_replace("/", "-", $post_custom_fields['event_start'][0]);
						$date_end = str_replace("/", "-", $post_custom_fields['event_end'][0]);
						$city = $post_custom_fields['city'][0];
						$institution = $post_custom_fields['institution'][0];
						$venue = $post_custom_fields['venue'][0];
						$categories = get_the_category();
						$tags = get_the_tags();
						$tag_names = array();
						$category_names = array();
						$categories_string = "";
						$categories_string = "";

						if ($categories) {
							foreach($categories as $category) {
								$category_names[] = $category->name;
							}
							if (isset($category_names)) $categories_string = implode(", ", $category_names);
						}

						if ($tags) {
					  	foreach($tags as $tag) {
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

			add_action( 'rest_api_init', function() {
				register_rest_route( 'events', '/all', array(
					'methods' => 'GET',
					'callback' => 'events_all',
				));
			});


?>
