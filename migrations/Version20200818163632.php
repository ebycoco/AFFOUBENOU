<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200818163632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE affiche ADD predefinie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE affiche ADD CONSTRAINT FK_E4314F0DA904BFF9 FOREIGN KEY (predefinie_id) REFERENCES affiche_filigrame (id)');
        $this->addSql('CREATE INDEX IDX_E4314F0DA904BFF9 ON affiche (predefinie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE affiche DROP FOREIGN KEY FK_E4314F0DA904BFF9');
        $this->addSql('DROP INDEX IDX_E4314F0DA904BFF9 ON affiche');
        $this->addSql('ALTER TABLE affiche DROP predefinie_id');
    }
}
