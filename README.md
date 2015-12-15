rasptimer
=========

Use a Raspberry Pi as a schedulable timer for GPIO hardware, configurable over the web.
Uses [WiringPi](http://wiringpi.com/). While I use it on the original Raspberry Pi,
I can't think of a reason it shouldn't work on Raspberry Pi 2 or Zero.

This is the software for the pool timer project described at
http://upon2020.com/blog/2012/12/my-raspberry-pi-pool-timer-why/

Rasptimer should run on any Linux-based OS that runs on the Raspberry Pi, but you will
have to manually put all the files in the right place, setup your web server, install
packages, including creating the configuration file from the template.

If you run [UBOS](http://ubos.net/), it's much simpler.

Step 1. Write UBOS to an SD Card suitable for your Raspberry Pi, as described
[here](http://ubos.net/docs/users/installation.html).

Step 2. Log on as root, and say:

```
> ubos-admin createsite --ask
```
Then answer the questions. Each pin that you give a name will show up in the
web interface; unnamed pins are skipped. Here is an example transcript:

```
> ubos-admin createsite --ask
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

Step 3. There is no step three :-) The previous command will have downloaded
all the code, and the libraries, created the right Apache config files,
and so forth, and even restarted your web server. Rasptimer is ready to use.

Questions? You often can find me on [#ubos](http://webchat.freenode.net/?channels=%23ubos).
