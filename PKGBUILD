developer=http://upon2020.com/
url="https://github.com/jernst/rasptimer/"
maintainer=$_developer
pkgname=$(basename $(pwd))
pkgver=0.6
pkgrel=3
pkgdesc="Timer app for GPIO pins"
arch=('any')
license=('GPL')
depends=('at' 'wiringpi')
options=('!strip')

package() {
# Manifest
    mkdir -p $pkgdir/var/lib/ubos/manifests
    install -m0644 $startdir/ubos-manifest.json $pkgdir/var/lib/ubos/manifests/${pkgname}.json

# Icons
    # mkdir -p $pkgdir/srv/http/_appicons/$pkgname
    # install -m644 $startdir/appicons/{72x72,144x144}.png $pkgdir/srv/http/_appicons/$pkgname/

# Templates
    mkdir -p $pkgdir/usr/share/${pkgname}/tmpl
    install $startdir/tmpl/config.php.pl $pkgdir/usr/share/${pkgname}/tmpl/
    install $startdir/tmpl/htaccess.tmpl $pkgdir/usr/share/${pkgname}/tmpl/

# Web stuff
    mkdir -p $pkgdir/usr/share/${pkgname}/web
    cp -a $startdir/web/* $pkgdir/usr/share/${pkgname}/web/

# Logs
    mkdir -p $pkgdir/etc/logrotate.d/${pkgname}
    install $startdir/logrotate.d-rasptimer $pkgdir/etc/logrotate.d/rasptimer
}
