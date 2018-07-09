<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180703180343 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_status_history ADD action_done_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_status_history ADD CONSTRAINT FK_471AD77E560C5433 FOREIGN KEY (action_done_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_471AD77E560C5433 ON order_status_history (action_done_by_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_status_history DROP FOREIGN KEY FK_471AD77E560C5433');
        $this->addSql('DROP INDEX IDX_471AD77E560C5433 ON order_status_history');
        $this->addSql('ALTER TABLE order_status_history DROP action_done_by_id');
    }
}
