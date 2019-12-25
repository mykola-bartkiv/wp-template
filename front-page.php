<?php get_header(); ?>
<section class="content">
    <div class="container">
         <?php if ( '' !== get_post()->post_content ) : ?>
            <div class="text">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php the_content();; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
