<?php get_header(); /* Template Name: Example */ ?>
    <section class="content">
        <div class="container">
	        <?php if (have_posts()) : while (have_posts()) : the_post();
		        the_content();
	        endwhile; endif; ?>
        </div>
    </section>
<?php get_footer(); ?>