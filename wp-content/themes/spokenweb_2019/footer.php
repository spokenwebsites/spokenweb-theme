    <?php if(is_front_page()):?>
    <?php elseif($pagename=="events" || $pagename=="past-events" ||  is_singular('events') ||  is_singular('post') || is_page('podcast') || get_post_type()=='podcast' || get_post($post->post_parent)->post_name=='podcast'):?>
    <?php elseif(is_category() && (get_queried_object()->slug=="audio-of-the-week" || get_queried_object()->slug=="spokenweblog" || get_queried_object()->slug=="symposia" || get_queried_object()->slug=="institutes")):?>
    <?php else:?>
    </section>
    <?php endif;?>

    <div class="clear"></div>
	</div> <!-- close #content -->

  <?php if (is_single() && (has_category("audio-of-the-week") || has_category("spokenweblog"))):?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
  <?php endif;?>

	<div class="clear"></div>
	<?php
  if (is_page('about-us') || get_post($post->post_parent)->post_name=='about-us' ):
    $footer_class='about_bg'; ?>
  <?php elseif (is_page('research') || get_post_type()=="collections" || get_post($post->post_parent)->post_name=='research'):
    $footer_class='research_bg'; ?>
	<?php elseif (is_page('events') ||  is_page('past-events') || is_singular( 'events')):
    $footer_class='events_bg'; ?>
	<?php elseif (is_page('pedagogy-training') || get_post($post->post_parent)->post_name=='pedagogy-training'):
    $footer_class='training_bg'; ?>
	<?php elseif (is_page('podcast') || get_post_type()=='podcast' || get_post($post->post_parent)->post_name=='podcast'):
    $footer_class='podcast_bg'; ?>
  <?php elseif (is_single() && (has_category("audio-of-the-week") || has_category("spokenweblog"))):
    $pagename = "spokenweblog_single";?>
  <?php elseif (is_category() && (get_queried_object()->slug=="audio-of-the-week")):
    $footer_class='news_bg'; $pagename="audio-of-the-week";?>
  <?php elseif (is_category() && (get_queried_object()->slug=="spokenweblog")):
    $footer_class='news_bg'; $pagename="spokenweblog";?>
  <?php elseif (is_category() && (get_queried_object()->slug=="institutes")):
    $footer_class='events_bg'; $pagename="institutes";?>
  <?php elseif (is_category() && (get_queried_object()->slug=="symposia")):
    $footer_class='events_bg'; $pagename="symposia";?>
	<?php elseif (is_archive() || is_home() || is_singular('post') ):
    $footer_class='news_bg';
  ?>
  <?php endif;?>


	<?php wp_reset_query(); ?>

	<footer id="footer" class="source-org vcard copyright <?php echo $header_class;?>">

		<div class="container">
    <div class="row">
    	<div class="col-sm-2">
        <h2><a href="<?php echo get_permalink(get_page_by_path('about-us/spokenweb'));?>">About Us</a></h2>
        <h2><a href="<?php echo get_permalink(get_page_by_path('contact-us'));?>">Contact Us</a></h2>
        <h2><a href="<?php echo get_permalink(get_page_by_title('Get Involved'));?>">Get Involved</a></h2>
      </div>
    	<div class="col-sm-2">
  			<h2><a href="<?php echo get_permalink(get_page_by_title('Downloads'));?>">Downloads</a></h2>
        <h2><a href="<?php echo get_permalink(get_page_by_title('Submit an Event'));?>">Submit an Event</a></h2>
        <h2><?php wp_loginout(); ?></h2>
      </div>

      <div class="col-sm-3">
        <div class="soc-icons" style="margin-bottom:20px;">
          <a href="https://twitter.com/SpokenWebCanada" target="_blank"><i class="fab fa-twitter-square"></i></a>
          <a href="https://www.instagram.com/spokenweb/" target="_blank"><i class="fab fa-instagram"></i></a>
          <a href="https://www.facebook.com/SpokenWeb-339287580136294/" target="_blank"><i class="fab fa-facebook"></i></a>
          <a href="https://www.youtube.com/channel/UCK2hH-Xmr6SxSKbqyeagLkA" target="_blank"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
			<div class="col-sm-5">

				<p>SpokenWeb is a SSHRC-funded partnership grant.</p>
				<p>All material that appears on this website is  used for the purposes of academic research and critical study.</p>
        <p style="margin-top:8px;">
          <?php if ($footer_class=="research_bg" || $footer_class=="training_bg" || $footer_class=="podcast_bg"):?>
					<div><a alt="SSHRC-CRSH" href="http://www.sshrc-crsh.gc.ca/" target="_blank"><img class="sshrc-logo" src="<?php bloginfo('template_directory') ?>/_/img/sshrc_white.png" width="139" /></a></div>
          <?php else:?>
					<div><a alt="SSHRC-CRSH" href="http://www.sshrc-crsh.gc.ca/" target="_blank"><img class="sshrc-logo" src="<?php bloginfo('template_directory') ?>/_/img/sshrc_black.png" width="139" /></a></div>
          <?php endif;?>
        </p>
				<p style="margin-top:10px;">&copy; 2010-<?php echo date("Y");?>. All rights reserved.</p>
			</div>


    </div>
    </div>

	</footer>

  <a id="back-to-top" href="#" class="btn btn-secondary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="oi oi-chevron-top"></span></a>


	<?php wp_footer(); ?>

	<?php wp_reset_query(); ?>

  <?php
  $post_custom_fields = get_post_custom();
  $call_for_proposals_template = $post_custom_fields['call_for_proposals_template'][0];
  ?>

  <?php if(isset($call_for_proposals_template) && $call_for_proposals_template!=""):?>
    <?php $pagename = "cfp";?>
  <?php endif;?>
  <script>var page = "<?php echo $pagename;?>";</script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <script src="https://unpkg.com/wavesurfer.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/_/js/moment.min.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/_/js/moment-duration-format.js"></script>





	<script src="<?php bloginfo('stylesheet_directory'); ?>/_/js/jquery.scrollTo.min.js"></script>

	<!-- jscrollpane  -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/_/js/jscrollpane/jquery.jscrollpane.css"/>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/_/js/jscrollpane/jquery.jscrollpane.min.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/_/js/jscrollpane/jquery.mousewheel.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/_/js/jscrollpane/mwheelIntent.js"></script>

	<script src="<?php bloginfo('stylesheet_directory'); ?>/_/js/mediaelementjs/mediaelement-and-player.min.js"></script>

	<!-- isotope  -->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

	<!--waypoints-->
	<script src="<?php bloginfo('template_directory'); ?>/_/js/waypoints/jquery.waypoints.min.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/_/js/waypoints/shortcuts/sticky.min.js"></script>


	<!-- site-wide javascript code -->
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_/js/functions.js?v=1.43"></script>

	<!--fancybox-->
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_/js/jquery.fancybox.min.js"></script>


	<?php if ( is_front_page() ): ?>



	<?php if ( is_category() ) : ?>
		<script type="text/javascript">

			$(document).ready(function($) {
				$('ul.blog-categories li ul').show();
			});

		</script>
	<?php endif; ?>

<?php endif;?>

	<?php if ( is_page('news') || is_singular('post') || is_search() ) : ?>

		<script type="text/javascript">

			$(document).ready(function($) {


				$("nav.blog > div > ul > li > a").click( function(event) {
					//console.log('clicked');
					$(this).next().stop(false, true).fadeToggle(200);
					event.preventDefault();
				});

    		    // hide the navigation if there are no links
    		    $(function() {
    		     	var $p = $('.wp-pagenavi .pages');
    		    	if ($p.html() == 'Page 1 of 1' )
    		    		$p.next().remove();
    		    });
		    });

		</script>
	<?php endif; ?>

  <script>window.twttr = (function (d,s,id) {
    var t, js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
    js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
    return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
    }(document, "script", "twitter-wjs"));
  </script>

  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v7.0&appId=534649353709663&autoLogAppEvents=1"></script>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-25239188-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-25239188-1');
  </script>



	</body>

</html>
