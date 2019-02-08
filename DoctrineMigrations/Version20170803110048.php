<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170803110048 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("
INSERT INTO `role` (`name`, `permissions`, `created_at`, `updated_at`, `version`) VALUES
('Customer Service', 'a:46:{i:0;s:14:\"ROLE_USER_LIST\";i:1;s:14:\"ROLE_USER_EDIT\";i:2;s:17:\"ROLE_USER_DETAILS\";i:3;s:15:\"ROLE_ADMIN_LIST\";i:4;s:18:\"ROLE_ADMIN_DETAILS\";i:5;s:16:\"ROLE_DRIVER_LIST\";i:6;s:18:\"ROLE_DRIVER_CREATE\";i:7;s:16:\"ROLE_DRIVER_EDIT\";i:8;s:19:\"ROLE_DRIVER_DETAILS\";i:9;s:14:\"ROLE_ROLE_LIST\";i:10;s:16:\"ROLE_ROLE_CREATE\";i:11;s:14:\"ROLE_ROLE_EDIT\";i:12;s:13:\"ROLE_VAN_LIST\";i:13;s:15:\"ROLE_VAN_CREATE\";i:14;s:13:\"ROLE_VAN_EDIT\";i:15;s:18:\"ROLE_CITYAREA_LIST\";i:16;s:20:\"ROLE_CITYAREA_CREATE\";i:17;s:18:\"ROLE_CITYAREA_EDIT\";i:18;s:20:\"ROLE_CITYAREA_DELETE\";i:19;s:14:\"ROLE_ITEM_LIST\";i:20;s:16:\"ROLE_ITEM_CREATE\";i:21;s:14:\"ROLE_ITEM_EDIT\";i:22;s:16:\"ROLE_ITEM_DELETE\";i:23;s:18:\"ROLE_ITEM_SHOWHIDE\";i:24;s:15:\"ROLE_SHIFT_EDIT\";i:25;s:15:\"ROLE_ORDER_LIST\";i:26;s:16:\"ROLE_ORDER_CLOSE\";i:27;s:17:\"ROLE_ORDER_ASSIGN\";i:28;s:18:\"ROLE_ORDER_DETAILS\";i:29;s:18:\"ROLE_COMPLAIN_LIST\";i:30;s:21:\"ROLE_COMPLAIN_DETAILS\";i:31;s:20:\"ROLE_SUGGESTION_LIST\";i:32;s:23:\"ROLE_SUGGESTION_DETAILS\";i:33;s:18:\"ROLE_PAGES_CONTROL\";i:34;s:21:\"ROLE_CLOSEREASON_LIST\";i:35;s:23:\"ROLE_CLOSEREASON_CREATE\";i:36;s:21:\"ROLE_CLOSEREASON_EDIT\";i:37;s:22:\"ROLE_RETURNREASON_LIST\";i:38;s:24:\"ROLE_RETURNREASON_CREATE\";i:39;s:22:\"ROLE_RETURNREASON_EDIT\";i:40;s:19:\"ROLE_CONTACTUS_LIST\";i:41;s:22:\"ROLE_CONTACTUS_DETAILS\";i:42;s:17:\"ROLE_BALANCE_LIST\";i:43;s:19:\"ROLE_BALANCE_CREATE\";i:44;s:17:\"ROLE_BALANCE_EDIT\";i:45;s:19:\"ROLE_BALANCE_DELETE\";}', '2017-08-03 10:59:20', '2017-08-03 10:59:20', 1);
");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("DELETE FROM `role` WHERE name='ROLE_CUSTOMER_SERVICE'");
    }
}
