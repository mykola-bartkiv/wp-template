<?php get_header(); ?>
<section class="content">
    <div class="container">
        <?php get_template_part( 'parts/social-icons' ); ?>
        <h1>Test</h1>
        <?php if ( '' !== get_post()->post_content ) : ?>
            <div class="text">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php the_content();; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
    <?php if ( $image = get_field( 'image' ) ) : ?>
        <div class="test" style="<?php echo image_src( $image, 'large', true, true ) ?>"></div>
    <?php endif; ?>
</section>
<?php get_footer(); ?>
