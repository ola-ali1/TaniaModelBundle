<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180527120136 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE item_package (id INT AUTO_INCREMENT NOT NULL, nameAr VARCHAR(100) NOT NULL, nameEn VARCHAR(100) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_attribute (id INT AUTO_INCREMENT NOT NULL, nameAr VARCHAR(100) NOT NULL, nameEn VARCHAR(100) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_package_size (id INT AUTO_INCREMENT NOT NULL, nameAr VARCHAR(100) NOT NULL, nameEn VARCHAR(100) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_type (id INT AUTO_INCREMENT NOT NULL, nameAr VARCHAR(100) NOT NULL, nameEn VARCHAR(100) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_brand (id INT AUTO_INCREMENT NOT NULL, nameAr VARCHAR(100) NOT NULL, nameEn VARCHAR(100) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item ADD item_attribute_id INT DEFAULT NULL, ADD item_brand_id INT DEFAULT NULL, ADD item_package_id INT DEFAULT NULL, ADD item_package_size_id INT DEFAULT NULL, ADD item_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E79BCD33B FOREIGN KEY (item_attribute_id) REFERENCES item_attribute (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E28F818C3 FOREIGN KEY (item_brand_id) REFERENCES item_brand (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E49FD83F5 FOREIGN KEY (item_package_id) REFERENCES item_package (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E7C171609 FOREIGN KEY (item_package_size_id) REFERENCES item_package_size (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251ECE11AAC7 FOREIGN KEY (item_type_id) REFERENCES item_type (id)');
        $this->addSql('CREATE INDEX IDX_1F1B251E79BCD33B ON item (item_attribute_id)');
        $this->addSql('CREATE INDEX IDX_1F1B251E28F818C3 ON item (item_brand_id)');
        $this->addSql('CREATE INDEX IDX_1F1B251E49FD83F5 ON item (item_package_id)');
        $this->addSql('CREATE INDEX IDX_1F1B251E7C171609 ON item (item_package_size_id)');
        $this->addSql('CREATE INDEX IDX_1F1B251ECE11AAC7 ON item (item_type_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E49FD83F5');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E79BCD33B');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E7C171609');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251ECE11AAC7');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E28F818C3');
        $this->addSql('DROP TABLE item_package');
        $this->addSql('DROP TABLE item_attribute');
        $this->addSql('DROP TABLE item_package_size');
        $this->addSql('DROP TABLE item_type');
        $this->addSql('DROP TABLE item_brand');
        $this->addSql('DROP INDEX IDX_1F1B251E79BCD33B ON item');
        $this->addSql('DROP INDEX IDX_1F1B251E28F818C3 ON item');
        $this->addSql('DROP INDEX IDX_1F1B251E49FD83F5 ON item');
        $this->addSql('DROP INDEX IDX_1F1B251E7C171609 ON item');
        $this->addSql('DROP INDEX IDX_1F1B251ECE11AAC7 ON item');
        $this->addSql('ALTER TABLE item DROP item_attribute_id, DROP item_brand_id, DROP item_package_id, DROP item_package_size_id, DROP item_type_id');
    }
}
