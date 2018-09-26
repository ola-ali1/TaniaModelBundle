<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180925161839 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE static_pages (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, identifier_ar INT DEFAULT NULL, identifier_en INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql("
        INSERT INTO `static_pages`(`id`, `name`, `identifier_ar`, `identifier_en`) 
            VALUES
            (1,'our-clients',0,0),
            (2,'tania-family',0,0),
            (3,'partners',0,0),
            (4,'newsroom',0,0),
            (5,'tania-world',0,0),
            (6,'products',0,0)");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE static_pages');
    }
}
