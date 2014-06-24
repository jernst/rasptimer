<p>It currently is <?php print( date( "H:i:s" )) ?>.
<?php
if( preg_match( '/(\d+(?:\.\d*))\s+(\d+(?:\.\d*))/', file_get_contents( '/proc/uptime' ), $matches )) {
    printf( "Up for %d days, %02d:%02d:%02d hours.", $matches[1]/(24*60*60), ($matches[1]/(60*60))%24, ($matches[1]/60)%60, $matches[1]%60 );
}
?>
   <a href="">Refresh</a>.
</p>
