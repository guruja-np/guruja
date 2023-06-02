## Guruja

Use the [composer](https://getcomposer.org/download/) to install php dependencies.

```bash
composer install
```

Use the [npm](https://www.w3schools.com/whatis/whatis_npm.asp) to install js dependencies.

```bash
npm install

#development server
npm run dev

#production server
npm run prod
```

```bash
#generates key for session encryption
php artisan key:generate

#create symlink in public folder
php artisan storage:link

#migrate database
php artisan migrate
php artisan db:seed

php artisan migrate:refresh --seed

```
