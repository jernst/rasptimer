<?php
$barHeight       = 10; // px
$barWidthPerHour = 24; // must be the same as in the CSS file, plus 1 for the border
?>
<style>
div.graphic-log td,
div.graphic-log div.bar {
    min-height: <?= max( 20, $barHeight * count( $devices )) ?>px;
}
</style>
<div class="graphic-log">
 <table>
  <thead>
   <tr>
    <th>Day</th>
    <th colspan="24">Time</th>
   </tr>
   <tr>
    <th></th>
<?php
    for( $i=0 ; $i<24 ; ++$i ) {
        print( "    <th class=\"h\">$i</th>\n" );
    }
?>
   </tr>
  </thead>
  <tbody>
<?php

$logFh = @fopen( $logFile, "r" );
if( $logFh ) {

    function drawBar( $deviceIndex, $timeOn, $timeOff ) {
        global $barHeight;
        global $barWidthPerHour;

        $left  = round( $timeOn/3600.0*$barWidthPerHour );
        $width = max( 1, round( ( $timeOff - $timeOn )/3600.0*$barWidthPerHour ));
        print( "<span style=\"left: ${left}px; width: ${width}px;\" class=\"d${deviceIndex}\"></span>\n" );
    }

    $reverseDevices = array_flip( $devices );
    $days = array();
    while( $line = fgets( $logFh )) {
        if( ( $parsedLine = parseLogLine( $line ))) {
            if( $parsedLine == NULL ) {
                continue;
            }
            $currentDay  = GregorianToJD( $parsedLine[2], $parsedLine[3], $parsedLine[1] );
            $timeOfDay   = $parsedLine[4]*60*60 + $parsedLine[5]*60 + $parsedLine[6]; 
            $deviceIndex = 0;
            foreach( $devices as $devicePin ) {
                if( $devicePin == $parsedLine[7] ) {
                    break;
                }
                ++$deviceIndex;
            }

            if( $deviceIndex == count( $devices ) ) {
                continue;
            }
            $days[$currentDay][$deviceIndex][$timeOfDay] = $parsedLine[8]; 
        }
    }
    fclose( $logFh );

    if( count( $days ) > 0 ) {
        ksort( $days, SORT_NUMERIC );
        foreach( $days as $day => $deviceEvents ) {
            $deviceStatus = array(); // keyed by deviceIndex, valued by start time

            preg_match( "!(\d+)/(\d+)/(\d+)!", jdtogregorian( $day ), $matched );
            print( "<tr>\n" );
            printf( " <td>%04d-%02d-%02d</td>\n", $matched[3], $matched[1], $matched[2] );

            print( " <td colspan=\"24\"><div class=\"bar\">\n" );
            foreach( $deviceEvents as $deviceIndex => $events ) {
                foreach( $events as $timeOfDay => $event ) {
                    if( $event == 1 ) {
                        if( !isset( $deviceStatus[$deviceIndex] )) {
                            $deviceStatus[$deviceIndex] = $timeOfDay;
                        } // else switched on again -- ignore
                    } else if( $event == 0 ) {
                        if( isset( $deviceStatus[$deviceIndex] )) {
                            drawBar( $deviceIndex, $deviceStatus[$deviceIndex], $timeOfDay );
                            unset( $deviceStatus[$deviceIndex] );
                        } // else switched off again -- ignore
                    }
                }
            }

            print( " </div></td>\n" );
            print( "</tr>\n" );
        }
    }
}

if( !isset( $parsedLine ) || !$parsedLine ) {
?>
   <tr>
    <td colspan="25">No events logged so far.</td>
   </tr>
<?php
}
?>
  </tbody>
 </table>
<?php
if( isset( $parsedLine ) && $parsedLine ) {
?>
  <div class="legend">Legend:
<?php
    $deviceIndex = 0;
    foreach( $devices as $deviceName => $devicePin ) {
        print( "<span class=\"d${deviceIndex}\">$deviceName</span>\n" );
        ++$deviceIndex;
    }
?>
</div>
<?php
}
?>
 <p>It currently is <?php print( date( "H:i:s" )) ?>. <a href="">Refresh</a>.</p>
</div>
