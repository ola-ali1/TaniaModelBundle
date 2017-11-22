<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171122103059 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("
            INSERT INTO `city` (`country_id`, `name_ar`, `created_at`, `updated_at`, `version`, `name_en`, `city_polygon`, `latitude`, `longitude`) VALUES (1, 'الخرج', '2017-11-22 12:16:29', '2017-11-22 12:16:29', 1, 'Al Kharj', 'a:8:{i:0;s:31:\"47.344207763672,24.248409730176\";i:1;s:31:\"47.360000610352,24.262808413216\";i:2;s:31:\"47.398109436035,24.258113369636\";i:3;s:31:\"47.429008483887,24.226808649483\";i:4;s:31:\"47.400856018066,24.112794512626\";i:5;s:31:\"47.382659912109,24.077332307225\";i:6;s:31:\"47.195892333984,24.076318806557\";i:7;s:31:\"47.242584228516,24.213538342944\";}', '24.146081', '47.2884267')
            ");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("DELETE FROM `city` WHERE name_en='Al Kharj'");
    }
}
