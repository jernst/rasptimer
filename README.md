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

1. Install the tools and dependencies you need:

    > sudo pacman -Syu
    > sudo pacman -S git base-devel wiringpi

2. Clone this repository:

    > git clone https://github.com/jernst/rasptimer.git

3. Build the UBOS package with:

    > cd rasptimer
    > makepkg -c -f

3. Install the UBOS package for rasptimer:

    > sudo pacman -U rasptimer-*-any.pkg.tar.xz

4. Create a site that runs rasptimer:

    > sudo ubos-admin createsite --ask

and answer the questions. Enter "rasptimer" as the name of the app,
and select '*' as your hostname.
