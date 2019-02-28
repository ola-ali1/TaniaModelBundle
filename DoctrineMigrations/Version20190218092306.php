<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190218092306 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

       // $this->addSql('DROP TABLE #Tableau_01_sid_003F34F7_4_Group');
        $this->addSql('ALTER TABLE `order` DROP created_by, DROP address_verified_cron_count, DROP rating_tag_id, CHANGE closed_by_fullName closed_by_fullName VARCHAR(100) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE first_payment_price first_payment_price NUMERIC(10, 2) DEFAULT NULL, CHANGE second_payment_method second_payment_method VARCHAR(255) DEFAULT NULL, CHANGE second_payment_price second_payment_price NUMERIC(10, 2) DEFAULT NULL, CHANGE address_verified address_verified INT DEFAULT NULL, CHANGE app_version app_version VARCHAR(255) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

       // $this->addSql('CREATE TABLE #Tableau_01_sid_003F34F7_4_Group (Number Of Used Times, promo_code_method, promo_code_name and 1 VARCHAR(30) DEFAULT NULL COLLATE utf8_general_ci, numberOfUsedTimes INT DEFAULT 0, promo_code_method VARCHAR(11) DEFAULT NULL COLLATE utf8mb4_general_ci, promo_code_name VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_general_ci, title (promo_code) VARCHAR(190) DEFAULT NULL COLLATE utf8mb4_general_ci, INDEX _tidx_#Tableau_01_sid_003F34F7_4_Group_3a (promo_code_method), INDEX _tidx_#Tableau_01_sid_003F34F7_4_Group_4a (promo_code_name(8)), INDEX _tidx_#Tableau_01_sid_003F34F7_4_Group_1a (Number Of Used Times, promo_code_method, promo_code_name and 1), INDEX _tidx_#Tableau_01_sid_003F34F7_4_Group_5a (title (promo_code)(12))) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `order` ADD created_by INT DEFAULT NULL COMMENT \'currently driverId\', ADD address_verified_cron_count INT DEFAULT 0, ADD rating_tag_id INT DEFAULT NULL, CHANGE second_payment_method second_payment_method VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_general_ci COMMENT \'New\', CHANGE first_payment_price first_payment_price NUMERIC(10, 2) DEFAULT NULL COMMENT \'New\', CHANGE second_payment_price second_payment_price NUMERIC(10, 2) DEFAULT NULL COMMENT \'New\', CHANGE price price NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE app_version app_version VARCHAR(256) DEFAULT NULL COLLATE utf8mb4_general_ci, CHANGE address_verified address_verified INT DEFAULT 1, CHANGE closed_by_fullName closed_by_fullName VARCHAR(256) DEFAULT NULL COLLATE utf8mb4_general_ci, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }
}
