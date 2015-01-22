rasptimer
=========

Use Raspberry Pi as a schedulable timer for GPIO hardware, configurable over the web.
Depends on [WiringPi](http://wiringpi.com/).

This is the software for the pool timer project described at
http://upon2020.com/blog/2012/12/my-raspberry-pi-pool-timer-why/

This should run on any Linux-based OS that runs on the Raspberry Pi, but you will
have to manually put all the files in the right place, including creating the
configuration file from the template.

If you run [UBOS](http://ubos.net/), it's much simpler.

1. Clone this repository
2. Build the UBOS package with:

    > makepkg -c -f

3. Install the UBOS package:

    > sudo pacman -U rasptimer-*-any.pkg.tar.xz

4. Create a site that runs rasptimer:

    > sudo ubos-admin createsite --ask
    App to run: rasptimer

and answer the questions. You might want to choose '*' as your hostname.
