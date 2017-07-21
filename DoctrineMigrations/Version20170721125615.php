<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170721125615 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` ADD `shift_from` DATETIME NOT NULL, ADD `shift_to` DATETIME NOT NULL, ADD card_number VARCHAR(20) NOT NULL, ADD expiry_date VARCHAR(10) NOT NULL, ADD merchant_reference VARCHAR(50) NOT NULL, ADD token_name VARCHAR(190) DEFAULT NULL, ADD payment_option VARCHAR(50) DEFAULT NULL, ADD payment_value VARCHAR(50) DEFAULT NULL, ADD is_default TINYINT(1) DEFAULT \'0\' NOT NULL, ADD title VARCHAR(100) DEFAULT NULL, ADD address VARCHAR(400) NOT NULL, ADD longitude NUMERIC(10, 7) DEFAULT \'0\', ADD latitude NUMERIC(10, 7) DEFAULT \'0\', ADD van_number VARCHAR(255) NOT NULL, ADD username VARCHAR(100) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` DROP `shift_from`, DROP `shift_to`, DROP card_number, DROP expiry_date, DROP merchant_reference, DROP token_name, DROP payment_option, DROP payment_value, DROP is_default, DROP title, DROP address, DROP longitude, DROP latitude, DROP van_number, DROP username');
    }
}
