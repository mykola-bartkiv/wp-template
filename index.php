<?php get_header(); ?>
<section class="content container space">
    <?php get_template_part( 'parts/breadcrumb' ); ?>
    <div class="posts-wrapper flex">
        <article>
            <h1><?php echo get_the_title( BLOG_ID ); ?></h1>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="post flex">
                    <a href="<?php the_permalink(); ?>" class="thumb">
                        <?php echo has_post_thumbnail() ? get_the_post_thumbnail( get_the_ID(), 'medium_large' ) : '<img src="' . theme( '/img/holder.png' ) . '" alt="holder">' ?>
                    </a>
                    <div class="info">
                        <time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date( 'F j, Y' ); ?></time>
                        <span class="post-title"><?php the_title(); ?></span>
                        <p><?php echo wp_trim_words( strip_shortcodes( get_the_content() ), 20, "..." ); ?></p>
                        <span class="more">Read more ></span>
                    </div>
                </div>
            <?php endwhile; endif; ?>
        </article>
        <?php if ( is_active_sidebar( 'blog_sidebar' ) ) : ?>
            <aside>
                <?php dynamic_sidebar( 'blog_sidebar' ); ?>
            </aside>
        <?php endif; ?>
    </div>
    <?php get_template_part( 'parts/pagination' ); ?>
</section>
<?php get_footer(); ?>
