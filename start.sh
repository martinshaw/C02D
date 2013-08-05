#!/bin/bash
echo "Setting Up Environment for /webdev/yrs/13/app.karbon"
cd /home/martin/webdev/yrs13
echo "         "
echo "Starting Web Server for /webdev/yrs/13/server/web.karboninstance"
sudo /etc/init.d/apache2 reload
echo "         "
echo "Starting Database Server for /webdev/yrs/13/server/db.karboninstance"
sudo /etc/init.d/mysql reload
echo "         "
echo "Host Records:"
sudo cat /etc/hosts
echo "         "