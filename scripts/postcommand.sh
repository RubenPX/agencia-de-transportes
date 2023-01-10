# /bin/bash

# This file is created to set some VM config

# Link "/var/www/html" to src folder
echo "> Link /var/www/html to /src"
sudo chmod a+x "$(pwd)/src/" && sudo rm -rf /var/www/html && sudo ln -s "$(pwd)/src/" /var/www/html

echo "> link arror.log & access.log to devcontainer folder"
sudo chmod a+x "$(pwd)/.devcontainer/logs/apache2/"

sudo rm /var/log/apache2/error.log
sudo rm /var/log/apache2/access.log

sudo ln -s "$(pwd)/.devcontainer/logs/apache2/error.log" /var/log/apache2/error.log
sudo ln -s "$(pwd)/.devcontainer/logs/apache2/access.log" /var/log/apache2/access.log

# Enabling module rewrite (Apache config)
echo "> Enable a2enmod rewrite"
sudo a2enmod rewrite

# composer install dependencies
echo "> composer install"
composer install

# Start apache server
echo "> Start Apache"
apache2ctl start

# Register post command run
date >> .devcontainer/logs/PostCommandRuns.log