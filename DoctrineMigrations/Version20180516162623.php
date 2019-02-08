<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180516162623 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` ADD user_address_id INT DEFAULT NULL, ADD address_type VARCHAR(30) DEFAULT \'USER\' NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939852D06999 FOREIGN KEY (user_address_id) REFERENCES user_address (id)');
        $this->addSql('CREATE INDEX IDX_F529939852D06999 ON `order` (user_address_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939852D06999');
        $this->addSql('DROP INDEX IDX_F529939852D06999 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP user_address_id, DROP address_type');
    }
}
