<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180605014545 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE order_offer (id INT AUTO_INCREMENT NOT NULL, offer_id INT DEFAULT NULL, order_id INT DEFAULT NULL, price NUMERIC(10, 2) DEFAULT NULL, title VARCHAR(100) DEFAULT NULL, title_en VARCHAR(100) DEFAULT NULL, description_public LONGTEXT DEFAULT NULL, description_public_en LONGTEXT DEFAULT NULL, type VARCHAR(50) NOT NULL, cash_get_amount NUMERIC(10, 2) DEFAULT NULL, percentage_get_amount DOUBLE PRECISION DEFAULT NULL, INDEX IDX_AA48F3C353C674EE (offer_id), INDEX IDX_AA48F3C38D9F6D38 (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_offer_buy_item (id INT AUTO_INCREMENT NOT NULL, item_id INT DEFAULT NULL, order_offer_id INT DEFAULT NULL, count INT NOT NULL, price NUMERIC(10, 2) NOT NULL, name VARCHAR(255) NOT NULL, name_en VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, INDEX IDX_F08019E0126F525E (item_id), INDEX IDX_F08019E0B23E965F (order_offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_offer_get_item (id INT AUTO_INCREMENT NOT NULL, item_id INT DEFAULT NULL, order_offer_id INT DEFAULT NULL, count INT NOT NULL, price NUMERIC(10, 2) NOT NULL, name VARCHAR(255) NOT NULL, name_en VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, INDEX IDX_63209894126F525E (item_id), INDEX IDX_63209894B23E965F (order_offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_offer ADD CONSTRAINT FK_AA48F3C353C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE order_offer ADD CONSTRAINT FK_AA48F3C38D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_offer_buy_item ADD CONSTRAINT FK_F08019E0126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE order_offer_buy_item ADD CONSTRAINT FK_F08019E0B23E965F FOREIGN KEY (order_offer_id) REFERENCES order_offer (id)');
        $this->addSql('ALTER TABLE order_offer_get_item ADD CONSTRAINT FK_63209894126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE order_offer_get_item ADD CONSTRAINT FK_63209894B23E965F FOREIGN KEY (order_offer_id) REFERENCES order_offer (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_offer_buy_item DROP FOREIGN KEY FK_F08019E0B23E965F');
        $this->addSql('ALTER TABLE order_offer_get_item DROP FOREIGN KEY FK_63209894B23E965F');
        $this->addSql('DROP TABLE order_offer');
        $this->addSql('DROP TABLE order_offer_buy_item');
        $this->addSql('DROP TABLE order_offer_get_item');
    }
}
