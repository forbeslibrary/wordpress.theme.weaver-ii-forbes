<?php
/**
 * Embeds a pdf.
 *
 * @wp-hook add_shortcode forbes_pdf
 */
function forbes_pdf_shortcode_handler( $atts, $content = null ) {
  extract( shortcode_atts( array(
    'src' => null,
    'height' => '500px',
    'width' => '100%'
  ), $atts ) );
  
  ob_start(); 
  echo "<object data=\"$src\" type=\"application/pdf\" style=\"width:$width; height:$height;\">";?>
  <p>It appears you don't have a PDF plugin for this browser.
  You can <a href="<?php echo $src; ?>">
  download the PDF file.</a></p>  
  </object><?php
  return ob_get_clean();
}
