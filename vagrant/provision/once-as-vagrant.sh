#!/usr/bin/env bash

#== Import script args ==

github_token=$(echo "$1")

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

#== Provision script ==

info "Provision-script user: `whoami`"

info "Configure composer"
composer config --global github-oauth.github.com ${github_token}
echo "Done!"

info "Install plugins for composer"
composer global require "fxp/composer-asset-plugin:^1.3.1" --no-progress

info "Install project dependencies"
cd /var/www/portal
composer --no-progress --prefer-dist install

info "Init project"
php init --env=Development --overwrite=All

info "Apply migrations"
php yii migrate --migrationPath=@vendor/kouosl/portal-user/migrations --interactive=0
php yii migrate --migrationPath=@vendor/kouosl/portal-site/migrations --interactive=0
php yii migrate --migrationPath=@vendor/kouosl/portal-content/migrations --interactive=0

info "Enabling colorized prompt for guest console"
sed -i "s/#force_color_prompt=yes/force_color_prompt=yes/" /home/vagrant/.bashrc
