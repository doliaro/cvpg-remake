<!-- footer -->
    <div class="container-fluid" style="background: #025223;">
        <div class="container">
			<footer class="bottom-footer container" role="contentinfo">
                <div class="row">
                    <ul class="col footer-links center-logo">
                        <li>
                            <a href="/forms"><strong>Links & Forms</strong></a>
                        </li>
                        <!-- <br> -->
                        <li>
                            <a href="/board_of_directors"><strong>Board of Directors</strong></a>
                        </li>
                        <!-- <br> -->
                        <li>
                            <a href="/contact"><strong>Contact</strong></a>
                        </li>

                    </ul>

                    <div class="col footer-media center-logo">
                        <i class="fab fa-2x fa-twitter"></i>
                        <i class="fab fa-2x fa-facebook"></i>
                        <i class="fab fa-2x fa-linkedin"></i>
                    </div>
                </div>
                <div class="container footer-copyright credit">
                    <div class="row">
                        <div class="col-md-8 text-left">
                            &copy; <?php echo date('Y'); ?> Copyright Copyright Citrus Valley Physicians Group
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="//mind.sh/are"><img src="<?php echo get_template_directory_uri(); ?>/img/mindshare.svg" alt="Mindshare Labs, Inc" class="credit"></a>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col footer-copyright center-logo align-middle">
                        <span> &copy; <?php echo date('Y'); ?> Copyright Citrus Valley Physicians Group </span>
                        <span>
                            <a href="//mind.sh/are">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/mindshare.svg" alt="Mindshare Labs, Inc" class="credit" />
                            </a>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 footer-mind center-logo">
                        <a href="//mind.sh/are"><img src="<?php echo get_template_directory_uri(); ?>/img/mindshare.svg" alt="Mindshare Labs, Inc" class="credit"></a>
                    </div>
                </div> -->
			</footer>
			<!-- /footer -->

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
