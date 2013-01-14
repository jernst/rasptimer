<?php
// run now or stop now
    foreach( $devices as $deviceName => $devicePin ) {
        $postPar = $deviceName . 'Action';
        $postPar = str_replace( ' ', '_', $postPar ); // we love PHP
        if( isset( $_POST[$postPar] )) {
            runGpio( "write", $devicePin, $_POST[$postPar] == 'Turn on' ? "1" : "0" );
        }
    }

// schedule
    if( isset( $_POST['change-schedule'] ) && $_POST['change-schedule'] == 'Save' ) {
        $schedule = readCrontab();
        $deviceName = $_POST['deviceName'];
        if( isset( $devices[$deviceName] )) {
            if( $_POST['scheduled'] == 'yes' ) {
function rangeCheck( $val, $min, $max ) {
    $val = intval( $val );
    if( $val < $min ) {
        $val = $min;
    } else if( $val > $max ) {
        $val = $max;
    }
    return $val;
}
                $schedule[$deviceName]['timeOn']['hour']   = rangeCheck( $_POST['timeOnHour'], 0, 23 );
                $schedule[$deviceName]['timeOn']['min']    = rangeCheck( $_POST['timeOnMin'], 0, 59 );
                $schedule[$deviceName]['duration']['hour'] = rangeCheck( $_POST['durationHour'], 0, 23 );
                $schedule[$deviceName]['duration']['min']  = rangeCheck( $_POST['durationMin'], 0, 59 );

            } else {
                $schedule[$deviceName] = NULL;
            }
            writeCrontab( $schedule );
        }
    }

    header( "Location: $baseUrl/" );
    exit( 0 );

