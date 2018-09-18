<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180918112508 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE van_type (id INT AUTO_INCREMENT NOT NULL, nameAr VARCHAR(100) NOT NULL, nameEn VARCHAR(100) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE van ADD van_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE van ADD CONSTRAINT FK_79D1DB493B2AEA3 FOREIGN KEY (van_type_id) REFERENCES van_type (id)');
        $this->addSql('CREATE INDEX IDX_79D1DB493B2AEA3 ON van (van_type_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE van DROP FOREIGN KEY FK_79D1DB493B2AEA3');
        $this->addSql('DROP TABLE van_type');
        $this->addSql('DROP INDEX IDX_79D1DB493B2AEA3 ON van');
        $this->addSql('ALTER TABLE van DROP van_type_id');
    }
}
