<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180808091142 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_package (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, package_id INT DEFAULT NULL, redeemedAt DATETIME NOT NULL, pointsEarned INT NOT NULL, INDEX IDX_8665799FA76ED395 (user_id), INDEX IDX_8665799FF44CABFF (package_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_item_package (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, item_id INT DEFAULT NULL, purchasedCount INT NOT NULL, redeemedCount INT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, INDEX IDX_55F93DC3A76ED395 (user_id), INDEX IDX_55F93DC3126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_package ADD CONSTRAINT FK_8665799FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_package ADD CONSTRAINT FK_8665799FF44CABFF FOREIGN KEY (package_id) REFERENCES package (id)');
        $this->addSql('ALTER TABLE user_item_package ADD CONSTRAINT FK_55F93DC3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_item_package ADD CONSTRAINT FK_55F93DC3126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_package');
        $this->addSql('DROP TABLE user_item_package');
    }
}
