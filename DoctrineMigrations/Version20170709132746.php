<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170709132746 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('UPDATE `shift` SET `shift`="Morning" WHERE `id` = 1;');
        $this->addSql('UPDATE `shift` SET `shift`="Afternoon" WHERE `id` = 2;');
        $this->addSql('UPDATE `shift` SET `shift`="Evening" WHERE `id` = 3;');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('UPDATE `shift` SET `shift`="" WHERE `id` = 1;');
        $this->addSql('UPDATE `shift` SET `shift`="" WHERE `id` = 2;');
        $this->addSql('UPDATE `shift` SET `shift`="" WHERE `id` = 3;');
    }
}
