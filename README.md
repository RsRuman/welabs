## Project setup/installation guides
Please Follow the guideline to set up locally.

- Laravel 11 (php 8.3/8.2)

### Installation process after cloning from git

1. composer install
2. cp .env.example .env
3. update variable APP_TIMEZONE=Asia/Dhaka in .env
4. set variable in .env
   SLACK_BOT_USER_DEFAULT_CHANNEL and
   SLACK_BOT_USER_OAUTH_TOKEN
5. php artisan key:generate
6. set database mysql and update related things in .env (for example your database name, password) or set DB_CONNECTION=sqlite
7. php artisan migrate
8. php artisan generate:salat_time and provide time for each waqt
9. php artisan queue:work
10. php artisan schedule:work

# note:
I didn't make a video guide due to personal time complexity.
Hope everything work fine. If any issue occurs please let me know.
