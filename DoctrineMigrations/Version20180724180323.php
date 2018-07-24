<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180724180323 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE promo_code_city (id INT AUTO_INCREMENT NOT NULL, promo_code_id INT DEFAULT NULL, city_id INT DEFAULT NULL, INDEX IDX_337A0F4E2FAE4625 (promo_code_id), INDEX IDX_337A0F4E8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE promo_code_city ADD CONSTRAINT FK_337A0F4E2FAE4625 FOREIGN KEY (promo_code_id) REFERENCES promo_code (id)');
        $this->addSql('ALTER TABLE promo_code_city ADD CONSTRAINT FK_337A0F4E8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE promo_code_city');
    }
}
