<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200728151746 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_logo ADD predefinie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_logo ADD CONSTRAINT FK_8FE29BF0A904BFF9 FOREIGN KEY (predefinie_id) REFERENCES commande_predefine (id)');
        $this->addSql('CREATE INDEX IDX_8FE29BF0A904BFF9 ON commande_logo (predefinie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_logo DROP FOREIGN KEY FK_8FE29BF0A904BFF9');
        $this->addSql('DROP INDEX IDX_8FE29BF0A904BFF9 ON commande_logo');
        $this->addSql('ALTER TABLE commande_logo DROP predefinie_id');
    }
}
