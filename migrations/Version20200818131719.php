<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200818131719 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte_visite ADD predefinie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE carte_visite ADD CONSTRAINT FK_A678EC8AA904BFF9 FOREIGN KEY (predefinie_id) REFERENCES carte_visite_filigramme (id)');
        $this->addSql('CREATE INDEX IDX_A678EC8AA904BFF9 ON carte_visite (predefinie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte_visite DROP FOREIGN KEY FK_A678EC8AA904BFF9');
        $this->addSql('DROP INDEX IDX_A678EC8AA904BFF9 ON carte_visite');
        $this->addSql('ALTER TABLE carte_visite DROP predefinie_id');
    }
}
