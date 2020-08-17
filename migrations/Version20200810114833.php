<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200810114833 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE autre_fonctionnalite (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, image_name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_B68BA411A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_web (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_3B7EF950A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_services_web (id INT AUTO_INCREMENT NOT NULL, categorie_web_id INT NOT NULL, user_id INT NOT NULL, nom_entreprise VARCHAR(255) NOT NULL, nom_site VARCHAR(255) NOT NULL, detail_site LONGTEXT DEFAULT NULL, social1 VARCHAR(255) DEFAULT NULL, social2 VARCHAR(255) DEFAULT NULL, social3 VARCHAR(255) DEFAULT NULL, social4 VARCHAR(255) DEFAULT NULL, lien VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_A82CF709783EED74 (categorie_web_id), INDEX IDX_A82CF709A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_services_web_autre_fonctionnalite (commande_services_web_id INT NOT NULL, autre_fonctionnalite_id INT NOT NULL, INDEX IDX_D6248B85B5E58E (commande_services_web_id), INDEX IDX_D6248B85CBA42F84 (autre_fonctionnalite_id), PRIMARY KEY(commande_services_web_id, autre_fonctionnalite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_web_demo (id INT AUTO_INCREMENT NOT NULL, commande_service_web_id INT NOT NULL, user_id INT NOT NULL, image_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_EB3689685844DA1 (commande_service_web_id), INDEX IDX_EB368968A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE autre_fonctionnalite ADD CONSTRAINT FK_B68BA411A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE categorie_web ADD CONSTRAINT FK_3B7EF950A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE commande_services_web ADD CONSTRAINT FK_A82CF709783EED74 FOREIGN KEY (categorie_web_id) REFERENCES categorie_web (id)');
        $this->addSql('ALTER TABLE commande_services_web ADD CONSTRAINT FK_A82CF709A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE commande_services_web_autre_fonctionnalite ADD CONSTRAINT FK_D6248B85B5E58E FOREIGN KEY (commande_services_web_id) REFERENCES commande_services_web (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_services_web_autre_fonctionnalite ADD CONSTRAINT FK_D6248B85CBA42F84 FOREIGN KEY (autre_fonctionnalite_id) REFERENCES autre_fonctionnalite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_web_demo ADD CONSTRAINT FK_EB3689685844DA1 FOREIGN KEY (commande_service_web_id) REFERENCES commande_services_web (id)');
        $this->addSql('ALTER TABLE service_web_demo ADD CONSTRAINT FK_EB368968A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_services_web_autre_fonctionnalite DROP FOREIGN KEY FK_D6248B85CBA42F84');
        $this->addSql('ALTER TABLE commande_services_web DROP FOREIGN KEY FK_A82CF709783EED74');
        $this->addSql('ALTER TABLE commande_services_web_autre_fonctionnalite DROP FOREIGN KEY FK_D6248B85B5E58E');
        $this->addSql('ALTER TABLE service_web_demo DROP FOREIGN KEY FK_EB3689685844DA1');
        $this->addSql('DROP TABLE autre_fonctionnalite');
        $this->addSql('DROP TABLE categorie_web');
        $this->addSql('DROP TABLE commande_services_web');
        $this->addSql('DROP TABLE commande_services_web_autre_fonctionnalite');
        $this->addSql('DROP TABLE service_web_demo');
    }
}
