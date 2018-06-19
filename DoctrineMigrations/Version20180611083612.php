<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180611083612 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE package_buy_item (id INT AUTO_INCREMENT NOT NULL, item_id INT DEFAULT NULL, package_id INT DEFAULT NULL, count INT NOT NULL, price NUMERIC(10, 2) NOT NULL, name VARCHAR(255) NOT NULL, name_en VARCHAR(255) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, INDEX IDX_50CED5C126F525E (item_id), INDEX IDX_50CED5CF44CABFF (package_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_package_buy_item (id INT AUTO_INCREMENT NOT NULL, item_id INT DEFAULT NULL, order_package_id INT DEFAULT NULL, count INT NOT NULL, price NUMERIC(10, 2) NOT NULL, name VARCHAR(255) NOT NULL, name_en VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, INDEX IDX_671AF940126F525E (item_id), INDEX IDX_671AF940479656AA (order_package_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE package (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) DEFAULT NULL, title_en VARCHAR(100) DEFAULT NULL, description_private LONGTEXT DEFAULT NULL, description_public LONGTEXT DEFAULT NULL, description_private_en LONGTEXT DEFAULT NULL, description_public_en LONGTEXT DEFAULT NULL, start_time DATETIME DEFAULT NULL, expiry_time DATETIME DEFAULT NULL, number_of_used_times INT DEFAULT 0 NOT NULL, get_amount NUMERIC(10, 2) DEFAULT \'0\', enabled TINYINT(1) DEFAULT \'1\' NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_package (id INT AUTO_INCREMENT NOT NULL, package_id INT DEFAULT NULL, order_id INT DEFAULT NULL, price NUMERIC(10, 2) DEFAULT NULL, title VARCHAR(100) DEFAULT NULL, title_en VARCHAR(100) DEFAULT NULL, description_public LONGTEXT DEFAULT NULL, description_public_en LONGTEXT DEFAULT NULL, get_amount NUMERIC(10, 2) DEFAULT NULL, count INT DEFAULT 0 NOT NULL, INDEX IDX_2812CEDEF44CABFF (package_id), INDEX IDX_2812CEDE8D9F6D38 (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE package_buy_item ADD CONSTRAINT FK_50CED5C126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE package_buy_item ADD CONSTRAINT FK_50CED5CF44CABFF FOREIGN KEY (package_id) REFERENCES package (id)');
        $this->addSql('ALTER TABLE order_package_buy_item ADD CONSTRAINT FK_671AF940126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE order_package_buy_item ADD CONSTRAINT FK_671AF940479656AA FOREIGN KEY (order_package_id) REFERENCES order_package (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_package ADD CONSTRAINT FK_2812CEDEF44CABFF FOREIGN KEY (package_id) REFERENCES package (id)');
        $this->addSql('ALTER TABLE order_package ADD CONSTRAINT FK_2812CEDE8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE package_buy_item DROP FOREIGN KEY FK_50CED5CF44CABFF');
        $this->addSql('ALTER TABLE order_package DROP FOREIGN KEY FK_2812CEDEF44CABFF');
        $this->addSql('ALTER TABLE order_package_buy_item DROP FOREIGN KEY FK_671AF940479656AA');
        $this->addSql('DROP TABLE package_buy_item');
        $this->addSql('DROP TABLE order_package_buy_item');
        $this->addSql('DROP TABLE package');
        $this->addSql('DROP TABLE order_package');
    }
}
