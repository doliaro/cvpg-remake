<!-- footer -->
    <div class="container-fluid" style="background: #025223;">
        <div class="container">
			<footer class="bottom-footer container" role="contentinfo">
                <div class="row">
                    <ul class="col footer-links center-logo">
                        <a href="/forms"><strong>Links & Forms</strong></a>
                        <br>
                        <a href="/board_of_directors"><strong>Board of Directors</strong></a>
                        <br>
                        <a href="/forms"><strong>Contact</strong></a>

                    </ul>
                    <div class="col-6 footer-copyright center-logo">
                        <p class="align-middle"> &copy; <?php echo date('Y'); ?> Copyright Citrus Valley Physicians Group</p>
                    </div>
                    <div class="col footer-media center-logo">
                        <i class="fab fa-2x fa-twitter"></i>
                        <i class="fab fa-2x fa-facebook"></i>
                        <i class="fab fa-2x fa-linkedin"></i>
                    </div>
                </div>
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
