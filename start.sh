#!/bin/sh
set -eu

# Activar un solo MPM compatible con PHP.
a2dismod mpm_event mpm_worker
a2enmod mpm_prefork

listen_port="${PORT:-8080}"
sed -i "s/Listen 80/Listen ${listen_port}/" /etc/apache2/ports.conf
sed -i "s/:80>/:${listen_port}>/" /etc/apache2/sites-available/000-default.conf

apache2ctl -t
apache2ctl -M
exec apache2-foreground