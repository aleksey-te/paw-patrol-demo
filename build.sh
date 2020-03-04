#!/usr/bin/env bash

cp /etc/apache2/ssl/*.* ./ssl/
NAME="$( basename $( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd ))"
docker build -t $NAME .

