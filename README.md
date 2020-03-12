# Ethics

This README is for new members of the [Ethics Project](https://cgae.sjtu.edu.cn/).

[toc]

## Get involved

### Install Laravel

It's highly recommended to use [Laravel Homestead
](https://laravel.com/docs/6.x/homestead) to develop the project. Homestead is an official, pre-packaged **virtual machine** that provides you a wonderful development environment without requiring you to install PHP, a web server, and any other server software on your local machine. It will make your life easier. A chinese version of installation guidance can be found [here](https://learnku.com/docs/laravel-development-environment/6.x).

### Connect to the git server

We use a self-hosted git server set to accept connection via ssh. To connect to the server to fetch the code, you should email your ssh public key to Manuel, and he will give you access to the server. 

#### Generate and set up your ssh public key

Use ssh-keygen for MacOS and Linux. Send the public key to Manuel, and put the private key in your .ssh folder. Then edit ~/.ssh/config to add these:

    Host focs.ji.sjtu.edu.cn
        IdentityFile /path/to/private.key

#### Connect to the server

Use  `git clone ssh://git@focs.ji.sjtu.edu.cn:2222/your-git`  to fetch the code. Currently there are two repos: `ethics-frt` for the frontend and `ethics-bck` for the backend.

### Environment Setup - frontend

#### Setting up Laravel

Trying to serve the website directly will cause errors. This is because you haven't set up Laravel for this project yet.

#### Generate the vendor directory

Make sure you are in the project root directory. Then use `composer install` to generate the vendor directory automatically.

#### Generate an application key

Make sure you are in the project root directory. Then use `php artisan key:generate` to generate a key, which will be displayed. Create a file named  `.env` , and add the following into it:

    APP_KEY=(paste the key here)

Use `php artisan config:cache` to make the changes take effect.

>Do this every time you edit `.env`!

#### Setting up the database

Refer to `Google` to set up your own MySQL server. Other database servers should also be OK but I know nothing about them.

>In Homestead, use `homestead` as username and `secret` as password.

#### Launching the web server

Now you can visit `127.0.0.1:8000` to look at the website, homestead has mapped the website automatically here.

>Note: Admin account
>>user: rolson@example.org
>>password: 123456

### Develop Procedure Regarding Front-End

1. remember to pull from the git repo before some programming, may use `git stash`
2. after push to the git repo, log on to the front-end server, `cd /var/www/new-server` to pull from the back-end, so that changes can be done to the website

## Appendix

### Frames used

- `laravel/ui`
- `barryvdh/laravel-debugbar`- a debugger for laravel
