<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210819112432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ltour_reservation (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, loueur_id INT NOT NULL, annonce_id INT NOT NULL, datedebut DATETIME NOT NULL, datefin DATETIME NOT NULL, datereservation DATETIME NOT NULL, tarifTotal DOUBLE PRECISION NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone INT NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, cp INT NOT NULL, nomsociete VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, INDEX IDX_E1379E2119EB6921 (client_id), INDEX IDX_E1379E21DAF8AEE6 (loueur_id), INDEX IDX_E1379E218805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ltour_equipement_reservation (reservation_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_8C6031DFB83297E7 (reservation_id), INDEX IDX_8C6031DF806F0F5C (equipement_id), PRIMARY KEY(reservation_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ltour_service_reservation (reservation_id INT NOT NULL, services_id INT NOT NULL, INDEX IDX_1B6F83D2B83297E7 (reservation_id), INDEX IDX_1B6F83D2AEF5A6C1 (services_id), PRIMARY KEY(reservation_id, services_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ltour_reservation ADD CONSTRAINT FK_E1379E2119EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ltour_reservation ADD CONSTRAINT FK_E1379E21DAF8AEE6 FOREIGN KEY (loueur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ltour_reservation ADD CONSTRAINT FK_E1379E218805AB2F FOREIGN KEY (annonce_id) REFERENCES annonces (id)');
        $this->addSql('ALTER TABLE ltour_equipement_reservation ADD CONSTRAINT FK_8C6031DFB83297E7 FOREIGN KEY (reservation_id) REFERENCES ltour_reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ltour_equipement_reservation ADD CONSTRAINT FK_8C6031DF806F0F5C FOREIGN KEY (equipement_id) REFERENCES ltour_equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ltour_service_reservation ADD CONSTRAINT FK_1B6F83D2B83297E7 FOREIGN KEY (reservation_id) REFERENCES ltour_reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ltour_service_reservation ADD CONSTRAINT FK_1B6F83D2AEF5A6C1 FOREIGN KEY (services_id) REFERENCES ltour_services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonces ADD typeTarification VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ltour_equipement_reservation DROP FOREIGN KEY FK_8C6031DFB83297E7');
        $this->addSql('ALTER TABLE ltour_service_reservation DROP FOREIGN KEY FK_1B6F83D2B83297E7');
        $this->addSql('DROP TABLE ltour_reservation');
        $this->addSql('DROP TABLE ltour_equipement_reservation');
        $this->addSql('DROP TABLE ltour_service_reservation');
        $this->addSql('ALTER TABLE annonces DROP typeTarification');
    }
}
