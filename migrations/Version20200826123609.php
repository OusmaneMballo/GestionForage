<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200826123609 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, compteur_id INT DEFAULT NULL, numero VARCHAR(30) NOT NULL, date VARCHAR(15) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_351268BB19EB6921 (client_id), UNIQUE INDEX UNIQ_351268BBAA3B9810 (compteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chef_village (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, telephone VARCHAR(15) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, village_id INT DEFAULT NULL, prenom VARCHAR(30) NOT NULL, nom VARCHAR(30) NOT NULL, telephone VARCHAR(15) NOT NULL, nci VARCHAR(15) NOT NULL, date_naiss VARCHAR(15) NOT NULL, INDEX IDX_C7440455A76ED395 (user_id), INDEX IDX_C74404555E0D5582 (village_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compteur (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(25) NOT NULL, etat VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consommation (id INT AUTO_INCREMENT NOT NULL, compteur_id INT DEFAULT NULL, facturation_id INT DEFAULT NULL, nombre_litre DOUBLE PRECISION NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, date VARCHAR(15) NOT NULL, INDEX IDX_F993F0A2AA3B9810 (compteur_id), UNIQUE INDEX UNIQ_F993F0A2DBC5F284 (facturation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, reglement_id INT DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, date_facturation VARCHAR(15) NOT NULL, date_limite VARCHAR(15) NOT NULL, numero VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_FE8664106A477111 (reglement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reglement (id INT AUTO_INCREMENT NOT NULL, date VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, profil_id INT NOT NULL, email VARCHAR(30) NOT NULL, login VARCHAR(30) NOT NULL, passwd VARCHAR(30) NOT NULL, nom_prenom VARCHAR(100) NOT NULL, telephone VARCHAR(15) DEFAULT NULL, INDEX IDX_8D93D649275ED078 (profil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE village (id INT AUTO_INCREMENT NOT NULL, chef_id INT NOT NULL, identifiant VARCHAR(15) NOT NULL, nom VARCHAR(30) NOT NULL, INDEX IDX_4E6C7FAA150A48F1 (chef_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BBAA3B9810 FOREIGN KEY (compteur_id) REFERENCES compteur (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404555E0D5582 FOREIGN KEY (village_id) REFERENCES village (id)');
        $this->addSql('ALTER TABLE consommation ADD CONSTRAINT FK_F993F0A2AA3B9810 FOREIGN KEY (compteur_id) REFERENCES compteur (id)');
        $this->addSql('ALTER TABLE consommation ADD CONSTRAINT FK_F993F0A2DBC5F284 FOREIGN KEY (facturation_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE8664106A477111 FOREIGN KEY (reglement_id) REFERENCES reglement (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE village ADD CONSTRAINT FK_4E6C7FAA150A48F1 FOREIGN KEY (chef_id) REFERENCES chef_village (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE village DROP FOREIGN KEY FK_4E6C7FAA150A48F1');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB19EB6921');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BBAA3B9810');
        $this->addSql('ALTER TABLE consommation DROP FOREIGN KEY FK_F993F0A2AA3B9810');
        $this->addSql('ALTER TABLE consommation DROP FOREIGN KEY FK_F993F0A2DBC5F284');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649275ED078');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE8664106A477111');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A76ED395');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404555E0D5582');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE chef_village');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE compteur');
        $this->addSql('DROP TABLE consommation');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE reglement');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE village');
    }
}
