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

Step 1. Upgrade UBOS to the latest, and install the tools and dependencies you need:

```
> sudo pacman -Syu
> sudo pacman -S git base-devel wiringpi
```

Step 2. Clone this repository:

```
> git clone https://github.com/jernst/rasptimer.git
```

Step 3. Build the rasptimer package with:

```
> cd rasptimer
> makepkg -c -f
```

Step 4. Install the rasptimer package:

```
> sudo pacman -U rasptimer-*-any.pkg.tar.xz
```

(There's a wildcard so it works with future versions as well)

Step 5. Create a site that runs rasptimer:

```
> sudo ubos-admin createsite --ask
```

and answer the questions in the way that is appropriate for you. E.g:

```
> ubos-admin createsite --ask -n
App to run: rasptimer
Hostname (or * for any): *
App rasptimer suggests context path /rasptimer
Enter context path:
Any accessories for rasptimer? Enter list:
App rasptimer suports a value for title: My pool on-line (duh!)
App rasptimer suports a value for pin1: Main pump
App rasptimer suports a value for pin2: Auxiliary pump
...
Site admin user id (e.g. admin): admin
Site admin user name (e.g. John Doe): Administrator
Site admin user password (e.g. s3cr3t):
Site admin user e-mail (e.g. foo@bar.com): demo@example.com
```

Questions? You often can find me on [#ubos](http://webchat.freenode.net/?channels=%23ubos).
