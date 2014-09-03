<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				if ( ! is_404() )
					get_sidebar( 'footer' );
			?>

			<div id="site-generator">
				<p>&copy;<a href="http://www.gongpingjia.com" target="_blank">二手评估</a><a href="http://www.gongpingjia.com" target="_blank">二手估价</a><a href="http://www.gongpingjia.com" target="_blank">就上公平价</a></p>
				<?php do_action( 'twentyeleven_credits' ); ?>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

    <!-- Baidu Site Analysis BEGIN -->
    <script type="text/javascript">
    var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Ffda46aee2fdc8758eb34d7ed9cf8f341' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <!-- Baidu Site Analysis END -->

    <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1000350436'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1000350436%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
    <script type="text/javascript" id="clientjs" src="http://cy-e.com/theapi/getjs?id=203308&type=20"></script>
</body>
</html>
