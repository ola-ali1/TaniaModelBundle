<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180715134026 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql("INSERT INTO `shift` (`shift`, `from`, `to`, `created_at`, `updated_at`, `version`, `shift_ar`, `maximumAllowedOrdersPerDay`, `shift_day_id`, `is_deleted`) VALUES ('Morning', '1970-01-01 10:00:00', '1970-01-01 11:00:00', '2017-07-04 10:53:24', '2018-07-15 13:52:01', '100', 'الصباح', '3', '1', '0');");
        
        $this->addSql("INSERT INTO `shift` (`shift`, `from`, `to`, `created_at`, `updated_at`, `version`, `shift_ar`, `maximumAllowedOrdersPerDay`, `shift_day_id`, `is_deleted`) VALUES ('Morning', '1970-01-01 10:00:00', '1970-01-01 11:00:00', '2017-07-04 10:53:24', '2018-07-15 13:52:01', '100', 'الصباح', '3', '2', '0'), ('Morning', '1970-01-01 10:00:00', '1970-01-01 11:00:00', '2017-07-04 10:53:24', '2018-07-15 13:52:01', '100', 'الصباح', '3', '3', '0'), ('Morning', '1970-01-01 10:00:00', '1970-01-01 11:00:00', '2017-07-04 10:53:24', '2018-07-15 13:52:01', '100', 'الصباح', '3', '4', '0');");
        
        $this->addSql("INSERT INTO `shift` (`shift`, `from`, `to`, `created_at`, `updated_at`, `version`, `shift_ar`, `maximumAllowedOrdersPerDay`, `shift_day_id`, `is_deleted`) VALUES ('Morning', '1970-01-01 10:00:00', '1970-01-01 11:00:00', '2017-07-04 10:53:24', '2018-07-15 13:52:01', '100', 'الصباح', '3', '5', '0'), ('Morning', '1970-01-01 10:00:00', '1970-01-01 11:00:00', '2017-07-04 10:53:24', '2018-07-15 13:52:01', '100', 'الصباح', '3', '6', '0'), ('Morning', '1970-01-01 10:00:00', '1970-01-01 11:00:00', '2017-07-04 10:53:24', '2018-07-15 13:52:01', '100', 'الصباح', '3', '7', '0');");
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
