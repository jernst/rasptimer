#
# Perl script that outputs the Rasptimer PHP config.php file, based on the parameters
# given in the Indie Box Site JSON. Note that this is a perl scriptlet that outputs
# PHP, so some of the PHP variable names had to be escaped with \$
#

use strict;
use warnings;

my $title = $config->getResolve( 'appconfig.installable.customizationpoints.title.value' );

my $ret = <<END;
<?php
// Configuration file. Automatically generated upon installation using "indie-box-admin deploy"
//

// Title of the web page
\$title = "$title";

// The devices being controlled.
// key:   name of the device
// value: wiringPi PIN number, see https://projects.drogon.net/raspberry-pi/wiringpi/pins/

\$devices = array(
END

for( my $i=0 ; $i<32 ; ++$i ) { # not sure exactly how many we need to check for
    my $label = $config->getResolveOrNull( "appconfig.installable.customizationpoints.pin$i.value", undef, 1 );
    if( $label ) {
        $ret .= "    \"$label\" => $i,\n";
    }
}

$ret .= <<'END';
);

// Where to log events.
$logFile      = "/var/log/rasptimer.log";

// "Glob" expression that finds all log files, including old ones. The syntax is the same as in a shell:
// * and ? are wildcards.
$logFilesGlob = "/var/log/rasptimer.log*";

// Regular expression that parses file names of log files other than the current one.
$oldLogFilesPattern = "/var/log/rasptimer\.log\.(\d+)(\.gz)?";

// Printf expression that creates candidate file names of log files other than the current one
$oldLogFilesPrintf = array( "/var/log/rasptimer.log.%d", "/var/log/rasptimer.log.%d.gz" );
END

$ret;

