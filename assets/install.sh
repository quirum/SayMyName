#!/bin/bash
cd /var/www/html/admin/modules/saymyname/assets/ && /usr/bin/npm install
su asterisk -c "cd /var/www/html/admin/modules/saymynamene/assets/ && /usr/bin/npm install -g"