	<!-- <footer id="footer-widget">
        <div class="container clearfix">
            <h3>About Tovna Sabay</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
        </div>
    </footer> --><!-- #footer-widget -->

    <footer id="footer-info">
        <div class="container clearfix">
            <nav id="footer-nav">
                <?php echo sp_footer_navigation(); ?>
            </nav>
            <p class="copyright">
                <?php if ( ot_get_option( 'copyright' ) ): ?>
                    <?php echo ot_get_option( 'copyright' ); ?>
                <?php else: ?>
                    <?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?>. <?php _e( 'All Rights Reserved.', SP_TEXT_DOMAIN ); ?>
                <?php endif; ?>
            </p><!--/.copyright-->
        </div> <!-- .container .clearfix -->    
    </footer><!-- #footer-info -->

    </div> <!-- .container .clearfix -->
	</div> <!-- #content-container -->
</div> <!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>