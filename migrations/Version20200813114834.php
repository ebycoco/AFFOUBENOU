<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200813114834 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_services_web ADD demo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_services_web ADD CONSTRAINT FK_A82CF709214B61EA FOREIGN KEY (demo_id) REFERENCES service_web_demo (id)');
        $this->addSql('CREATE INDEX IDX_A82CF709214B61EA ON commande_services_web (demo_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_services_web DROP FOREIGN KEY FK_A82CF709214B61EA');
        $this->addSql('DROP INDEX IDX_A82CF709214B61EA ON commande_services_web');
        $this->addSql('ALTER TABLE commande_services_web DROP demo_id');
    }
}
