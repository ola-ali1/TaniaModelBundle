<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180620132739 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rating_tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, name_en VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating_range (id INT AUTO_INCREMENT NOT NULL, start NUMERIC(4, 2) NOT NULL, end NUMERIC(4, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating_tag_rating_range (id INT AUTO_INCREMENT NOT NULL, rating_tag_id INT DEFAULT NULL, rating_range_id INT DEFAULT NULL, INDEX IDX_16A366FA95200999 (rating_tag_id), INDEX IDX_16A366FA74BF6546 (rating_range_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rating_tag_rating_range ADD CONSTRAINT FK_16A366FA95200999 FOREIGN KEY (rating_tag_id) REFERENCES rating_tag (id)');
        $this->addSql('ALTER TABLE rating_tag_rating_range ADD CONSTRAINT FK_16A366FA74BF6546 FOREIGN KEY (rating_range_id) REFERENCES rating_range (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rating_tag_rating_range DROP FOREIGN KEY FK_16A366FA95200999');
        $this->addSql('ALTER TABLE rating_tag_rating_range DROP FOREIGN KEY FK_16A366FA74BF6546');
        $this->addSql('DROP TABLE rating_tag');
        $this->addSql('DROP TABLE rating_range');
        $this->addSql('DROP TABLE rating_tag_rating_range');
    }
}
