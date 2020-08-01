<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200730131315 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_logo_personalise (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, predefinie_id INT DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, nom_logo VARCHAR(255) NOT NULL, couleur0 VARCHAR(255) DEFAULT NULL, couleur1 VARCHAR(255) DEFAULT NULL, couleur2 VARCHAR(255) DEFAULT NULL, couleur3 VARCHAR(255) DEFAULT NULL, modification LONGTEXT DEFAULT NULL, etat TINYINT(1) DEFAULT \'0\' NOT NULL, type_logo INT NOT NULL, INDEX IDX_D072620EA76ED395 (user_id), INDEX IDX_D072620EA904BFF9 (predefinie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_logo_personalise ADD CONSTRAINT FK_D072620EA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE commande_logo_personalise ADD CONSTRAINT FK_D072620EA904BFF9 FOREIGN KEY (predefinie_id) REFERENCES commande_predefine (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande_logo_personalise');
    }
}
