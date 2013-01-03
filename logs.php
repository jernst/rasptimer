<?php
require_once( 'config.php' );
require_once( 'functions.php' );
require_once( 'decode-url.php' );
require_once( 'template.php' );

?>
<html>
 <head>
<?php emitHtmlHead( $title . " &mdash; Logs" ); ?>
 </head>
 <body>
<?php emitHeader( $title . " &mdash; Logs" ); ?>
  <div class="body">
<?php
require_once( 'emit-logs.php' );
?>
  </div>
<?php emitFooter(); ?>
 </body>
</html>

