<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180423141826 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` ADD promo_code_id INT DEFAULT NULL, ADD promo_code_name VARCHAR(20) DEFAULT NULL, ADD promo_code_method VARCHAR(11) DEFAULT NULL, ADD promo_code_value NUMERIC(8, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993982FAE4625 FOREIGN KEY (promo_code_id) REFERENCES promo_code (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_F52993982FAE4625 ON `order` (promo_code_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993982FAE4625');
        $this->addSql('DROP INDEX IDX_F52993982FAE4625 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP promo_code_id, DROP promo_code_name, DROP promo_code_method, DROP promo_code_value');
    }
}
