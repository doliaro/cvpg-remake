<!-- footer -->
    <div class="container-fluid" style="background: #025223;">
        <div class="container">
			<footer class="bottom-footer container" role="contentinfo">
                <div class="row">
                    <ul class="col footer-links center-logo">
                        <li>
                            <a href="/provider"><strong>Provider Information</strong></a>
                        </li>
                        <li>
                            <a href="/member"><strong>Member Information</strong></a>
                        </li>
                        <li>
                            <a href="wp-content/uploads/2018/05/Affirmative_Statement_Memo_2018.pdf"><strong>Affirmative Statement</strong></a>
                        </li>
                    </ul>

                    <div class="col footer-media center-logo">
                        <i class="fab fa-2x fa-twitter"></i>
                        <i class="fab fa-2x fa-facebook"></i>
                        <i class="fab fa-2x fa-linkedin"></i>
                    </div>
                </div>
			</footer>
		</div>
    </div>
    <div class="container-fluid footer-copyright credit" style="height:55px">
        <div class="row" style="background: #000;">
                <div class="col-md-8 cvpg-copyright">
                    &copy; <?php echo date('Y'); ?> Copyright Copyright Citrus Valley Physicians Group
                </div>
                <div class="col-md-4 mind-right">
                    <a href="//mind.sh/are"><img width="165px" src="<?php echo get_template_directory_uri(); ?>/img/mindshare_labs_asset.png" alt="Mindshare Labs, Inc" class="credit"></a>
                </div>
        </div>
    </div>
		<!-- /wrapper //Opened in layout/navigation.php-->

		<?php wp_footer(); ?>
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-16159409-37"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-16159409-37');
            </script>

	</body>
</html>
