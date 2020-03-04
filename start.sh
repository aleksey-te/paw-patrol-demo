#!/usr/bin/env bash

NAME="$( basename $( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd ))"

if [ -z "$(docker images -q fa-demo-site 2> /dev/null)" ]; then
    ./build.sh
    if [ $? -ne 0 ]; then
        exit 2;
    fi
fi
docker run -d --rm --name $NAME -p 8053:80 -v $PWD:/opt/www $NAME

