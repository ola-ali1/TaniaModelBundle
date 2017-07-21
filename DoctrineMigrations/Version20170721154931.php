<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170721154931 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` CHANGE card_number card_number VARCHAR(20) DEFAULT NULL, CHANGE expiry_date expiry_date VARCHAR(10) DEFAULT NULL, CHANGE merchant_reference merchant_reference VARCHAR(50) DEFAULT NULL, CHANGE is_default is_default TINYINT(1) DEFAULT \'1\' NOT NULL, CHANGE address address VARCHAR(400) DEFAULT NULL, CHANGE fort_id fort_id VARCHAR(190) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` CHANGE fort_id fort_id VARCHAR(190) NOT NULL COLLATE utf8mb4_general_ci, CHANGE card_number card_number VARCHAR(20) NOT NULL COLLATE utf8mb4_general_ci, CHANGE expiry_date expiry_date VARCHAR(10) NOT NULL COLLATE utf8mb4_general_ci, CHANGE merchant_reference merchant_reference VARCHAR(50) NOT NULL COLLATE utf8mb4_general_ci, CHANGE is_default is_default TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE address address VARCHAR(400) NOT NULL COLLATE utf8mb4_general_ci');
    }
}
