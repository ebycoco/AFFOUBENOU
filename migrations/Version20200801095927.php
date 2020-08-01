<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200801095927 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_logo ADD etat_final_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_logo ADD CONSTRAINT FK_8FE29BF08E01B3BD FOREIGN KEY (etat_final_id) REFERENCES commande_finale (id)');
        $this->addSql('CREATE INDEX IDX_8FE29BF08E01B3BD ON commande_logo (etat_final_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_logo DROP FOREIGN KEY FK_8FE29BF08E01B3BD');
        $this->addSql('DROP INDEX IDX_8FE29BF08E01B3BD ON commande_logo');
        $this->addSql('ALTER TABLE commande_logo DROP etat_final_id');
    }
}
