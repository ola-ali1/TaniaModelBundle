<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170601020753 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE van_drivers');
        $this->addSql('ALTER TABLE van CHANGE current_capacity current_capacity INT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE van_drivers (driver_id INT NOT NULL, van_id INT NOT NULL, INDEX IDX_22EEE137C3423909 (driver_id), INDEX IDX_22EEE1378A128D90 (van_id), PRIMARY KEY(driver_id, van_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE van_drivers ADD CONSTRAINT FK_22EEE1378A128D90 FOREIGN KEY (van_id) REFERENCES van (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE van_drivers ADD CONSTRAINT FK_22EEE137C3423909 FOREIGN KEY (driver_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE van CHANGE current_capacity current_capacity INT NOT NULL');
    }
}
