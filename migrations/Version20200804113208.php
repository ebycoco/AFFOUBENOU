<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200804113208 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carte_visite (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, profession VARCHAR(255) NOT NULL, nom_societe VARCHAR(255) NOT NULL, contact1 INT NOT NULL, contact2 INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, address_du_site VARCHAR(255) DEFAULT NULL, numero_fixe INT DEFAULT NULL, lieu VARCHAR(255) NOT NULL, social VARCHAR(255) NOT NULL, autres_infor LONGTEXT DEFAULT NULL, etat VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_A678EC8AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carte_visite_filigramme (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, cartevisite_id INT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_12A6AC43A76ED395 (user_id), INDEX IDX_12A6AC4364EAE937 (cartevisite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carte_visite_finale (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, cartevisite_id INT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_8840AC92A76ED395 (user_id), INDEX IDX_8840AC9264EAE937 (cartevisite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carte_visite ADD CONSTRAINT FK_A678EC8AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE carte_visite_filigramme ADD CONSTRAINT FK_12A6AC43A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE carte_visite_filigramme ADD CONSTRAINT FK_12A6AC4364EAE937 FOREIGN KEY (cartevisite_id) REFERENCES carte_visite (id)');
        $this->addSql('ALTER TABLE carte_visite_finale ADD CONSTRAINT FK_8840AC92A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE carte_visite_finale ADD CONSTRAINT FK_8840AC9264EAE937 FOREIGN KEY (cartevisite_id) REFERENCES carte_visite (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte_visite_filigramme DROP FOREIGN KEY FK_12A6AC4364EAE937');
        $this->addSql('ALTER TABLE carte_visite_finale DROP FOREIGN KEY FK_8840AC9264EAE937');
        $this->addSql('DROP TABLE carte_visite');
        $this->addSql('DROP TABLE carte_visite_filigramme');
        $this->addSql('DROP TABLE carte_visite_finale');
    }
}
