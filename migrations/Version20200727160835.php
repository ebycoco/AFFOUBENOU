<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200727160835 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_predefine (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, commandelogo_id INT NOT NULL, image_filigrame VARCHAR(255) DEFAULT NULL, image_finale VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_6C074669A76ED395 (user_id), INDEX IDX_6C0746692E8081C (commandelogo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_predefine ADD CONSTRAINT FK_6C074669A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE commande_predefine ADD CONSTRAINT FK_6C0746692E8081C FOREIGN KEY (commandelogo_id) REFERENCES commande_logo (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande_predefine');
    }
}
