<?php

namespace Ibtikar\TaniaModelBundle\DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170529113019 extends AbstractMigration {

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("
            INSERT INTO `user` (`id`, `country_id`, `city_id`, `application_language`, `email`, `password`, `salt`, `roles`, `enabled`, `emailVerified`, `isPhoneVerified`, `emailVerificationToken`, `emailVerificationTokenExpiryTime`, `changePasswordToken`, `changePasswordTokenExpiryTime`, `lastForgetPasswordRequestDate`, `forgetPasswordRequests`, `lastEmailVerificationRequestDate`, `verificationEmailRequests`, `fullName`, `phone`, `locale`, `systemUser`, `image`, `created_at`, `updated_at`, `version`, `entityClass`) VALUES
            (NULL, NULL, NULL, 'ar', 'admin@ibtikar.net', 'S2CVsPxiIXtZp5409nvRz6B6RVptkryAhV94UqwvuamEyD56NEwMu23sC0lq2n//68+FovLT6XjGteMbFl54Tw==', '32bbba04283e1ada5776eaf3edc98a0b', 'ROLE_SUPER_ADMIN', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tania Admin', '01000000000', 'ar', 1, NULL, '2017-05-28 16:32:41', '2017-05-28 16:32:41', 1, 'user');
");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("DELETE FROM `user` WHERE email='admin@ibtikar.net'");
    }

}
