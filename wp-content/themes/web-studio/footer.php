<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package web-studio
 */

?>
	<footer class="footer">
		<div class="footer__container _container">
			<div class="footer__body">
				<div class="footer__logo">
					<a href="#">
						<img src="<?php echo get_template_directory_uri().'/assets/img/logo-footer.png' ?>" alt="logo-footer">
					</a>
				</div>
				<div class="footer__info">
					<p>г. Киев, пр-т Леси Украинки, 26</p>
					<a href="#">info@example.com</a>
					<a href="#">+38 099 111 11 11</a>
				</div>
			</div>
		</div>
	</footer>
<script
  src="https://code.jquery.com/jquery-3.6.4.min.js"
  integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
  crossorigin="anonymous"></script>
<?php wp_footer(); ?>

</body>
</html>
