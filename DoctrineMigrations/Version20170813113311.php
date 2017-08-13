<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170813113311 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE balance_request');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE balance_request (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, driver_id INT DEFAULT NULL, name VARCHAR(190) NOT NULL COLLATE utf8mb4_general_ci, balance NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL, balance_price NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL, status VARCHAR(190) NOT NULL COLLATE utf8mb4_general_ci, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, van_number VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_general_ci, username VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_general_ci, driver_phone VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_general_ci, driver_fullName VARCHAR(190) DEFAULT NULL COLLATE utf8mb4_general_ci, driver_fullNameAr VARCHAR(190) DEFAULT NULL COLLATE utf8mb4_general_ci, driver_image VARCHAR(300) DEFAULT NULL COLLATE utf8mb4_general_ci, driver_rate NUMERIC(4, 2) DEFAULT NULL, INDEX FK_F7CAD25A76ED395 (user_id), INDEX FK_F7CAD25C3423909 (driver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE balance_request ADD CONSTRAINT FK_F7CAD25A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE balance_request ADD CONSTRAINT FK_F7CAD25C3423909 FOREIGN KEY (driver_id) REFERENCES user (id)');
    }
}
