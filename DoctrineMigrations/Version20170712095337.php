<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170712095337 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE van_driver (id INT AUTO_INCREMENT NOT NULL, driver_id INT DEFAULT NULL, van_id INT DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, INDEX IDX_E39DFEE3C3423909 (driver_id), INDEX IDX_E39DFEE38A128D90 (van_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE van_driver ADD CONSTRAINT FK_E39DFEE3C3423909 FOREIGN KEY (driver_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE van_driver ADD CONSTRAINT FK_E39DFEE38A128D90 FOREIGN KEY (van_id) REFERENCES van (id)');
        $this->addSql('DROP TABLE van_drivers');
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
        $this->addSql('DROP TABLE van_driver');
    }
}
