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
        if( preg_match( '!^([^\t]*)\t([^\t]*)\t([^\t]*)$!', $line, $matches )) {
?>
   <tr>
    <td><?= $matches[1] ?></td>
    <td><?= $reverseDevices[ $matches[2]] ?></td>
    <td>
<?php
            if( $matches[3] == 1 ) {
                print( 'On' );
            } else if( $matches[3] == 0 ) {
                print( 'Off' );
            } else {
                print( $matches[3] );
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
</table>

