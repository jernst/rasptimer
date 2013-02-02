<div class="log">
 <table>
  <thead>
   <tr>
    <th>Time</th>
    <th>Device</th>
    <th>Event</th>
   </tr>
  </thead>
  <tbody>
<?php

$logFh = @fopen( $logFile, "r" );
if( $logFh ) {
    $reverseDevices = array_flip( $devices );
    while( $line = fgets( $logFh )) {
        if( ( $matches = parseLogLine( $line ))) {
?>
   <tr>
    <td><?= sprintf( "%02d-%02d-%02d %02d:%02d:%02d", $matches[1], $matches[2], $matches[3], $matches[4], $matches[5], $matches[6] ) ?></td>
    <td><?= $reverseDevices[ $matches[7]] ?></td>
    <td>
<?php
            if( $matches[8] == 1 ) {
                print( 'On' );
            } else if( $matches[8] == 0 ) {
                print( 'Off' );
            } else {
                print( $matches[8] );
            }
?>
    </td>
   </tr>
<?php
        }
    }
    fclose( $logFh );
}

if( !isset( $matches ) || !$matches ) {
?>
   <tr>
    <td colspan="3">No events logged so far.</td>
   </tr>
<?php
}
?>
  </tbody>
 </table>
<?php
require( 'emit-current-time.php' );
?>
</div>

