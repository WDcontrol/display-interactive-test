# Backend Setup

Exécuter les commandes ci-dessous pour setup le backend : 

```bash
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php import_data.php
symfony server:start
```


# Frontend Setup

Exécuter les commandes ci-dessous pour setup le frontend : 

```bash
npm install
npm test
npm run start
```