## Pre-requistre
- jdk 17
- docker
- docker compose
- git

## Clone the repo
Run the following command to clone the repository
`$ git clone https://github.com/uswpdjohn/usw-msc-john.git`

## Deployment
Build the gradle in Stirline

`$ cd strline/`

`$ ./gradlew build`

Build Docker in the project root

`$ cd ../`

`$ docker compose build`

`$ docker compose up -d`

Run migration in the laravel docker container

`$ docker exec laravel_app php artisan migrate`

Run seeder command (optional)
`$ docker exec laravel_app php artisan migrate --seed`

## Live Server
The project live url is below (use any one of them)

- http://dmsusw.pdjohn.me
- http://20.195.8.182







