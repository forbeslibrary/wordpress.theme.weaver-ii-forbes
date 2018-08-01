<?php
/**
 * Shows a simple list of todays events from libcal
 *
 * Much of this is hard coded!
 * 
 * @wp-hook add_shortcode forbes_todays_events
 */
function forbes_todays_events() {
  ob_start();
  ?>
<style scoped> #api_today_cid228_iid1448 .s-lc-ea-date, #api_today_cid228_iid1448 .s-lc-ea-h3 { display:none; }</style>

<div id="api_today_cid228_iid1448"></div>

<script type="text/javascript" src="https://api3.libcal.com/api_events.php?iid=1448&m=today&cid=228&c=&d=&simple=ul_date&context=object&format=js"></script>

<a style="font-weight: bold" href="http://forbeslibrary.org/wordpress/?p=187">More Events»</a>
  <?php
  return ob_get_clean();
}
