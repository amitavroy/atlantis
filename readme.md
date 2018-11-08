# Atlantis

![Build Status](https://img.shields.io/travis/amitavroy/atlantis.svg)

![Atlantis](https://d15dxe0kapai5v.cloudfront.net/misc/prime_04.jpg)

This is an application which I will use for many of my day to day activity. Customisations can be made for personal use as well. But, the overall development is not done with any multi tenant or multiple users of different groups in mind. The different modules available in this application is listed below with a brief of their specifications.

## Features
1. Added the [Vali theme](https://pratikborsadiya.in/vali-admin/) to the project.

2. Tasks - This is a way for me to keep a track of things that I need to do and things which are pending along with comments for each tasks.

3. Site Monitoring - A module which I use to monitor the uptime of my sites. A simple code which runs every minute and call the site urls and records the time. If the previous time is more than 30% of the average then an email is sent to the mentioned email address.

4. Expense capturing - This application is also used to capture expense. There are categories of expense which is unique to a family and based on that a User in that family can add expenses. And then there are certain reports available to the User like month wise total expense, category wise data etc.

5. Document management - Using S3 bucket, I can manage my documents. I can view the files on the S3 bucket. [NOTE: WIP - more features to come]

6. Github Projects - Using the Github project module, I can keep an eye on the key parameters of some of my selected projects like Stars, Issues. Will also need to add the Downloads information which will be available from Packagist.

7. Reminder - As a user, I can set up different kinds of reminders like 'Bill', 'Birthday' etc. Everyday, the application will check for any new reminder and then create an event for the same. These events will be visible on the dashboard. Right now, for Bills, there is a Pay button which will allow to make a payment and add an expense linking the reminder to it.

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
