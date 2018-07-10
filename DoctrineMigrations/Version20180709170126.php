<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180709170126 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE order_rating_tag (id INT AUTO_INCREMENT NOT NULL, rating_tag_id INT DEFAULT NULL, order_id INT DEFAULT NULL, INDEX IDX_A98A772F95200999 (rating_tag_id), INDEX IDX_A98A772F8D9F6D38 (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_rating_tag ADD CONSTRAINT FK_A98A772F95200999 FOREIGN KEY (rating_tag_id) REFERENCES rating_tag (id)');
        $this->addSql('ALTER TABLE order_rating_tag ADD CONSTRAINT FK_A98A772F8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939895200999');
        $this->addSql('DROP INDEX IDX_F529939895200999 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP rating_tag_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE order_rating_tag');
        
    }
}
