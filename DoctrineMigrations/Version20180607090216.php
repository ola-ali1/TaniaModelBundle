<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180607090216 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_offer_get_item DROP FOREIGN KEY FK_63209894B23E965F');
        $this->addSql('DROP INDEX IDX_63209894B23E965F ON order_offer_get_item');
        $this->addSql('ALTER TABLE order_offer_get_item CHANGE order_offer_id offer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_offer_get_item ADD CONSTRAINT FK_6320989453C674EE FOREIGN KEY (offer_id) REFERENCES order_offer (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_6320989453C674EE ON order_offer_get_item (offer_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_offer_get_item DROP FOREIGN KEY FK_6320989453C674EE');
        $this->addSql('DROP INDEX IDX_6320989453C674EE ON order_offer_get_item');
        $this->addSql('ALTER TABLE order_offer_get_item CHANGE offer_id order_offer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_offer_get_item ADD CONSTRAINT FK_63209894B23E965F FOREIGN KEY (order_offer_id) REFERENCES order_offer (id)');
        $this->addSql('CREATE INDEX IDX_63209894B23E965F ON order_offer_get_item (order_offer_id)');
    }
}
