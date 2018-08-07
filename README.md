Introduction:

This project is based on the Faqbot project.
Faqbot project link: https://github.com/NJIT-WIS/faqbot

Below process is for Docker CE, If you use Docker ToolBox,please go to docker tutorial:https://github.com/NJIT-WIS/faqbot/wiki/Docker-Tutorial-New#docker


Running requirement:
$ git clone https://github.com/gongyuhua/faqbot.git

Aliases
Enter the aliases into your bash terminal as-is

Bash alias for Composer:

alias composer='docker run --rm -v `pwd`:/app composer'

PHP:

alias php='docker run --rm -v `pwd`:/p -w /p php:7-fpm-alpine php'

Project PHP container:

alias faqphp='docker exec -w /code faqbot_php_1'
Aliases can be saved into ~/.bashrc for future use.

Running steps:

Step 1
Make .env.docker your default .env
Run:
$ cp .env.docker .env

Step 2
Get dependencies with composer
Use composer alias to get dependencies required to run the project

$ composer install

Populate APP_KEY
Run:

$ php artisan key:generate

$ composer require botman/installer

$ composer require predis/predis

$ composer update

Run composer update twice if it gives you an error the first time

Step 3
Non-Docker-Toolbox Section
Navigate to the directory of the cloned repo and run:

$ docker-compose up

Use docker-compose up -d to start the containers in the background.

Use docker-compose stop to stop the containers in the background.

While the containers are running open your web browser and enter http://localhost in your addressbar.


Step 4
Artisan commands
Once the containers are running, in either the foreground or background, execute the following artisan commands in your repo directory.

$ faqphp php artisan migrate
$ faqphp php artisan elastic:create-index App\\QuestionIndexConfigurator
$ faqphp php artisan elastic:create-index App\\TagIndexConfigurator
$ faqphp php artisan db:seed
After executing those commands, you should have a functional project.

To test whether or not you have a functional project, run the unit tests:

$ faqphp ./vendor/bin/phpunit


Display:

Create a free account at : https://mailtrap.io/
copy and paste the smtp credentials to .env (mail_username and mail_password)
run faqphp php artisan queue:work in your terminal 

Then go to http://localhost, post a new answer and save, then you will see new email in mailtrap.



