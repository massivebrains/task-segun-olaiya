### About
This is a simple Tasks app with support for projects. It uses Laravel, Inertia & Vue as it was created from the starter kit.

### Setup
1. Pull this repo and update the Database `.env` keys
2. Run `composer install` and `npm install`
3. Run `php artisan migrate`
4. Run `composer run dev`

### Demo
Please see demo below:

https://drive.google.com/file/d/1O6yaR86ksxnWOx7whvkOZmyjqOSnO2z-/view?usp=sharing


### Deployment
Since this is a simple Laravel App, You can simply dockerize this app if you like and run it as a container, or run it on a bare bone server like EC2.

### Deploying on a barebone EC2
1. Ensure your AWS VPC is setup properly (Including your Subnets & Security groups)
2. Create a new EC2 instance (preferrably ubuntu)
3. Ssh into the EC2 box
4. Install Nginx
5. Copy the default nginx config from Laravel here: https://laravel.com/docs/11.x/deployment#nginx
6. Install git
7. Navigate to `/var/www/html` and pull this repo
8. Follow the same setup as above in the `Setup` section
9. Install Lets encrypt and configure it for https
> Note: This steps are just summaries
