This README is for new members of the [Ethics Project](https://cgae.sjtu.edu.cn/).

# Get involved

## Install Laravel

For MacOS, use Homebrew to install  `compose`, and run `compose global require lavarel/installer` to install Laravel. You may get the error message telling you that the php module `php-zip` is missing. In this case, use Homebrew to install php instead of using the one shipped with MacOS. The missing module is already included in the Homebrew php. As another benefit, you can later install other modules more easily.

## Connecting to the git server

We use a self-hosted git server set to accept connection via ssh. To connect to the server to fetch the code, you should email your ssh public key to Manuel, and he will give you access to the server. 

### Generate and set up your ssh public key

Use ssh-keygen for MacOS and Linux. Send the public key to Manuel, and put the private key in your .ssh folder. Then edit ~/.ssh/config to add these:

    Host focs.ji.sjtu.edu.cn
        IdentityFile /path/to/private.key

### Connect to the server

Use  `git clone ssh://git@focs.ji.sjtu.edu.cn:2222/your-git`  to fetch the code. Currently there are two repos: `ethics-frt` for the frontend and `ethics-bck` for the backend.

# Environment Setup - frontend

## Setting up Laravel

Trying to serve the website directly will cause errors. This is because you haven't set up Laravel for this project yet.

### Generate the vendor directory

Make sure you are in the project root directory. Then use `composer install` to generate the vendor directory automatically.

### Generate an application key

> I don't understand details about this procedure.

Make sure you are in the project root directory. Then use `php artisan key:generate` to generate a key, which will be displayed. Create a file named  `.env` , and add the following into it:

    APP_KEY=(paste the key here)
    
Use `php artisan config:cache` to make the changes take effect. 

>Do this every time you edit `.env`!
    
### Setting up the database

Refer to `Google` to set up your own MySQL server. Other database servers should also be OK but I know nothing about them. 

>Do not use Baidu!

Pay attention that the latest MySQL update deleted the PASSWORD function and made `caching_sha2_password` the default authentication plugin. This gives rises to compatibility issues. Make sure to use `mysql_native_password` for the user used for this project.

Edit the `.env` file and add these keys:

    DB_HOST=(your database server address, typically 127.0.0.1)
    DB_PORT=(your database server port, typically 3306)
    DB_USERNAME=(a user with full access to the project database, do not use root)
    DB_PASSWORD=(the password for the user)
    DB_DATABASE=(the project database)
    
Use `php artisan migrate` to initialize the database.

> You may encounter an error message. I ignored it and nothing happened. Reserved for research.

### Launching the web server

Make sure you are in the project root directory. Use `php artisan serve` to launch a web server on `127.0.0.1:8000`. 

You can also use other web server softwares. For Apache, remember to enable the rewrite module and the php module. Also, remember to use the `AllowOverride All` directive to make the `public/.htaccess` file take effect.

>Note: Admin account
>>user: rolson@example.org
>>password: 123456

## Develop Procedure Regarding Front-End

>I don't understand this - this is not written by me. I just kept it here.

1. remember to pull from the git repo before some programming, may use `git stash`
2. after push to the git repo, log on to the front-end server, `cd /var/www/new-server` to pull from the back-end, so that changes can be done to the website
