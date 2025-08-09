<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250809151836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE correction (id INT AUTO_INCREMENT NOT NULL, professeur_id INT DEFAULT NULL, epreuve_id INT DEFAULT NULL, date DATE NOT NULL, nbr_copie INT NOT NULL, INDEX IDX_A29DA1B8BAB22EE9 (professeur_id), INDEX IDX_A29DA1B8AB990336 (epreuve_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE epreuve (id INT AUTO_INCREMENT NOT NULL, examen_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_D6ADE47F5C8659A (examen_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examen (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, etablissement_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(100) NOT NULL, grade VARCHAR(30) NOT NULL, INDEX IDX_17A55299FF631228 (etablissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE correction ADD CONSTRAINT FK_A29DA1B8BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE correction ADD CONSTRAINT FK_A29DA1B8AB990336 FOREIGN KEY (epreuve_id) REFERENCES epreuve (id)');
        $this->addSql('ALTER TABLE epreuve ADD CONSTRAINT FK_D6ADE47F5C8659A FOREIGN KEY (examen_id) REFERENCES examen (id)');
        $this->addSql('ALTER TABLE professeur ADD CONSTRAINT FK_17A55299FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE correction DROP FOREIGN KEY FK_A29DA1B8BAB22EE9');
        $this->addSql('ALTER TABLE correction DROP FOREIGN KEY FK_A29DA1B8AB990336');
        $this->addSql('ALTER TABLE epreuve DROP FOREIGN KEY FK_D6ADE47F5C8659A');
        $this->addSql('ALTER TABLE professeur DROP FOREIGN KEY FK_17A55299FF631228');
        $this->addSql('DROP TABLE correction');
        $this->addSql('DROP TABLE epreuve');
        $this->addSql('DROP TABLE examen');
        $this->addSql('DROP TABLE professeur');
    }
}
