<?php
require_once( 'config.php' );
require_once( '/usr/share/rasptimer/php/template.php' );
require_once( '/usr/share/rasptimer/php/functions.php' );
require_once( '/usr/share/rasptimer/php/decode-url.php' );

if( $_POST ) {
    require_once( '/usr/share/rasptimer/handle-post.php' );
}

?>
<html>
 <head>
<?php emitHtmlHead( $title ); ?>
 </head>
 <body>
<?php emitHeader( $title ); ?>
  <div class="body">
<?php
if( !isset( $devices )) {
?>
   <p class="error">No devices have been defined. Edit config.php</p>
<?php
} else if( isset( $_GET ) && count( $_GET ) > 0 ) {
    require_once( 'show-change-schedule.php' );
} else {
    require_once( 'show-status.php' );
    require_once( 'show-schedule.php' );
}
?>
  </div>
<?php emitFooter(); ?>
 </body>
</html>

