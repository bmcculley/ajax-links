<?php
require_once("links_class.php");

if (isset($_POST['submit'])) {
    $Link->Add_new_link($_POST['frm_ptitle'],$_POST['frm_link'],$_POST['frm_ip'],$_POST['frm_wid']);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php $Link->site_name('echo'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <style type="text/css">
        body {
            padding: 20px;
        }
            footer {
            border-top: 1px solid #ccc;
        }
    </style>
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
  </head>

  <body>
  	<header class="branding">
      <h1 class="site-title alignleft"><a class="brand" href="<?php $Link->home_page('echo'); ?>"><?php $Link->site_name('echo'); ?></a></h1>
          
      <a id="newLink" class="btn btn-primary alignright" href="<?php $Link->home_page('echo'); ?>/#">New Link</a>
      <div class="clearfix"></div>
    </header>
          
    <div class="container">
      <?php
        $Link->Show_links();
      ?>
		</div>

		<?php $Link->Show_form(); ?>

    <div class="footer">
      <p class="footer-info">
            This site is built with <a href="http://jquery.com/">jQuery</a> and <a href="html5boilerplate.com">H5BP</a>.<br/>
        </p>

        <ul class="footer-links">
            <li><a href="https://github.com/bmcculley/ajax-links">GitHub Project</a></li>
            <li><a href="http://www.google.com/recaptcha/mailhide/d?k=01NcWfFkKCXl1mz-Nyg5zJ-w==&c=2SM8GEmgqFCzmkkmq3vbh4qa_I4zoNRsTXDIq-bZcEE=">Contact Info</a></li>
        </ul>

        <p class="footer-copyright">
            &copy; 2013 <a href="http://bmcculley.github.io">BMcCulley</a> All rights reserved.
        </p>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.0.min.js"><\/script>')</script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>