<?php get_header(); ?>
<section class="content">
    <div class="container">
        <h1><?php the_title(); ?></h1>
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
