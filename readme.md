# TARO installation process

 The TARO project uses the laravel MVC framework as a base. Installation + running the website:
 1. Install Composer(https://getcomposer.org/)
 2. Install XAMPP (https://www.apachefriends.org/index.html)
 3. Pull the repository and put it in the htdocs folder inside the newly created xampp folder
 4. Navigate to the repository folder in a cms/terminal and run 'composer install'
 5. Change/create your .env file. Should look something like this but it will depend on your OS/xampp version:
 APP_ENV=local
 APP_KEY=base64:7av5YTgFFeo/uPa2g1gmuO1fLell+8Xct/SmmW4V1T4=
 APP_DEBUG=true
 APP_LOG_LEVEL=debug
 APP_URL=http://localhost

 DB_CONNECTION=mysql
 DB_HOST=127.0.0.1
 DB_PORT=8889
 DB_DATABASE=taro
 DB_USERNAME=root
 DB_PASSWORD=root

 BROADCAST_DRIVER=log
 CACHE_DRIVER=file
 SESSION_DRIVER=file
 QUEUE_DRIVER=sync

 REDIS_HOST=127.0.0.1
 REDIS_PASSWORD=null
 REDIS_PORT=6379

 MAIL_DRIVER=log
 MAIL_HOST=mailtrap.io
 MAIL_PORT=2525
 MAIL_USERNAME=null
 MAIL_PASSWORD=null
 MAIL_ENCRYPTION=null

 PUSHER_APP_ID=
 PUSHER_KEY=
 PUSHER_SECRET=

 6. Make sure your xampp is running as well as apache and mysql
 7. Create a database called 'taro' via phpmyadmin
 8. Fill the data via the admin or using populate_database.txt via phpmyadmin
 9. Run php artisan serve while being located in the repository folder
 10. Go to http://localhost:8000 and register
 11. If you want to add data via the admin go to the database changing your user's 'is_admin' field is '1'
 Go to http://localhost:8000/admin/categories
 12. Use the website
