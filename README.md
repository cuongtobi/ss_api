# SS_API
A Super Simple API

## Install the Application
Clone project
```
git clone git@github.com:cuongtobi/ss_api.git
cd ss_api
```

Install dependencies by composer
```
composer install
```

Copy .env.example to .env
```
cp .env.example .env
```

Change environment variables
```
ENVIRONMENT=development
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=api_example
DB_USERNAME=api_user
DB_PASSWORD=api_password
```

To run the application in development, you can run these commands
```
composer start
```

Run this command in the application directory to run the PHPCS
```
composer convention
```
