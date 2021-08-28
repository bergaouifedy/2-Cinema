<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210823115129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ltour_decoration_annonce DROP FOREIGN KEY FK_F69B3653446DFC4');
        $this->addSql('ALTER TABLE ltour_environment_annonce DROP FOREIGN KEY FK_51C9C8421083D442');
        $this->addSql('ALTER TABLE ltour_equipement_annonce DROP FOREIGN KEY FK_7F7E70FE806F0F5C');
        $this->addSql('ALTER TABLE ltour_equipement_reservation DROP FOREIGN KEY FK_8C6031DF806F0F5C');
        $this->addSql('ALTER TABLE ltour_service_annonce DROP FOREIGN KEY FK_89B1DA27AEF5A6C1');
        $this->addSql('ALTER TABLE ltour_service_reservation DROP FOREIGN KEY FK_1B6F83D2AEF5A6C1');
        $this->addSql('ALTER TABLE ltour_souscategorie_annonce DROP FOREIGN KEY FK_9B13D2CA9F751138');
        $this->addSql('ALTER TABLE ltour_decoration DROP FOREIGN KEY FK_44B39DC53446DFC4');
        $this->addSql('ALTER TABLE ltour_environments DROP FOREIGN KEY FK_99E3E2C3C54C8C93');
        $this->addSql('ALTER TABLE ltour_services DROP FOREIGN KEY FK_912A991BC54C8C93');
        $this->addSql('DROP TABLE ltour_decoration');
        $this->addSql('DROP TABLE ltour_decoration_annonce');
        $this->addSql('DROP TABLE ltour_environment_annonce');
        $this->addSql('DROP TABLE ltour_environments');
        $this->addSql('DROP TABLE ltour_equipement');
        $this->addSql('DROP TABLE ltour_equipement_annonce');
        $this->addSql('DROP TABLE ltour_equipement_reservation');
        $this->addSql('DROP TABLE ltour_service_annonce');
        $this->addSql('DROP TABLE ltour_service_reservation');
        $this->addSql('DROP TABLE ltour_services');
        $this->addSql('DROP TABLE ltour_sous_categories');
        $this->addSql('DROP TABLE ltour_souscategorie_annonce');
        $this->addSql('DROP TABLE ltour_type_decoration');
        $this->addSql('DROP TABLE ltour_type_environment');
        $this->addSql('DROP TABLE ltour_type_services');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ltour_decoration (id INT AUTO_INCREMENT NOT NULL, decoration_id INT DEFAULT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_44B39DC53446DFC4 (decoration_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ltour_decoration_annonce (annonces_id INT NOT NULL, decoration_id INT NOT NULL, INDEX IDX_F69B3654C2885D7 (annonces_id), INDEX IDX_F69B3653446DFC4 (decoration_id), PRIMARY KEY(annonces_id, decoration_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ltour_environment_annonce (annonces_id INT NOT NULL, environments_id INT NOT NULL, INDEX IDX_51C9C8424C2885D7 (annonces_id), INDEX IDX_51C9C8421083D442 (environments_id), PRIMARY KEY(annonces_id, environments_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ltour_environments (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_99E3E2C3C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ltour_equipement (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ltour_equipement_annonce (annonces_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_7F7E70FE4C2885D7 (annonces_id), INDEX IDX_7F7E70FE806F0F5C (equipement_id), PRIMARY KEY(annonces_id, equipement_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ltour_equipement_reservation (reservation_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_8C6031DFB83297E7 (reservation_id), INDEX IDX_8C6031DF806F0F5C (equipement_id), PRIMARY KEY(reservation_id, equipement_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ltour_service_annonce (annonces_id INT NOT NULL, services_id INT NOT NULL, INDEX IDX_89B1DA274C2885D7 (annonces_id), INDEX IDX_89B1DA27AEF5A6C1 (services_id), PRIMARY KEY(annonces_id, services_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ltour_service_reservation (reservation_id INT NOT NULL, services_id INT NOT NULL, INDEX IDX_1B6F83D2B83297E7 (reservation_id), INDEX IDX_1B6F83D2AEF5A6C1 (services_id), PRIMARY KEY(reservation_id, services_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ltour_services (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_912A991BC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ltour_sous_categories (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_6CEB08DCBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ltour_souscategorie_annonce (annonces_id INT NOT NULL, sous_categories_id INT NOT NULL, INDEX IDX_9B13D2CA4C2885D7 (annonces_id), INDEX IDX_9B13D2CA9F751138 (sous_categories_id), PRIMARY KEY(annonces_id, sous_categories_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ltour_type_decoration (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ltour_type_environment (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ltour_type_services (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ltour_decoration ADD CONSTRAINT FK_44B39DC53446DFC4 FOREIGN KEY (decoration_id) REFERENCES ltour_type_decoration (id)');
        $this->addSql('ALTER TABLE ltour_decoration_annonce ADD CONSTRAINT FK_F69B3653446DFC4 FOREIGN KEY (decoration_id) REFERENCES ltour_decoration (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ltour_decoration_annonce ADD CONSTRAINT FK_F69B3654C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonces (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ltour_environment_annonce ADD CONSTRAINT FK_51C9C8421083D442 FOREIGN KEY (environments_id) REFERENCES ltour_environments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ltour_environment_annonce ADD CONSTRAINT FK_51C9C8424C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonces (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ltour_environments ADD CONSTRAINT FK_99E3E2C3C54C8C93 FOREIGN KEY (type_id) REFERENCES ltour_type_environment (id)');
        $this->addSql('ALTER TABLE ltour_equipement_annonce ADD CONSTRAINT FK_7F7E70FE4C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonces (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ltour_equipement_annonce ADD CONSTRAINT FK_7F7E70FE806F0F5C FOREIGN KEY (equipement_id) REFERENCES ltour_equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ltour_equipement_reservation ADD CONSTRAINT FK_8C6031DF806F0F5C FOREIGN KEY (equipement_id) REFERENCES ltour_equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ltour_equipement_reservation ADD CONSTRAINT FK_8C6031DFB83297E7 FOREIGN KEY (reservation_id) REFERENCES ltour_reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ltour_service_annonce ADD CONSTRAINT FK_89B1DA274C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonces (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ltour_service_annonce ADD CONSTRAINT FK_89B1DA27AEF5A6C1 FOREIGN KEY (services_id) REFERENCES ltour_services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ltour_service_reservation ADD CONSTRAINT FK_1B6F83D2AEF5A6C1 FOREIGN KEY (services_id) REFERENCES ltour_services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ltour_service_reservation ADD CONSTRAINT FK_1B6F83D2B83297E7 FOREIGN KEY (reservation_id) REFERENCES ltour_reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ltour_services ADD CONSTRAINT FK_912A991BC54C8C93 FOREIGN KEY (type_id) REFERENCES ltour_type_services (id)');
        $this->addSql('ALTER TABLE ltour_sous_categories ADD CONSTRAINT FK_6CEB08DCBCF5E72D FOREIGN KEY (categorie_id) REFERENCES ltour_categorie (id)');
        $this->addSql('ALTER TABLE ltour_souscategorie_annonce ADD CONSTRAINT FK_9B13D2CA4C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonces (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ltour_souscategorie_annonce ADD CONSTRAINT FK_9B13D2CA9F751138 FOREIGN KEY (sous_categories_id) REFERENCES ltour_sous_categories (id) ON DELETE CASCADE');
    }
}
