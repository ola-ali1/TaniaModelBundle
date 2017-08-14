<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170813104804 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE balance_request ADD user_id INT DEFAULT NULL, ADD driver_id INT DEFAULT NULL, ADD van_number VARCHAR(255) DEFAULT NULL, ADD username VARCHAR(100) DEFAULT NULL, ADD driver_phone VARCHAR(100) DEFAULT NULL, ADD driver_fullName VARCHAR(190) DEFAULT NULL, ADD driver_fullNameAr VARCHAR(190) DEFAULT NULL, ADD driver_image VARCHAR(300) DEFAULT NULL, ADD driver_rate NUMERIC(4, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE balance_request ADD CONSTRAINT FK_F7CAD25A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE balance_request ADD CONSTRAINT FK_F7CAD25C3423909 FOREIGN KEY (driver_id) REFERENCES user (id)');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE balance_request DROP FOREIGN KEY FK_F7CAD25A76ED395');
        $this->addSql('ALTER TABLE balance_request DROP FOREIGN KEY FK_F7CAD25C3423909');
        $this->addSql('ALTER TABLE balance_request DROP user_id, DROP driver_id, DROP van_number, DROP username, DROP driver_phone, DROP driver_fullName, DROP driver_fullNameAr, DROP driver_image, DROP driver_rate');

    }
}
