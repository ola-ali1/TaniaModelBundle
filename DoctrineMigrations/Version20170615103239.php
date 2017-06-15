<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170615103239 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE city_area (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, nameAr VARCHAR(15) NOT NULL, nameEn VARCHAR(15) NOT NULL, polygon LONGTEXT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, UNIQUE INDEX UNIQ_34DA0000F757D935 (nameAr), UNIQUE INDEX UNIQ_34DA0000873A407E (nameEn), INDEX IDX_34DA00008BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE city_area ADD CONSTRAINT FK_34DA00008BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE city_area');
    }
}
