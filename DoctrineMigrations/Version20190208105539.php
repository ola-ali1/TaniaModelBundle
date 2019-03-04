<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190208105539 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE #Tableau_01_sid_003F34F7_4_Group');
        $this->addSql('ALTER TABLE contact_us ADD CONSTRAINT FK_8205FDD08D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE contact_us ADD CONSTRAINT FK_8205FDD0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE users_verification_codes ADD CONSTRAINT FK_38992541A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_verification_codes ADD CONSTRAINT FK_3899254171D7FC04 FOREIGN KEY (phone_verification_code_id) REFERENCES phone_verification_code (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer_buy_item ADD CONSTRAINT FK_98F0C950126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE offer_buy_item ADD CONSTRAINT FK_98F0C95053C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D98BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D9126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE shift ADD CONSTRAINT FK_A50B3B45851AD333 FOREIGN KEY (shift_day_id) REFERENCES shift_days (id)');
        $this->addSql('ALTER TABLE rating_tag_rating_range ADD CONSTRAINT FK_16A366FA95200999 FOREIGN KEY (rating_tag_id) REFERENCES rating_tag (id)');
        $this->addSql('ALTER TABLE rating_tag_rating_range ADD CONSTRAINT FK_16A366FA74BF6546 FOREIGN KEY (rating_range_id) REFERENCES rating_range (id)');
        $this->addSql('ALTER TABLE order_rating_tag ADD CONSTRAINT FK_A98A772F95200999 FOREIGN KEY (rating_tag_id) REFERENCES rating_tag (id)');
        $this->addSql('ALTER TABLE order_rating_tag ADD CONSTRAINT FK_A98A772F8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F09126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F098D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE promo_code_city ADD CONSTRAINT FK_337A0F4E2FAE4625 FOREIGN KEY (promo_code_id) REFERENCES promo_code (id)');
        $this->addSql('ALTER TABLE promo_code_city ADD CONSTRAINT FK_337A0F4E8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE user_package ADD CONSTRAINT FK_8665799FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_package ADD CONSTRAINT FK_8665799FF44CABFF FOREIGN KEY (package_id) REFERENCES package (id)');
        $this->addSql('ALTER TABLE `order` DROP created_by, DROP created_by_fullName, DROP first_payment_price, DROP second_payment_method, DROP second_payment_price, DROP rating_tag_id, CHANGE price price NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993986E6F1246 FOREIGN KEY (assigned_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398C3423909 FOREIGN KEY (driver_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939847FECE FOREIGN KEY (city_area_id) REFERENCES city_area (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993988A128D90 FOREIGN KEY (van_id) REFERENCES van (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993988BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398BB70BC0E FOREIGN KEY (shift_id) REFERENCES shift (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939853C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993987048FD0F FOREIGN KEY (credit_card_id) REFERENCES pf_payment_method (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993982FAE4625 FOREIGN KEY (promo_code_id) REFERENCES promo_code (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939852D06999 FOREIGN KEY (user_address_id) REFERENCES user_address (id)');
        $this->addSql('ALTER TABLE user_item_package ADD CONSTRAINT FK_55F93DC3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_item_package ADD CONSTRAINT FK_55F93DC3126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE order_status_history ADD CONSTRAINT FK_471AD77E8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_status_history ADD CONSTRAINT FK_471AD77E560C5433 FOREIGN KEY (action_done_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_status_history ADD CONSTRAINT FK_471AD77EB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item_home ADD CONSTRAINT FK_B9E6482B126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE user_address ADD CONSTRAINT FK_5543718BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE package_buy_item ADD CONSTRAINT FK_50CED5C126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE package_buy_item ADD CONSTRAINT FK_50CED5CF44CABFF FOREIGN KEY (package_id) REFERENCES package (id)');
        $this->addSql('ALTER TABLE order_offer ADD CONSTRAINT FK_AA48F3C353C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE order_offer ADD CONSTRAINT FK_AA48F3C38D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE device_notification ADD CONSTRAINT FK_CD21911BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE van_item ADD CONSTRAINT FK_943ECC1D126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE van_item ADD CONSTRAINT FK_943ECC1D8A128D90 FOREIGN KEY (van_id) REFERENCES van (id)');
        $this->addSql('ALTER TABLE van_driver ADD CONSTRAINT FK_E39DFEE3C3423909 FOREIGN KEY (driver_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE van_driver ADD CONSTRAINT FK_E39DFEE38A128D90 FOREIGN KEY (van_id) REFERENCES van (id)');
        $this->addSql('ALTER TABLE offer_Get_item ADD CONSTRAINT FK_F2262A72126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE offer_Get_item ADD CONSTRAINT FK_F2262A7253C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E79BCD33B FOREIGN KEY (item_attribute_id) REFERENCES item_attribute (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E28F818C3 FOREIGN KEY (item_brand_id) REFERENCES item_brand (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E49FD83F5 FOREIGN KEY (item_package_id) REFERENCES item_package (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E7C171609 FOREIGN KEY (item_package_size_id) REFERENCES item_package_size (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251ECE11AAC7 FOREIGN KEY (item_type_id) REFERENCES item_type (id)');
        $this->addSql('ALTER TABLE order_offer_get_item ADD CONSTRAINT FK_63209894126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE order_offer_get_item ADD CONSTRAINT FK_63209894B23E965F FOREIGN KEY (order_offer_id) REFERENCES order_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_package_buy_item ADD CONSTRAINT FK_671AF940126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE order_package_buy_item ADD CONSTRAINT FK_671AF940479656AA FOREIGN KEY (order_package_id) REFERENCES order_package (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_package ADD CONSTRAINT FK_2812CEDEF44CABFF FOREIGN KEY (package_id) REFERENCES package (id)');
        $this->addSql('ALTER TABLE order_package ADD CONSTRAINT FK_2812CEDE8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE van ADD CONSTRAINT FK_79D1DB493B2AEA3 FOREIGN KEY (van_type_id) REFERENCES van_type (id)');
        $this->addSql('DROP INDEX IDX_F08019E053C674EE ON order_offer_buy_item');
        $this->addSql('ALTER TABLE order_offer_buy_item ADD CONSTRAINT FK_F08019E0126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE order_offer_buy_item ADD CONSTRAINT FK_F08019E0B23E965F FOREIGN KEY (order_offer_id) REFERENCES order_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pf_payment_method ADD CONSTRAINT FK_B7402433DEEE62D0 FOREIGN KEY (holder_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pf_transaction_status ADD CONSTRAINT FK_B55D4B7B2FC0CB0F FOREIGN KEY (transaction_id) REFERENCES pf_transaction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pf_transaction ADD CONSTRAINT FK_C29DBE415AA1164F FOREIGN KEY (payment_method_id) REFERENCES pf_payment_method (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE pf_transaction ADD CONSTRAINT FK_C29DBE412989F1FD FOREIGN KEY (invoice_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE device DROP locale');
        $this->addSql('ALTER TABLE device ADD CONSTRAINT FK_92FB68EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('DROP INDEX UNIQ_140AB6202B36786B ON page');
        $this->addSql('DROP INDEX UNIQ_140AB620CE671CFF ON page');
        $this->addSql('ALTER TABLE page CHANGE title title VARCHAR(200) NOT NULL, CHANGE titleAr titleAr VARCHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE cms_contact ADD CONSTRAINT FK_128EE929A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_128EE929A76ED395 ON cms_contact (user_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE #Tableau_01_sid_003F34F7_4_Group (Number Of Used Times, promo_code_method, promo_code_name and 1 VARCHAR(30) DEFAULT NULL COLLATE utf8_general_ci, numberOfUsedTimes INT DEFAULT 0, promo_code_method VARCHAR(11) DEFAULT NULL COLLATE utf8mb4_general_ci, promo_code_name VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_general_ci, title (promo_code) VARCHAR(190) DEFAULT NULL COLLATE utf8mb4_general_ci, INDEX _tidx_#Tableau_01_sid_003F34F7_4_Group_4a (promo_code_name), INDEX _tidx_#Tableau_01_sid_003F34F7_4_Group_3a (promo_code_method), INDEX _tidx_#Tableau_01_sid_003F34F7_4_Group_5a (title (promo_code)), INDEX _tidx_#Tableau_01_sid_003F34F7_4_Group_1a (Number Of Used Times, promo_code_method, promo_code_name and 1)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cms_contact DROP FOREIGN KEY FK_128EE929A76ED395');
        $this->addSql('DROP INDEX IDX_128EE929A76ED395 ON cms_contact');
        $this->addSql('ALTER TABLE contact_us DROP FOREIGN KEY FK_8205FDD08D9F6D38');
        $this->addSql('ALTER TABLE contact_us DROP FOREIGN KEY FK_8205FDD0A76ED395');
        $this->addSql('ALTER TABLE device DROP FOREIGN KEY FK_92FB68EA76ED395');
        $this->addSql('ALTER TABLE device ADD locale VARCHAR(2) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE device_notification DROP FOREIGN KEY FK_CD21911BA76ED395');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E79BCD33B');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E28F818C3');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E49FD83F5');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E7C171609');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251ECE11AAC7');
        $this->addSql('ALTER TABLE item_home DROP FOREIGN KEY FK_B9E6482B126F525E');
        $this->addSql('ALTER TABLE offer_Get_item DROP FOREIGN KEY FK_F2262A72126F525E');
        $this->addSql('ALTER TABLE offer_Get_item DROP FOREIGN KEY FK_F2262A7253C674EE');
        $this->addSql('ALTER TABLE offer_buy_item DROP FOREIGN KEY FK_98F0C950126F525E');
        $this->addSql('ALTER TABLE offer_buy_item DROP FOREIGN KEY FK_98F0C95053C674EE');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993986E6F1246');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398C3423909');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939847FECE');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993988A128D90');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993988BAC62AF');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398BB70BC0E');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939853C674EE');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993987048FD0F');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993982FAE4625');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939852D06999');
        $this->addSql('ALTER TABLE `order` ADD created_by INT DEFAULT NULL COMMENT \'currently driverId\', ADD created_by_fullName VARCHAR(190) DEFAULT NULL COLLATE utf8mb4_general_ci, ADD first_payment_price NUMERIC(10, 2) DEFAULT NULL COMMENT \'New\', ADD second_payment_method VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_general_ci COMMENT \'New\', ADD second_payment_price NUMERIC(10, 2) DEFAULT NULL COMMENT \'New\', ADD rating_tag_id INT DEFAULT NULL, CHANGE price price NUMERIC(10, 2) DEFAULT \'0.00\'');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F09126F525E');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F098D9F6D38');
        $this->addSql('ALTER TABLE order_offer DROP FOREIGN KEY FK_AA48F3C353C674EE');
        $this->addSql('ALTER TABLE order_offer DROP FOREIGN KEY FK_AA48F3C38D9F6D38');
        $this->addSql('ALTER TABLE order_offer_buy_item DROP FOREIGN KEY FK_F08019E0126F525E');
        $this->addSql('ALTER TABLE order_offer_buy_item DROP FOREIGN KEY FK_F08019E0B23E965F');
        $this->addSql('CREATE INDEX IDX_F08019E053C674EE ON order_offer_buy_item (order_offer_id)');
        $this->addSql('ALTER TABLE order_offer_get_item DROP FOREIGN KEY FK_63209894126F525E');
        $this->addSql('ALTER TABLE order_offer_get_item DROP FOREIGN KEY FK_63209894B23E965F');
        $this->addSql('ALTER TABLE order_package DROP FOREIGN KEY FK_2812CEDEF44CABFF');
        $this->addSql('ALTER TABLE order_package DROP FOREIGN KEY FK_2812CEDE8D9F6D38');
        $this->addSql('ALTER TABLE order_package_buy_item DROP FOREIGN KEY FK_671AF940126F525E');
        $this->addSql('ALTER TABLE order_package_buy_item DROP FOREIGN KEY FK_671AF940479656AA');
        $this->addSql('ALTER TABLE order_rating_tag DROP FOREIGN KEY FK_A98A772F95200999');
        $this->addSql('ALTER TABLE order_rating_tag DROP FOREIGN KEY FK_A98A772F8D9F6D38');
        $this->addSql('ALTER TABLE order_status_history DROP FOREIGN KEY FK_471AD77E8D9F6D38');
        $this->addSql('ALTER TABLE order_status_history DROP FOREIGN KEY FK_471AD77E560C5433');
        $this->addSql('ALTER TABLE order_status_history DROP FOREIGN KEY FK_471AD77EB03A8386');
        $this->addSql('ALTER TABLE package_buy_item DROP FOREIGN KEY FK_50CED5C126F525E');
        $this->addSql('ALTER TABLE package_buy_item DROP FOREIGN KEY FK_50CED5CF44CABFF');
        $this->addSql('ALTER TABLE page CHANGE title title VARCHAR(190) NOT NULL COLLATE utf8_unicode_ci, CHANGE titleAr titleAr VARCHAR(190) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_140AB6202B36786B ON page (title)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_140AB620CE671CFF ON page (titleAr)');
        $this->addSql('ALTER TABLE pf_payment_method DROP FOREIGN KEY FK_B7402433DEEE62D0');
        $this->addSql('ALTER TABLE pf_transaction DROP FOREIGN KEY FK_C29DBE415AA1164F');
        $this->addSql('ALTER TABLE pf_transaction DROP FOREIGN KEY FK_C29DBE412989F1FD');
        $this->addSql('ALTER TABLE pf_transaction_status DROP FOREIGN KEY FK_B55D4B7B2FC0CB0F');
        $this->addSql('ALTER TABLE price DROP FOREIGN KEY FK_CAC822D98BAC62AF');
        $this->addSql('ALTER TABLE price DROP FOREIGN KEY FK_CAC822D9126F525E');
        $this->addSql('ALTER TABLE promo_code_city DROP FOREIGN KEY FK_337A0F4E2FAE4625');
        $this->addSql('ALTER TABLE promo_code_city DROP FOREIGN KEY FK_337A0F4E8BAC62AF');
        $this->addSql('ALTER TABLE rating_tag_rating_range DROP FOREIGN KEY FK_16A366FA95200999');
        $this->addSql('ALTER TABLE rating_tag_rating_range DROP FOREIGN KEY FK_16A366FA74BF6546');
        $this->addSql('ALTER TABLE shift DROP FOREIGN KEY FK_A50B3B45851AD333');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F92F3E70');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498BAC62AF');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('ALTER TABLE user_address DROP FOREIGN KEY FK_5543718BA76ED395');
        $this->addSql('ALTER TABLE user_item_package DROP FOREIGN KEY FK_55F93DC3A76ED395');
        $this->addSql('ALTER TABLE user_item_package DROP FOREIGN KEY FK_55F93DC3126F525E');
        $this->addSql('ALTER TABLE user_package DROP FOREIGN KEY FK_8665799FA76ED395');
        $this->addSql('ALTER TABLE user_package DROP FOREIGN KEY FK_8665799FF44CABFF');
        $this->addSql('ALTER TABLE users_verification_codes DROP FOREIGN KEY FK_38992541A76ED395');
        $this->addSql('ALTER TABLE users_verification_codes DROP FOREIGN KEY FK_3899254171D7FC04');
        $this->addSql('ALTER TABLE van DROP FOREIGN KEY FK_79D1DB493B2AEA3');
        $this->addSql('ALTER TABLE van_driver DROP FOREIGN KEY FK_E39DFEE3C3423909');
        $this->addSql('ALTER TABLE van_driver DROP FOREIGN KEY FK_E39DFEE38A128D90');
        $this->addSql('ALTER TABLE van_item DROP FOREIGN KEY FK_943ECC1D126F525E');
        $this->addSql('ALTER TABLE van_item DROP FOREIGN KEY FK_943ECC1D8A128D90');
    }
}
