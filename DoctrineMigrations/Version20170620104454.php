<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170620104454 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pf_transaction (id INT AUTO_INCREMENT NOT NULL, payment_method_id INT NOT NULL, invoice_id INT NOT NULL, customer_ip VARCHAR(50) DEFAULT NULL, fort_id VARCHAR(20) NOT NULL, currency CHAR(3) NOT NULL, amount NUMERIC(9, 2) NOT NULL, merchant_reference VARCHAR(100) NOT NULL, authorization_code INT DEFAULT NULL, current_status SMALLINT DEFAULT NULL, created_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, INDEX payment_method_id (payment_method_id), INDEX invoice_id (invoice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pf_transaction_status (id INT AUTO_INCREMENT NOT NULL, transaction_id INT NOT NULL, response_code SMALLINT NOT NULL, response_message VARCHAR(255) DEFAULT NULL, status CHAR(2) NOT NULL, response LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', created_at DATETIME DEFAULT NULL, INDEX transaction_id (transaction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pf_payment_method (id INT AUTO_INCREMENT NOT NULL, holder_id INT NOT NULL, fort_id VARCHAR(190) NOT NULL, card_number VARCHAR(20) NOT NULL, expiry_date VARCHAR(10) NOT NULL, merchant_reference VARCHAR(50) NOT NULL, token_name VARCHAR(190) DEFAULT NULL, payment_option VARCHAR(50) DEFAULT NULL, is_default TINYINT(1) DEFAULT \'0\' NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, version INT DEFAULT 1 NOT NULL, INDEX holder_id (holder_id), INDEX is_default (is_default), UNIQUE INDEX token_name (token_name, holder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pf_transaction ADD CONSTRAINT FK_C29DBE415AA1164F FOREIGN KEY (payment_method_id) REFERENCES pf_payment_method (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE pf_transaction ADD CONSTRAINT FK_C29DBE412989F1FD FOREIGN KEY (invoice_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pf_transaction_status ADD CONSTRAINT FK_B55D4B7B2FC0CB0F FOREIGN KEY (transaction_id) REFERENCES pf_transaction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pf_payment_method ADD CONSTRAINT FK_B7402433DEEE62D0 FOREIGN KEY (holder_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `order` ADD credit_card_id INT DEFAULT NULL, ADD pfPayed TINYINT(1) DEFAULT \'0\' NOT NULL, ADD payment_method VARCHAR(190) NOT NULL, ADD amountDue NUMERIC(10, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993987048FD0F FOREIGN KEY (credit_card_id) REFERENCES pf_payment_method (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_F52993987048FD0F ON `order` (credit_card_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pf_transaction_status DROP FOREIGN KEY FK_B55D4B7B2FC0CB0F');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993987048FD0F');
        $this->addSql('ALTER TABLE pf_transaction DROP FOREIGN KEY FK_C29DBE415AA1164F');
        $this->addSql('DROP TABLE pf_transaction');
        $this->addSql('DROP TABLE pf_transaction_status');
        $this->addSql('DROP TABLE pf_payment_method');
        $this->addSql('DROP INDEX IDX_F52993987048FD0F ON `order`');
        $this->addSql('ALTER TABLE `order` DROP credit_card_id, DROP pfPayed, DROP payment_method, DROP amountDue');
    }
}
