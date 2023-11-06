<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231106083439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appartement_immeuble (appartement_id INT NOT NULL, immeuble_id INT NOT NULL, INDEX IDX_56510AC7E1729BBA (appartement_id), INDEX IDX_56510AC763768E3F (immeuble_id), PRIMARY KEY(appartement_id, immeuble_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semaine_saison (semaine_id INT NOT NULL, saison_id INT NOT NULL, INDEX IDX_F6199422122EEC90 (semaine_id), INDEX IDX_F6199422F965414C (saison_id), PRIMARY KEY(semaine_id, saison_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appartement_immeuble ADD CONSTRAINT FK_56510AC7E1729BBA FOREIGN KEY (appartement_id) REFERENCES appartement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appartement_immeuble ADD CONSTRAINT FK_56510AC763768E3F FOREIGN KEY (immeuble_id) REFERENCES immeuble (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE semaine_saison ADD CONSTRAINT FK_F6199422122EEC90 FOREIGN KEY (semaine_id) REFERENCES semaine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE semaine_saison ADD CONSTRAINT FK_F6199422F965414C FOREIGN KEY (saison_id) REFERENCES saison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appartement ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE appartement ADD CONSTRAINT FK_71A6BD8DB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_71A6BD8DB83297E7 ON appartement (reservation_id)');
        $this->addSql('ALTER TABLE categorie ADD appartement_id INT NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634E1729BBA FOREIGN KEY (appartement_id) REFERENCES appartement (id)');
        $this->addSql('CREATE INDEX IDX_497DD634E1729BBA ON categorie (appartement_id)');
        $this->addSql('ALTER TABLE reservation ADD semaine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955122EEC90 FOREIGN KEY (semaine_id) REFERENCES semaine (id)');
        $this->addSql('CREATE INDEX IDX_42C84955122EEC90 ON reservation (semaine_id)');
        $this->addSql('ALTER TABLE saison ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE saison ADD CONSTRAINT FK_C0D0D586BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_C0D0D586BCF5E72D ON saison (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartement_immeuble DROP FOREIGN KEY FK_56510AC7E1729BBA');
        $this->addSql('ALTER TABLE appartement_immeuble DROP FOREIGN KEY FK_56510AC763768E3F');
        $this->addSql('ALTER TABLE semaine_saison DROP FOREIGN KEY FK_F6199422122EEC90');
        $this->addSql('ALTER TABLE semaine_saison DROP FOREIGN KEY FK_F6199422F965414C');
        $this->addSql('DROP TABLE appartement_immeuble');
        $this->addSql('DROP TABLE semaine_saison');
        $this->addSql('ALTER TABLE appartement DROP FOREIGN KEY FK_71A6BD8DB83297E7');
        $this->addSql('DROP INDEX IDX_71A6BD8DB83297E7 ON appartement');
        $this->addSql('ALTER TABLE appartement DROP reservation_id');
        $this->addSql('ALTER TABLE saison DROP FOREIGN KEY FK_C0D0D586BCF5E72D');
        $this->addSql('DROP INDEX IDX_C0D0D586BCF5E72D ON saison');
        $this->addSql('ALTER TABLE saison DROP categorie_id');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634E1729BBA');
        $this->addSql('DROP INDEX IDX_497DD634E1729BBA ON categorie');
        $this->addSql('ALTER TABLE categorie DROP appartement_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955122EEC90');
        $this->addSql('DROP INDEX IDX_42C84955122EEC90 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP semaine_id');
    }
}
