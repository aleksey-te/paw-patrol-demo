#!/usr/bin/env bash

NAME="$( basename $( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd ))"

docker exec -it $NAME tail -f /var/log/apache2/error.log
