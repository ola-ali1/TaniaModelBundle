<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180524152453 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) DEFAULT NULL, description_private LONGTEXT DEFAULT NULL, description_public LONGTEXT DEFAULT NULL, start_time DATETIME DEFAULT NULL, expiry_time DATETIME DEFAULT NULL, type VARCHAR(50) NOT NULL, enabled TINYINT(1) DEFAULT \'1\' NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer_Get_item (id INT AUTO_INCREMENT NOT NULL, item_id INT DEFAULT NULL, offer_id INT DEFAULT NULL, count INT NOT NULL, price NUMERIC(10, 2) NOT NULL, name VARCHAR(255) NOT NULL, name_en VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, INDEX IDX_F2262A72126F525E (item_id), INDEX IDX_F2262A7253C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer_buy_item (id INT AUTO_INCREMENT NOT NULL, item_id INT DEFAULT NULL, offer_id INT DEFAULT NULL, count INT NOT NULL, price NUMERIC(10, 2) NOT NULL, name VARCHAR(255) NOT NULL, name_en VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, INDEX IDX_98F0C950126F525E (item_id), INDEX IDX_98F0C95053C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offer_Get_item ADD CONSTRAINT FK_F2262A72126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE offer_Get_item ADD CONSTRAINT FK_F2262A7253C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE offer_buy_item ADD CONSTRAINT FK_98F0C950126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE offer_buy_item ADD CONSTRAINT FK_98F0C95053C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE `order` ADD offer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939853C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('CREATE INDEX IDX_F529939853C674EE ON `order` (offer_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939853C674EE');
        $this->addSql('ALTER TABLE offer_Get_item DROP FOREIGN KEY FK_F2262A7253C674EE');
        $this->addSql('ALTER TABLE offer_buy_item DROP FOREIGN KEY FK_98F0C95053C674EE');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE offer_Get_item');
        $this->addSql('DROP TABLE offer_buy_item');
        $this->addSql('DROP INDEX IDX_F529939853C674EE ON `order`');
        $this->addSql('ALTER TABLE `order` DROP offer_id');
    }
}
