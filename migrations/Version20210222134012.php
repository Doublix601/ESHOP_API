<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210222134012 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, siren VARCHAR(15) NOT NULL, num_tva VARCHAR(30) NOT NULL, adress VARCHAR(100) NOT NULL, cp INT NOT NULL, city VARCHAR(50) NOT NULL, country VARCHAR(35) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(50) NOT NULL, price DOUBLE PRECISION NOT NULL, delivery_time INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, date DATE NOT NULL, client INT NOT NULL, products INT NOT NULL, ht INT NOT NULL, tva INT NOT NULL, ecotax INT NOT NULL, delivery_price INT NOT NULL, ttc INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, date DATE NOT NULL, client INT NOT NULL, products INT NOT NULL, ht INT NOT NULL, tva INT NOT NULL, ecotax INT NOT NULL, delivery_price INT NOT NULL, ttc INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_name VARCHAR(50) DEFAULT NULL, nb_ventes INT NOT NULL, label VARCHAR(30) NOT NULL, brand VARCHAR(25) NOT NULL, ht_price DOUBLE PRECISION NOT NULL, description VARCHAR(10000) NOT NULL, tva INT NOT NULL, ecotax DOUBLE PRECISION NOT NULL, delivery_option VARCHAR(50) NOT NULL, delivery_price INT NOT NULL, discount INT NOT NULL, stock INT NOT NULL, img VARCHAR(255) NOT NULL, ttc_price DOUBLE PRECISION NOT NULL, description_courte VARCHAR(100) NOT NULL, INDEX IDX_D34A04ADD5B80441 (category_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, cp VARCHAR(5) NOT NULL, city VARCHAR(35) NOT NULL, country VARCHAR(35) NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, active TINYINT(1) NOT NULL, mail_confirmation VARCHAR(180) DEFAULT NULL, pass_confirmation VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADD5B80441 FOREIGN KEY (category_name) REFERENCES category (name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADD5B80441');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE delivery');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE user');
    }
}
