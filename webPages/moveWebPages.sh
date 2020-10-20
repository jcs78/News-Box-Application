#!/bin/bash

sudo rm -r /var/www/html

sudo cp -r ../webPages /var/www/webPages

sudo mv /var/www/webPages /var/www/html

sudo systemctl restart apache2
