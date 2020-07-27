<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200726164106 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_logo ADD services_graphisme_id INT NOT NULL, ADD user_id INT NOT NULL, ADD image_name VARCHAR(255) DEFAULT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE commande_logo ADD CONSTRAINT FK_8FE29BF0466E5027 FOREIGN KEY (services_graphisme_id) REFERENCES services_graphisme (id)');
        $this->addSql('ALTER TABLE commande_logo ADD CONSTRAINT FK_8FE29BF0A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_8FE29BF0466E5027 ON commande_logo (services_graphisme_id)');
        $this->addSql('CREATE INDEX IDX_8FE29BF0A76ED395 ON commande_logo (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_logo DROP FOREIGN KEY FK_8FE29BF0466E5027');
        $this->addSql('ALTER TABLE commande_logo DROP FOREIGN KEY FK_8FE29BF0A76ED395');
        $this->addSql('DROP INDEX IDX_8FE29BF0466E5027 ON commande_logo');
        $this->addSql('DROP INDEX IDX_8FE29BF0A76ED395 ON commande_logo');
        $this->addSql('ALTER TABLE commande_logo DROP services_graphisme_id, DROP user_id, DROP image_name, DROP created_at, DROP updated_at');
    }
}
