<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180702081210 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE shift_days (id INT AUTO_INCREMENT NOT NULL, day_ar VARCHAR(255) NOT NULL, day_en VARCHAR(255) NOT NULL, active INT DEFAULT 1, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shift ADD shift_day_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shift ADD CONSTRAINT FK_A50B3B45851AD333 FOREIGN KEY (shift_day_id) REFERENCES shift_days (id)');
        $this->addSql('CREATE INDEX IDX_A50B3B45851AD333 ON shift (shift_day_id)');
        $this->addSql("INSERT INTO `shift_days` (`id`, `day_ar`, `day_en`, `active`, `created_at`, `updated_at`, `version`) VALUES (NULL, 'السبت', 'Saturday', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '1'), (NULL, 'الأحد', 'Sunday', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '1'), (NULL, 'الأثنين', 'Monday', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '1'), (NULL, 'الثلاثاء', 'Tuesday', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '1'), (NULL, 'الأربعاء', 'Wednesday', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '1'), (NULL, 'الخميس', 'Thursday', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '1'), (NULL, 'الجمعة', 'Friday', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '1')");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shift DROP FOREIGN KEY FK_A50B3B45851AD333');
        $this->addSql('DROP TABLE shift_days');
        $this->addSql('DROP INDEX IDX_A50B3B45851AD333 ON shift');
        $this->addSql('ALTER TABLE shift DROP shift_day_id');
    }
}
