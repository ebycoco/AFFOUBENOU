<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200803112806 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_finale_perso (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, commandelogoperso_id INT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_F1BBC7FDA76ED395 (user_id), INDEX IDX_F1BBC7FD450FDC8B (commandelogoperso_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_finale_perso ADD CONSTRAINT FK_F1BBC7FDA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE commande_finale_perso ADD CONSTRAINT FK_F1BBC7FD450FDC8B FOREIGN KEY (commandelogoperso_id) REFERENCES commande_logo_personalise (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande_finale_perso');
    }
}
