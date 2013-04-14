<?php
// run now or stop now
    foreach( $devices as $deviceName => $devicePin ) {
        $actionPar   = $deviceName . 'Action';
        $durationPar = $deviceName . 'Duration';
        $actionPar   = str_replace( ' ', '_', $actionPar ); // we love PHP
        $durationPar = str_replace( ' ', '_', $durationPar ); // we love PHP

        if( isset( $_POST[$actionPar] )) {
            $turnOn = $_POST[$actionPar] == 'Turn on';
            runGpio( "write", $devicePin, $turnOn ? "1" : "0" );

            if( isset( $_POST[$durationPar] ) && $_POST[$durationPar] ) { # something other than 0
                issueAt( $deviceName, $_POST[$durationPar], $turnOn ? "0" : "1" );
            }
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

