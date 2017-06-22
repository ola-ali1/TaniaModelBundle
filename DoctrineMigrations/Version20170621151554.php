<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170621151554 extends AbstractMigration
{

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DELETE FROM `city` WHERE `name_en`="Hafr Al-Batin"');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('INSERT INTO `city` (`id`, `country_id`, `name_ar`, `created_at`, `updated_at`, `version`, `name_en`, `city_polygon`, `latitude`, `longitude`) VALUES (NULL, "1", "حفرالباطن", "2017-05-24 00:00:00", "2017-05-24 00:00:00", "1", "Hafr Al-Batin", \'a:4:{i:0;s:17:"46.01074,28.50852";i:1;s:16:"46.1824,28.43971";i:2;s:17:"45.94482,28.26689";i:3;s:17:"45.76355,28.38294";}\', "28.3595", "Riyadh")');
    }
}
