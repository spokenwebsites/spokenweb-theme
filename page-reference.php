<?php
/*
Template Name: Reference
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

	.post-full ul li,
	.post-full ol li {
		margin-left: 20px;
	}

	.post-full ul li a,
	.post-full ol li a {
		text-decoration: underline;
	}

	.post-full ul li a:hover,
	.post-full ol li a:hover {
		text-decoration: none;
	}

	.post-full ul.nostyle {
		list-style-type: none;
	}

	.post-full ul.nostyle li {
		margin-bottom: 40px;
	}

	blockquote {
		margin: 30px 60px;
		font-style: italic;
	}

	.post-full img {
		border: 1px solid #eee;
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

	hr {
		margin: 40px 0px;
	}
</style>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


		<article <?php post_class('post-full') ?> id="post-<?php the_ID(); ?>">

			<div class="entry">
				<?php the_content(); ?>
			</div>

			<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

		</article>

<?php endwhile;
endif; ?>



<?php get_footer(); ?>