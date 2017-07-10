<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170709125827 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('UPDATE `shift` SET `from`="2017-07-05 00:00:00",`to`="2017-07-05 00:00:00" WHERE `id` = 1;');
        $this->addSql('UPDATE `shift` SET `from`="2017-07-05 00:00:00",`to`="2017-07-05 00:00:00" WHERE `id` = 2;');
        $this->addSql('UPDATE `shift` SET `from`="2017-07-05 00:00:00",`to`="2017-07-05 00:00:00" WHERE `id` = 3;');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('UPDATE `shift` SET `from`="00:00 AM",`to`="00:00 AM" WHERE `id` = 1;');
        $this->addSql('UPDATE `shift` SET `from`="00:00 AM",`to`="00:00 AM" WHERE `id` = 2;');
        $this->addSql('UPDATE `shift` SET `from`="00:00 AM",`to`="00:00 AM" WHERE `id` = 3;');
    }
}
