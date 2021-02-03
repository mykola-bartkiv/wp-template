<?php get_header(); ?>
<section class="content">
    <div class="container">
        <article>
            <h1><?php echo get_the_title(BLOG_ID); ?></h1>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="post">
                    <figure class="thumb">
                            <?php echo has_post_thumbnail() ? get_the_post_thumbnail( get_the_ID(), 'medium_large' ) : '<img src="' . theme('/img/holder.png') . '" alt="holder">' ?>
                     </figure>
                    <div class="info">
                        <time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('F j, Y'); ?></time>
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo wp_trim_words( strip_shortcodes( get_the_content() ), 20, "..." );  ?></p>
                        <span class="more">Read more ></span>
                    </div>
                </a>
            <?php endwhile; endif; ?>
        </article>
        <?php echo ( is_active_sidebar( 'blog_sidebar' ) ) ? '<aside>'. dynamic_sidebar('blog_sidebar') .'</aside>' : ''; ?>
    </div>
</section>
<?php get_footer(); ?>
