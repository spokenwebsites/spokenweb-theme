<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php if (is_search()) :
    $s = (get_query_var('s')) ? esc_html(get_query_var('s')) : '';
  ?>
    <meta name="robots" content="noindex, nofollow" />
  <?php endif; ?>

  <title><?php wp_title(''); ?></title>

  <meta name="title" content="<?php wp_title(''); ?>">

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#893025">
  <meta name="msapplication-TileColor" content="#f4f4f4">
  <meta name="theme-color" content="#f4f4f4">

  <link rel="stylesheet" href="https://use.typekit.net/rmr6mit.css">

  <!-- CSS: screen, mobile & print are all in the same file -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="<?php bloginfo('template_directory'); ?>/_/inc/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/_/js/jquery.fancybox.min.css" type="text/css" media="screen" title="no title" charset="utf-8">

  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/_/js/mediaelementjs/mediaelementplayer.min.css">

  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css?v=1.99">

  <?php if (is_page('spokenweb')) : ?>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/_/css/about.css?v=1.1"><?php endif; ?>

  <?php if (get_post_type() == 'podcast') $podcast_type = get_post_meta($post->ID, $key = 'type', true); ?>
  <?php if (!is_page('shortcuts') && $podcast_type != "ShortCuts" && (is_page('podcast') || get_post_type() == 'podcast' || get_post($post->post_parent)->post_name == 'podcast')) : ?>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/_/css/podcast.css?v=1.2"><?php endif; ?>
  <?php if (is_page('shortcuts') || $podcast_type == "ShortCuts") : ?>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/_/css/shortcuts.css?v=1.2"><?php endif; ?>
  <?php if (is_category() && (get_queried_object()->slug == "institutes" || get_queried_object()->slug == "institutes")) : ?>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/_/css/institutes.css"><?php endif; ?>
  <?php if (is_category() && (get_queried_object()->slug == "symposia" || get_queried_object()->slug == "symposia")) : ?>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/_/css/symposia.css"><?php endif; ?>
  <?php if (is_category() && (get_queried_object()->slug == "audio-of-the-week" || get_queried_object()->slug == "shortcuts" || get_queried_object()->slug == "spokenweblog")) : ?>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/_/css/spokenweblog.css?v=1.1"><?php endif; ?>

  <?php if (is_single() && (has_category("audio-of-the-week") || has_category("shortcuts") || has_category("spokenweblog"))) : ?>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/_/css/spokenweblog.css?v=1.1"><?php endif; ?>

  <?php if (is_page('about-us') || get_post($post->post_parent)->post_name == 'about-us') $header_class = 'about_bg'; ?>
  <?php if (is_archive() || is_home() || is_singular('post') || is_page('about-swb')) $header_class = 'news_bg'; ?>
  <?php if (is_page('research') || get_post($post->post_parent)->post_name == 'research') $header_class = 'research_bg'; ?>
  <?php if (is_page('podcast') || get_post_type() == 'podcast' || get_post($post->post_parent)->post_name == 'podcast') $header_class = 'podcast_bg'; ?>
  <?php if (is_page('shortcuts') || $podcast_type == "ShortCuts") $header_class = 'shortcuts_bg'; ?>
  <?php if (is_page('events') || is_page('past-events') || is_singular('events')) $header_class = 'events_bg'; ?>
  <?php if (is_page('pedagogy-training') || get_post($post->post_parent)->post_name == 'pedagogy-training') $header_class = 'training_bg'; ?>
  <?php if (is_category() && (get_queried_object()->slug == "symposia" || get_queried_object()->slug == "symposia")) $header_class = 'events_bg'; ?>
  <?php if (is_category() && (get_queried_object()->slug == "institutes" || get_queried_object()->slug == "institutes")) $header_class = 'events_bg'; ?>


  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

  <?php wp_head(); ?>

</head>

<body <?php body_class("$header_class noscroll"); ?>>
  <p>STAGING!</p>
  <header id="header">

    <nav class="navbar navbar-expand-lg navbar-main">
      <a class="navbar-brand" href="<?php echo home_url(); ?>">
        <div id="header_logo"></div>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="navbar" class="collapse navbar-collapse">
        <?php wp_nav_menu(array('menu' => 'Primary Navigation', 'container' => false, 'container-fluid' => false, 'menu_class' => 'nav mr-auto navbar-nav', 'link_before' => '<span>', 'link_after' => '</span>', 'add_li_class' => 'nav-item', 'walker' => new Bootstrap_Walker_Menu_Nav())); ?>
        <?php get_search_form(); ?>
      </div>
    </nav>

  </header>

  <?php wp_reset_query(); ?>

  <div id="loader">
    <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>

  <div id="content" style="opacity:0;">

    <?php if (is_front_page()) : ?>
      <div id="bg"></div>
    <?php elseif ($pagename == "events" || is_page('spokenweb') || is_page('about-swb') || $pagename == "past-events" ||  is_singular('events') ||  is_singular('post') || is_page('podcast') || get_post_type() == 'podcast' || get_post($post->post_parent)->post_name == 'podcast') : ?>
    <?php elseif (is_category() && (get_queried_object()->slug == "audio-of-the-week" || get_queried_object()->slug == "shortcuts" || get_queried_object()->slug == "spokenweblog" || get_queried_object()->slug == "institutes" || get_queried_object()->slug == "symposia")) : ?>
    <?php else : ?>
      <section class="container-fluid">
      <?php endif; ?>