<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170905123319 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('UPDATE `role` SET `permissions` = \'a:55:{i:0;s:14:"ROLE_USER_LIST";i:1;s:14:"ROLE_USER_EDIT";i:2;s:17:"ROLE_USER_DETAILS";i:3;s:15:"ROLE_ADMIN_LIST";i:4;s:17:"ROLE_ADMIN_CREATE";i:5;s:15:"ROLE_ADMIN_EDIT";i:6;s:17:"ROLE_ADMIN_DELETE";i:7;s:18:"ROLE_ADMIN_DETAILS";i:8;s:16:"ROLE_DRIVER_LIST";i:9;s:18:"ROLE_DRIVER_CREATE";i:10;s:16:"ROLE_DRIVER_EDIT";i:11;s:18:"ROLE_DRIVER_DELETE";i:12;s:19:"ROLE_DRIVER_DETAILS";i:13;s:18:"ROLE_DRIVER_ASSIGN";i:14;s:14:"ROLE_ROLE_LIST";i:15;s:16:"ROLE_ROLE_CREATE";i:16;s:14:"ROLE_ROLE_EDIT";i:17;s:13:"ROLE_VAN_LIST";i:18;s:15:"ROLE_VAN_CREATE";i:19;s:13:"ROLE_VAN_EDIT";i:20;s:15:"ROLE_VAN_ASSIGN";i:21;s:18:"ROLE_CITYAREA_LIST";i:22;s:20:"ROLE_CITYAREA_CREATE";i:23;s:18:"ROLE_CITYAREA_EDIT";i:24;s:20:"ROLE_CITYAREA_DELETE";i:25;s:14:"ROLE_ITEM_LIST";i:26;s:16:"ROLE_ITEM_CREATE";i:27;s:14:"ROLE_ITEM_EDIT";i:28;s:16:"ROLE_ITEM_DELETE";i:29;s:18:"ROLE_ITEM_SHOWHIDE";i:30;s:15:"ROLE_SHIFT_EDIT";i:31;s:15:"ROLE_ORDER_LIST";i:32;s:17:"ROLE_ORDER_ASSIGN";i:33;s:16:"ROLE_ORDER_CLOSE";i:34;s:18:"ROLE_ORDER_DETAILS";i:35;s:18:"ROLE_COMPLAIN_LIST";i:36;s:21:"ROLE_COMPLAIN_DETAILS";i:37;s:20:"ROLE_SUGGESTION_LIST";i:38;s:23:"ROLE_SUGGESTION_DETAILS";i:39;s:18:"ROLE_PAGES_CONTROL";i:40;s:21:"ROLE_CLOSEREASON_LIST";i:41;s:23:"ROLE_CLOSEREASON_CREATE";i:42;s:21:"ROLE_CLOSEREASON_EDIT";i:43;s:22:"ROLE_RETURNREASON_LIST";i:44;s:24:"ROLE_RETURNREASON_CREATE";i:45;s:22:"ROLE_RETURNREASON_EDIT";i:46;s:19:"ROLE_CONTACTUS_LIST";i:47;s:22:"ROLE_CONTACTUS_DETAILS";i:48;s:17:"ROLE_BALANCE_LIST";i:49;s:19:"ROLE_BALANCE_CREATE";i:50;s:17:"ROLE_BALANCE_EDIT";i:51;s:19:"ROLE_BALANCE_DELETE";i:52;s:24:"ROLE_BALANCEREQUEST_LIST";i:53;s:26:"ROLE_BALANCEREQUEST_ASSIGN";i:54;s:25:"ROLE_BALANCEREQUEST_CLOSE";}\' WHERE `role`.`name` = \'Customer Service\';');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('UPDATE `role` SET `permissions` = \'a:52:{i:0;s:14:"ROLE_USER_LIST";i:1;s:14:"ROLE_USER_EDIT";i:2;s:17:"ROLE_USER_DETAILS";i:3;s:15:"ROLE_ADMIN_LIST";i:4;s:17:"ROLE_ADMIN_CREATE";i:5;s:15:"ROLE_ADMIN_EDIT";i:6;s:17:"ROLE_ADMIN_DELETE";i:7;s:18:"ROLE_ADMIN_DETAILS";i:8;s:16:"ROLE_DRIVER_LIST";i:9;s:18:"ROLE_DRIVER_CREATE";i:10;s:16:"ROLE_DRIVER_EDIT";i:11;s:19:"ROLE_DRIVER_DETAILS";i:12;s:14:"ROLE_ROLE_LIST";i:13;s:16:"ROLE_ROLE_CREATE";i:14;s:14:"ROLE_ROLE_EDIT";i:15;s:13:"ROLE_VAN_LIST";i:16;s:15:"ROLE_VAN_CREATE";i:17;s:13:"ROLE_VAN_EDIT";i:18;s:18:"ROLE_CITYAREA_LIST";i:19;s:20:"ROLE_CITYAREA_CREATE";i:20;s:18:"ROLE_CITYAREA_EDIT";i:21;s:20:"ROLE_CITYAREA_DELETE";i:22;s:14:"ROLE_ITEM_LIST";i:23;s:16:"ROLE_ITEM_CREATE";i:24;s:14:"ROLE_ITEM_EDIT";i:25;s:16:"ROLE_ITEM_DELETE";i:26;s:18:"ROLE_ITEM_SHOWHIDE";i:27;s:15:"ROLE_SHIFT_EDIT";i:28;s:15:"ROLE_ORDER_LIST";i:29;s:16:"ROLE_ORDER_CLOSE";i:30;s:17:"ROLE_ORDER_ASSIGN";i:31;s:18:"ROLE_ORDER_DETAILS";i:32;s:18:"ROLE_COMPLAIN_LIST";i:33;s:21:"ROLE_COMPLAIN_DETAILS";i:34;s:20:"ROLE_SUGGESTION_LIST";i:35;s:23:"ROLE_SUGGESTION_DETAILS";i:36;s:18:"ROLE_PAGES_CONTROL";i:37;s:21:"ROLE_CLOSEREASON_LIST";i:38;s:23:"ROLE_CLOSEREASON_CREATE";i:39;s:21:"ROLE_CLOSEREASON_EDIT";i:40;s:22:"ROLE_RETURNREASON_LIST";i:41;s:24:"ROLE_RETURNREASON_CREATE";i:42;s:22:"ROLE_RETURNREASON_EDIT";i:43;s:19:"ROLE_CONTACTUS_LIST";i:44;s:22:"ROLE_CONTACTUS_DETAILS";i:45;s:17:"ROLE_BALANCE_LIST";i:46;s:19:"ROLE_BALANCE_CREATE";i:47;s:17:"ROLE_BALANCE_EDIT";i:48;s:19:"ROLE_BALANCE_DELETE";i:49;s:24:"ROLE_BALANCEREQUEST_LIST";i:50;s:25:"ROLE_BALANCEREQUEST_CLOSE";i:51;s:26:"ROLE_BALANCEREQUEST_ASSIGN";}\' WHERE `role`.`name` = \'Customer Service\';');
    }
}
