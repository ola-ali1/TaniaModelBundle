<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180402133800 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE promo_code (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(11) NOT NULL COMMENT \'available types are fixed-value and percentage\', title VARCHAR(190) NOT NULL, code VARCHAR(10) NOT NULL, discountAmount NUMERIC(8, 2) NOT NULL COMMENT \'Based on type the maximum value should be either 100 or 999999\', expiryTime DATETIME DEFAULT NULL, activeDurationInDaysAfterTheAddByUser INT DEFAULT NULL, maximumNumberOfAllowedTimesPerUser INT DEFAULT NULL, maximumNumberOfUsersAllowedToUse INT DEFAULT NULL, maximumAllowedTimesForAllUsers INT DEFAULT NULL, numberOfUsedByUsers INT DEFAULT 0 NOT NULL, numberOfUsedTimes INT DEFAULT 0 NOT NULL, usageTotalAmount NUMERIC(12, 2) DEFAULT \'0\' NOT NULL, sendToAllUsers TINYINT(1) DEFAULT \'0\' NOT NULL, enabled TINYINT(1) DEFAULT \'1\' NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, UNIQUE INDEX UNIQ_3D8C939E77153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE promo_code');
    }
}
