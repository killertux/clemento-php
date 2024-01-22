#!/bin/bash
composer install && sleep 1 && php -S 0.0.0.0:4241 -t /app/public
