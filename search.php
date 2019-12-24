<?php get_header(); ?>
<section class="content">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <h3>All posts by "<?php echo $s; ?>"</h3>
            <?php  while ( have_posts() ) : the_post(); ?>
                <div class="post">
                    <?php if ( has_post_thumbnail() ) { ?>
                        <a class="thumb" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( "thumbnail" ); ?>
                        </a>
                    <?php } ?>
                    <div class="info">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date( get_option( 'date_format_custom' ) ); ?></time>
                        <p><?php echo wp_trim_words( get_the_content(), 40 ); ?></p>
                        <a class="more" href="<?php the_permalink(); ?>">Read more ></a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <h2>Sorry, No Posts Found</h2>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
