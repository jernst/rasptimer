developer=http://upon2020.com/
url="https://github.com/jernst/rasptimer/"
maintainer=$_developer
pkgname=$(basename $(pwd))
pkgver=0.9
pkgrel=1
pkgdesc="Timer app for GPIO pins"
arch=('any')
license=('GPL')
depends=('at' 'wiringpi')
options=('!strip')

package() {
# Manifest
    install -D -m0644 ${startdir}/ubos-manifest.json ${pkgdir}/ubos/lib/ubos/manifests/${pkgname}.json

# Icons
    # install -D -m0644 ${startdir}/appicons/{72x72,144x144}.png -t ${pkgdir}/ubos/http/_appicons/${pkgname}/

# Templates
    install -D -m0644 ${startdir}/tmpl/* -t ${pkgdir}/ubos/share/${pkgname}/tmpl/

# Web stuff
    mkdir -p ${pkgdir}/ubos/share/${pkgname}/web
    cp -a ${startdir}/web/* ${pkgdir}/ubos/share/${pkgname}/web/

# Logs
    install -D -m0644 ${startdir}/logrotate.d-rasptimer -t ${pkgdir}/etc/logrotate.d/
}
