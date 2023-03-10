<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package web-studio
 */

get_header();
?>

	<main id="primary" class="site-main">

	<section class="portfolio">
                <div class="portfolio__container _container">
                    <div class="portfolio__body">
                        <?php get_search_form(); ?>
                        <div class="portfolio__btns">
                            <div class="portfolio__btn active btn-all">
                                <button class="btn">
                                    <p>Все</p>
                                </button>
                            </div>
                            <?php
                                $terms = array_reverse(get_terms('Type'));
                                foreach($terms as $term) {?>
                                    <div class="portfolio__btn" data-id="<?php echo $term->term_id ?>" data-link="<?php echo get_category_link($term->term_id) ?>">
                                        <button class="btn">
                                            <p><?php echo $term->description;?></p>
                                        </button>
                                    </div>
                                <?php }
                            ?>
                        </div>
                        <div class="portfolio__carts">
                            <?php
                                $news = new WP_Query(array(
                                    'post_type' => 'news',
                                    'posts_per_page' => 3,
                                    'paged' => 1,
                                    'orderby' => 'new-date',
                                    'order' => 'ASC'
                                ));
                                if($news->have_posts()) {
                                    while($news->have_posts()){
                                        $news->the_post();?>
                                        <div class="portfolio__cart">
                                            <div class="portfolio__img">
                                                <?php the_post_thumbnail(); ?>
                                            </div>
                                            <div class="portfolio__title">
                                                <a href="<?php echo the_permalink() ?>"><?php the_title(); ?></a>
                                            </div>
                                            <div class="portfolio__category">
                                                <p><?php 
                                                    $terms =  get_the_terms($post->ID, 'Type');
                                                    foreach($terms as $term) {
                                                        echo $term->description;
                                                    }
                                                ?></p>
                                            </div>
                                        </div>
                                    <?php }
                                }
                                wp_reset_postdata();
                            ?>
                        </div>
                        <div class="portfolio__more">
                            <button class="btn more">
                                <p>Дивитись ще</p>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
	</main><!-- #main -->

<?php
get_footer();
