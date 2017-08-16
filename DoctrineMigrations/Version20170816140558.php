<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170816140558 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(200) NOT NULL, titleAr VARCHAR(200) NOT NULL, slug VARCHAR(190) NOT NULL, content LONGTEXT DEFAULT NULL, contentAr LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, UNIQUE INDEX UNIQ_140AB620989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cms_contact_type (id SMALLINT AUTO_INCREMENT NOT NULL, title_ar VARCHAR(190) DEFAULT NULL, title_en VARCHAR(190) DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cms_contact (id INT AUTO_INCREMENT NOT NULL, type_id SMALLINT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(190) DEFAULT NULL, description TEXT DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, INDEX IDX_128EE929A76ED395 (user_id), INDEX type_id (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cms_contact ADD CONSTRAINT FK_128EE929C54C8C93 FOREIGN KEY (type_id) REFERENCES cms_contact_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cms_contact ADD CONSTRAINT FK_128EE929A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE item DROP code');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cms_contact DROP FOREIGN KEY FK_128EE929C54C8C93');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE cms_contact_type');
        $this->addSql('DROP TABLE cms_contact');
        $this->addSql('ALTER TABLE item ADD code VARCHAR(255) NOT NULL COLLATE utf8mb4_general_ci');
    }
}
