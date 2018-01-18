# Nginx vhost Manager

This tool uses PHP + Silex + Sqlite to make the management of Nginx's vhosts using templates of `.conf` files,
dynamic configuration of paths and authenticated access.

## Instalation
In your server, follow the above steps:

1. Clone this repo;
1. Execute `composer install` inside new folder;
1. Execute `bower install` inside new folder;
1. Copy self vhost config to vhosts folder `cp provison/nginx-vhost-manager.conf vhosts`.
As **default** this is configured to listen on port `8080`, uses
`/srv/www/nginx-vhost-manager/public` as root folder and use `fastcgi_pass 127.0.0.1:9000`
to send code to PHP-FPM ,
if necessary you should make appropriate changes;
1. Make the Nginx proccess user as owner of `vhosts` folder, as exemple: `chown -R www-data vhosts`
1. Copy `provision/app.db` to `database/app.db`;
1. Access from browser (if you're using default config it's something like `localhot:8080`);
1. Use `admin:foo` credentials for first access, then **change the password** (TODO).
For now, we strongly encourages to use this only inside a VPN.
1. Edit your Nginx configuration file (normally `/etc/nginx/nginx.conf`) to add
an `include` directive on the `http` section as follow: `include ABSOLUTE_PATH_TO_THIS_APP/vhosts`.
Note that `ABSOLUTE_PATH_TO_THIS_APP` will be `/srv/www/nginx-vhost-manager`
if using default config, or your custom path.

## Usage
With installation done, you must create your own Nginx configuration templates inside `templates` folder,
you can use the `.dist` file as base;

If you desire, you could put a folder named `default-files` inside `templates`, and when you check the option 
**Copy files from template folder** while creating a vHost, then the files will be copied to `../HOST_NAME_OF_VHOST_BEING_CREATED`

### Auto reload Nginx configuration
To make the usage even easier, we suggest use the tool [incron](http://inotify.aiken.cz/?section=incron&page=doc&lang=en) wich will watch for
the *.conf* file changes and performs an Nginx reload.

Exemple of **incrontab** entry in a SO using *systemctl*: `/srv/www/nginx-vhost-manager/vhosts IN_CLOSE_WRITE systemctl reload nginx`