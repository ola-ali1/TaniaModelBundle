<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170821103630 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_address CHANGE longitude longitude NUMERIC(14, 14) DEFAULT \'0\', CHANGE latitude latitude NUMERIC(14, 14) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE `order` CHANGE longitude longitude NUMERIC(14, 14) DEFAULT \'0\', CHANGE latitude latitude NUMERIC(14, 14) DEFAULT \'0\', CHANGE starting_longitude starting_longitude NUMERIC(14, 14) DEFAULT \'0\', CHANGE starting_latitude starting_latitude NUMERIC(14, 14) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE user CHANGE longitude longitude NUMERIC(14, 14) DEFAULT \'0\', CHANGE latitude latitude NUMERIC(14, 14) DEFAULT \'0\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` CHANGE longitude longitude NUMERIC(10, 7) DEFAULT \'0.0000000\', CHANGE latitude latitude NUMERIC(10, 7) DEFAULT \'0.0000000\', CHANGE starting_longitude starting_longitude NUMERIC(10, 7) DEFAULT \'0.0000000\', CHANGE starting_latitude starting_latitude NUMERIC(10, 7) DEFAULT \'0.0000000\'');
        $this->addSql('ALTER TABLE user CHANGE longitude longitude NUMERIC(10, 7) DEFAULT \'0.0000000\', CHANGE latitude latitude NUMERIC(10, 7) DEFAULT \'0.0000000\'');
        $this->addSql('ALTER TABLE user_address CHANGE longitude longitude NUMERIC(10, 7) DEFAULT \'0.0000000\', CHANGE latitude latitude NUMERIC(10, 7) DEFAULT \'0.0000000\'');
    }
}
