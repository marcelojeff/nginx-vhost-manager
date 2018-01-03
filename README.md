# Nginx vhost Manager

This tool uses PHP + Silex + Sqlite to make the management of Nginx's vhosts using templates of `.conf` files,
dynamic configuration of paths and authenticated access.

## Instalation
In your server, follow the above steps:

1. Clone this repo;
1. Execute `composer install` inside new folder;
1. Copy self vhost config to vhosts folder `cp provison/nginx-vhost-manager.conf vhosts`.
As **default** this is configured to listen on port `8080`, uses
`/srv/www/nginx-vhost-manager/public` as root folder and use `fastcgi_pass 127.0.0.1:9000`
to send code to PHP-FPM ,
if necessary you should make appropriate changes;
1. Copy `provision/app.db` to `database/app.db`;
1. Access from browser (if you're using default config it's something like `localhot:8080`);
1. Use `admin:admin` credentials for first access, then **change the password**
to active the App, as before a password change you're unable to use it.
1. Edit your Nginx configuration file (normally `/etc/nginx/nginx.conf`) to add
an `include` directive on the `http` section as follow: `include ABSOLUTE_PATH_TO_THIS_APP/vhosts`.
Note that `ABSOLUTE_PATH_TO_THIS_APP` will be `/srv/www/nginx-vhost-manager`
if using default config, or your custom path.

## Usage
With installation done, you must create your own Nginx configuration templates
