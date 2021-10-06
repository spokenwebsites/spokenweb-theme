<?php
/*
Template Name: Article
*/
?>
<?php get_header(); ?>

<style>
	#searchform {
		position: absolute;
	}

	.entry p,
	.comments p,
	.entry ul,
	.entry ol {
		font-size: 20px !important;
		line-height: 160%;
	}

	.post-full .entry p,
	.post-full .entry ul,
	.post-full .entry ol,
	.comments p {
		margin-bottom: 20px;
	}

	.post-full ul,
	.post-full ol {
		list-style-position: outside;
	}

	.post-full ul {
		list-style-type: disc;
	}

	.post-full ul li {
		margin-left: 20px;
	}

	.post-ful ul li a {
		text-decoration: underline;
	}

	.post-ful ul li a:hover {
		text-decoration: none;
	}

	body {
		font: 20px 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
		line-height: 160%;
	}

	blockquote {
		margin: 30px 60px;
		font-style: italic;
	}

	img.alignleft {
		float: left;
		margin: 20px 20px 10px 0px;
	}

	img.alignright {
		float: right;
		margin: 20px 0px 10px 20px;
	}

	article h2,
	.comments h2,
	.not-found {
		font-size: 22px;
		margin: 8px 0 20px 0;
		line-height: 120%;
		font-family: Georgia;
	}

	.main-content h1 {
		color: #000;
		text-transform: uppercase;
		font-size: 20px;
		margin-bottom: 20px;
	}

	article h3,
	.listings-container h3 {
		font-size: 18px;
		margin: 0 0 10px 0;
		line-height: 160%;
		font-weight: bold;
	}

	.mejs-container {
		margin-bottom: 20px;
	}

	hr {
		margin: 40px 0px;
	}

	.references p {
		font-size: 15px !important;
	}
</style>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article <?php post_class('post-full') ?> id="post-<?php the_ID(); ?>">

			<div class="entry full">
				<?php the_content(); ?>
			</div>

			<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

		</article>

		<?php comments_template(); ?>

<?php endwhile;
endif; ?>

<script>
	$(document).ready(function() {
		//console.log("OKOKOK");		
	});

	var play_status = 0,
		duration;
	var timer;
	var currentTimestamp, nextTimestamp, tsIndex = 0,
		closestTimestamp, closestKey, currentKey, previousKey;

	$(window).load(function() {
		$('.audio-container.sticky').waypoint('sticky');
		audio_play();
		$(".mejs-controls .mejs-playpause-button").click(function() {
			if (play_status == 1) {
				play_status = 0;
				stopTimer();
			} else {
				play_status = 1;
				startTimer();
			}
			console.log(play_status);
		});

		duration = $(".mejs-duration");

		$(".mejs-offscreen").remove();

		$(".mejs-time-rail").click(function() {
			setTimeout(function() {
				//					getCurrentTime();
			}, 10);
		});

	});


	var timestamps = Array(0, 71, 149, 249, 272, 414, 468, 569);

	function getCurrentTime() {
		$currentTime = $(".mejs-time-total").attr('aria-valuenow');
		closestTimestamp = closest($currentTime, timestamps);
		closestKey = $.inArray(closestTimestamp, timestamps);
		if (closestTimestamp <= $currentTime) currentKey = closestKey;
		else currentKey = closestKey - 1;
		if (currentKey < 0) currentKey = 0;
		currentTimestamp = timestamps[currentKey];
		if (currentKey != previousKey) {
			if (currentKey == 0) $('body').scrollTo($("article"), 800, {
				offset: {
					top: -20,
					left: 0
				}
			});
			else $('body').scrollTo($("#timestamp" + currentKey), 800, {
				offset: {
					top: -80,
					left: 0
				}
			});
		}
		previousKey = currentKey;
		if (currentTimestamp >= duration) {
			$('body').scrollTo($("article"), 800, {
				offset: {
					top: -20,
					left: 0
				}
			});
			console.log("OOK");
		}
	}

	$('audio').each(function() {
		this.addEventListener('ended', function(e) {
			setTimeout(function() {
				audio_play();
			}, 10);
		});
	});

	function startTimer() {
		timer = setInterval(getCurrentTime, 100);
		console.log("start");
	}

	function stopTimer() {
		window.clearInterval(timer);
		console.log("stop");
	}

	function closest(num, arr) {
		var curr = arr[0];
		var diff = Math.abs(num - curr);
		for (var val = 0; val < arr.length; val++) {
			var newdiff = Math.abs(num - arr[val]);
			if (newdiff < diff) {
				diff = newdiff;
				curr = arr[val];
			}
		}
		return curr;
	}


	/*
	 */
	$("a.seekTo").each(function() {
		$(this).click(function(e) {
			e.preventDefault();
			audio_seekTo($(this).data('seconds'));
			if (play_status == 0) audio_play();
			$('body').scrollTo($(this), 800, {
				offset: {
					top: -80,
					left: 0
				}
			});
		});
	});


	function audio_play() {
		$('audio').each(function() {
			this.play();
		});
		play_status = 1;
		startTimer();
	}

	function audio_pause() {
		$('audio').each(function() {
			this.pause();
		});
		play_status = 0;
		stopTimer();
	}

	function audio_seekTo(time) {
		$('audio').each(function() {
			this.currentTime = time;
		});
	}
</script>

<?php get_footer(); ?>