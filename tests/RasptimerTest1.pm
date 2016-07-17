#!/usr/bin/perl
#
# Simple test for rasptimer
#

use strict;
use warnings;

package RasptimerTest1;

use UBOS::WebAppTest;

# The states and transitions for this test

my $TEST = new UBOS::WebAppTest(
    appToTest   => 'rasptimer',
    description => 'Tests whether rasptimer comes up',
    checks      => [
            new UBOS::WebAppTest::StateCheck(
                    name  => 'virgin',
                    check => sub {
                        my $c = shift;
                        
                        $c->getMustContain(    '/', 'Current status', undef, 'Wrong front page' );

                        return 1;
                    }
            )
    ]
);

$TEST;
