<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package web-studio
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php web_studio_post_thumbnail(); ?>
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
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

</article><!-- #post-<?php the_ID(); ?> -->
