<?php
// filter hooks
add_filter( 'query_vars', 'forbes_search_add_query_vars_filter' );

// action hooks
add_action( 'parse_query', 'forbes_search_redirect' );
add_action( 'init', 'forbes_search_init' );

/**
 * Sets the cookie used by this shortcode
 */
function forbes_search_init() {
  $searchOpt = get_query_var( 'searchOpt', 'website' );
  if (isset($_COOKIE['searchOpt']) ) {
    $searchOpt = $_COOKIE['searchOpt'];
  }
  setcookie( 'searchOpt', $searchOpt, 0, '/' , $_SERVER['HTTP_HOST']);
}

/**
 * Displays a search widget
 *
 * @wp-hook add-shortcode forbes_search
 */
function forbes_search_shortcode_handler( $atts, $content = null ) {
  $searchOpt = get_query_var( 'searchOpt', null );
  $catalogSearchOpt = FALSE;

  if ( !$searchOpt and isset($_COOKIE['searchOpt']) ) {
    $searchOpt = $_COOKIE['searchOpt'];
  }
  if ($searchOpt == 'catalog' ) {
    $catalogSearchOpt = TRUE;
    $action = 'http://northamptn.cwmars.org/eg/opac/results';
    $searchName = 'query';
  } else {
    $websiteSearchOpt = TRUE;
    $action = get_home_url();
    $searchName = 's';
  }


  ob_start();
  ?>
  <form role="search" id="searchForm" method="get" class="searchform" action="<?php echo $action?>">
    <div class="searchMain">
      <label id="searchLabel" class="screen-reader-text" for="search">Search for:</label>
      <input type="search" value="" name="<?php echo $searchName;?>" id="search" tabindex="2">
      <input class="searchformimg" type="image" src="<?php echo get_template_directory_uri(); ?>/images/search_button.gif" alt="Submit Search" tabindex="5">
    </div>
    <div class="searchOptions">
      <fieldset>
        <legend class="assistive-text">What to search</legend>
        <input id="searchOpt_website" class="inline" name="searchOpt" value="website" <?php checked($websiteSearchOpt); ?> type="radio" tabindex="4"><label class="inline" for="searchOpt_website">Website</label>
        <input id="searchOpt_catalog" class="inline" name="searchOpt" value="catalog" <?php checked($catalogSearchOpt); ?> type="radio" tabindex="3"><label class="inline" for="searchOpt_catalog">Catalog</label>
      </fieldset>
      <a id="searchOpt_advanced" class="moreSearch" href="http://northamptn.cwmars.org/eg/opac/advanced" tabindex="6">Advanced Catalog Search</a>
    </div>
  </form>
  <script>
  /**
   * Enable the radio buttons to switch between searching the catalog or the WordPress site.
   */
  jQuery(document).ready( function($) {
    $("#search").attr("placeholder", "search website");
    $(".searchformimg").attr("alt", "search website");
    $("#searchOpt_catalog").click( function() {
        $("#search").attr("placeholder", "search catalog (books, movies, music, and more...)");
        $(".searchformimg").attr("alt", "search catalog");
        $("#search").attr("name", "query");
        $("#searchForm").attr("action", "http://northamptn.cwmars.org/eg/opac/results");
        document.cookie="searchOpt=catalog; path=/; domain=<?php echo $_SERVER['HTTP_HOST']; ?>";
    });
    $("#searchOpt_website").click( function() {
        $("#search").attr("placeholder", "search website");
        $(".searchformimg").attr("alt", "search website");
        $("#search").attr("name", "s");
        $("#searchForm").attr("action", "<?php get_home_url(); ?>");
        document.cookie="searchOpt=website; path=/; domain=<?php echo $_SERVER['HTTP_HOST']; ?>";
    });
  }) ;
  </script>
  <?php
  return ob_get_clean();
}

/**
 * Adds custom query variables so they will be recognized by wordpress
 */
function forbes_search_add_query_vars_filter( $vars ){
  $vars[] = "searchOpt";
  return $vars;
}

/**
 * Redirects search to the online catalog if needed.
 *
 * This may happen if the user does not have Javascript enabled.
 */
function forbes_search_redirect() {
  if (get_query_var( 'searchOpt' ) == 'catalog') {
    $atts = array();
    parse_str($_SERVER['QUERY_STRING'], $atts);
    $atts['query'] = $atts['s'];
    unset($atts['s']);
    header('Location: http://northamptn.cwmars.org/eg/opac/results?' . http_build_query($atts));
    exit();
  }
}
