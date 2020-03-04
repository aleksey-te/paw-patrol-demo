#!/usr/bin/env bash

NAME="$( basename $( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd ))"
docker stop $NAME

