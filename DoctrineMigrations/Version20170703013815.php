<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170703013815 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` ADD shift_id INT DEFAULT NULL, ADD note LONGTEXT NOT NULL, CHANGE payment_method payment_method INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398BB70BC0E FOREIGN KEY (shift_id) REFERENCES shift (id)');
        $this->addSql('CREATE INDEX IDX_F5299398BB70BC0E ON `order` (shift_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398BB70BC0E');
        $this->addSql('DROP INDEX IDX_F5299398BB70BC0E ON `order`');
        $this->addSql('ALTER TABLE `order` DROP shift_id, DROP note, CHANGE payment_method payment_method VARCHAR(190) NOT NULL COLLATE utf8mb4_general_ci');
    }
}
