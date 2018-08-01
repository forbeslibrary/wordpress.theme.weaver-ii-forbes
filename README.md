wordpress.theme.weaver-ii-forbes
=======
A child theme for the Weaver II Wordpress theme, used by Forbes Library.

## File Description
### content.php
+ The default template for displaying content on blog pages. We have modified
Weaver II's template to put page ancestry in header on search pages.

### custom-editor-style.css
+ css to be used in the TinyMCE editor

### functions.php
+ Removes the forecolor, underline, and justify buttons from the TinyMCE Editor.
+ Adds custom CSS to the editor.
+ Changes default linking behavior for inserted images.
+ Fixes Weaver II's broken search pagination.
+ Customize WeaverII's breadcrumbs so that they always show a page's parent.

### style.css
+ Custom css associated with this theme. Note that most of the custom css used by
Forbes Library can be found in forbeslibrary/wordpress.theme.weaver-ii.forbes-custom-css

### shortcodes/
+ Shortcodes, each definied in their own file
  + `forbes_panorama`: for embedding images with a fixed height but variable width
  + `forbes_pdf`: for embedding pdf files.
  + `forbes_search`: outputs a search form
