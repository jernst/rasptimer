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
<?php
$page = $_GET['page'];
printLogFileLines( "graphic-logs.php", $page );
?>
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

if( $page ) {
    foreach( $oldLogFilesPrintf as $candidate ) {
        $candidateFile = sprintf( $candidate, $page );
        if( substr( $candidateFile, -3 ) === ".gz" ) {
            $logFh = @gzopen( $candidateFile, "r" );
        } else {
           $logFh = @fopen( $candidateFile, "r" );
        }
        if( $logFh ) {
            break;
        }
    }
} else {
    $logFh = @fopen( $logFile, "r" );
}

if( $logFh ) {

    function drawBar( $deviceIndex, $timeOn, $timeOff, $dotdotdot=0 ) {
        global $barHeight;
        global $barWidthPerHour;

        $left  = round( $timeOn/3600.0*$barWidthPerHour );
        $width = max( 1, round( ( $timeOff - $timeOn )/3600.0*$barWidthPerHour ));

        print( "<span style=\"left: ${left}px; width: ${width}px;\" class=\"d${deviceIndex}\"></span>\n" );
        if( $dotdotdot ) {
            $both = $left + $width;
            print( "<span style=\"left: ${both}px;\" class=\"d${deviceIndex} dotdotdot\">...</span>\n" );
        }
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
        $today = strtotime('today');
        $now   = time() - $today;
        $today = unixtojd( $today );

        $deviceStatus = array(); // keyed by deviceIndex, valued by start time

        foreach( $days as $day => $deviceEvents ) {
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
            if( $day == $today ) {
                foreach( $deviceStatus as $deviceIndex => $timeOfDay ) {
                    drawBar( $deviceIndex, $timeOfDay, $now, 1 );
                }
            } else {
                foreach( $deviceStatus as $deviceIndex => $timeOfDay ) {
                    drawBar( $deviceIndex, $timeOfDay, 24*60*60 );
                    $deviceStatus[$deviceIndex] = 0; // midnight
                }
            }

            print( " </div></td>\n" );
            print( "</tr>\n" );
        }
        if( $day < $today && count( $deviceStatus ) > 0 ) {
            for( ; $day < $today ; ++$day ) {
                preg_match( "!(\d+)/(\d+)/(\d+)!", jdtogregorian( $day ), $matched );
                print( "<tr>\n" );
                printf( " <td>%04d-%02d-%02d</td>\n", $matched[3], $matched[1], $matched[2] );
                print( " <td colspan=\"24\"><div class=\"bar\">\n" );
                foreach( $deviceStatus as $deviceIndex => $timeOfDay ) {
                    drawBar( $deviceIndex, 0, 24*60*60 );
                }
                print( " </div></td>\n" );
                print( "</tr>\n" );
            }
            print( "<tr>\n" );
            print( strftime( " <td>%G-%m-%d</td>\n" ));
            print( " <td colspan=\"24\"><div class=\"bar\">\n" );
            foreach( $deviceStatus as $deviceIndex => $timeOfDay ) {
                drawBar( $deviceIndex, 0, $now, 1 );
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
require( 'emit-current-time.php' );
?>
</div>
