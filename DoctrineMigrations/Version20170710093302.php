<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170710093302 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` ADD rate NUMERIC(4, 2) DEFAULT NULL COMMENT \'value set by user for rating order\', ADD rate_comment VARCHAR(190) DEFAULT NULL COMMENT \'value set by user for rating order\', DROP driver_rate, DROP driver_rate_comment');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` ADD driver_rate NUMERIC(4, 2) DEFAULT NULL COMMENT \'value set by user for rating partner\', ADD driver_rate_comment VARCHAR(190) DEFAULT NULL COLLATE utf8mb4_general_ci COMMENT \'value set by user for rating partner\', DROP rate, DROP rate_comment');
    }
}
