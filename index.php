<?php
require_once( 'config.php' );
require_once( 'functions.php' );

$baseUrl = $_SERVER['REQUEST_URI'];
$q       = strpos( $baseUrl, '?' );
if( $q > 0 ) {
    $baseUrl = substr( $baseUrl, 0, $q );
}
$baseUrl = ( isset( $_SERVER['HTTPS'] ) ? 'https://' : 'http://' ) . $_SERVER['SERVER_NAME'] . $baseUrl;

if( $_POST ) {
    require_once( 'handle-post.php' );
}

?>
<html>
 <head>
  <title><?php print( $title ); ?></title>
  <link href="css/default.css" rel="stylesheet" type="text/css" />
 </head>
 <body>
  <div class="h1">
   <h1><?php print( $title ); ?></h1>
  </div>
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
  <div class="footnote">
   <p>Licensed under <a href="LICENSE">GPLv3</a>.
      More info: <a href="https://github.com/jernst/rasptimer">https://github.com/jernst/rasptimer</a>.</p>
  </div>
 </body>
</html>

