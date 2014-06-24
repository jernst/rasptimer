<?php

foreach( $devices as $deviceName => $devicePin ) {
    $postPar = $deviceName . 'Action';
    $postPar = str_replace( ' ', '_', $postPar ); // we love PHP
    if( $_GET[$postPar] == 'Change schedule' ) {
        $foundDeviceName = $deviceName;
        $foundDevicePin  = $devicePin;
        break;
    }
}

if( !isset( $foundDeviceName )) {
    print( "<p class='error'>Cannot find this device.</p>" );
} else {
    $schedule = readCrontab();
?>
    <h2>Change schedule for <?php print( $foundDeviceName )?></h2>

    <form method="POST" class="change-schedule">
     <p>
      <input type="hidden" name="deviceName" value="<?php print( $foundDeviceName ) ?>"/>
      <input type="radio" name="scheduled" value="yes"<?php if( isset( $schedule[$foundDeviceName] )) { print( " checked='checked'" ); }?>/>Run regularly, or
      <input type="radio" name="scheduled" value="no"<?php if( !isset( $schedule[$foundDeviceName] )) { print( " checked='checked'" ); }?>/>do not run regularly.
     </p>
     <p>When run, run at
      <input type="text" name="timeOnHour" value="<?php printf( "%02d", isset( $schedule[$foundDeviceName]['timeOn']['hour'] ) ? $schedule[$foundDeviceName]['timeOn']['hour'] : 7 );?>" maxlength="2"/>
      :
      <input type="text" name="timeOnMin" value="<?php printf( "%02d", isset( $schedule[$foundDeviceName]['timeOn']['min'] ) ?  $schedule[$foundDeviceName]['timeOn']['min'] : 0 );?>" maxlength="2"/>
      for
      <input type="text" name="durationHour" value="<?php printf( "%02d", isset( $schedule[$foundDeviceName]['duration']['hour'] ) ?  $schedule[$foundDeviceName]['duration']['hour'] : 1 );?>" maxlength="2"/>
      :
      <input type="text" name="durationMin" value="<?php printf( "%02d", isset( $schedule[$foundDeviceName]['duration']['min'] ) ? $schedule[$foundDeviceName]['duration']['min'] : 0 );?>" maxlength="2"/>.
     </p>
     <p>
      <input type="submit" name="change-schedule" value="Save"/>
      <a href="<?php print( $baseUrl ) ?>/">Cancel</a>
     </p>
    </form>
<?php
}
?>
