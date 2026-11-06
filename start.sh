#!/bin/sh
set -eu
listen_port="${PORT:-8080}"
sed -i "s/Listen 80/Listen ${listen_port}/" /etc/apache2/ports.conf
sed -i "s/:80>/:${listen_port}>/" /etc/apache2/sites-available/000-default.conf
exec apache2-foreground
