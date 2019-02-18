<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190218092947 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

       // $this->addSql('DROP TABLE #Tableau_01_sid_003F34F7_4_Group');
        $this->addSql('ALTER TABLE `order` CHANGE price price NUMERIC(19, 4) DEFAULT \'0.00\' NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        //$this->addSql('CREATE TABLE #Tableau_01_sid_003F34F7_4_Group (Number Of Used Times, promo_code_method, promo_code_name and 1 VARCHAR(30) DEFAULT NULL COLLATE utf8_general_ci, numberOfUsedTimes INT DEFAULT 0, promo_code_method VARCHAR(11) DEFAULT NULL COLLATE utf8mb4_general_ci, promo_code_name VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_general_ci, title (promo_code) VARCHAR(190) DEFAULT NULL COLLATE utf8mb4_general_ci, INDEX _tidx_#Tableau_01_sid_003F34F7_4_Group_3a (promo_code_method), INDEX _tidx_#Tableau_01_sid_003F34F7_4_Group_4a (promo_code_name(8)), INDEX _tidx_#Tableau_01_sid_003F34F7_4_Group_1a (Number Of Used Times, promo_code_method, promo_code_name and 1), INDEX _tidx_#Tableau_01_sid_003F34F7_4_Group_5a (title (promo_code)(12))) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `order` CHANGE price price NUMERIC(10, 2) DEFAULT \'0.00\'');
    }
}
