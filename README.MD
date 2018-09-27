# What is this?

Just a simple POC how to use softdeletable with Symfony 4

## Install + setup

- Clone repo
- make necessary changes to `.env` file (database, etc.)
- run following commands:
```bash
composer install
./bin/console doctrine:database:create
./bin/console doctrine:schema:create
```

## How to use

Start webserver with following command:
```bash
./bin/console server:start
```

Open `http://127.0.0.1:8000` URL with your browser.

Create / delete books and check your database that _deleted_ books aren't really deleted.
