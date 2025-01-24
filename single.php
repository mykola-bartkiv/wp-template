<?php get_header(); ?>

<section class="single-wrapper">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="wrap content space">
            <?php get_template_part( 'parts/breadcrumb' ); ?>
            <h1 class="tac"><?php the_title(); ?></h1>
            <?php if ( has_post_thumbnail() ) : ?>
                <figure class="thumbnail">
                    <?php the_post_thumbnail( 'max' ); ?>
                </figure>
            <?php endif; ?>
            <time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date( 'F j, Y' ); ?></time>
            <div class="author">Author: <?php the_author(); ?></div>
            <div class="cats">Category: <?php echo cats( $post->ID ); ?></div>
            <div class="text last-no-spacing cfx">
                <?php the_content(); ?>
            </div>
            <div class="tags_list">Tags: <?php the_tags( '' ); ?></div>
            <div class="share-icons">
                <a class="twitter-icon"
                   href="https://twitter.com/intent/tweet?status=<?php the_title(); ?> - <?php the_permalink(); ?>"
                   title="Tweet It"
                   target="_blank"
                   rel="noopener"><span class="link-text">Twitter</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-twitter fa-w-16 fa-3x">
                        <path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" class=""></path>
                    </svg>
                </a>
                <a class="facebook-icon"
                   href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>"
                   title="Share at Facebook"
                   target="_blank"
                   rel="noopener"><span class="link-text">Facebook</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-facebook-f fa-w-10 fa-3x">
                        <path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" class=""></path>
                    </svg>
                </a>
                <a class="linkedin-icon"
                   href="https://www.linkedin.com/shareArticle?mini=true&amp;title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>"
                   title="Share at LinkedIn"
                   target="_blank"
                   rel="noopener"><span class="link-text">Linkedin</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-linkedin-in fa-w-14 fa-3x">
                        <path fill="currentColor" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z" class=""></path>
                    </svg>
                </a>
                <a class="pinterest-icon"
                   href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>"
                   title="Pin It"
                   target="_blank"
                   rel="noopener"><span class="link-text">Pinterest</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-pinterest-p fa-w-12 fa-3x">
                        <path fill="currentColor" d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z" class=""></path>
                    </svg>
                </a>
            </div>
            <div class="post-navigation">
                <?php if ( get_previous_post_link() ) : ?>
                    <?php previous_post_link( '%link', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14 fa-3x"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" class=""></path></svg><span>Previous</span>' ); ?>
                <?php endif; ?>
                <?php if ( get_next_post_link() ) : ?>
                    <?php next_post_link( '%link', '<span>Next</span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-long-arrow-alt-right fa-w-14 fa-3x"><path fill="currentColor" d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z" class=""></path></svg>' ); ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>
