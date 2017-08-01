<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170801160528 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("DELETE FROM `page` WHERE 1;
            INSERT INTO `page` (`id`, `title`, `slug`, `content`, `titleAr`, `contentAr`, `created_at`, `updated_at`, `version`) VALUES
                (1, 'Driver Terms and Conditions', 'driver-terms-and-conditions', '', 'الشروط و الأحكام للسائق', '', '2017-05-30 22:01:17', '2017-05-30 22:01:17', 1),
                (2, 'User Terms and Conditions', 'user-terms-and-conditions', '', 'الشروط و الأحكام للمستخدم', '', '2017-05-30 22:01:17', '2017-05-30 22:01:17', 1),
                (3, 'Videos About Driver', 'videos-about-driver', '', 'فيديوهات عن السائق', '', '2017-05-30 22:01:17', '2017-05-30 22:01:17', 1),
                (4, 'Videos About User', 'videos-about-user', '', 'فيديوهات عن المستخدم', '', '2017-05-30 22:01:17', '2017-05-30 22:01:17', 1),
                (5, 'Driver Privacy Policy', 'driver-privacy-policy', '', 'سياسة الخصوصية للسائق', '', '2017-05-30 22:01:17', '2017-05-30 22:01:17', 1),
                (6, 'User Privacy Policy', 'user-privacy-policy', '', 'سياسة الخصوصية للمستخدم', '', '2017-05-30 22:01:17', '2017-05-30 22:01:17', 1),
                (7, 'Driver FAQ', 'driver-faq', '', 'الأسئلة الشائعة للسائق', '', '2017-05-30 22:01:17', '2017-05-30 22:01:17', 1),
                (8, 'User FAQ', 'user-faq', '', 'الأسئلة الشائعة للمستخدم', '', '2017-05-30 22:01:17', '2017-05-30 22:01:17', 1);
                ");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
         $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("DELETE FROM `page` WHERE 1;"
        ."INSERT INTO `page` (`id`, `title`, `slug`, `content`, `titleAr`, `contentAr`, `created_at`, `updated_at`, `version`) VALUES
            (1, 'About', 'about', '<p>w et5g weg weg wsgh wege</p>', 'عن الموقع', '<p>ghw wtg werg weg weg wgh werg</p>', '2017-07-05 11:16:36', '2017-08-01 15:15:54', 2),
            (2, 'Privacy Policy', 'privacy-policy', NULL, 'سياسة الخصوصية', NULL, '2017-07-05 11:16:36', '2017-07-05 11:16:36', 1),
            (3, 'Terms and conditions', 'terms-and-conditions', NULL, 'الشروط و الأحكام', NULL, '2017-07-05 11:16:36', '2017-07-05 11:16:36', 1);
            ");

    }
}
