<?php
$mainPumpPin = 11;
$sweepPumpPin = 6;

function runGpio( $args ) {
    exec( "/usr/local/bin/gpio $args", $out, $status );
    if( $status ) {
        print( "<p class='error'>Failed to execute /usr/local/bin/gpio $args: Status $status</p>\n" );
    }
    if( is_array( $out ) && count( $out ) > 0  ) {
        return $out[0];
    } else {
        return NULL;
    }
}

if( $_POST ) {
    if( $_POST['mainPumpAction'] ) {
        runGpio( "write $mainPumpPin " . ( $_POST['mainPumpAction'] == 'Turn on' ? "1" : "0" ));
    }
    if( $_POST['sweepPumpAction'] ) {
        runGpio( "write $sweepPumpPin " . ( $_POST['sweepPumpAction'] == 'Turn on' ? "1" : "0" ));
    }
    header( 'Location: ' . $_SERVER['REQUEST_URI'] );
    exit( 0 );
}

?>
<html>
 <head>
  <title>Rasptimer</title>
  <link href="css/default.css" rel="stylesheet" type="text/css" />
 </head>
 <body>
  <h1>Rasptimer</h1>
  <p>Current status:</p>
<?php
$mainPumpPinStatus  = runGpio( "read $mainPumpPin" );
$sweepPumpPinStatus = runGpio( "read $sweepPumpPin" );
?>
  <form method="POST">
   <table class="status">
    <tr>
     <th>Main pump is:</th>
     <td>
<?php
print( $mainPumpPinStatus ? "on" : "off" );
?>
     </td>
     <td>
      <input type="submit" name="mainPumpAction" value="<?php print( $mainPumpPinStatus ? "Turn off" : "Turn on" ) ?>"/>
     </td>
    </tr>
    <tr>
     <th>Sweep pump is:</th>
     <td>
<?php
print( $sweepPumpPinStatus ? "on" : "off" );
?>
     </td>
     <td>
      <input type="submit" name="sweepPumpAction" value="<?php print( $sweepPumpPinStatus ? "Turn off" : "Turn on" ) ?>"/>
     </td>
    </tr>
   </table>
  </form>
 </body>
</html>

