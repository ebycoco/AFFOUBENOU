<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200819094348 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carte_menu (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, predefinie_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, menus LONGTEXT NOT NULL, contact INT NOT NULL, lieu VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, quantite INT NOT NULL, info LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_DA2B034BA76ED395 (user_id), INDEX IDX_DA2B034BA904BFF9 (predefinie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carte_menu_filigramme (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, cartemenu_id INT NOT NULL, image_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_448F063A76ED395 (user_id), INDEX IDX_448F06323006EA0 (cartemenu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carte_menu_finale (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, cartemenu_id INT NOT NULL, image_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_5B623BC5A76ED395 (user_id), INDEX IDX_5B623BC523006EA0 (cartemenu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carte_menu ADD CONSTRAINT FK_DA2B034BA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE carte_menu ADD CONSTRAINT FK_DA2B034BA904BFF9 FOREIGN KEY (predefinie_id) REFERENCES carte_menu_filigramme (id)');
        $this->addSql('ALTER TABLE carte_menu_filigramme ADD CONSTRAINT FK_448F063A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE carte_menu_filigramme ADD CONSTRAINT FK_448F06323006EA0 FOREIGN KEY (cartemenu_id) REFERENCES carte_menu (id)');
        $this->addSql('ALTER TABLE carte_menu_finale ADD CONSTRAINT FK_5B623BC5A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE carte_menu_finale ADD CONSTRAINT FK_5B623BC523006EA0 FOREIGN KEY (cartemenu_id) REFERENCES carte_menu (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte_menu_filigramme DROP FOREIGN KEY FK_448F06323006EA0');
        $this->addSql('ALTER TABLE carte_menu_finale DROP FOREIGN KEY FK_5B623BC523006EA0');
        $this->addSql('ALTER TABLE carte_menu DROP FOREIGN KEY FK_DA2B034BA904BFF9');
        $this->addSql('DROP TABLE carte_menu');
        $this->addSql('DROP TABLE carte_menu_filigramme');
        $this->addSql('DROP TABLE carte_menu_finale');
    }
}
