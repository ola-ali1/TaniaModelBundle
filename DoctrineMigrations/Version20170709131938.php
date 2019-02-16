<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170709131938 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE average_rate partner_rate NUMERIC(4, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD driver_id INT DEFAULT NULL, ADD driver_rate NUMERIC(4, 2) DEFAULT NULL COMMENT \'value set by user for rating partner\', ADD driver_rate_comment VARCHAR(190) DEFAULT NULL COMMENT \'value set by user for rating partner\'');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398C3423909 FOREIGN KEY (driver_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F5299398C3423909 ON `order` (driver_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398C3423909');
        $this->addSql('DROP INDEX IDX_F5299398C3423909 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP driver_id, DROP driver_rate, DROP driver_rate_comment');
        $this->addSql('ALTER TABLE user CHANGE partner_rate average_rate NUMERIC(4, 2) DEFAULT NULL');
    }
}
