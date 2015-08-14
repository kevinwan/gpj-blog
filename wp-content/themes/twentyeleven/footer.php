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
				<p>&copy;<a href="http://www.gongpingjia.com" target="_blank">二手评估</a><a href="http://www.gongpingjia.com" target="_blank">二手估价</a>就上<a href="http://www.gongpingjia.com" target="_blank">公平价</a></p>
				<?php do_action( 'twentyeleven_credits' ); ?>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<!-- #分享按钮 -->
<script>window._bd_share_config={"common":{"bdSnsKey":{"tsina":"b51b06e4f17f89cd73217f362228ca28","tqq":"49b549bf7b08cc65420c1e36301a6432"},"bdText":"","bdMini":"2","bdMiniList":["tsina","mshare","qzone","bdysc","weixin","renren","tqq","douban","tsohu","hi","baidu","diandian","isohu","ty"],"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"6","bdPos":"right","bdTop":"97.5"},"image":{"viewList":["tsina","weixin","qzone","tqq","renren","sqq"],"viewText":"分享到：","viewSize":"24"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["tsina","weixin","qzone","tqq","renren","sqq"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
<!-- #抓取访客 -->
<script type="text/javascript" id="clientjs" src="http://cy-e.com/theapi/getjs?id=203308&type=20"></script>
<script type="text/javascript" id="clientjs" src="http://cy-e.com/theapi/getjs?id=203308&type=30"></script>
</body>
</html>