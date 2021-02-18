# Laravel-Barebone-Admin-Panel-Bootstrap-4-Boilerplate-
Laravel 8.x with PHP 8 using bootstrap 4 premade admin panel. Out of the box administration for building custom admin template style websites using Laravel MVC framework. PLEASE STAR THIS REPO &lt;3 

Instructions:

1) Install the .sql file to your MySQL database
2) Copy the files to your host
3) Change the database connection strings in the .env file. Also run ```php artisan key:generate``` on the root directory. (usual laravel installation)
4) Change the salt string in app/Models/Admin_model.php (line 16) to something else random (if you do this you can't login with current password if you cant figure out how to change salt and get logged in then you probably shouldn't code)
5) Login with user: admin password: admin (if you want to login before changing salt)

I included the vhost file for an example on using it on xampp. You would have to update the vhost file changing your domain to the one you want to use for local, as well your host file to point to 127.0.0.1 when visiting the domain in your browser.


I made this because there are so many projects I want to do where I need a basic admin login with potential for administrative roles. (Also I originally made this for CodeIgniter using PHP 5.6 to PHP 7. Now with PHP 8 available and Laravel being a clear winner of market share, here is something to help)

You are free to use it, but please don't fork it, and when you show your job recruiter your sample code don't send mine.

Credits: 

1. Bootstrap 4
2. Laravel 8.x 
3. PHP 8
4. Free admin template source (https://startbootstrap.com/template-overviews/sb-admin-2/) 

Send me money to my coinbase wallet if you want to buy me a beer for this
```@jopanel```
