<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240421043943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Add SQL statements to check for table existence and handle appropriately

        if ($schema->hasTable('customer')) {
            $this->addSql('CREATE TEMPORARY TABLE __temp__customer AS SELECT customer_id, title, lastname, firstname, postal_code, city, email FROM customer');
            $this->addSql('DROP TABLE customer');
        }

        $this->addSql('CREATE TABLE IF NOT EXISTS customer (customer_id INTEGER PRIMARY KEY AUTOINCREMENT, title INTEGER NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL)');

        if ($schema->hasTable('customer')) {
            $this->addSql('INSERT INTO customer (customer_id, title, lastname, firstname, postal_code, city, email) SELECT customer_id, title, lastname, firstname, postal_code, city, email FROM __temp__customer');
            $this->addSql('DROP TABLE __temp__customer');
        }

        if ($schema->hasTable('purchase')) {
            $this->addSql('CREATE TEMPORARY TABLE __temp__purchase AS SELECT purchase_identifier, customer_id, product_id, quantity, price, currency, date FROM purchase');
            $this->addSql('DROP TABLE purchase');
        }

        $this->addSql('CREATE TABLE IF NOT EXISTS purchase (purchase_identifier VARCHAR(255) PRIMARY KEY, customer_id INTEGER NOT NULL, product_id INTEGER NOT NULL, quantity INTEGER NOT NULL, price INTEGER NOT NULL, currency VARCHAR(255) NOT NULL, date DATETIME NOT NULL)');

        if ($schema->hasTable('purchase')) {
            $this->addSql('INSERT INTO purchase (purchase_identifier, customer_id, product_id, quantity, price, currency, date) SELECT purchase_identifier, customer_id, product_id, quantity, price, currency, date FROM __temp__purchase');
            $this->addSql('DROP TABLE __temp__purchase');
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('customer')) {
            $this->addSql('CREATE TEMPORARY TABLE __temp__customer_backup AS SELECT customer_id, title, lastname, firstname, postal_code, city, email FROM customer');
            $this->addSql('DROP TABLE customer');
        }
        
        $this->addSql('CREATE TABLE customer (customer_id INTEGER NOT NULL, title INTEGER NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(customer_id))');
        
        if ($schema->hasTable('__temp__customer_backup')) {
            $this->addSql('INSERT INTO customer (customer_id, title, lastname, firstname, postal_code, city, email) SELECT customer_id, title, lastname, firstname, postal_code, city, email FROM __temp__customer_backup');
            $this->addSql('DROP TABLE __temp__customer_backup');
        }
        
        if ($schema->hasTable('purchase')) {
            $this->addSql('CREATE TEMPORARY TABLE __temp__purchase_backup AS SELECT purchase_identifier, customer_id, product_id, quantity, price, currency, date FROM purchase');
            $this->addSql('DROP TABLE purchase');
        }
        
        $this->addSql('CREATE TABLE purchase (purchase_identifier VARCHAR(255) NOT NULL, customer_id INTEGER NOT NULL, product_id INTEGER NOT NULL, quantity INTEGER NOT NULL, price INTEGER NOT NULL, currency VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(purchase_identifier))');
        
        if ($schema->hasTable('__temp__purchase_backup')) {
            $this->addSql('INSERT INTO purchase (purchase_identifier, customer_id, product_id, quantity, price, currency, date) SELECT purchase_identifier, customer_id, product_id, quantity, price, currency, date FROM __temp__purchase_backup');
            $this->addSql('DROP TABLE __temp__purchase_backup');
        }
    }
}
