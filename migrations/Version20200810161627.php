<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200810161627 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande_services_web_autre_fonctionnalite');
        $this->addSql('ALTER TABLE commande_services_web DROP detail_site');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_services_web_autre_fonctionnalite (commande_services_web_id INT NOT NULL, autre_fonctionnalite_id INT NOT NULL, INDEX IDX_D6248B85CBA42F84 (autre_fonctionnalite_id), INDEX IDX_D6248B85B5E58E (commande_services_web_id), PRIMARY KEY(commande_services_web_id, autre_fonctionnalite_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commande_services_web_autre_fonctionnalite ADD CONSTRAINT FK_D6248B85B5E58E FOREIGN KEY (commande_services_web_id) REFERENCES commande_services_web (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_services_web_autre_fonctionnalite ADD CONSTRAINT FK_D6248B85CBA42F84 FOREIGN KEY (autre_fonctionnalite_id) REFERENCES autre_fonctionnalite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_services_web ADD detail_site LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
