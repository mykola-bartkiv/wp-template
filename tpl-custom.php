<?php get_header(); /* Template Name: Example */ ?>
    <section class="content space">
        <div class="container">
	  <?php if ( '' !== get_post()->post_content ) : ?>
            <div class="text last-no-spacing cfx">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            </div>
          <?php endif; ?>
        </div>
    </section>
<?php get_footer(); ?>
