# Atlantis

This is an application which I will use for many of my day to day activity. It has many modules which are listed below:

1. Added the [Vali theme](https://pratikborsadiya.in/vali-admin/) to the project.
2. Tasks - This is a way for me to keep a track of things that I need to do and things which are pending.
3. Site Monitoring - A module which I use to monitor the uptime of my sites. A simple code which runs every minute and call the site urls and records the time. If the previous time is more than 30% of the average then an email is sent to the mentioned email address.

## Installation
The process to install and run this application are mentioned below. Note that this is primarily for development version and if you want to deploy this kind of an app on any server, there are certain things which you need to secure like Laravel Echo Server keys, ports for running the socket connection, run the server in production mode and few more things.

```
git clone https://github.com/amitavroy/atlantis
```

After doing a git clone, you need to install the composer and node dependencies. So run the following commands

```
composer install
npm install
php artisan migrate --seed
```

Once these commands are executes, we have all the dependencies required and also the database also has some data to start with. You can login to the application.

```
username: reachme@amitavroy.com
password: password
```

For this application to run, there are a few things which need to run as service 
1. You need to run Laravel Echo Server so that the socket connection is maintained and also, for that you need to configure the laravel-echo-server.json file specifically the "authHost" to your application.
2. You need to ensure the cron is running because the site monitoring feature uses cron jobs to check the site health.

For the laravel echo server you can run on your local environment and the laravel echo server will start
```
./node_modules/.bin/laravel-echo-server start
```
