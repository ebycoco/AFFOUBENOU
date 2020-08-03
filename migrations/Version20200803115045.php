<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200803115045 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_logo_personalise DROP FOREIGN KEY FK_D072620EA904BFF9');
        $this->addSql('DROP INDEX IDX_D072620EA904BFF9 ON commande_logo_personalise');
        $this->addSql('ALTER TABLE commande_logo_personalise ADD niveau VARCHAR(55) NOT NULL, DROP predefinie_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_logo_personalise ADD predefinie_id INT DEFAULT NULL, DROP niveau');
        $this->addSql('ALTER TABLE commande_logo_personalise ADD CONSTRAINT FK_D072620EA904BFF9 FOREIGN KEY (predefinie_id) REFERENCES commande_predefine (id)');
        $this->addSql('CREATE INDEX IDX_D072620EA904BFF9 ON commande_logo_personalise (predefinie_id)');
    }
}
