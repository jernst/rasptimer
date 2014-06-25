_developer=http://upon2020.com/
_maintainer=$_developer
pkgname=rasptimer
pkgver=0.3
pkgrel=1
pkgdesc="Rasptimer"
arch=('any')
url="https://github.com/jernst/rasptimer/"
license=('GPL')
groups=()
depends=(wiringpi)
backup=()
source=()
options=('!strip')
md5sums=()
_parameterize=$(cat <<END
    s!##pkgname##!$pkgname!g;
    s!##pkgdesc##!$pkgdesc!g;
    s!##developer##!$_developer!g;
    s!##maintainer##!$_maintainer!g;
    s!##pkgver##!$pkgver!g;
    s!##pkgrel##!$pkgrel!g;
    s!##license##!$license!g;
END
)
package() {
# Manifest
    mkdir -p $pkgdir/var/lib/indie-box/manifests
    perl -pe "$_parameterize" $startdir/indie-box-manifest.json > $pkgdir/var/lib/indie-box/manifests/${pkgname}.json
    chmod 0644 $pkgdir/var/lib/indie-box/manifests/${pkgname}.json

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
    mkdir -p $pkgdir/var/log
    touch $pkgdir/var/log/rasptimer.log
    chmod 644 $pkgdir/var/log/rasptimer.log
    chown http:http $pkgdir/var/log/rasptimer.log
    mkdir -p $pkgdir/etc/logrotate.d/${pkgname}
    install $startdir/logrotate.d-rasptimer $pkgdir/etc/logrotate.d/rasptimer
}

