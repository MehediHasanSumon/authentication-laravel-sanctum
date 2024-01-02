# Laravel Authentication API using Laravel Sanctum

This guide will walk you through setting up a Laravel authentication API using Laravel Sanctum. We will cover the installation process, configuration, and testing using Postman. Make sure you have the following materials ready:

-   Laravel v10.x
-   Laravel Sanctum
-   Postman

## Installation

1. Open your terminal and run the following command to install all dependencies:

```bash
composer install
```

2. Copy the .env.example file and rename it to .env. Configure the database section in the .env file with your database details:


```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=YourDatabaseName
DB_USERNAME=root
DB_PASSWORD=
```

3. Configure the mail section in the .env file for any email-related settings you may need:

```bash
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

4. Run the development server:

```bash
php artisan serve
```

5. Open your browser and navigate to:

```bash
http://127.0.0.1:8000/api/(api routes)
```

## Testing with Postman

1. Use Postman to test the authentication API endpoints. You can use routes like `/register`, `/login`, `/logout`, etc., based on your implementation.
2. Make sure to include the necessary headers for Sanctum. For example:

-   Key: `Accept`, Value: `application/json`
-   Key: `Content-Type`, Value: `application/json`

3. Follow the API documentation or Laravel Sanctum documentation for details on how to interact with the authentication routes.
