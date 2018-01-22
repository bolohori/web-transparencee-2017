<?php
$src = get_template_directory_uri();
global $couns;
?>

<div id="footer">
  <div class="content">
    <div class="wrap">
      <div class="column-1">
        <span class="footer-comment">TransparenCEE is run by:</span>
        <div class="footer-logos">
          <div class="logo">
            <a href="https://transparencee.org/organization/epanstwo-foundation/">
              <img src="<?php echo $src; ?>/img/fundacja-epanstwo.png" alt="">
            </a>
          </div>
          <div class="logo">
            <a href="https://transparencee.org/organization/techsoup-europe/">
              <img src="<?php echo $src; ?>/img/techsoup.png" alt="">
            </a>
          </div>
          <div class="logo">
            <a href="https://transparencee.org/organization/actionsee-network/">
              <img src="<?php echo $src; ?>/img/actionsee-300x66.png" alt="">
            </a>
          </div>
          <div class="logo">
            <a href="https://transparencee.org/organization/opora/">
              <img src="<?php echo $src; ?>/img/opora-logo.png" alt="">
            </a>
          </div>
          <div class="logo">
            <a href="https://transparencee.org/organization/k-monitor/">
              <img src="<?php echo $src; ?>/img/kmonitor-logo.jpg" alt="">
            </a>
          </div>
        </div>

        <div class="america">
          <div class="flag"><img src="<?php echo $src; ?>/img/flag.png" alt=""></div>
          <div class="flag-text">The&nbsp;project is possible thanks to the&nbsp;generosity of the&nbsp;U.&nbsp;S. Department of State</div>
        </div>
      </div>

      <div class="column-2">
        <span class="footer-comment">Subscribe to our mailing list</span>
				<form action="//transparencee.us11.list-manage.com/subscribe/post?u=d857aba08d7e3c85c7c791833&amp;id=d28a20762e" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="">
					<div id="mc_embed_signup_scroll">

						<div class="subscribe-input">
							<input type="email" value="" name="EMAIL" class="email input" id="mce-EMAIL" placeholder="" required="">
							<input type="submit" value="subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
						</div>
						<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_d857aba08d7e3c85c7c791833_d28a20762e" tabindex="-1" value=""></div>

					</div>
				</form>

				<?php
				$facebook = get_field('facebook', 6);
				$twitter = get_field('twitter', 6);
				$slack = get_field('slack', 6);
				?>

        <div class="social-media">
					<?php if ($facebook): ?>
	          <a class="media-icon" href="<?php the_field('facebook', 6); ?>" target="_blank">
	            <img src="<?php echo $src; ?>/img/facebook.svg" alt="">
	          </a>
					<?php endif; ?>
					<?php if ($twitter): ?>
	          <a class="media-icon" href="<?php the_field('twitter', 6); ?>" target="_blank">
	            <img src="<?php echo $src; ?>/img/twitter.svg" alt="">
	          </a>
					<?php endif; ?>
					<?php if ($slack): ?>
	          <a class="media-icon" href="<?php the_field('slack', 6); ?>" target="_blank">
	            <img src="<?php echo $src; ?>/img/slack.svg" alt="">
	          </a>
					<?php endif; ?>
        </div>
				<?php
				$mail = get_field('mail', 6)
				?>
        Write to us at:<br>
        <a href="mailto:<?php echo $mail; ?>"><?php echo $mail; ?></a>

        <div class="credits">
					Web Design: <a href="http://transparent.agency" target="_blank">Transparent</a>
				</div>
      </div>
    </div>
  </div>
</div>

</div>

<?php
wp_footer();
?>



</body>
</html>
