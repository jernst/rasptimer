rasptimer
=========

Use Raspberry Pi as a timer, configurable over the web.

This will be the software for the pool timer project described at
http://upon2020.com/blog/2012/12/my-raspberry-pi-pool-timer-why/


Installation:
    sudo apt-get update
    sudo apt-get install libapache2-mod-php5
    sudo apt-get install git
    cd ~
    git clone https://github.com/WiringPi/WiringPi.git
    cd WiringPi/wiringPi
    make
    sudo make install
    cd ../gpio
    make
    sudo make install
    cd /var/www
    sudo git clone https://github.com/jernst/rasptimer.git
then visit
    http://1.1.1.1/rasptimer/
    (if 1.1.1.1 is the IP address of your Raspberry Pi)

To add a password:
    sudo vi /etc/apache2/sites-enabled/000-default
        In section <Directory /var/www/, change "AllowOverride None" to "AllowOverride AuthConfig"
    sudo a2enmod auth_digest
    sudo service apache2 restart
    sudo htdigest -c /var/www/.htpasswd "Administrators only" admin
        (use any username instead of 'admin')

