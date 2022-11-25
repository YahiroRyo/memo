#!/bin/sh

set -eu

dockerComposeYml='docker-compose.yml'

Main() {
    hereIn
    dockerComposeUp
    runFormat
    exit 0
}

hereIn() {
    here=$(pwd)
    printf '[Annotation] We do the command here... %s' "$here"
    printf '\n'
}

dockerComposeUp() {
    printf '[docker compose] Start on...'
    printf '\n'

    if [ ! -e $dockerComposeYml ]; then
        errorPrint '[docker compose] docker-compose.yml file does not exists.'
    fi

    dockerComposeUpResult=$(docker compose up -d)

    if [ $? -ne 0 ]; then
        echo "$dockerComposeUpResult"
        errorPrint '[docker compose] fail to run docker compose up.'
    fi
}

runFormat() {
    printf '[Format] Start on...'
    printf '\n'

    docker compose exec memo-api ./vendor/bin/php-cs-fixer fix .
}

errorPrint() {
  printf "\n"
  printf "[ERROR] %s\n" "$1"
  exit 1
}

Main